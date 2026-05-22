#!/usr/bin/env python3
"""
Script Scraping Berita pii.or.id via API
Mengambil 20 berita terbaru dari https://api.pii.or.id/api/content/news
dan menyimpan data + gambar ke folder scraped_berita/

API ditemukan dari analisis JS bundle Next.js pii.or.id.

Struktur database target (tabel beritas):
  - id (auto)
  - title (string)
  - category (string, nullable)
  - sub_category (string, nullable)
  - author (string)
  - excerpt (text)
  - content (longText, nullable)
  - image (string - path lokal, nullable)
  - published_at (timestamp, nullable)
  - is_active (boolean, default true)
  - created_at, updated_at (timestamps)
"""

import os
import re
import json
import time
import requests
from datetime import datetime
from urllib.parse import urljoin, urlparse
from bs4 import BeautifulSoup

# ─── Konfigurasi ───────────────────────────────────────────────────────────────
API_BASE    = "https://api.pii.or.id/api"
API_NEWS    = f"{API_BASE}/content/news"
IMG_BASE    = "https://is3.cloudhost.id/orbit-pii"   # S3 storage PII, untuk gambar: /news/cover/<filename>
TARGET      = 20

OUTPUT_DIR  = os.path.dirname(os.path.abspath(__file__))
IMAGE_DIR   = os.path.join(OUTPUT_DIR, "images")
OUTPUT_JSON = os.path.join(OUTPUT_DIR, "berita_data.json")
OUTPUT_SQL  = os.path.join(OUTPUT_DIR, "berita_import.sql")

HEADERS = {
    "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)",
    "Accept": "application/json",
    "Origin": "https://www.pii.or.id",
    "Referer": "https://www.pii.or.id/",
}

os.makedirs(IMAGE_DIR, exist_ok=True)


# ─── Helper Functions ───────────────────────────────────────────────────────────

def slugify(text, max_len=50):
    text = str(text).lower().strip()
    text = re.sub(r"[^a-z0-9\s-]", "", text)
    text = re.sub(r"\s+", "-", text)
    return text[:max_len].strip("-")


def html_to_text(html_content):
    """Konversi HTML ke teks bersih menggunakan BeautifulSoup."""
    if not html_content:
        return ""
    soup = BeautifulSoup(html_content, "html.parser")
    # Tambahkan newline untuk elemen block
    for br in soup.find_all("br"):
        br.replace_with("\n")
    for p in soup.find_all("p"):
        p.append("\n")
    return soup.get_text(separator=" ", strip=True)


def download_image(img_url, filename):
    """Download gambar dan simpan ke folder images/."""
    if not img_url:
        return None, None
    try:
        resp = requests.get(img_url, headers={**HEADERS, "Accept": "image/*"},
                            timeout=20, stream=True)
        resp.raise_for_status()
        # Tentukan ekstensi
        ext = os.path.splitext(urlparse(img_url).path)[-1].lower()
        if ext not in [".jpg", ".jpeg", ".png", ".gif", ".webp"]:
            ct = resp.headers.get("Content-Type", "")
            if "jpeg" in ct or "jpg" in ct:
                ext = ".jpg"
            elif "png" in ct:
                ext = ".png"
            elif "webp" in ct:
                ext = ".webp"
            else:
                ext = ".jpg"
        filepath = os.path.join(IMAGE_DIR, filename + ext)
        with open(filepath, "wb") as f:
            for chunk in resp.iter_content(8192):
                f.write(chunk)
        db_path = f"scraped_berita/images/{filename}{ext}"
        print(f"    📷 Gambar: {filename}{ext} ({os.path.getsize(filepath)//1024} KB)")
        return db_path, filepath
    except Exception as e:
        print(f"    ⚠  Gagal download gambar {img_url}: {e}")
        return None, None


def parse_date(date_str):
    """Parse ISO date string."""
    if not date_str:
        return None
    try:
        # ISO 8601: 2026-05-21T09:28:13.538Z
        dt = datetime.fromisoformat(date_str.replace("Z", "+00:00"))
        return dt.strftime("%Y-%m-%d %H:%M:%S")
    except Exception:
        return date_str[:19].replace("T", " ") if date_str else None


def escape_sql(val):
    if val is None:
        return "NULL"
    val = str(val).replace("'", "''")
    return f"'{val}'"


# ─── Main ───────────────────────────────────────────────────────────────────────

