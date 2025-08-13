<?php
// app/Http/Controllers/Admin/ProfileController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the admin profile
     */
    public function show()
    {
        $admin = Auth::guard('admin')->user();
        
        return view('admin.profile.show', [
            'admin' => $admin,
            'title' => 'Profil Saya'
        ]);
    }

    /**
     * Show the edit profile form
     */
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        
        return view('admin.profile.edit', [
            'admin' => $admin,
            'title' => 'Edit Profil'
        ]);
    }

    /**
     * Update the admin profile
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins')->ignore($admin->id),
            ],
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'bio']);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($admin->avatar && Storage::disk('public')->exists($admin->avatar)) {
                Storage::disk('public')->delete($admin->avatar);
            }

            $avatarPath = $request->file('avatar')->store('admin/avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        $admin->update($data);

        return redirect()->route('admin.profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update the admin password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $admin = Auth::guard('admin')->user();

        // Verify current password
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak benar.'
            ])->withInput();
        }

        // Update password
        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.profile.show')
            ->with('success', 'Password berhasil diperbarui!');
    }

    /**
     * Delete avatar
     */
    public function deleteAvatar()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->avatar && Storage::disk('public')->exists($admin->avatar)) {
            Storage::disk('public')->delete($admin->avatar);
            
            $admin->update(['avatar' => null]);
            
            return response()->json([
                'success' => true,
                'message' => 'Avatar berhasil dihapus!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Avatar tidak ditemukan.'
        ], 404);
    }
}