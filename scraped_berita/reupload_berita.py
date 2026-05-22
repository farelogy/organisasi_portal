#!/usr/bin/env python3
"""
Script Re-Upload Berita ke piijawabarat.or.id
- Hapus semua berita yang ada
- Upload ulang 20 berita dengan mapping kategori yang benar
  Kategori utama: Artikel Teknik, Regulasi Terbaru, Inovasi Teknologi, Opini
  Sub kategori: dari hasil scraping pii.or.id
"""

import requests, json, os, re, time
from bs4 import BeautifulSoup
from urllib.parse import unquote

BASE_URL  = 'https://piijawabarat.or.id'
EMAIL     = 'admin@pii.or.id'
PASSWORD  = 'password'
DATA_JSON = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'berita_data.json')

# ─── Mapping Kategori ──────────────────────────────────────────────────────────
# Kategori scraped → Kategori utama website
# 4 pilihan: Artikel Teknik, Regulasi Terbaru, Inovasi Teknologi, Opini
CATEGORY_MAP = {
    # Scraping category        → Website category
    'Sertifikat Internasional' : 'Regulasi Terbaru',     # Sertifikasi = regulasi profesi
    'Muswil'                   : 'Opini',                # Musyawarah wilayah = opini organisasi
    'Teknologi'                : 'Inovasi Teknologi',    # Teknologi perkeretaapian
    'Audiensi'                 : 'Artikel Teknik',       # Audiensi pemerintah
    'Pelantikan PSPPI'         : 'Artikel Teknik',       # Pelantikan insinyur profesional
    'Meeting'                  : 'Artikel Teknik',       # Rapat / pertemuan internasional
    'AFEO'                     : 'Artikel Teknik',       # Konferensi ASEAN
    'Pelayanan'                : 'Artikel Teknik',       # Pelayanan & kegiatan PII
    'Sarasehan & FGD'          : 'Opini',                # Diskusi / FGD
    'Perwakilan Wilayah PII'   : 'Artikel Teknik',       # Kegiatan perwakilan wilayah
    'MoU'                      : 'Artikel Teknik',       # Kerja sama / MoU
    'Berita'                   : 'Artikel Teknik',       # Default
}

def map_category(scraped_cat: str) -> str:
    return CATEGORY_MAP.get(scraped_cat, 'Artikel Teknik')


# ─── Helpers ───────────────────────────────────────────────────────────────────

def make_session():
    session = requests.Session()
    session.headers.update({
        'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
        'Accept': 'application/json, text/html',
    })
    resp = session.get(BASE_URL + '/login', timeout=15)
    csrf = BeautifulSoup(resp.text, 'html.parser').find('input', {'name': '_token'})['value']
    session.post(BASE_URL + '/login',
                 data={'_token': csrf, 'email': EMAIL, 'password': PASSWORD},
                 allow_redirects=True, timeout=15)
    return session


def get_xsrf(session):
    resp = session.get(BASE_URL + '/admin', timeout=15)
    soup = BeautifulSoup(resp.text, 'html.parser')
    fc_tag = soup.find('input', {'name': '_token'})
    fc = fc_tag['value'] if fc_tag else ''
    xf = ''
    for c in session.cookies:
        if 'XSRF' in c.name.upper():
            xf = unquote(c.value)
            break
    return fc, xf


def get_all_berita_ids(session) -> list:
    """Ambil semua ID berita dari admin panel (semua halaman)."""
    ids = []
    page = 1
    while True:
        resp = session.get(f'{BASE_URL}/admin?beritas_page={page}', timeout=15)
        html = resp.text
        # Cari semua ID berita dari link edit/delete
        found = re.findall(r'/admin/beritas/(\d+)/edit', html)
        if not found:
            break
        new_ids = [int(x) for x in found if int(x) not in ids]
        if not new_ids:
            break
        ids.extend(new_ids)
        page += 1
        time.sleep(0.5)
    return ids


def delete_berita(session, bid: int) -> bool:
    fc, xf = get_xsrf(session)
    r = session.post(
        f'{BASE_URL}/admin/beritas/{bid}',
        data={'_token': fc, '_method': 'DELETE'},
        headers={'X-XSRF-TOKEN': xf, 'Referer': f'{BASE_URL}/admin'},
        allow_redirects=True, timeout=15,
    )
    return r.status_code == 200


