# Data Berita Scraped dari pii.or.id

**Tanggal scraping:** 2026-05-22 16:08:25  
**Sumber:** https://www.pii.or.id/kabar/berita  
**Total berita:** 20 artikel  

## Isi Folder

| File/Folder | Keterangan |
|---|---|
| `images/` | Folder berisi 20 gambar cover berita |
| `berita_data.json` | Data berita dalam format JSON (lengkap dengan konten HTML & teks) |
| `berita_import.sql` | Script SQL untuk import ke database SQLite |
| `scrape_pii_berita.py` | Script Python yang digunakan untuk scraping |

## Cara Import ke Database

### Opsi 1: Via Admin Panel
Masukkan manual satu per satu melalui halaman admin.  
Gambar sudah tersimpan di `images/`, copy ke `public/uploads/beritas/`.

### Opsi 2: Via SQL (SQLite)
1. Copy folder `images/` ke `public/uploads/beritas/`
2. Buka database dengan SQLite browser atau via artisan tinker:
   ```bash
   php artisan tinker
   DB::unprepared(file_get_contents('scraped_berita/berita_import.sql'));
   ```

### Opsi 3: Via Laravel Seeder
Buat seeder yang membaca `berita_data.json`:
```php
$beritas = json_decode(file_get_contents(base_path('scraped_berita/berita_data.json')), true);
foreach ($beritas as $b) {
    Berita::create([...]);
}
```

## Daftar Berita
1. **6 Hari Lagi Pendaftaran Akan Ditutup  APLIKASI ASEAN ENGINEER BATCH 1/2026**  
   - Kategori: Sertifikat Internasional | Author: Septya Sekar | Tanggal: 2026-05-21
   - Gambar: `berita_01_6-hari-lagi-pendaftaran-akan-ditutup-apl.jpeg`

2. **PII Jawa Timur Gelar Muswil, Gentur Prihantono Kembali Terpilih sebagai Ketua**  
   - Kategori: Muswil | Author: Septya Sekar | Tanggal: 2026-05-12
   - Gambar: `berita_02_pii-jawa-timur-gelar-muswil-gentur-priha.jpeg`

3. **Tragedi di Bekasi Timur bukan sekadar insiden ini adalah pengingat bahwa keselamatan dalam sistem perkeretaapian tidak boleh ditawar.**  
   - Kategori: Teknologi | Author: Septya Sekar | Tanggal: 2026-05-07
   - Gambar: `berita_03_tragedi-di-bekasi-timur-bukan-sekadar-in.png`

4. **Indeks Keinsinyuran hingga  Giant Sea Wall Dibahas dalam Audiensi Bersama Pemprov DKI Jakarta dan PII**  
   - Kategori: Audiensi | Author: Septya Sekar | Tanggal: 2026-05-05
   - Gambar: `berita_04_indeks-keinsinyuran-hingga-giant-sea-wal.jpeg`

5. **Pelantikan dan Pengambilan Sumpah PSPPI Fakultas Teknik Universitas Katolik Widya Mandala Surabaya Tahun Akademik 2025/2026**  
   - Kategori: Pelantikan PSPPI | Author: Septya Sekar | Tanggal: 2026-04-24
   - Gambar: `berita_05_pelantikan-dan-pengambilan-sumpah-psppi.jpeg`

6. **PII turut menghadiri 67th Annual Dinner & Awards Night 2026 yang diselenggarakan oleh The Institution of Engineers, Malaysia (IEM)**  
   - Kategori: Meeting | Author: Septya Sekar | Tanggal: 2026-04-24
   - Gambar: `berita_06_pii-turut-menghadiri-67th-annual-dinner.png`

7. **PII Perkuat Koordinasi CAFEO 44 di AFEO Sekretariat**  
   - Kategori: AFEO | Author: Septya Sekar | Tanggal: 2026-04-24
   - Gambar: `berita_07_pii-perkuat-koordinasi-cafeo-44-di-afeo.png`

8. **Pertemuan yang produktif dalam kerangka Indonesia–Malaysia–Thailand Growth Triangle (IMT-GT) di Kuala Lumpur,**  
   - Kategori: Audiensi | Author: Septya Sekar | Tanggal: 2026-04-22
   - Gambar: `berita_08_pertemuan-yang-produktif-dalam-kerangka.jpeg`

