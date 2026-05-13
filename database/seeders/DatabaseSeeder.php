<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Hero;
use App\Models\Berita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if not exists
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@pii.or.id'],
            [
                'name' => 'Admin PII',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Seed Hero
        Hero::create([
            'title' => 'Selamat Datang di PII',
            'subtitle' => 'Persatuan Insinyur Indonesia - Wadah persatuan dan kesatuan insinyur Indonesia untuk memajukan profesi keinsinyuran dan berkontribusi bagi pembangunan bangsa.',
            'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920',
            'button_text' => 'Bergabung Sekarang',
            'button_link' => '#',
            'is_active' => true,
        ]);

        
        // Call additional seeders
        $this->call([
            BeritaSeeder::class,
            EventSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
