<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo "🌱 Starting database seeding for Desa Papanloe...\n\n";

        // Run AdminSeeder first (required for content creation)
        $this->call(AdminSeeder::class);
        echo "\n";

        // Run ContentSeeder (berita, agenda, layanan)
        $this->call(ContentSeeder::class);
        echo "\n";

        echo "🎉 Database seeding completed successfully!\n";
        echo "🚀 Ready to test the application!\n\n";

        echo "📝 Next steps:\n";
        echo "   1. Run: php artisan serve\n";
        echo "   2. Visit: http://localhost:8000\n";
        echo "   3. Admin login: http://localhost:8000/admin/login\n\n";
    }
}