def main():
    print("=" * 65)
    print("  🕷  Scraper Berita PII via API - api.pii.or.id")
    print("=" * 65)
    print(f"  API: {API_NEWS}")
    print(f"  Target: {TARGET} berita")
    print(f"  Output: {OUTPUT_DIR}")
    print()

    # 1. Fetch data berita dari API
    print("📡 Mengambil data dari API...")
    resp = requests.get(API_NEWS, headers=HEADERS, timeout=30)
    resp.raise_for_status()
    all_news = resp.json()
    print(f"   Total tersedia: {len(all_news)} berita")

    # Filter hanya yang statusnya PUBLISHED
    published = [n for n in all_news if n.get("status") == "PUBLISHED"]
    print(f"   Status PUBLISHED: {len(published)} berita")
    
    # Ambil 20 berita pertama (sudah terurut terbaru dari API)
    items = published[:TARGET]
    print(f"   Yang diambil: {len(items)} berita")
    print()

    results = []
    now_str = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    for idx, item in enumerate(items, start=1):
        title = item.get("title", "").strip()
        print(f"[{idx:02d}/{len(items)}] {title[:70]}...")

        # ── Konten ──
        content_html = item.get("content", "")
        content_text = html_to_text(content_html)

        # ── Excerpt: ambil 2 kalimat pertama dari konten bersih ──
        sentences = [s.strip() for s in re.split(r'(?<=[.!?])\s+', content_text) if s.strip()]
        excerpt = " ".join(sentences[:3])[:500]
        if not excerpt:
            excerpt = title

        # ── Kategori ──
        categories = item.get("categories", [])
        category = None
        sub_category = None
        if categories:
            cat_names = [c.get("category", {}).get("name", "") for c in categories if c.get("category")]
            if cat_names:
                category = cat_names[0]
                if len(cat_names) > 1:
                    sub_category = cat_names[1]

        # ── Author ──
        created_by = item.get("created_by", {})
        if isinstance(created_by, dict):
            first = created_by.get("first_name", "")
            last = created_by.get("last_name", "")
            author = f"{first} {last}".strip() or "Redaksi PII"
        else:
            author = "Redaksi PII"

        # ── Tanggal ──
        published_at = parse_date(item.get("created_at")) or now_str

        # ── Download Gambar ──
        img_path = item.get("cover_image_path", "")  # e.g. /news/cover/xxx.jpeg
        db_image_path = None
        local_image_path = None
        if img_path:
            img_url = IMG_BASE.rstrip("/") + "/" + img_path.lstrip("/")
            img_filename = f"berita_{idx:02d}_{slugify(title, 40)}"
            db_image_path, local_image_path = download_image(img_url, img_filename)

        record = {
            "title": title,
            "category": category or "Berita",
            "sub_category": sub_category,
            "author": author,
            "excerpt": excerpt,
            "content_html": content_html,
            "content_text": content_text,
            "image_db_path": db_image_path,
            "image_local_path": local_image_path,
            "published_at": published_at,
            "is_active": 1,
            "source_id": item.get("id"),
            "source_url": f"https://www.pii.or.id/kabar/berita/{item.get('id')}",
            "scraped_at": now_str,
        }
        results.append(record)
        print(f"        ✅ Kategori: {category or 'Berita'} | Author: {author} | Tgl: {published_at[:10]}")
        print()

    # ── Simpan JSON ──
    with open(OUTPUT_JSON, "w", encoding="utf-8") as f:
        json.dump(results, f, ensure_ascii=False, indent=2)
    print(f"\n💾 JSON disimpan: {OUTPUT_JSON}")

    # ── Buat SQL INSERT ──
    sql_lines = [
        "-- ================================================================",
        "-- Import Data Berita dari pii.or.id",
        f"-- Dibuat: {now_str}",
        f"-- Total: {len(results)} berita",
        "-- Sumber: https://api.pii.or.id/api/content/news",
        "-- ================================================================",
        "",
        "-- PETUNJUK:",
        "-- 1. Copy folder scraped_berita/images/ ke public/uploads/beritas/",
        "-- 2. Jalankan SQL ini di SQLite browser atau via php artisan tinker",
        "",
    ]
    for r in results:
        # Path gambar untuk database public/uploads/beritas/<namafile>
        db_img = None
        if r["image_db_path"]:
            basename = os.path.basename(r["image_db_path"])
            db_img = f"uploads/beritas/{basename}"

        sql_lines.append(
            "INSERT INTO beritas "
            "(title, category, sub_category, author, excerpt, content, image, published_at, is_active, created_at, updated_at) "
            "VALUES ("
            f"{escape_sql(r['title'])}, "
            f"{escape_sql(r['category'])}, "
            f"{escape_sql(r['sub_category'])}, "
            f"{escape_sql(r['author'])}, "
            f"{escape_sql(r['excerpt'])}, "
            f"{escape_sql(r['content_text'])}, "
            f"{escape_sql(db_img)}, "
            f"{escape_sql(r['published_at'])}, "
            f"1, "
            f"{escape_sql(now_str)}, "
            f"{escape_sql(now_str)}"
            ");"
        )

    with open(OUTPUT_SQL, "w", encoding="utf-8") as f:
        f.write("\n".join(sql_lines))
    print(f"💾 SQL disimpan : {OUTPUT_SQL}")

    # ── Buat README ──
    readme_path = os.path.join(OUTPUT_DIR, "README.md")
    with open(readme_path, "w", encoding="utf-8") as f:
        f.write(f"""# Data Berita Scraped dari pii.or.id

**Tanggal scraping:** {now_str}  
**Sumber:** https://www.pii.or.id/kabar/berita  
**Total berita:** {len(results)} artikel  

## Isi Folder

| File/Folder | Keterangan |
|---|---|
| `images/` | Folder berisi {len([r for r in results if r['image_db_path']])} gambar cover berita |
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
foreach ($beritas as $b) {{
    Berita::create([...]);
}}
```

## Daftar Berita
""")
        for i, r in enumerate(results, 1):
            f.write(f"{i}. **{r['title']}**  \n")
            f.write(f"   - Kategori: {r['category']} | Author: {r['author']} | Tanggal: {r['published_at'][:10]}\n")
            f.write(f"   - Gambar: `{os.path.basename(r['image_db_path']) if r['image_db_path'] else 'Tidak ada'}`\n\n")

    print(f"📋 README disimpan: {readme_path}")

    # ── Ringkasan ──
    img_count = len([r for r in results if r["image_db_path"]])
    print("\n" + "=" * 65)
    print(f"  ✅ Selesai! {len(results)} berita berhasil discraping")
    print(f"  🖼  {img_count} gambar berhasil didownload")
    print("=" * 65)
    print(f"  📁 Folder: {OUTPUT_DIR}")
    print()
    print("  📌 Langkah selanjutnya:")
    print("  1. Copy folder images/ ke public/uploads/beritas/")
    print("  2. Import data via admin panel atau gunakan berita_import.sql")
    print()


if __name__ == "__main__":
    main()
