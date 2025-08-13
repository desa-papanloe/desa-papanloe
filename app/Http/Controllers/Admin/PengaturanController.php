<?php
// app/Http/Controllers/Admin/SettingsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PengaturanController extends Controller
{
    /**
     * Show settings dashboard
     */
    public function index()
    {
        return view('admin.settings.index', [
            'title' => 'Pengaturan Sistem'
        ]);
    }

    /**
     * Show general settings
     */
    public function general()
    {
        // Get current website settings from config or database
        $settings = [
            'site_name' => config('app.name', 'Desa Papanloe'),
            'site_description' => 'Website Resmi Desa Papanloe',
            'site_keywords' => 'desa papanloe, bantaeng, sulawesi selatan',
            'contact_email' => 'info@papanloe.com',
            'contact_phone' => '+62 xxx xxxx xxxx',
            'contact_address' => 'Desa Papanloe, Kec. Xxx, Kab. Bantaeng',
            'maintenance_mode' => false,
        ];

        return view('admin.settings.general', [
            'title' => 'Pengaturan Umum',
            'settings' => $settings
        ]);
    }

    /**
     * Update general settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
            'site_keywords' => 'nullable|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_address' => 'required|string|max:500',
            'maintenance_mode' => 'boolean',
        ]);

        // Here you would typically save to a settings table or config files
        // For now, we'll just return success
        
        return redirect()->route('admin.settings.general')
            ->with('success', 'Pengaturan umum berhasil diperbarui!');
    }

    /**
     * Show users management
     */
    public function users()
    {
        $admins = Admin::latest()->paginate(10);

        return view('admin.settings.users', [
            'title' => 'Manajemen Pengguna',
            'admins' => $admins
        ]);
    }

    /**
     * Create new admin user
     */
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,editor',
            'is_active' => 'boolean',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.settings.users')
            ->with('success', 'Admin baru berhasil ditambahkan!');
    }

    /**
     * Update admin user
     */
    public function updateUser(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore($admin->id),
            ],
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,editor',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_active' => $request->boolean('is_active'),
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.settings.users')
            ->with('success', 'Data admin berhasil diperbarui!');
    }

    /**
     * Delete admin user
     */
    public function deleteUser(Admin $admin)
    {
        // Prevent deleting current user
        if ($admin->id === auth('admin')->id()) {
            return redirect()->route('admin.settings.users')
                ->with('error', 'Tidak dapat menghapus akun Anda sendiri!');
        }

        // Prevent deleting last super admin
        if ($admin->role === 'super_admin' && Admin::where('role', 'super_admin')->count() <= 1) {
            return redirect()->route('admin.settings.users')
                ->with('error', 'Tidak dapat menghapus super admin terakhir!');
        }

        $admin->delete();

        return redirect()->route('admin.settings.users')
            ->with('success', 'Admin berhasil dihapus!');
    }
}