<?php
// app/Http/Controllers/Admin/AuthController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Admin;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        // Redirect if already authenticated
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Debug: Check if view exists
        $viewPath = 'admin.auth.login';
        
        if (!view()->exists($viewPath)) {
            // Create a simple error response if view doesn't exist
            return response()->view('errors.500', [
                'message' => "Login view tidak ditemukan di: resources/views/admin/auth/login.blade.php"
            ], 500);
        }

        return view($viewPath);
    }

    /**
     * Handle admin login request
     */
    public function login(Request $request)
    {
        // Rate limiting key
        $key = Str::transliterate(Str::lower($request->ip()));
        
        // Check rate limiting
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
            ]);
        }

        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->only('email'));
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Check if admin exists and is active
        $admin = Admin::where('email', $credentials['email'])->first();
        
        if (!$admin) {
            RateLimiter::hit($key, 300); // 5 minutes penalty
            throw ValidationException::withMessages([
                'email' => 'Email tidak terdaftar sebagai admin.'
            ]);
        }

        if (!$admin->is_active) {
            RateLimiter::hit($key, 300);
            throw ValidationException::withMessages([
                'email' => 'Akun admin tidak aktif. Hubungi administrator.'
            ]);
        }

        // Attempt login
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Update last login info
            $admin->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            // Clear rate limiter on successful login
            RateLimiter::clear($key);

            // Redirect to intended page or dashboard
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang, ' . $admin->name . '!');
        }

        // Failed login attempt
        RateLimiter::hit($key, 300);
        
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.'
        ]);
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        $adminName = Auth::guard('admin')->user()->name ?? 'Admin';
        
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Berhasil logout. Sampai jumpa, ' . $adminName . '!');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        $viewPath = 'admin.auth.forgot-password';
        
        if (!view()->exists($viewPath)) {
            return response()->view('errors.500', [
                'message' => "Forgot password view tidak ditemukan di: resources/views/admin/auth/forgot-password.blade.php"
            ], 500);
        }

        return view($viewPath);
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins,email',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar sebagai admin',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if admin is active
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin->is_active) {
            return back()->withErrors([
                'email' => 'Akun admin tidak aktif. Hubungi administrator.'
            ])->withInput();
        }

        // In a real application, you would send a password reset email here
        // For now, just return a success message
        return back()->with('success', 
            'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.'
        );
    }

    /**
     * Show reset password form
     */
    public function showResetPasswordForm(Request $request, $token = null)
    {
        $viewPath = 'admin.auth.reset-password';
        
        if (!view()->exists($viewPath)) {
            return response()->view('errors.500', [
                'message' => "Reset password view tidak ditemukan di: resources/views/admin/auth/reset-password.blade.php"
            ], 500);
        }

        return view($viewPath, compact('token'));
    }

    /**
     * Handle password reset
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'token.required' => 'Token tidak valid',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->only('email'));
        }

        // In a real application, you would verify the token and reset the password
        // For demonstration purposes, let's actually reset the password
        $admin = Admin::where('email', $request->email)->first();
        
        if ($admin && $admin->is_active) {
            $admin->update([
                'password' => Hash::make($request->password),
                'updated_at' => now(),
            ]);
            
            return redirect()->route('admin.login')
                ->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
        }

        return back()->withErrors([
            'email' => 'Terjadi kesalahan. Silakan coba lagi.'
        ])->withInput($request->only('email'));
    }

    /**
     * Show admin profile page
     */
    public function showProfile()
    {
        $admin = Auth::guard('admin')->user();
        $viewPath = 'admin.profile.show';
        
        if (!view()->exists($viewPath)) {
            return response()->view('errors.500', [
                'message' => "Profile view tidak ditemukan di: resources/views/admin/profile/show.blade.php"
            ], 500);
        }

        return view($viewPath, compact('admin'));
    }

    /**
     * Update admin profile
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan admin lain',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
            'avatar.image' => 'File harus berupa gambar',
            'avatar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'avatar.max' => 'Ukuran avatar maksimal 2MB',
            'current_password.required_with' => 'Password lama wajib diisi saat mengubah password',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->only(['name', 'email', 'phone']);

            // Check current password if changing password
            if ($request->filled('password')) {
                if (!Hash::check($request->current_password, $admin->password)) {
                    return back()->withErrors([
                        'current_password' => 'Password lama tidak benar'
                    ])->withInput();
                }
                $data['password'] = Hash::make($request->password);
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($admin->avatar && Storage::disk('public')->exists('admin/avatars/' . $admin->avatar)) {
                    Storage::disk('public')->delete('admin/avatars/' . $admin->avatar);
                }

                $avatar = $request->file('avatar');
                $filename = time() . '_' . Str::random(10) . '.' . $avatar->getClientOriginalExtension();
                
                // Store in admin/avatars directory
                $avatar->storeAs('admin/avatars', $filename, 'public');
                $data['avatar'] = $filename;
            }

            $data['updated_at'] = now();
            $admin->update($data);

            return back()->with('success', 'Profil berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                         ->withInput();
        }
    }

    /**
     * Check admin authentication status (API)
     */
    public function checkAuth(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        if (!$admin) {
            return response()->json([
                'authenticated' => false,
                'message' => 'Not authenticated'
            ], 401);
        }

        if (!$admin->is_active) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            
            return response()->json([
                'authenticated' => false,
                'message' => 'Account deactivated'
            ], 403);
        }

        return response()->json([
            'authenticated' => true,
            'admin' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => $admin->role,
                'avatar_url' => $admin->avatar_url,
                'last_login' => $admin->last_login_at ? $admin->last_login_at->diffForHumans() : null,
            ]
        ]);
    }

    /**
     * Update admin activity timestamp (for online status)
     */
    public function updateActivity(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        if ($admin) {
            $admin->touch(); // Update updated_at timestamp
            
            return response()->json([
                'status' => 'success',
                'timestamp' => now()->toISOString()
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Not authenticated'
        ], 401);
    }

    /**
     * Get admin permissions based on role
     */
    public function getPermissions(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        if (!$admin) {
            return response()->json([
                'error' => 'Not authenticated'
            ], 401);
        }

        $permissions = [];
        
        // Define permissions based on role
        switch ($admin->role) {
            case Admin::ROLE_SUPER_ADMIN:
                $permissions = [
                    'admin.manage', 'admin.create', 'admin.edit', 'admin.delete',
                    'berita.manage', 'berita.create', 'berita.edit', 'berita.delete', 'berita.publish',
                    'agenda.manage', 'agenda.create', 'agenda.edit', 'agenda.delete', 'agenda.publish',
                    'settings.manage', 'system.backup', 'system.logs'
                ];
                break;
                
            case Admin::ROLE_ADMIN:
                $permissions = [
                    'berita.manage', 'berita.create', 'berita.edit', 'berita.delete', 'berita.publish',
                    'agenda.manage', 'agenda.create', 'agenda.edit', 'agenda.delete', 'agenda.publish',
                ];
                break;
                
            case Admin::ROLE_OPERATOR:
                $permissions = [
                    'berita.create', 'berita.edit',
                    'agenda.create', 'agenda.edit',
                ];
                break;
                
            default:
                $permissions = [];
        }

        return response()->json([
            'permissions' => $permissions,
            'role' => $admin->role,
            'role_label' => $admin->role_label
        ]);
    }
}