9. **PII turut menghadiri Peluncuran & Diskusi Buku “Dari Loyang Jadi Emas”,**  
   - Kategori: Pelayanan | Author: Septya Sekar | Tanggal: 2026-04-17
   - Gambar: `berita_09_pii-turut-menghadiri-peluncuran-diskusi.jpg`

10. **PII Wilayah Jawa Timur menyelenggarakan Rapimwil yang berangkaian dengan kegiatan Halal Bihalal 1447 H pada Sabtu, 11 April 2026**  
   - Kategori: Pelayanan | Author: Septya Sekar | Tanggal: 2026-04-17
   - Gambar: `berita_10_pii-wilayah-jawa-timur-menyelenggarakan.png`

11. **Persatuan Insinyur Indonesia (PII) menerima kunjungan dari The Institution of Engineers Singapore**  
   - Kategori: Meeting | Author: Septya Sekar | Tanggal: 2026-04-17
   - Gambar: `berita_11_persatuan-insinyur-indonesia-pii-menerim.jpg`

12. **Webinar GOES 2.0 III Bahas Regulasi Data Center untuk Mendukung Infrastruktur Digital Indonesia**  
   - Kategori: Sertifikat Internasional | Author: Septya Sekar | Tanggal: 2026-04-02
   - Gambar: `berita_12_webinar-goes-20-iii-bahas-regulasi-data.jpeg`

13. **PII Riau Gelar Buka Puasa Bersama dan Executive Talk Bahas Ketahanan Energi Nasional**  
   - Kategori: Sarasehan & FGD | Author: PW Riau | Tanggal: 2026-03-14
   - Gambar: `berita_13_pii-riau-gelar-buka-puasa-bersama-dan-ex.jpg`

14. **PII Cabang Makassar Dorong Kolaborasi Atasi Persoalan Perkotaan**  
   - Kategori: Perwakilan Wilayah PII | Author: Septya Sekar | Tanggal: 2026-03-09
   - Gambar: `berita_14_pii-cabang-makassar-dorong-kolaborasi-at.jpeg`

15. **Pengambilan Sumpah 24 Insinyur PPI IPB**  
   - Kategori: Pelantikan PSPPI | Author: Septya Sekar | Tanggal: 2026-02-25
   - Gambar: `berita_15_pengambilan-sumpah-24-insinyur-ppi-ipb.png`

16. **Persatuan Insinyur Indonesia (PII) Wilayah Jawa Barat menggelar Musyawarah Wilayah (Muswil) ke-3**  
   - Kategori: Pelantikan PSPPI | Author: Septya Sekar | Tanggal: 2026-02-20
   - Gambar: `berita_16_persatuan-insinyur-indonesia-pii-wilayah.png`

17. **Persatuan Insinyur Indonesia (PII) menjalin kerja sama dengan Universitas Pertamina.**  
   - Kategori: MoU | Author: Septya Sekar | Tanggal: 2026-02-20
   - Gambar: `berita_17_persatuan-insinyur-indonesia-pii-menjali.png`

18. **Ketua Umum PII memimpin Pengambilan Sumpah Profesi Insinyur pada Program Studi Program Profesi Insinyur (PSPPI) di Politeknik Negeri Batam**  
   - Kategori: Pelantikan PSPPI | Author: Septya Sekar | Tanggal: 2026-02-20
   - Gambar: `berita_18_ketua-umum-pii-memimpin-pengambilan-sump.png`

19. **APLIKASI ASEAN ENGINEER BATCH I/2026 TELAH DIBUKA**  
   - Kategori: Sertifikat Internasional | Author: Septya Sekar | Tanggal: 2026-02-09
   - Gambar: `berita_19_aplikasi-asean-engineer-batch-i2026-tela.jpeg`

20. **PII & Gubernur Pramono Anung Bahas Jakarta Jadi Tuan Rumah WED 2026**  
   - Kategori: Audiensi | Author: Septya Sekar | Tanggal: 2026-02-09
   - Gambar: `berita_20_pii-gubernur-pramono-anung-bahas-jakarta.jpg`

