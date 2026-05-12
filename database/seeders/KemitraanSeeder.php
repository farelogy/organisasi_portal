<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kemitraan;

class KemitraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kerjasama Kampus - 10 partners
        $kampusPartners = [
            [
                'name' => 'Institut Teknologi Bandung',
                'type' => 'kerjasama_kampus',
                'description' => 'Kerjasama dalam bidang riset dan pengembangan teknologi terkini untuk mendukung inovasi industri.',
                'logo' => 'https://via.placeholder.com/300?text=ITB',
                'link' => 'https://www.itb.ac.id',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Indonesia',
                'type' => 'kerjasama_kampus',
                'description' => 'Kolaborasi dalam pengembangan kurikulum dan pelatihan untuk generasi insinyur Indonesia.',
                'logo' => 'https://via.placeholder.com/300?text=UI',
                'link' => 'https://www.ui.ac.id',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Institut Teknologi Sepuluh Nopember',
                'type' => 'kerjasama_kampus',
                'description' => 'Kemitraan strategis dalam pengembangan talenta insinyur profesional di bidang teknik.',
                'logo' => 'https://via.placeholder.com/300?text=ITS',
                'link' => 'https://www.its.ac.id',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Gadjah Mada',
                'type' => 'kerjasama_kampus',
                'description' => 'Kontribusi bersama dalam penelitian dan pengembangan solusi teknik berkelanjutan.',
                'logo' => 'https://via.placeholder.com/300?text=UGM',
                'link' => 'https://www.ugm.ac.id',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Diponegoro',
                'type' => 'kerjasama_kampus',
                'description' => 'Program bersama untuk pemberdayaan sumber daya manusia di bidang keteknikan.',
                'logo' => 'https://via.placeholder.com/300?text=UNDIP',
                'link' => 'https://www.undip.ac.id',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Padjadjaran',
                'type' => 'kerjasama_kampus',
                'description' => 'Kerjasama dalam pengembangan program studi dan sertifikasi keahlian insinyur.',
                'logo' => 'https://via.placeholder.com/300?text=UNPAD',
                'link' => 'https://www.unpad.ac.id',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Sumatera Utara',
                'type' => 'kerjasama_kampus',
                'description' => 'Kolaborasi untuk meningkatkan standar pendidikan teknik di kawasan Indonesia Timur.',
                'logo' => 'https://via.placeholder.com/300?text=USU',
                'link' => 'https://www.usu.ac.id',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Hasanuddin',
                'type' => 'kerjasama_kampus',
                'description' => 'Program pengembangan profesional dan sertifikasi bagi mahasiswa teknik.',
                'logo' => 'https://via.placeholder.com/300?text=UNHAS',
                'link' => 'https://www.unhas.ac.id',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Brawijaya',
                'type' => 'kerjasama_kampus',
                'description' => 'Kemitraan dalam penelitian aplikatif dan pengembangan teknologi berkelanjutan.',
                'logo' => 'https://via.placeholder.com/300?text=UB',
                'link' => 'https://www.ub.ac.id',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Andalas',
                'type' => 'kerjasama_kampus',
                'description' => 'Kerjasama dalam pengembangan program magang dan penempatan profesional.',
                'logo' => 'https://via.placeholder.com/300?text=UNAND',
                'link' => 'https://www.unand.ac.id',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        // Kerjasama Industri - 10 partners
        $industriPartners = [
            [
                'name' => 'PT Telkom Indonesia',
                'type' => 'kerjasama_industri',
                'description' => 'Kerjasama dalam infrastruktur telekomunikasi dan transformasi digital.',
                'logo' => 'https://via.placeholder.com/300?text=Telkom',
                'link' => 'https://www.telkom.co.id',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'PT Pertamina',
                'type' => 'kerjasama_industri',
                'description' => 'Kolaborasi dalam industri energi dan manajemen proyek infrastruktur.',
                'logo' => 'https://via.placeholder.com/300?text=Pertamina',
                'link' => 'https://www.pertamina.com',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'PT PLN',
                'type' => 'kerjasama_industri',
                'description' => 'Kerjasama strategis dalam pengembangan energi terbarukan dan efisiensi energi.',
                'logo' => 'https://via.placeholder.com/300?text=PLN',
                'link' => 'https://www.pln.co.id',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PT Jasa Marga',
                'type' => 'kerjasama_industri',
                'description' => 'Kemitraan dalam pengembangan infrastruktur jalan dan transportasi modern.',
                'logo' => 'https://via.placeholder.com/300?text=Jasa+Marga',
                'link' => 'https://www.jmb.co.id',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'PT Konstruksi Surveyor Indonesia',
                'type' => 'kerjasama_industri',
                'description' => 'Kolaborasi dalam survei teknik dan konsultasi proyek besar.',
                'logo' => 'https://via.placeholder.com/300?text=KSI',
                'link' => '#',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'PT Semen Indonesia',
                'type' => 'kerjasama_industri',
                'description' => 'Kerjasama dalam teknologi produksi dan manajemen operasional industri.',
                'logo' => 'https://via.placeholder.com/300?text=Semen+Indonesia',
                'link' => 'https://www.semenbali.co.id',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'PT Indonesia Power',
                'type' => 'kerjasama_industri',
                'description' => 'Kemitraan dalam pembangkit energi dan teknologi power generation.',
                'logo' => 'https://via.placeholder.com/300?text=Indonesia+Power',
                'link' => '#',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Wika Gedhe Construction',
                'type' => 'kerjasama_industri',
                'description' => 'Kolaborasi dalam proyek konstruksi dan engineering services.',
                'logo' => 'https://via.placeholder.com/300?text=Wika',
                'link' => '#',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'PT Hyundai Engineering & Construction',
                'type' => 'kerjasama_industri',
                'description' => 'Kerjasama internasional dalam teknologi konstruksi dan proyek infrastruktur.',
                'logo' => 'https://via.placeholder.com/300?text=Hyundai',
                'link' => '#',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'PT Freeport Indonesia',
                'type' => 'kerjasama_industri',
                'description' => 'Kemitraan dalam pertambangan dan operasi industrial skala besar.',
                'logo' => 'https://via.placeholder.com/300?text=Freeport',
                'link' => '#',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        // Program Pemerintah - 10 partners
        $pemerintahPartners = [
            [
                'name' => 'Kementerian PUPR',
                'type' => 'program_pemerintah',
                'description' => 'Kolaborasi dalam pengembangan infrastruktur publik dan peraturan teknis.',
                'logo' => 'https://via.placeholder.com/300?text=Kemen+PUPR',
                'link' => 'https://www.pu.go.id',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Kementerian Perindustrian',
                'type' => 'program_pemerintah',
                'description' => 'Program bersama untuk pengembangan industri manufaktur Indonesia.',
                'logo' => 'https://via.placeholder.com/300?text=Kemen+Perindustrian',
                'link' => 'https://kemenperin.go.id',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Kementerian Energi dan SDM',
                'type' => 'program_pemerintah',
                'description' => 'Kerjasama dalam pengembangan energi terbarukan dan sumber daya manusia.',
                'logo' => 'https://via.placeholder.com/300?text=Kemen+Energi',
                'link' => 'https://www.esdm.go.id',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Standardisasi Nasional',
                'type' => 'program_pemerintah',
                'description' => 'Kolaborasi dalam penetapan standar teknik dan sertifikasi profesional.',
                'logo' => 'https://via.placeholder.com/300?text=BSN',
                'link' => 'https://www.bsn.go.id',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Kementerian Pendidikan dan Kebudayaan',
                'type' => 'program_pemerintah',
                'description' => 'Program pengembangan kurikulum pendidikan teknik nasional.',
                'logo' => 'https://via.placeholder.com/300?text=Kemen+Pendidikan',
                'link' => 'https://www.kemdikbud.go.id',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Lembaga Ilmu Pengetahuan Indonesia',
                'type' => 'program_pemerintah',
                'description' => 'Kemitraan dalam penelitian dan pengembangan teknologi nasional.',
                'logo' => 'https://via.placeholder.com/300?text=LIPI',
                'link' => 'https://www.lipi.go.id',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Kementerian Perhubungan',
                'type' => 'program_pemerintah',
                'description' => 'Kolaborasi dalam pengembangan transportasi dan infrastruktur mobilitas.',
                'logo' => 'https://via.placeholder.com/300?text=Kemen+Perhubungan',
                'link' => 'https://www.kemenhub.go.id',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Badan Penelitian dan Pengembangan',
                'type' => 'program_pemerintah',
                'description' => 'Program penelitian dan inovasi teknologi untuk pembangunan nasional.',
                'logo' => 'https://via.placeholder.com/300?text=BPP',
                'link' => '#',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Otoritas Jasa Keuangan',
                'type' => 'program_pemerintah',
                'description' => 'Kerjasama dalam pengaturan industri keuangan dan infrastruktur finansial.',
                'logo' => 'https://via.placeholder.com/300?text=OJK',
                'link' => 'https://www.ojk.go.id',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Kementerian Lingkungan Hidup',
                'type' => 'program_pemerintah',
                'description' => 'Program bersama untuk pembangunan berkelanjutan dan efisiensi lingkungan.',
                'logo' => 'https://via.placeholder.com/300?text=Kemen+LH',
                'link' => 'https://www.menlhk.go.id',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        // Insert all data
        Kemitraan::insert(array_merge($kampusPartners, $industriPartners, $pemerintahPartners));
    }
}
