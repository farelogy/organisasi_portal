<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Konvensi Insinyur Nasional 2024',
                'description' => 'Ribuan insinyur dari seluruh Indonesia berkumpul dalam acara tahunan yang membahas perkembangan teknologi dan inovasi di bidang keinsinyuran.',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80',
                'category' => 'konferensi',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Workshop Sertifikasi Profesi Insinyur',
                'description' => 'Pelatihan intensif bagi calon insinyur profesional yang ingin memperoleh sertifikasi kompetensi nasional.',
                'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80',
                'category' => 'pelatihan',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Kunjungan ke Proyek Infrastruktur Tol Cisumdawu',
                'description' => 'Delegasi PII melakukan kunjungan lapangan untuk meninjau progres pembangunan jalan tol strategis nasional.',
                'image' => 'https://images.unsplash.com/photo-1590642916589-592bca10dfbf?w=800&q=80',
                'category' => 'kegiatan',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Seminar Teknologi Konstruksi Modern',
                'description' => 'Pemaparan terkini tentang penerapan Building Information Modeling (BIM) dan teknologi konstruksi ramah lingkungan.',
                'image' => 'https://images.unsplash.com/photo-1475721027767-4d529c3c4096?w=800&q=80',
                'category' => 'seminar',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Pelantikan Ketua Umum PII Periode Baru',
                'description' => 'Acara pelantikan ketua umum dan pengurus PII periode 2024-2028 di hadapan anggota dan tamu undangan.',
                'image' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=800&q=80',
                'category' => 'kegiatan',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Manajemen Proyek untuk Insinyur',
                'description' => 'Program pelatihan certifikasi manajemen proyek yang diselenggarakan bekerja sama dengan lembaga internasional.',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80',
                'category' => 'pelatihan',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Diskusi Panel: Masa Depan Energi Terbarukan',
                'description' => 'Para pakar energi membahas tantangan dan peluang transisi energi di Indonesia menuju net zero emission 2060.',
                'image' => 'https://images.unsplash.com/photo-1466611653911-95081537e5b7?w=800&q=80',
                'category' => 'seminar',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Kunjungan ke Pembangkit Listrik Tenaga Panas Bumi',
                'description' => 'Studi banding lapangan mengenai pemanfaatan energi panas bumi sebagai sumber energi bersih dan berkelanjutan.',
                'image' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=800&q=80',
                'category' => 'kegiatan',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Workshop Keamanan Siber untuk Insinyur',
                'description' => 'Pelatihan praktis mengenai perlindungan sistem infrastruktur kritis dari ancaman serangan siber.',
                'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&q=80',
                'category' => 'workshop',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Konferensi Jembatan dan Terowongan Asia Tenggara',
                'description' => 'Forum regional yang membahas inovasi teknologi pembangunan jembatan dan terowongan di kawasan Asia Tenggara.',
                'image' => 'https://images.unsplash.com/photo-1444313431167-e7921088a9d3?w=800&q=80',
                'category' => 'konferensi',
                'order' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Peluncuran Buku Panduan Insinyur Indonesia',
                'description' => 'Acara peluncuran publikasi resmi PII yang menjadi referensi komprehensif bagi para praktisi keinsinyuran.',
                'image' => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=800&q=80',
                'category' => 'kegiatan',
                'order' => 11,
                'is_active' => true,
            ],
            [
                'title' => 'Workshop Teknologi 3D Printing untuk Konstruksi',
                'description' => 'Demonstrasi langsung penerapan teknologi cetak tiga dimensi dalam pembuatan komponen struktur bangunan.',
                'image' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=800&q=80',
                'category' => 'workshop',
                'order' => 12,
                'is_active' => true,
            ],
            [
                'title' => 'Seminar Transportasi Cerdas dan Mobilitas Berkelanjutan',
                'description' => 'Diskusi mendalam tentang konsep smart transportation dan implementasinya di kota-kota besar Indonesia.',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80',
                'category' => 'seminar',
                'order' => 13,
                'is_active' => true,
            ],
            [
                'title' => 'Kunjungan ke Pabrik Precast Beton Modern',
                'description' => 'Tur produksi untuk melihat proses pembuatan komponen beton pracetak dengan teknologi otomasi terkini.',
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80',
                'category' => 'kegiatan',
                'order' => 14,
                'is_active' => true,
            ],
            [
                'title' => 'Webinar: Keterampilan Kepemimpinan untuk Insinyur',
                'description' => 'Sesi online interaktif mengenai pengembangan soft skills kepemimpinan yang esensial bagi para profesional teknik.',
                'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800&q=80',
                'category' => 'webinar',
                'order' => 15,
                'is_active' => true,
            ],
            [
                'title' => 'Pameran Teknologi Konstruksi Indonesia 2024',
                'description' => 'Pameran tahunan yang menampilkan produk dan solusi teknologi terbaru dari perusahaan konstruksi nasional.',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&q=80',
                'category' => 'event',
                'order' => 16,
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Desain Jembatan dengan Software Midas',
                'description' => 'Kursus teknis tentang penggunaan software analisis struktur untuk perencanaan jembatan modern.',
                'image' => 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=800&q=80',
                'category' => 'pelatihan',
                'order' => 17,
                'is_active' => true,
            ],
            [
                'title' => 'Seminar Nasional Mitigasi Bencana Alam',
                'description' => 'Pertemuan ilmiah mengenai strategi rekayasa untuk mengurangi risiko bencana gempa bumi dan tsunami.',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&q=80',
                'category' => 'seminar',
                'order' => 18,
                'is_active' => true,
            ],
            [
                'title' => 'Kegiatan Sosial PII: Pembangunan Jembatan Desa',
                'description' => 'Program pengabdian masyarakat melibatkan relawan insinyur dalam pembangunan infrastruktur dasar di daerah terpencil.',
                'image' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800&q=80',
                'category' => 'kegiatan',
                'order' => 19,
                'is_active' => true,
            ],
            [
                'title' => 'Workshop Penggunaan Drone untuk Survey dan Pemetaan',
                'description' => 'Pelatihan pengoperasian drone untuk keperluan pemetaan topografi dan inspeksi infrastruktur.',
                'image' => 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?w=800&q=80',
                'category' => 'workshop',
                'order' => 20,
                'is_active' => true,
            ],
            [
                'title' => 'Konferensi Internasional Teknik Sipil Asia',
                'description' => 'Forum ilmiah berskala internasional yang mengumpulkan peneliti dan praktisi teknik sipil dari berbagai negara.',
                'image' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800&q=80',
                'category' => 'konferensi',
                'order' => 21,
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Sistem Manajemen Mutu ISO 9001',
                'description' => 'Program sertifikasi internal bagi anggota PII dalam implementasi sistem manajemen mutu proyek.',
                'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&q=80',
                'category' => 'pelatihan',
                'order' => 22,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
