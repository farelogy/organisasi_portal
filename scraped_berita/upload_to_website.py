#!/usr/bin/env python3
"""
Script Auto-Upload Berita ke piijawabarat.or.id
Login ke admin panel lalu upload 20 berita dari berita_data.json beserta gambarnya.
"""

import os
import re
import json
import time
import requests
from datetime import datetime
from bs4 import BeautifulSoup

# ─── Konfigurasi ───────────────────────────────────────────────────────────────
BASE_URL  = "https://piijawabarat.or.id"
LOGIN_URL = f"{BASE_URL}/login"
STORE_URL = f"{BASE_URL}/admin/beritas"

EMAIL    = "admin@pii.or.id"
PASSWORD = "password"

SCRIPT_DIR   = os.path.dirname(os.path.abspath(__file__))
DATA_JSON    = os.path.join(SCRIPT_DIR, "berita_data.json")
IMAGE_DIR    = os.path.join(SCRIPT_DIR, "images")

DELAY = 2  # jeda antar request (detik)

HEADERS = {
    "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) "
                  "AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36",
    "Accept-Language": "id,en-US;q=0.9,en;q=0.8",
}


def get_csrf_token(session, url):
    """Ambil CSRF token dari halaman HTML."""
    resp = session.get(url, timeout=15)
    soup = BeautifulSoup(resp.text, "html.parser")
    token = soup.find("input", {"name": "_token"})
    if token:
        return token["value"]
    # Coba dari meta tag
    meta = soup.find("meta", {"name": "csrf-token"})
    if meta:
        return meta.get("content", "")
    # Fallback: cari di hidden inputs
    hidden = soup.find_all("input", {"type": "hidden"})
    for h in hidden:
        val = h.get("value", "")
        if len(val) > 30:
            return val
    return ""


def login(session):
    """Login ke admin panel. Kembalikan True jika berhasil."""
    print("🔐 Login ke admin panel...")

    # Step 1: GET login page untuk ambil CSRF token
    csrf = get_csrf_token(session, LOGIN_URL)
    if not csrf:
        print("  ⚠  CSRF token tidak ditemukan di halaman login!")
        # Coba cari dari cookie
        for cookie in session.cookies:
            if "XSRF" in cookie.name.upper():
                csrf = requests.utils.unquote(cookie.value)
                break

    print(f"  CSRF token: {csrf[:20]}...")

    # Step 2: POST login
    payload = {
        "_token": csrf,
        "email": EMAIL,
        "password": PASSWORD,
    }
    resp = session.post(
        LOGIN_URL,
        data=payload,
        headers={**HEADERS, "Referer": LOGIN_URL},
        allow_redirects=True,
        timeout=15,
    )

    # Cek apakah berhasil login
    if "/admin" in resp.url or "dashboard" in resp.text.lower() or "admin" in resp.text.lower():
        print(f"  ✅ Login berhasil! URL: {resp.url}")
        return True
    elif "login" in resp.url and "incorrect" in resp.text.lower():
        print(f"  ❌ Login gagal: email/password salah")
        return False
    elif resp.status_code == 200 and "email" in resp.text.lower():
        print(f"  ❌ Login gagal (masih di halaman login). URL: {resp.url}")
        print(f"     Response snippet: {resp.text[200:400]}")
        return False
    else:
        # Mungkin berhasil redirect
        print(f"  ✅ Redirect ke: {resp.url} (status {resp.status_code})")
        return True