def clean_text(text: str) -> str:
    """Strip karakter 4-byte Unicode (emoji/SMP) dan simbol yang menyebabkan error SQLite."""
    # Hapus semua karakter di atas BMP
    text = re.sub(r'[\U00010000-\U0010FFFF]', '', text)
    # Hapus ZWJ, variation selectors, zero-width chars
    text = re.sub(r'[\u200D\uFE0F\uFE0E\u200B\u200C]', '', text)
    # Hapus Miscellaneous Symbols, Dingbats, Box drawing, dll
    text = re.sub(r'[\u2300-\u27FF]', '', text)
    text = re.sub(r'[\u2460-\u2BFF]', '', text)
    # Bersihkan spasi ganda
    text = re.sub(r'  +', ' ', text).strip()
    return text


def upload_berita(session, item: dict) -> tuple:
    fc, xf = get_xsrf(session)

    # Mapping kategori
    scraped_cat = item.get('category', 'Berita')
    main_cat    = map_category(scraped_cat)
    sub_cat     = scraped_cat if scraped_cat != main_cat else ''

    content = clean_text(item.get('content_text', ''))
    title   = clean_text(item['title'])

    form = {
        '_token'      : fc,
        'title'       : title,
        'category'    : main_cat,
        'sub_category': sub_cat,
        'content'     : '<p>' + content + '</p>',
        'is_active'   : '1',
    }
    headers = {'X-XSRF-TOKEN': xf, 'Referer': f'{BASE_URL}/admin'}

    img_path = item.get('image_local_path', '')
    if img_path and os.path.exists(img_path):
        ext  = img_path.rsplit('.', 1)[-1].lower()
        mime = 'image/jpeg' if ext in ('jpg', 'jpeg') else 'image/png'
        with open(img_path, 'rb') as f:
            r = session.post(
                f'{BASE_URL}/admin/beritas',
                data=form,
                files={'image': (os.path.basename(img_path), f, mime)},
                headers=headers,
                allow_redirects=True, timeout=60,
            )
    else:
        r = session.post(
            f'{BASE_URL}/admin/beritas',
            data=form,
            headers=headers,
            allow_redirects=True, timeout=30,
        )
    return r.status_code, r.text[:150]


# ─── Main ──────────────────────────────────────────────────────────────────────

def main():
    print('=' * 65)
    print('  🔄  Re-Upload Berita PII ke piijawabarat.or.id')
    print('=' * 65)
    print()

    # Load data
    with open(DATA_JSON, encoding='utf-8') as f:
        berita_list = json.load(f)
    print(f'📂 Data terbaca: {len(berita_list)} berita')

    # Preview mapping kategori
    print('\n📋 Preview mapping kategori:')
    for item in berita_list:
        sc = item.get('category', 'Berita')
        mc = map_category(sc)
        print(f'   {sc:30s} → {mc}')

    print()

    # Login
    print('🔐 Login...')
    session = make_session()
    print('   ✅ Login berhasil!\n')

    # ── Step 1: Hapus semua berita yang ada ──
    print('🗑  Mengambil daftar berita yang ada...')
    existing_ids = get_all_berita_ids(session)
    print(f'   Ditemukan {len(existing_ids)} berita: {existing_ids}')

    if existing_ids:
        print(f'\n🗑  Menghapus {len(existing_ids)} berita...')
        deleted = 0
        for bid in existing_ids:
            ok = delete_berita(session, bid)
            status = '✅' if ok else '❌'
            print(f'   {status} Hapus ID {bid}')
            if ok:
                deleted += 1
            time.sleep(0.5)
        print(f'   Terhapus: {deleted}/{len(existing_ids)}\n')
    else:
        print('   Tidak ada berita yang perlu dihapus.\n')

    # ── Step 2: Upload ulang semua berita ──
    print('📤 Mengupload ulang 20 berita...\n')
    success = 0
    failed  = []

    for idx, item in enumerate(berita_list, 1):
        sc = item.get('category', 'Berita')
        mc = map_category(sc)
        title = item['title'][:65]
        print(f'[{idx:02d}/20] {title}...')
        print(f'        Kategori: {mc} | Sub: {sc}')

        code, txt = upload_berita(session, item)

        if code == 200 and 'success' in txt:
            print(f'        ✅ Berhasil!')
            success += 1
        else:
            print(f'        ⚠  Error {code}, coba tanpa gambar...')
            # Fallback tanpa gambar
            item_no_img = {**item, 'image_local_path': ''}
            code2, txt2 = upload_berita(session, item_no_img)
            if code2 == 200 and 'success' in txt2:
                print(f'        ✅ Berhasil (tanpa gambar)!')
                success += 1
            else:
                print(f'        ❌ Gagal: {code2}: {txt2}')
                failed.append(idx)
        print()
        time.sleep(2)

    # ── Ringkasan ──
    print('=' * 65)
    print(f'  ✅ Selesai! {success}/20 berita berhasil diupload')
    if failed:
        print(f'  ⚠  Gagal: berita nomor {failed}')
    print('=' * 65)


if __name__ == '__main__':
    main()
