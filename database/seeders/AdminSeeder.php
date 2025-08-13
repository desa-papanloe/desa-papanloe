<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@desapapanloe.id',
            'password' => Hash::make('password123'),
            'role' => Admin::ROLE_SUPER_ADMIN,
            'phone' => '081234567890',
            'is_active' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin Utama
        Admin::create([
            'name' => 'Admin Desa Papanloe',
            'email' => 'admin@desapapanloe.id',
            'password' => Hash::make('admin123'),
            'role' => Admin::ROLE_ADMIN,
            'phone' => '081234567891',
            'is_active' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Operator 1
        Admin::create([
            'name' => 'Operator Berita',
            'email' => 'operator.berita@desapapanloe.id',
            'password' => Hash::make('operator123'),
            'role' => Admin::ROLE_OPERATOR,
            'phone' => '081234567892',
            'is_active' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Operator 2
        Admin::create([
            'name' => 'Operator Layanan',
            'email' => 'operator.layanan@desapapanloe.id',
            'password' => Hash::make('operator123'),
            'role' => Admin::ROLE_OPERATOR,
            'phone' => '081234567893',
            'is_active' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        echo "✅ AdminSeeder: 4 admin accounts created successfully!\n";
        echo "📧 Login credentials:\n";
        echo "   Super Admin: superadmin@desapapanloe.id / password123\n";
        echo "   Admin: admin@desapapanloe.id / admin123\n";
        echo "   Operator Berita: operator.berita@desapapanloe.id / operator123\n";
        echo "   Operator Layanan: operator.layanan@desapapanloe.id / operator123\n";
    }
}