def upload_berita(session, item, idx, total):
    """Upload satu berita ke admin panel."""
    title = item["title"]
    print(f"[{idx}/{total}] Uploading: {title[:65]}...")

    # Ambil CSRF token terbaru dari halaman berita admin
    csrf = get_csrf_token(session, f"{BASE_URL}/admin#tab=beritas")
    if not csrf:
        # Coba dari halaman utama admin
        csrf = get_csrf_token(session, f"{BASE_URL}/admin")

    # Path gambar lokal
    img_path = item.get("image_local_path")
    image_file = None
    if img_path and os.path.exists(img_path):
        image_file = open(img_path, "rb")
        img_filename = os.path.basename(img_path)
        # Tentukan MIME type
        ext = img_filename.lower().rsplit(".", 1)[-1]
        mime = {
            "jpg": "image/jpeg", "jpeg": "image/jpeg",
            "png": "image/png", "gif": "image/gif",
            "webp": "image/webp",
        }.get(ext, "image/jpeg")

    # Siapkan data form
    form_data = {
        "_token": csrf,
        "_method": "POST",
        "title": item["title"],
        "author": item.get("author", "Redaksi PII"),
        "excerpt": item.get("excerpt", "")[:500],
        "content": item.get("content_html", item.get("content_text", "")),
        "published_at": item.get("published_at", ""),
        "is_active": "1",
    }

    # Tambahkan category dan sub_category jika ada
    if item.get("category"):
        form_data["category"] = item["category"]
    if item.get("sub_category"):
        form_data["sub_category"] = item["sub_category"]

    try:
        if image_file:
            files = {"image": (img_filename, image_file, mime)}
            resp = session.post(
                STORE_URL,
                data=form_data,
                files=files,
                headers={**HEADERS, "Referer": f"{BASE_URL}/admin"},
                allow_redirects=True,
                timeout=60,
            )
            image_file.close()
        else:
            resp = session.post(
                STORE_URL,
                data=form_data,
                headers={**HEADERS, "Referer": f"{BASE_URL}/admin"},
                allow_redirects=True,
                timeout=30,
            )

        # Cek hasil
        if resp.status_code in [200, 201, 302] and ("berhasil" in resp.text.lower() or
                                                     "success" in resp.text.lower() or
                                                     "/admin" in resp.url):
            print(f"        ✅ Berhasil diupload!")
            return True
        elif "validation" in resp.text.lower() or "error" in resp.text.lower():
            # Coba parse error
            soup = BeautifulSoup(resp.text, "html.parser")
            errors = soup.find_all(class_=re.compile(r"error|alert|danger|invalid", re.I))
            error_msgs = [e.get_text(strip=True) for e in errors[:3]]
            print(f"        ⚠  Mungkin ada error validasi: {error_msgs}")
            print(f"        Status: {resp.status_code}, URL: {resp.url}")
            return False
        else:
            print(f"        ⚠  Status {resp.status_code}, URL: {resp.url}")
            # Cek apakah ada pesan sukses tersembunyi
            if "berita" in resp.url.lower() or resp.status_code == 302:
                print(f"        ✅ Kemungkinan berhasil (redirect detected)")
                return True
            return False

    except Exception as e:
        print(f"        ❌ Error: {e}")
        if image_file and not image_file.closed:
            image_file.close()
        return False


def main():
    print("=" * 65)
    print("  📤  Auto-Upload Berita PII ke piijawabarat.or.id")
    print("=" * 65)
    print(f"  Target: {BASE_URL}")
    print(f"  Data: {DATA_JSON}")
    print()

    # Load data
    with open(DATA_JSON, encoding="utf-8") as f:
        berita_list = json.load(f)
    print(f"  Data terbaca: {len(berita_list)} berita")
    print()

    # Buat session
    session = requests.Session()
    session.headers.update(HEADERS)

    # Login
    if not login(session):
        print("❌ Login gagal, proses dihentikan.")
        return

    print()
    success_count = 0
    failed = []

    for idx, item in enumerate(berita_list, start=1):
        result = upload_berita(session, item, idx, len(berita_list))
        if result:
            success_count += 1
        else:
            failed.append(idx)
        time.sleep(DELAY)

    print()
    print("=" * 65)
    print(f"  ✅ Selesai! {success_count}/{len(berita_list)} berita berhasil diupload")
    if failed:
        print(f"  ⚠  Gagal: berita nomor {failed}")
    print("=" * 65)


if __name__ == "__main__":
    main()
