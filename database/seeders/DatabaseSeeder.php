<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Hero;
use App\Models\Layanan;
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

        // Seed Layanan
        $layanans = [
            [
                'title' => 'Keanggotaan',
                'description' => 'Bergabunglah dengan komunitas insinyur Indonesia dan nikmati berbagai keuntungan keanggotaan serta jaringan profesional yang luas.',
                'icon' => '👥',
                'image' => null,
                'link' => '#',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Program Profesi Insinyur',
                'description' => 'Kembangkan kompetensi profesional melalui program pelatihan dan sertifikasi yang diakui secara nasional maupun internasional.',
                'icon' => '🎓',
                'image' => null,
                'link' => '#',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Sertifikasi',
                'description' => 'Dapatkan sertifikasi profesional untuk meningkatkan kredibilitas karir dan kompetensi keinsinyuran Anda.',
                'icon' => '📜',
                'image' => null,
                'link' => '#',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Advokasi',
                'description' => 'Layanan advokasi untuk melindungi hak dan kepentingan profesi insinyur serta memberikan dukungan hukum.',
                'icon' => '⚖️',
                'image' => null,
                'link' => '#',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }

        // Seed Berita
        $beritas = [
            [
                'title' => 'PII Gelar Kongres Nasional Ke-32 di Jakarta',
                'author' => 'Humas PII',
                'excerpt' => 'Persatuan Insinyur Indonesia sukses menyelenggarakan Kongres Nasional ke-32 yang dihadiri oleh lebih dari 500 insinyur dari seluruh Indonesia.',
                'content' => 'Persatuan Insinyur Indonesia sukses menyelenggarakan Kongres Nasional ke-32 yang dihadiri oleh lebih dari 500 insinyur dari seluruh Indonesia. Acara ini membahas berbagai isu strategis terkait pembangunan nasional dan peran insinyur dalam era digital.',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800',
                'published_at' => now()->subDays(2),
                'is_active' => true,
            ],
            [
                'title' => 'Peluncuran Program Sertifikasi Baru untuk Insinyur Muda',
                'author' => 'Divisi Pendidikan',
                'excerpt' => 'PII meluncurkan program sertifikasi baru yang dirancang khusus untuk insinyur muda untuk meningkatkan daya saing di pasar kerja.',
                'content' => 'PII meluncurkan program sertifikasi baru yang dirancang khusus untuk insinyur muda untuk meningkatkan daya saing di pasar kerja. Program ini mencakup berbagai kompetensi teknis dan soft skills yang dibutuhkan di industri 4.0.',
                'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800',
                'published_at' => now()->subDays(5),
                'is_active' => true,
            ],
            [
                'title' => 'Kerjasama PII dengan Berbagai Universitas',
                'author' => 'Kerjasama Luar Negeri',
                'excerpt' => 'PII menjalin kerjasama strategis dengan universitas-universitas terkemuka untuk pengembangan pendidikan keinsinyuran.',
                'content' => 'PII menjalin kerjasama strategis dengan universitas-universitas terkemuka untuk pengembangan pendidikan keinsinyuran. Kerjasama ini meliputi pertukaran mahasiswa, joint research, dan program magang.',
                'image' => 'https://images.unsplash.com/photo-1562774053-701939374585?w=800',
                'published_at' => now()->subDays(7),
                'is_active' => true,
            ],
            [
                'title' => 'Seminar Nasional Teknologi Hijau 2024',
                'author' => 'Panitia Seminar',
                'excerpt' => 'Seminar nasional yang membahas inovasi teknologi hijau untuk mendukung pembangunan berkelanjutan di Indonesia.',
                'content' => 'Seminar nasional yang membahas inovasi teknologi hijau untuk mendukung pembangunan berkelanjutan di Indonesia. Hadirkan pembicara ahli dari dalam dan luar negeri.',
                'image' => 'https://images.unsplash.com/photo-1497436072909-60f360e1d4b1?w=800',
                'published_at' => now()->subDays(10),
                'is_active' => true,
            ],
            [
                'title' => 'Beasiswa PII untuk Mahasiswa Teknik',
                'author' => 'Divisi Beasiswa',
                'excerpt' => 'PII membuka program beasiswa untuk mahasiswa teknik berprestasi dari seluruh Indonesia untuk tahun akademik 2024/2025.',
                'content' => 'PII membuka program beasiswa untuk mahasiswa teknik berprestasi dari seluruh Indonesia untuk tahun akademik 2024/2025. Beasiswa ini mencakup biaya pendidikan dan dukungan pengembangan karir.',
                'image' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=800',
                'published_at' => now()->subDays(14),
                'is_active' => true,
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
