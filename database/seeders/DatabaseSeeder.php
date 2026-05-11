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
                'category' => 'artikel_teknik',
                'author' => 'Humas PII',
                'excerpt' => 'Persatuan Insinyur Indonesia sukses menyelenggarakan Kongres Nasional ke-32 yang dihadiri oleh lebih dari 500 insinyur dari seluruh Indonesia.',
                'content' => '<p>Persatuan Insinyur Indonesia sukses menyelenggarakan Kongres Nasional ke-32 yang dihadiri oleh lebih dari 500 insinyur dari seluruh Indonesia. Acara ini membahas berbagai isu strategis terkait pembangunan nasional dan peran insinyur dalam era digital.</p><p>Kongres yang berlangsung selama tiga hari ini menghasilkan beberapa rekomendasi penting untuk pengembangan profesi keinsinyuran di Indonesia. Para peserta aktif berdiskusi tentang tantangan dan peluang yang dihadapi oleh insinyur Indonesia di era globalisasi.</p><p>"Kita harus memastikan bahwa insinyur Indonesia siap menghadapi revolusi industri 4.0. Ini bukan lagi tentang pilihan, tapi keharusan," ujar Ketua Umum PII dalam sambutannya.</p>',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800',
                'published_at' => now()->subDays(2),
                'is_active' => true,
            ],
            [
                'title' => 'Peluncuran Program Sertifikasi Baru untuk Insinyur Muda',
                'category' => 'regulasi',
                'author' => 'Divisi Pendidikan',
                'excerpt' => 'PII meluncurkan program sertifikasi baru yang dirancang khusus untuk insinyur muda untuk meningkatkan daya saing di pasar kerja.',
                'content' => '<p>PII meluncurkan program sertifikasi baru yang dirancang khusus untuk insinyur muda untuk meningkatkan daya saing di pasar kerja. Program ini mencakup berbagai kompetensi teknis dan soft skills yang dibutuhkan di industri 4.0.</p><p>Program sertifikasi ini terdiri dari beberapa level, mulai dari junior engineer hingga professional engineer. Setiap level memiliki kriteria dan standar kompetensi yang harus dipenuhi oleh peserta.</p><p>"Dengan adanya program ini, kami berharap dapat meningkatkan kualitas insinyur Indonesia secara menyeluruh," jelas Direktur Pendidikan PII.</p>',
                'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800',
                'published_at' => now()->subDays(5),
                'is_active' => true,
            ],
            [
                'title' => 'Kerjasama PII dengan Berbagai Universitas',
                'category' => 'inovasi',
                'author' => 'Kerjasama Luar Negeri',
                'excerpt' => 'PII menjalin kerjasama strategis dengan universitas-universitas terkemuka untuk pengembangan pendidikan keinsinyuran.',
                'content' => '<p>PII menjalin kerjasama strategis dengan universitas-universitas terkemuka untuk pengembangan pendidikan keinsinyuran. Kerjasama ini meliputi pertukaran mahasiswa, joint research, dan program magang.</p><p>Beberapa universitas yang telah menjalin kerjasama meliputi ITB, UI, UGM, dan ITS. Kerjasama ini diharapkan dapat menjembatani dunia akademik dengan dunia industri.</p><p>"Kolaborasi antara perguruan tinggi dan organisasi profesi sangat penting untuk memastikan lulusan siap kerja," ujar salah satu dekan teknik yang hadir dalam penandatanganan MoU.</p>',
                'image' => 'https://images.unsplash.com/photo-1562774053-701939374585?w=800',
                'published_at' => now()->subDays(7),
                'is_active' => true,
            ],
            [
                'title' => 'Seminar Nasional Teknologi Hijau 2024',
                'category' => 'inovasi',
                'author' => 'Panitia Seminar',
                'excerpt' => 'Seminar nasional yang membahas inovasi teknologi hijau untuk mendukung pembangunan berkelanjutan di Indonesia.',
                'content' => '<p>Seminar nasional yang membahas inovasi teknologi hijau untuk mendukung pembangunan berkelanjutan di Indonesia. Hadirkan pembicara ahli dari dalam dan luar negeri.</p><p>Teknologi hijau menjadi fokus utama dalam seminar ini, mengingat komitmen Indonesia untuk mengurangi emisi karbon. Berbagai solusi inovatif dari insinyur Indonesia dipresentasikan dalam acara ini.</p><p>"Insinyur memiliki peran penting dalam menciptakan solusi teknologi yang ramah lingkungan," tegas salah satu pembicara kunci.</p>',
                'image' => 'https://images.unsplash.com/photo-1497436072909-60f360e1d4b1?w=800',
                'published_at' => now()->subDays(10),
                'is_active' => true,
            ],
            [
                'title' => 'Beasiswa PII untuk Mahasiswa Teknik',
                'category' => 'artikel_teknik',
                'author' => 'Divisi Beasiswa',
                'excerpt' => 'PII membuka program beasiswa untuk mahasiswa teknik berprestasi dari seluruh Indonesia untuk tahun akademik 2024/2025.',
                'content' => '<p>PII membuka program beasiswa untuk mahasiswa teknik berprestasi dari seluruh Indonesia untuk tahun akademik 2024/2025. Beasiswa ini mencakup biaya pendidikan dan dukungan pengembangan karir.</p><p>Program beasiswa ini terbuka untuk mahasiswa semester 3-7 dari berbagai disiplin teknik. Seleksi dilakukan berdasarkan prestasi akademik, aktivitas organisasi, dan wawancara.</p><p>"Kami berkomitmen untuk mendukung generasi muda Indonesia yang berbakat di bidang teknik," ungkap Ketua Divisi Beasiswa PII.</p>',
                'image' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=800',
                'published_at' => now()->subDays(14),
                'is_active' => true,
            ],
            [
                'title' => 'Perubahan Regulasi Sertifikat Kompetensi Insinyur 2024',
                'category' => 'regulasi',
                'author' => 'Divisi Regulasi',
                'excerpt' => 'Pemerintah mengeluarkan regulasi baru terkait sertifikat kompetensi insinyur yang berlaku mulai tahun 2024.',
                'content' => '<p>Pemerintah melalui Kementerian PUPR mengeluarkan regulasi baru terkait sertifikat kompetensi insinyur yang berlaku mulai tahun 2024. Regulasi ini membawa beberapa perubahan signifikan dalam proses sertifikasi.</p><p>Beberapa poin penting dalam regulasi baru meliputi: penambahan kompetensi digital, peningkatan standar keselamatan, dan adopsi standar internasional.</p><p>PII menyambut baik regulasi ini dan berkomitmen untuk membantu anggota dalam proses transisi menuju sistem yang baru.</p>',
                'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800',
                'published_at' => now()->subDays(8),
                'is_active' => true,
            ],
            [
                'title' => 'Inovasi AI dalam Perencanaan Proyek Konstruksi',
                'category' => 'inovasi',
                'author' => 'Divisi Teknologi',
                'excerpt' => 'Pemanfaatan kecerdasan buatan (AI) semakin merambah ke dunia konstruksi, membawa efisiensi yang signifikan.',
                'content' => '<p>Pemanfaatan kecerdasan buatan (AI) semakin merambah ke dunia konstruksi, membawa efisiensi yang signifikan dalam perencanaan dan pelaksanaan proyek.</p><p>Beberapa perusahaan konstruksi besar di Indonesia telah mulai mengadopsi teknologi AI untuk optimasi jadwal, prediksi risiko, dan manajemen sumber daya.</p><p>"AI bukan pengganti insinyur, tapi alat bantu yang sangat powerful untuk meningkatkan akurasi dan efisiensi," jelas pakar konstruksi yang menjadi narasumber.</p>',
                'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800',
                'published_at' => now()->subDays(3),
                'is_active' => true,
            ],
            [
                'title' => 'Masa Depan Profesi Insinyur di Era Digital',
                'category' => 'opini',
                'author' => 'Prof. Dr. Ahmad Santoso',
                'excerpt' => 'Refleksi tentang bagaimana profesi keinsinyuran harus beradaptasi dengan perkembangan teknologi digital.',
                'content' => '<p>Profesi keinsinyuran sedang menghadapi titik balik yang penting. Era digital tidak hanya mengubah cara kita bekerja, tapi juga mengubah esensi dari apa yang menjadi tanggung jawab seorang insinyur.</p><p>Di masa depan, insinyur tidak hanya dituntut untuk memahami fisika dan matematika, tapi juga harus menguasai data science, pemrograman, dan berbagai soft skills baru.</p><p>Adaptasi adalah kunci. Insinyur yang mampu menggabungkan pengetahuan teknik klasik dengan keterampilan digital akan menjadi pemimpin di era baru ini.</p>',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800',
                'published_at' => now()->subDays(4),
                'is_active' => true,
            ],
            [
                'title' => 'Peran Insinyur dalam Pembangunan Berkelanjutan',
                'category' => 'opini',
                'author' => 'Dr. Rina Wijaya',
                'excerpt' => 'Tanggung jawab insinyur tidak hanya menciptakan struktur yang kuat, tapi juga yang berkelanjutan bagi generasi mendatang.',
                'content' => '<p>Ketika kita berbicara tentang pembangunan berkelanjutan, peran insinyur menjadi sangat sentral. Setiap keputusan desain yang kita buat hari ini akan berdampak puluhan tahun ke depan.</p><p>Insinyur harus mulai memikirkan siklus hidup penuh dari setiap proyek, bukan hanya aspek konstruksi. Ini berarti mempertimbangkan dampak lingkungan, efisiensi energi, dan kemudahan perawatan.</p><p>Komitmen terhadap sustainability bukan lagi pilihan, tapi keharusan bagi profesi kita.</p>',
                'image' => 'https://images.unsplash.com/photo-1518173946687-a4c036bc3c95?w=800',
                'published_at' => now()->subDays(6),
                'is_active' => true,
            ],
            [
                'title' => 'Teknik Sipil dan Tantangan Perubahan Iklim',
                'category' => 'artikel_teknik',
                'author' => 'Ir. Budi Hartono, M.Eng',
                'excerpt' => 'Perubahan iklim membawa tantangan baru bagi insinyur sipil dalam merancang infrastruktur yang tangguh.',
                'content' => '<p>Perubahan iklim bukan lagi isu abstrak. Bagi insinyur sipil, ini adalah realitas yang harus dihadapi setiap hari dalam bentuk cuaca ekstrem, kenaikan muka air laut, dan perubahan pola curah hujan.</p><p>Infrastruktur yang kita bangun 20 tahun lalu mungkin tidak cukup kuat menghadapi kondisi iklim saat ini. Ini berarti kita perlu merevisi banyak standar dan spesifikasi teknis.</p><p>Resilience menjadi kata kunci dalam setiap proyek konstruksi modern. Bangunan tidak hanya harus kuat, tapi juga adaptif terhadap perubahan lingkungan.</p>',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800',
                'published_at' => now()->subDays(9),
                'is_active' => true,
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create($berita);
        }
    }
}
