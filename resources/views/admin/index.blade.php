<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — PII</title>
    @if (isset($site_settings['site_favicon']))
        <link rel="icon" type="image/x-icon" href="{{ asset($site_settings['site_favicon']) }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            margin: 0;
            color: #334155;
        }

        /* ---- SIDEBAR ----- */
        .sidebar {
            width: 260px;
            height: 100vh;
            max-height: 100vh;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .sidebar-logo {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .sidebar-logo h1 {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
        }

        .sidebar-logo p {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.1) transparent;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 0 12px;
            margin-bottom: 8px;
            margin-top: 20px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #94a3b8;
            transition: all 0.2s ease;
            margin-bottom: 2px;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }

        .nav-item .nav-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.05);
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .nav-item .nav-count {
            margin-left: auto;
            font-size: 11px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.08);
            color: #64748b;
            padding: 2px 8px;
            border-radius: 20px;
            transition: all 0.2s;
        }

        .nav-item:hover {
            background: rgba(249, 115, 22, 0.1);
            color: #fdba74;
        }

        .nav-item:hover .nav-icon {
            background: rgba(249, 115, 22, 0.15);
        }

        .nav-item.active {
            background: linear-gradient(90deg, rgba(249, 115, 22, 0.2) 0%, rgba(249, 115, 22, 0.05) 100%);
            color: #f97316;
            font-weight: 600;
        }

        .nav-item.active .nav-icon {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
        }

        .nav-item.active .nav-count {
            background: #f97316;
            color: white;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        /* ---- MAIN CONTENT ---- */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar h2 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.3px;
        }

        .topbar p {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* ---- BUTTONS ---- */
        .btn-orange {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.25);
            text-decoration: none;
        }

        .btn-orange:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(249, 115, 22, 0.35);
        }

        .btn-orange:active {
            transform: translateY(0);
        }

        .btn-orange:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-outline {
            background: transparent;
            color: #f97316;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            border: 1.5px solid rgba(249, 115, 22, 0.3);
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-outline:hover {
            background: rgba(249, 115, 22, 0.08);
        }

        .btn-cancel {
            background: white;
            color: #64748b;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            border: 1.5px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* ---- STAT CARDS ---- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #f97316, #ea580c);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
            background: linear-gradient(135deg, #fff7ed, #ffedd5);
        }

        .stat-num {
            font-size: 30px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .stat-label {
            font-size: 13px;
            color: #94a3b8;
            font-weight: 500;
            margin-top: 4px;
        }

        /* ---- TAB CONTENT ---- */
        .content-area {
            padding: 28px 32px;
            flex: 1;
            transition: opacity 0.2s;
        }

        .tab-panel {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-panel.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ---- CARDS ---- */
        .card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
        }

        .card-body {
            padding: 20px 24px;
        }

        /* ---- ITEM ROWS ---- */
        .item-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-row:hover {
            background: #f8fafc;
            margin: 0 -24px;
            padding: 14px 24px;
            border-radius: 10px;
        }

        .item-thumb {
            width: 56px;
            height: 56px;
            object-fit: cover;
            border-radius: 12px;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .item-thumb-placeholder {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, #fff7ed, #ffedd5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .item-info {
            flex: 1;
            min-width: 0;
        }

        .item-title {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
        }

        .item-meta {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 3px;
        }

        /* ---- BADGES ---- */
        .badge-active {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-inactive {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #94a3b8;
        }

        /* ---- EDIT BUTTON ---- */
        .edit-btn {
            font-size: 13px;
            font-weight: 600;
            color: #f97316;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 8px;
            border: 1.5px solid #fed7aa;
            transition: all 0.2s;
            flex-shrink: 0;
            background: white;
            cursor: pointer;
        }

        .edit-btn:hover {
            background: #fff7ed;
            border-color: #f97316;
        }

        /* ---- FORMS ---- */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f172a;
            transition: all 0.2s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.12);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        /* ---- EMPTY STATE ---- */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
        }

        .empty-icon {
            font-size: 48px;
            margin-bottom: 12px;
            opacity: 0.7;
        }

        .empty-title {
            font-size: 16px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 6px;
        }

        .empty-desc {
            font-size: 13px;
            color: #94a3b8;
        }

        /* ---- ALERT ---- */
        .alert-success {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #22c55e;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
            color: #15803d;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ---- FORM PANEL ---- */
        [id^="form-panel-"] {
            display: none;
        }

        [id^="form-panel-"].active {
            display: block;
            animation: slideInRight 0.3s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ---- TOAST ---- */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }

        .toast {
            background: white;
            border-radius: 12px;
            padding: 14px 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
            min-width: 300px;
            max-width: 400px;
            pointer-events: all;
            animation: toastIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-left: 4px solid;
        }

        .toast.success {
            border-left-color: #22c55e;
            color: #15803d;
        }

        .toast.error {
            border-left-color: #ef4444;
            color: #b91c1c;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(100px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes toastOut {
            from {
                opacity: 1;
                transform: translateX(0) scale(1);
            }

            to {
                opacity: 0;
                transform: translateX(100px) scale(0.9);
            }
        }

        .toast.hiding {
            animation: toastOut 0.3s ease forwards;
        }

        /* ---- SPINNER ---- */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ---- MODAL ---- */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.5);
            z-index: 200;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 540px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        /* Mobile menu button - hidden by default */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #374151;
            border-radius: 8px;
            z-index: 200;
            position: relative;
        }

        .mobile-menu-btn:hover {
            background: #f3f4f6;
        }

        /* Mobile Responsive - Tablet and below */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .main-content.sidebar-open::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 99;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .content-area {
                padding: 20px 16px;
            }

            .topbar {
                padding: 16px;
            }

            .toast {
                max-width: 100%;
                min-width: auto;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <h1>PII Admin</h1>
            <p>Dashboard Pengelola Konten</p>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Konten Utama</div>
            <button onclick="showTab('heroes')" id="nav-heroes" class="nav-item active">
                <span class="nav-icon">🎯</span> Hero Section
            </button>
            <button onclick="showTab('beritas')" id="nav-beritas" class="nav-item">
                <span class="nav-icon">📰</span> Berita
                <span class="nav-count">{{ $beritas->total() }}</span>
            </button>

            @if (Auth::user()->role === 'admin')
                <div class="nav-label">Tentang PII</div>
                <button onclick="showTab('sejarahs')" id="nav-sejarahs" class="nav-item">
                    <span class="nav-icon">📜</span> Sejarah
                </button>
                <button onclick="showTab('sekilas')" id="nav-sekilas" class="nav-item">
                    <span class="nav-icon">👁️</span> Sekilas
                    @if ($sekilas)
                        <span class="nav-count">1</span>
                    @endif
                </button>
                <button onclick="showTab('strukturs')" id="nav-strukturs" class="nav-item">
                    <span class="nav-icon">👥</span> Struktur Org.
                    @if ($strukturs)
                        <span class="nav-count">1</span>
                    @endif
                </button>
                <button onclick="showTab('kontaks')" id="nav-kontaks" class="nav-item">
                    <span class="nav-icon">📞</span> Kontak
                    @if ($kontaks)
                        <span class="nav-count">1</span>
                    @endif
                </button>
            @endif

            <div class="nav-label">Kegiatan & Media</div>
            <button onclick="showTab('events')" id="nav-events" class="nav-item">
                <span class="nav-icon">📅</span> Event
                <span class="nav-count">{{ $events->total() }}</span>
            </button>
            <button onclick="showTab('galleries')" id="nav-galleries" class="nav-item">
                <span class="nav-icon">🖼️</span> Gallery
                <span class="nav-count">{{ $galleries->total() }}</span>
            </button>
            <button onclick="showTab('kemitraans')" id="nav-kemitraans" class="nav-item">
                <span class="nav-icon">🤝</span> Kemitraan
                <span class="nav-count">{{ $kemitraans->total() }}</span>
            </button>

            @if (Auth::user()->role === 'admin')
                <div class="nav-label">Manajemen</div>
                <button onclick="showTab('users')" id="nav-users" class="nav-item">
                    <span class="nav-icon">👤</span> Users
                    <span class="nav-count">{{ $users->total() }}</span>
                </button>
                <button onclick="showTab('settings')" id="nav-settings" class="nav-item">
                    <span class="nav-icon">⚙️</span> Pengaturan Situs
                </button>
            @endif
        </nav>
        <div class="sidebar-footer" style="display:flex;flex-direction:column;gap:10px;">
            <div
                style="display:flex;align-items:center;gap:10px;padding-bottom:10px;border-bottom:1px solid rgba(255,255,255,0.06);">
                <div
                    style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#f97316,#ea580c);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <span
                        style="color:#fff;font-weight:700;font-size:14px;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div style="overflow:hidden;">
                    <p
                        style="color:#fff;font-size:13px;font-weight:600;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        {{ Auth::user()->name }}</p>
                    <p style="color:#94a3b8;font-size:11px;margin:0;text-transform:capitalize;">
                        {{ Auth::user()->role ?? 'User' }}</p>
                </div>
            </div>
            <a href="{{ route('home') }}" class="btn-outline" style="width:100%; justify-content:center;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Lihat Website
            </a>
            <form action="{{ route('logout') }}" method="POST" style="width:100%;">
                @csrf
                <button type="submit" class="btn-outline"
                    style="width:100%; justify-content:center; color:#f87171; border-color:rgba(248,113,113,0.3);">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main-content">
        <!-- TOPBAR -->
        <div class="topbar">
            <div style="display:flex; align-items:center; gap:12px;">
                <button type="button" id="mobile-menu-toggle" class="mobile-menu-btn"
                    onclick="toggleMobileSidebar()" aria-label="Toggle Menu">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div>
                    <h2 id="topbar-title">Hero Section</h2>
                    <p>Kelola dan perbarui konten website PII</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">{{ now()->format('d M Y') }}</span>
            </div>
        </div>

        <div class="content-area">
            @if ($errors->any())
                <div
                    style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:14px 18px;margin-bottom:24px;font-size:14px;color:#b91c1c;">
                    <strong>Terdapat kesalahan:</strong>
                    <ul style="margin-top:8px; margin-bottom:0; padding-left:20px;">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert-success">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#fff7ed;">📰</div>
                    <div class="stat-num">
                        {{ $beritas->total() }}
                    </div>
                    <div class="stat-label">Total Berita</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background:#f0fdf4;">📅</div>
                    <div class="stat-num">
                        {{ $events->total() }}
                    </div>
                    <div class="stat-label">Total Event</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background:#fdf4ff;">🖼️</div>
                    <div class="stat-num">
                        {{ $galleries->total() }}
                    </div>
                    <div class="stat-label">Total Gallery</div>
                </div>
            </div>

            {{-- ==================== HEROES ==================== --}}
            <div id="tab-heroes" class="tab-panel active">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- List Panel -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Daftar Hero Section</h3>
                            <button onclick="showForm(event, 'hero')" class="btn-orange">
                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Hero
                            </button>
                        </div>
                        <div class="card-body">
                            @if ($heroes->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($heroes as $hero)
                                        <div class="item-row">
                                            @if ($hero->image)
                                                <img src="{{ Str::startsWith($hero->image, ['http://', 'https://']) ? $hero->image : asset($hero->image) }}"
                                                    style="width:160px;height:90px;object-fit:cover;border-radius:10px;flex-shrink:0;box-shadow:0 2px 8px rgba(0,0,0,0.08);"
                                                    alt="{{ $hero->title }}">
                                            @else
                                                <div
                                                    style="width:160px;height:90px;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:#94a3b8;font-size:24px;">
                                                    🎯</div>
                                            @endif
                                            <div class="item-info">
                                                <div class="item-title">{{ $hero->title }}</div>
                                                <div class="item-meta">{{ Str::limit($hero->subtitle, 70) }}</div>
                                                <div style="margin-top:6px;">
                                                    <span
                                                        class="{{ $hero->is_active ? 'badge-active' : 'badge-inactive' }}">
                                                        {{ $hero->is_active ? 'Aktif' : 'Non-Aktif' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div style="display:flex;gap:6px;align-items:center;">
                                                <button onclick="showForm(event, 'hero', {{ $hero->id }})"
                                                    class="edit-btn" data-title="{{ $hero->title }}"
                                                    data-subtitle="{{ $hero->subtitle }}"
                                                    data-button_text="{{ $hero->button_text }}"
                                                    data-button_link="{{ $hero->button_link }}"
                                                    data-is_active="{{ $hero->is_active ? 'true' : 'false' }}"
                                                    data-image="{{ $hero->image }}">Edit</button>
                                                <form action="{{ route('admin.heroes.delete', $hero->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"
                                                        style="background:none;border:none;cursor:pointer;color:#ef4444;font-size:16px;"
                                                        onclick="return confirm('Hapus hero ini?')">🗑️</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">🎯</div>
                                    <div class="empty-title">Belum ada Hero</div>
                                    <div class="empty-desc">Tambahkan hero section untuk ditampilkan di halaman utama
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Form Panel -->
                    <div id="form-panel-hero" class="card" style="display:none;">
                        <div class="card-header">
                            <h3 id="form-title-hero">Tambah Hero Section</h3>
                            <button onclick="hideForm('hero')" class="btn-cancel">Batal</button>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.heroes.store') }}" method="POST"
                                enctype="multipart/form-data" id="form-hero">
                                @csrf
                                <input type="hidden" name="_method" value="POST" id="hero-method">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-input" required
                                        placeholder="Judul hero section">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Subtitle</label>
                                    <textarea name="subtitle" class="form-input form-textarea" required placeholder="Subtitle deskripsi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gambar</label>
                                    <input type="file" name="image" accept="image/*" class="form-input"
                                        onchange="previewHeroImage(this)">
                                    <div id="hero-image-preview-wrap" style="margin-top:10px;display:none;">
                                        <img id="hero-image-preview" src="" alt="Preview"
                                            style="width:120px;height:68px;object-fit:cover;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="button_text" class="form-input"
                                        placeholder="Contoh: Daftar Sekarang">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Button Link</label>
                                    <input type="text" name="button_link" class="form-input"
                                        placeholder="contoh: facebook.com atau https://xyz.com">
                                    <p style="font-size:11px;color:#9ca3af;margin-top:4px;">https:// akan otomatis
                                        ditambahkan jika tidak diisi</p>
                                </div>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" id="hero-active"
                                        style="width:16px;height:16px;accent-color:#f97316;" checked>
                                    <label for="hero-active" class="form-label" style="margin:0;">Aktif</label>
                                </div>
                                <button type="submit" class="btn-orange"
                                    style="width:100%;justify-content:center;margin-top:16px;">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            {{-- ==================== BERITA ==================== --}}
            <div id="tab-beritas" class="tab-panel">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- List Panel -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Daftar Berita</h3>
                            <button onclick="showForm(event, 'berita')" class="btn-orange">
                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                    Tambah Berita
                            </button>
                        </div>
                        <div class="card-body">
                            @if ($beritas->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($beritas as $berita)
                                        <div class="item-row">
                                            @if ($berita->image)
                                                <img src="{{ Str::startsWith($berita->image, ['http://', 'https://']) ? $berita->image : asset($berita->image) }}"
                                                    class="item-thumb" alt="{{ $berita->title }}">
                                            @else
                                                <div class="item-thumb-placeholder">📰</div>
                                            @endif
                                            <div class="item-info">
                                                <div class="item-title">{{ $berita->title }}</div>
                                                @if ($berita->category || $berita->sub_category)
                                                    <div class="item-meta" style="color:#f97316;font-weight:500;">
                                                        @if ($berita->category)
                                                            {{ str_replace('_', ' ', ucwords($berita->category, '_')) }}
                                                        @endif
                                                        @if ($berita->category && $berita->sub_category)
                                                            -
                                                        @endif
                                                        @if ($berita->sub_category)
                                                            {{ $berita->sub_category }}
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="item-meta">{{ Str::limit($berita->excerpt ?? '', 70) }}
                                                </div>
                                                <div style="margin-top:6px;">
                                                    <span
                                                        class="{{ $berita->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $berita->is_active ? 'Aktif' : 'Non-Aktif' }}</span>
                                                </div>
                                            </div>
                                            <div style="display:flex;gap:6px;align-items:center;">
                                                <button type="button"
                                                    onclick="showForm(event, 'berita', {{ $berita->id }})"
                                                    class="edit-btn" data-title="{{ $berita->title }}"
                                                    data-category="{{ $berita->category }}"
                                                    data-sub_category="{{ $berita->sub_category }}"
                                                    data-current-image="{{ $berita->image ?? '' }}"
                                                    data-is_active="{{ $berita->is_active ? 'true' : 'false' }}">Edit</button>
                                                <form action="{{ route('admin.beritas.delete', $berita->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="page"
                                                        value="{{ request()->get('page', 1) }}">
                                                    <button type="submit"
                                                        style="background:none;border:none;cursor:pointer;color:#ef4444;font-size:16px;"
                                                        onclick="return confirm('Hapus berita ini?')">🗑️</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Pagination -->
                                @if ($beritas->hasPages())
                                    <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                                        {{ $beritas->fragment('tab=beritas')->links() }}
                                    </div>
                                @endif
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">📰</div>
                                    <div class="empty-title">Belum ada Berita</div>
                                    <div class="empty-desc">Mulai posting berita terbaru tentang PII</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Form Panel -->
                    <div id="form-panel-berita" class="card" style="display:none;">
                        <div class="card-header">
                            <h3 id="form-title-berita">Tambah Berita</h3>
                            <button onclick="hideForm('berita')" class="btn-cancel">Batal</button>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.beritas.store') }}" method="POST"
                                enctype="multipart/form-data" id="form-berita">
                                @csrf
                                <input type="hidden" name="_method" value="POST" id="berita-method">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kategori</label>
                                    <select name="category" class="form-input" required>
                                        <option value="artikel_teknik">Artikel Teknik</option>
                                        <option value="regulasi">Regulasi Terbaru</option>
                                        <option value="inovasi">Inovasi Teknologi</option>
                                        <option value="opini">Opini</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sub Kategori (Opsional)</label>
                                    <input type="text" name="sub_category" class="form-input"
                                        placeholder="Tuliskan sub kategori bebas...">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Content</label>
                                    <textarea name="content" id="berita-content" class="form-input form-textarea tinymce-editor" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gambar</label>
                                    <input type="file" name="image" accept="image/*" class="form-input"
                                        onchange="previewBeritaImage(event)">
                                    <div id="berita-image-preview-wrap" style="margin-top:10px;display:none;">
                                        <img id="berita-image-preview" src="" alt="Preview"
                                            style="max-width:200px;max-height:140px;border-radius:8px;border:1px solid #e2e8f0;background:#f8fafc;padding:4px;object-fit:cover;">
                                        <p id="berita-image-preview-label"
                                            style="font-size:12px;color:#6b7280;margin-top:4px;">Preview gambar</p>
                                    </div>
                                    <div id="berita-image-empty"
                                        style="margin-top:10px;display:none;font-size:12px;color:#9ca3af;">
                                        Belum ada gambar
                                    </div>
                                </div>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" id="berita-active"
                                        style="width:16px;height:16px;accent-color:#f97316;" checked>
                                    <label for="berita-active" class="form-label" style="margin:0;">Aktif</label>
                                </div>
                                <button type="submit" class="btn-orange"
                                    style="width:100%;justify-content:center;margin-top:16px;">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->role === 'admin')
                {{-- ==================== SEJARAH ==================== --}}
                <div id="tab-sejarahs" class="tab-panel">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">
                        <!-- Panel Sejarah -->
                        <div class="card">
                            <div class="card-header">
                                <h3>✍️ Konten Sejarah</h3>
                                @if ($sejarah)
                                    <span class="badge-active">Tersimpan</span>
                                @else
                                    <span class="badge-inactive">Belum ada</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.sejarahs.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if ($errors->any())
                                        <div
                                            style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#b91c1c;">
                                            @foreach ($errors->all() as $e)
                                                <div>• {{ $e }}</div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="title" value="{{ $sejarah->title ?? '' }}"
                                            class="form-input" required placeholder="Judul konten sejarah">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Upload Gambar</label>
                                        <div style="margin-bottom:8px;">
                                            @if ($sejarah && ($sejarah->image ?? false))
                                                <img id="preview-sejarah"
                                                    src="{{ Str::startsWith($sejarah->image, ['http://', 'https://']) ? $sejarah->image : asset($sejarah->image) }}"
                                                    alt="Preview"
                                                    style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;">
                                            @else
                                                <img id="preview-sejarah" src="" alt="Preview"
                                                    style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;display:none;">
                                            @endif
                                        </div>
                                        <input type="file" name="image" accept="image/*" class="form-input"
                                            onchange="previewImage(this, 'preview-sejarah')">
                                        <p style="font-size:11px;color:#d1d5db;margin-top:4px;">JPEG, PNG, JPG, GIF —
                                            Maks.
                                            2MB</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Konten</label>
                                        <textarea name="content" id="sejarah-editor" class="form-input form-textarea tinymce-editor"
                                            placeholder="Tuliskan sejarah PII di sini...">{{ $sejarah->content ?? '' }}</textarea>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1"
                                            id="is_active_sejarah"
                                            style="width:16px;height:16px;accent-color:#f97316;"
                                            {{ $sejarah->is_active ?? true ? 'checked' : '' }}>
                                        <label for="is_active_sejarah" class="form-label" style="margin:0;">Tampilkan
                                            di
                                            website</label>
                                    </div>
                                    <button type="submit" class="btn-orange"
                                        style="width:100%;justify-content:center;">
                                        <svg width="16" height="16" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Sejarah
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Panel Ketua Umum -->
                        <div class="card">
                            <div class="card-header">
                                <h3>👑 Ketua Umum PII</h3>
                                <span class="badge-active">{{ $ketuaUmums->count() }}
                                    data</span>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.ketuaUmums.store') }}" method="POST"
                                    enctype="multipart/form-data" id="ketua-umum-form"
                                    style="padding-bottom:16px;border-bottom:1px solid #f3f4f6;margin-bottom:16px;">
                                    @csrf
                                    <input type="hidden" name="_method" value="POST" id="ketua-umum-method">
                                    <input type="hidden" name="ketua_umum_id" id="ketua-umum-id">
                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                                        <div class="form-group">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="name" id="ketua-umum-name"
                                                class="form-input" required placeholder="Nama lengkap">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Periode</label>
                                            <input type="text" name="period" id="ketua-umum-period"
                                                class="form-input" placeholder="cth: 2020–2024">
                                        </div>
                                    </div>
                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                                        <div class="form-group">
                                            <label class="form-label">Foto</label>
                                            <input type="file" name="image" id="ketua-umum-image"
                                                accept="image/*" class="form-input">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Urutan</label>
                                            <input type="number" name="order" id="ketua-umum-order"
                                                value="0" class="form-input">
                                        </div>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:14px;">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1"
                                            id="ketua-umum-is_active"
                                            style="width:16px;height:16px;accent-color:#f97316;" checked>
                                        <label for="ketua-umum-is_active" class="form-label"
                                            style="margin:0;">Aktifkan</label>
                                    </div>
                                    <div id="ketua-umum-form-actions">
                                        <button type="submit" class="btn-orange"
                                            style="width:100%;justify-content:center;">
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            Tambah Ketua Umum
                                        </button>
                                    </div>
                                    <button type="button" id="ketua-umum-cancel" onclick="cancelEditKetuaUmum()"
                                        class="btn-cancel"
                                        style="width:100%;justify-content:center;margin-top:8px;display:none;">Batal</button>
                                </form>
                                @if ($ketuaUmums->count() > 0)
                                    <div style="max-height:260px;overflow-y:auto;">
                                        @foreach ($ketuaUmums->sortBy('order') as $k)
                                            <div class="item-row">
                                                @if ($k->image)
                                                    <img src="{{ Str::startsWith($k->image, ['http://', 'https://']) ? $k->image : asset($k->image) }}"
                                                        class="item-thumb" alt="{{ $k->name }}"
                                                        style="width:44px;height:44px;border-radius:50%;">
                                                @else
                                                    <div class="item-thumb-placeholder"
                                                        style="width:44px;height:44px;border-radius:50%;font-size:18px;">
                                                        👤
                                                    </div>
                                                @endif
                                                <div class="item-info">
                                                    <div class="item-title" style="font-size:13px;">
                                                        {{ $k->name }}
                                                    </div>
                                                    <div class="item-meta">{{ $k->period }} · Urutan:
                                                        {{ $k->order }}</div>
                                                </div>
                                                <div style="display:flex;gap:6px;align-items:center;">
                                                    <button type="button"
                                                        onclick="editKetuaUmum(event, {{ $k->id }})"
                                                        class="edit-btn" data-name="{{ $k->name }}"
                                                        data-period="{{ $k->period }}"
                                                        data-order="{{ $k->order }}"
                                                        data-is_active="{{ $k->is_active ? 'true' : 'false' }}">✏️</button>
                                                    <form action="{{ route('admin.ketuaUmums.delete', $k->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            style="background:none;border:none;cursor:pointer;color:#f87171;font-size:16px;"
                                                            onclick="return confirm('Hapus?')">🗑️</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-state" style="padding:24px;">
                                        <div class="empty-icon" style="font-size:32px;">👑</div>
                                        <div class="empty-desc">Belum ada data ketua umum</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ==================== SEKILAS ==================== --}}
                <div id="tab-sekilas" class="tab-panel">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

                        {{-- Panel Konten Sekilas --}}
                        <div class="card">
                            <div class="card-header">
                                <h3>👁️ Konten Sekilas PII</h3>
                                @if ($sekilas)
                                    <span class="badge-active">Tersimpan</span>
                                @else
                                    <span class="badge-inactive">Belum ada</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.sekilas.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="title" value="{{ $sekilas->title ?? '' }}"
                                            class="form-input" required placeholder="Judul konten sekilas">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Upload Gambar</label>
                                        <div style="margin-bottom:8px;">
                                            @if ($sekilas && ($sekilas->image ?? false))
                                                <img id="preview-sekilas"
                                                    src="{{ Str::startsWith($sekilas->image, ['http://', 'https://']) ? $sekilas->image : asset($sekilas->image) }}"
                                                    alt="Preview"
                                                    style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;">
                                            @else
                                                <img id="preview-sekilas" src="" alt="Preview"
                                                    style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;display:none;">
                                            @endif
                                        </div>
                                        <input type="file" name="image" accept="image/*" class="form-input"
                                            onchange="previewImage(this, 'preview-sekilas')">
                                        <p style="font-size:11px;color:#d1d5db;margin-top:4px;">JPEG, PNG, JPG, GIF —
                                            Maks.
                                            2MB</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Konten</label>
                                        <textarea name="content" id="sekilas-editor" class="form-input form-textarea tinymce-editor"
                                            placeholder="Tuliskan konten sekilas PII di sini...">{{ $sekilas->content ?? '' }}</textarea>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1"
                                            id="is_active_sekilas"
                                            style="width:16px;height:16px;accent-color:#f97316;"
                                            {{ $sekilas->is_active ?? true ? 'checked' : '' }}>
                                        <label for="is_active_sekilas" class="form-label" style="margin:0;">Tampilkan
                                            di
                                            website</label>
                                    </div>
                                    <button type="submit" class="btn-orange"
                                        style="width:100%;justify-content:center;">
                                        <svg width="16" height="16" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Sekilas
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Panel Visi & Misi --}}
                        <div class="card">
                            <div class="card-header">
                                <h3>🎯 Visi &amp; Misi</h3>
                                @if (isset($visiMisis) && $visiMisis)
                                    <span class="badge-active">Tersimpan</span>
                                @else
                                    <span class="badge-inactive">Belum ada</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.visiMisis.store') }}" method="POST"
                                    id="form-visi-misi">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="title" value="{{ $visiMisis->title ?? '' }}"
                                            class="form-input" required placeholder="contoh: Visi &amp; Misi PII">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Isi Konten</label>
                                        <textarea name="content" id="visi-misi-editor" class="form-input form-textarea tinymce-editor"
                                            placeholder="Tuliskan visi dan misi di sini...">{{ $visiMisis->content ?? '' }}</textarea>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1"
                                            id="is_active_visi_misi"
                                            style="width:16px;height:16px;accent-color:#f97316;"
                                            {{ $visiMisis->is_active ?? true ? 'checked' : '' }}>
                                        <label for="is_active_visi_misi" class="form-label"
                                            style="margin:0;">Tampilkan
                                            di website</label>
                                    </div>
                                    <button type="submit" class="btn-orange"
                                        style="width:100%;justify-content:center;">
                                        <svg width="16" height="16" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Visi &amp; Misi
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ==================== STRUKTUR ==================== --}}
                <div id="tab-strukturs" class="tab-panel">
                    <div style="max-width:700px;">
                        <div class="card">
                            <div class="card-header">
                                <h3>👥 Konten Struktur Organisasi</h3>
                                @if ($strukturs)
                                    <span class="badge-active">Tersimpan</span>
                                @else
                                    <span class="badge-inactive">Belum ada</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.strukturs.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @if ($errors->any())
                                        <div
                                            style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#b91c1c;">
                                            @foreach ($errors->all() as $e)
                                                <div>• {{ $e }}</div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="title" value="{{ $strukturs->title ?? '' }}"
                                            class="form-input" required
                                            placeholder="Judul konten struktur organisasi">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Upload Gambar</label>
                                        <div style="margin-bottom:8px;">
                                            @if ($strukturs && ($strukturs->image ?? false))
                                                <img id="preview-struktur"
                                                    src="{{ Str::startsWith($strukturs->image, ['http://', 'https://']) ? $strukturs->image : asset($strukturs->image) }}"
                                                    alt="Preview"
                                                    style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;">
                                            @else
                                                <img id="preview-struktur" src="" alt="Preview"
                                                    style="width:100%;max-height:180px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;display:none;">
                                            @endif
                                        </div>
                                        <input type="file" name="image" accept="image/*" class="form-input"
                                            onchange="previewImage(this, 'preview-struktur')">
                                        <p style="font-size:11px;color:#d1d5db;margin-top:4px;">JPEG, PNG, JPG, GIF —
                                            Maks.
                                            2MB</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Konten</label>
                                        <textarea name="content" id="struktur-editor" class="form-input form-textarea tinymce-editor"
                                            placeholder="Tuliskan konten struktur organisasi PII di sini...">{{ $strukturs->content ?? '' }}</textarea>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1"
                                            id="is_active_struktur"
                                            style="width:16px;height:16px;accent-color:#f97316;"
                                            {{ $strukturs->is_active ?? true ? 'checked' : '' }}>
                                        <label for="is_active_struktur" class="form-label"
                                            style="margin:0;">Tampilkan di
                                            website</label>
                                    </div>
                                    <button type="submit" class="btn-orange"
                                        style="width:100%;justify-content:center;">
                                        <svg width="16" height="16" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Struktur Organisasi
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ==================== KONTAK ==================== --}}
                <div id="tab-kontaks" class="tab-panel">
                    <div style="max-width:700px;">
                        <div class="card">
                            <div class="card-header">
                                <h3>📞 Informasi Kontak</h3>
                                @if ($kontaks)
                                    <span class="badge-active">Tersimpan</span>
                                @else
                                    <span class="badge-inactive">Belum ada</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.kontaks.store') }}" method="POST">
                                    @csrf
                                    @if ($errors->any())
                                        <div
                                            style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#b91c1c;">
                                            @foreach ($errors->all() as $e)
                                                <div>• {{ $e }}</div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="address" class="form-input form-textarea" required placeholder="Alamat lengkap kantor PII">{{ $kontaks->address ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Telepon</label>
                                        <input type="text" name="phone" value="{{ $kontaks->phone ?? '' }}"
                                            class="form-input" required placeholder="Nomor telepon">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ $kontaks->email ?? '' }}"
                                            class="form-input" required placeholder="Email resmi">
                                    </div>
                                    <div style="border-top:1px solid #e5e7eb;margin:16px 0;padding-top:16px;">
                                        <p style="font-size:13px;font-weight:600;color:#6b7280;margin-bottom:12px;">
                                            Media
                                            Sosial (opsional)</p>
                                        <div class="form-group">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" name="facebook"
                                                value="{{ $kontaks->facebook ?? '' }}" class="form-input"
                                                placeholder="URL Facebook">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Twitter / X</label>
                                            <input type="text" name="twitter"
                                                value="{{ $kontaks->twitter ?? '' }}" class="form-input"
                                                placeholder="URL Twitter / X">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" name="instagram"
                                                value="{{ $kontaks->instagram ?? '' }}" class="form-input"
                                                placeholder="URL Instagram">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">LinkedIn</label>
                                            <input type="text" name="linkedin"
                                                value="{{ $kontaks->linkedin ?? '' }}" class="form-input"
                                                placeholder="URL LinkedIn">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">YouTube</label>
                                            <input type="text" name="youtube"
                                                value="{{ $kontaks->youtube ?? '' }}" class="form-input"
                                                placeholder="URL YouTube">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Google Maps Embed Code</label>
                                        <textarea name="map_url" class="form-input form-textarea" rows="4"
                                            placeholder='Paste kode <iframe> dari Google Maps di sini...'>{{ $kontaks->map_url ?? '' }}</textarea>
                                        <p style="font-size:11px;color:#d1d5db;margin-top:4px;">Google Maps → Share →
                                            Embed
                                            a map → Copy HTML</p>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" id="is_active_kontak"
                                            style="width:16px;height:16px;accent-color:#f97316;"
                                            {{ $kontaks->is_active ?? true ? 'checked' : '' }}>
                                        <label for="is_active_kontak" class="form-label" style="margin:0;">Tampilkan
                                            di
                                            website</label>
                                    </div>
                                    <button type="submit" class="btn-orange"
                                        style="width:100%;justify-content:center;">
                                        <svg width="16" height="16" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Kontak
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            {{-- ==================== EVENTS ==================== --}}
            <div id="tab-events" class="tab-panel">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- List Panel -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Daftar Event & Pelatihan</h3>
                            <button onclick="showForm(event, 'event')" class="btn-orange">
                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Event
                            </button>
                        </div>
                        <div class="card-body">
                            @if ($events->total() > 0)
                                <div class="space-y-4">
                                    @foreach ($events as $e)
                                        <div class="item-row">
                                            @if ($e->image)
                                                <img src="{{ Str::startsWith($e->image, ['http://', 'https://']) ? $e->image : asset($e->image) }}"
                                                    class="item-thumb" alt="{{ $e->title }}">
                                            @else
                                                <div class="item-thumb-placeholder">📅</div>
                                            @endif
                                            <div class="item-info">
                                                <div class="item-title">{{ $e->title }}</div>
                                                <div class="item-meta" style="color:#f97316;font-weight:500;">
                                                    {{ ucfirst($e->type) }}
                                                    @if ($e->category)
                                                        · {{ str_replace('_', ' ', ucwords($e->category, '_')) }}
                                                    @endif
                                                    @if ($e->sub_category)
                                                        · {{ $e->sub_category }}
                                                    @endif
                                                </div>
                                                @if ($e->event_date)
                                                    <div class="item-meta">📅 {{ $e->event_date->format('d M Y') }}
                                                        @if ($e->location)
                                                            · 📍 {{ $e->location }}
                                                        @endif
                                                    </div>
                                                @endif
                                                <div style="margin-top:6px;">
                                                    <span
                                                        class="{{ $e->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $e->is_active ? 'Aktif' : 'Non-Aktif' }}</span>
                                                </div>
                                            </div>
                                            <div style="display:flex;gap:6px;align-items:center;">
                                                <button type="button"
                                                    onclick="showForm(event, 'event', {{ $e->id }})"
                                                    class="edit-btn" data-title="{{ $e->title }}"
                                                    data-type="{{ $e->type }}"
                                                    data-category="{{ $e->category }}"
                                                    data-sub_category="{{ $e->sub_category }}"
                                                    data-event_date="{{ $e->event_date ? $e->event_date->format('Y-m-d') : '' }}"
                                                    data-location="{{ $e->location }}"
                                                    data-link="{{ $e->link }}"
                                                    data-current-image="{{ $e->image ?? '' }}"
                                                    data-is_active="{{ $e->is_active ? 'true' : 'false' }}">Edit</button>
                                                <form action="{{ route('admin.events.delete', $e->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="events_page"
                                                        value="{{ $events->currentPage() }}">
                                                    <button type="submit"
                                                        style="background:none;border:none;cursor:pointer;color:#ef4444;font-size:16px;"
                                                        onclick="return confirm('Hapus event ini?')">🗑️</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- Pagination --}}
                                @if ($events->hasPages())
                                    <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                                        {{ $events->fragment('tab=events')->links() }}
                                    </div>
                                @endif
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">📅</div>
                                    <div class="empty-title">Belum ada Event</div>
                                    <div class="empty-desc">Jadwalkan event dan pelatihan PII</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Form Panel -->
                    <div id="form-panel-event" class="card" style="display:none;">
                        <div class="card-header">
                            <h3 id="form-title-event">Tambah Event</h3>
                            <button onclick="hideForm('event')" class="btn-cancel">Batal</button>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.events.store') }}" method="POST"
                                enctype="multipart/form-data" id="form-event">
                                @csrf
                                <input type="hidden" name="_method" value="POST" id="event-method">
                                <div class="form-group">
                                    <label class="form-label">Judul</label>
                                    <input type="text" name="title" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tipe</label>
                                    <select name="type" class="form-input" required>
                                        <option value="seminar">Seminar</option>
                                        <option value="pelatihan">Pelatihan</option>
                                        <option value="konferensi">Konferensi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kategori</label>
                                    <select name="category" class="form-input">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="nasional">Nasional</option>
                                        <option value="internasional">Internasional</option>
                                        <option value="regional">Regional</option>
                                        <option value="online">Online</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sub Kategori (Opsional)</label>
                                    <input type="text" name="sub_category" class="form-input"
                                        placeholder="Tuliskan sub kategori bebas...">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Event</label>
                                    <input type="date" name="event_date" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" name="location" class="form-input"
                                        placeholder="Kota / Online">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Link Pendaftaran (Opsional)</label>
                                    <input type="text" name="link" class="form-input"
                                        placeholder="https://...">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Konten</label>
                                    <textarea name="content" id="event-content" class="form-input form-textarea tinymce-editor" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gambar</label>
                                    <input type="file" name="image" accept="image/*" class="form-input"
                                        onchange="previewEventImage(event)">
                                    <div id="event-image-preview-wrap" style="margin-top:10px;display:none;">
                                        <img id="event-image-preview" src="" alt="Preview"
                                            style="max-width:200px;max-height:140px;border-radius:8px;border:1px solid #e2e8f0;object-fit:cover;">
                                    </div>
                                </div>
                                <div style="display:flex;align-items:center;gap:8px;margin-bottom:16px;">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" id="event-active"
                                        style="width:16px;height:16px;accent-color:#f97316;" checked>
                                    <label for="event-active" class="form-label" style="margin:0;">Aktif</label>
                                </div>
                                <button type="submit" class="btn-orange"
                                    style="width:100%;justify-content:center;">Simpan Event</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            {{-- ==================== GALLERY ==================== --}}
            <div id="tab-galleries" class="tab-panel">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- List Panel -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Gallery</h3>
                            <button onclick="showForm(event, 'gallery')" class="btn-orange">
                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Foto
                            </button>
                        </div>
                        <div class="card-body">
                            @if ($galleries->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($galleries as $g)
                                        <div class="item-row">
                                            @if ($g->image)
                                                <img src="{{ Str::startsWith($g->image, ['http://', 'https://']) ? $g->image : asset($g->image) }}"
                                                    class="item-thumb" alt="{{ $g->title }}">
                                            @else
                                                <div class="item-thumb-placeholder">🖼️</div>
                                            @endif
                                            <div class="item-info">
                                                <div class="item-title">{{ $g->title }}</div>
                                                @if ($g->category)
                                                    <div class="item-meta" style="color:#f97316;font-weight:500;">
                                                        {{ $g->category }}</div>
                                                @endif
                                                <div class="item-meta">{{ Str::limit($g->description, 60) }}</div>
                                                <div style="margin-top:6px;display:flex;gap:8px;align-items:center;">
                                                    <span
                                                        class="{{ $g->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $g->is_active ? 'Aktif' : 'Non-Aktif' }}</span>
                                                    <span style="font-size:11px;color:#d1d5db;">Order:
                                                        {{ $g->order }}</span>
                                                </div>
                                            </div>
                                            <div style="display:flex;gap:6px;align-items:center;">
                                                <button onclick="showForm(event, 'gallery', {{ $g->id }})"
                                                    class="edit-btn" data-title="{{ $g->title }}"
                                                    data-category="{{ $g->category }}"
                                                    data-description="{{ $g->description }}"
                                                    data-order="{{ $g->order }}"
                                                    data-current-image="{{ $g->image ?? '' }}"
                                                    data-is_active="{{ $g->is_active ? 'true' : 'false' }}">Edit</button>
                                                <form action="{{ route('admin.galleries.delete', $g->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="galleries_page"
                                                        value="{{ $galleries->currentPage() }}">
                                                    <button type="submit"
                                                        style="background:none;border:none;cursor:pointer;color:#ef4444;font-size:16px;"
                                                        onclick="return confirm('Hapus foto ini?')">🗑️</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Pagination -->
                                @if ($galleries->hasPages())
                                    <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                                        {{ $galleries->fragment('tab=galleries')->links() }}
                                    </div>
                                @endif
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">🖼️</div>
                                    <div class="empty-title">Belum ada Foto</div>
                                    <div class="empty-desc">Unggah foto-foto kegiatan PII</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Form Panel -->
                    <div id="form-panel-gallery" class="card" style="display:none;">
                        <div class="card-header">
                            <h3 id="form-title-gallery">Tambah Foto</h3>
                            <button onclick="hideForm('gallery')" class="btn-cancel">Batal</button>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.galleries.store') }}" method="POST"
                                enctype="multipart/form-data" id="form-gallery">
                                @csrf
                                <input type="hidden" name="_method" value="POST" id="gallery-method">
                                <input type="hidden" name="gallery_id" id="gallery-id">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" id="gallery-title" class="form-input"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <input type="text" name="category" id="gallery-category"
                                        class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="gallery-description" class="form-input form-textarea"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gambar</label>
                                    <input type="file" name="image" id="gallery-image" accept="image/*"
                                        class="form-input" onchange="previewGalleryImage(event)">
                                    <div id="gallery-image-preview-wrap" style="margin-top:10px;display:none;">
                                        <img id="gallery-image-preview" src="" alt="Preview"
                                            style="max-width:200px;max-height:140px;border-radius:8px;border:1px solid #e2e8f0;background:#f8fafc;padding:4px;object-fit:cover;">
                                        <p id="gallery-image-preview-label"
                                            style="font-size:12px;color:#6b7280;margin-top:4px;">Preview gambar</p>
                                    </div>
                                    <p style="font-size:11px;color:#9ca3af;margin-top:4px;">Kosongkan jika ingin
                                        mempertahankan gambar saat ini (mode edit).</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" name="order" id="gallery-order" value="0"
                                        class="form-input">
                                </div>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" id="gallery-active"
                                        style="width:16px;height:16px;accent-color:#f97316;" checked>
                                    <label for="gallery-active" class="form-label" style="margin:0;">Aktif</label>
                                </div>
                                <button type="submit" class="btn-orange"
                                    style="width:100%;justify-content:center;margin-top:16px;">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== KEMITRAAN ==================== --}}
            <div id="tab-kemitraans" class="tab-panel">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- List Panel -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Kemitraan</h3>
                            <button onclick="showForm(event, 'kemitraan')" class="btn-orange">
                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Mitra
                            </button>
                        </div>
                        <div class="card-body">
                            @if ($kemitraans->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($kemitraans as $km)
                                        <div class="item-row">
                                            @if ($km->logo)
                                                <img src="{{ $km->logo }}" class="item-thumb"
                                                    alt="{{ $km->name }}"
                                                    style="object-fit:contain;background:#f9fafb;padding:4px;">
                                            @else
                                                <div class="item-thumb-placeholder">🤝</div>
                                            @endif
                                            <div class="item-info">
                                                <div class="item-title">{{ $km->name }}</div>
                                                <div class="item-meta" style="color:#f97316;font-weight:500;">
                                                    {{ str_replace('_', ' ', $km->type) }}</div>
                                                <div class="item-meta">{{ Str::limit($km->description, 60) }}</div>
                                                <div style="margin-top:6px;display:flex;gap:8px;align-items:center;">
                                                    <span
                                                        class="{{ $km->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $km->is_active ? 'Aktif' : 'Non-Aktif' }}</span>
                                                    <span style="font-size:11px;color:#d1d5db;">Order:
                                                        {{ $km->order }}</span>
                                                </div>
                                            </div>
                                            <div style="display:flex;gap:6px;align-items:center;">
                                                <button type="button"
                                                    onclick="showForm(event, 'kemitraan', {{ $km->id }})"
                                                    class="edit-btn" data-name="{{ $km->name }}"
                                                    data-type="{{ $km->type }}"
                                                    data-description="{{ $km->description }}"
                                                    data-logo="{{ $km->logo }}"
                                                    data-link="{{ $km->link }}"
                                                    data-order="{{ $km->order }}"
                                                    data-is_active="{{ $km->is_active ? 'true' : 'false' }}"
                                                    data-current-image="{{ $km->logo }}">Edit</button>
                                                <form action="{{ route('admin.kemitraans.delete', $km->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="kemitraans_page"
                                                        value="{{ request()->get('kemitraans_page', 1) }}">
                                                    <button type="submit"
                                                        style="background:none;border:none;cursor:pointer;color:#ef4444;font-size:16px;"
                                                        onclick="return confirm('Hapus kemitraan ini?')">🗑️</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Pagination -->
                                @if ($kemitraans->hasPages())
                                    <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                                        {{ $kemitraans->fragment('tab=kemitraans')->links() }}
                                    </div>
                                @endif
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">🤝</div>
                                    <div class="empty-title">Belum ada Mitra</div>
                                    <div class="empty-desc">Tambahkan mitra dan rekanan PII</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Form Panel -->
                    <div id="form-panel-kemitraan" class="card" style="display:none;">
                        <div class="card-header">
                            <h3 id="form-title-kemitraan">Tambah Mitra</h3>
                            <button onclick="hideForm('kemitraan')" class="btn-cancel">Batal</button>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.kemitraans.store') }}" method="POST"
                                enctype="multipart/form-data" id="form-kemitraan">
                                @csrf
                                <input type="hidden" name="_method" value="POST" id="kemitraan-method">
                                <div class="form-group">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Type</label>
                                    <select name="type" id="kemitraan-type" class="form-input">
                                        <option value="kerjasama_kampus">Kerjasama Kampus</option>
                                        <option value="kerjasama_industri">Kerjasama Industri</option>
                                        <option value="program_pemerintah">Program Pemerintah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="kemitraan-description" class="form-input form-textarea"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Logo</label>
                                    <input type="file" name="logo" accept="image/*" class="form-input"
                                        onchange="previewKemitraanImage(this)">
                                    <div id="kemitraan-image-preview-wrap" style="margin-top:8px;display:none;">
                                        <p id="kemitraan-image-preview-label"
                                            style="font-size:11px;color:#6b7280;margin-bottom:4px;">Preview</p>
                                        <img id="kemitraan-image-preview" src=""
                                            style="max-height:100px;border-radius:6px;border:1px solid #e5e7eb;background:#f9fafb;padding:4px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Link</label>
                                    <input type="text" name="link" id="kemitraan-link" class="form-input"
                                        placeholder="https://...">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" name="order" value="0" class="form-input">
                                </div>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" id="kemitraan-active"
                                        style="width:16px;height:16px;accent-color:#f97316;" checked>
                                    <label for="kemitraan-active" class="form-label"
                                        style="margin:0;">Aktif</label>
                                </div>
                                <button type="submit" class="btn-orange"
                                    style="width:100%;justify-content:center;margin-top:16px;">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->role === 'admin')
                {{-- ==================== USERS ==================== --}}
                <div id="tab-users" class="tab-panel">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- List Panel -->
                        <div class="card">
                            <div class="card-header">
                                <h3>Daftar User</h3>
                                <button onclick="showForm(event, 'user')" class="btn-orange">
                                    <svg width="16" height="16" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah User
                                </button>
                            </div>
                            <div class="card-body">
                                @if ($users->count() > 0)
                                    <div class="space-y-4">
                                        @foreach ($users as $u)
                                            <div class="item-row">
                                                <div class="item-thumb-placeholder">👤</div>
                                                <div class="item-info">
                                                    <div class="item-title">{{ $u->name }}</div>
                                                    <div class="item-meta">{{ $u->email }} ·
                                                        {{ $u->role ?? 'user' }}</div>
                                                    <div style="margin-top:6px;">
                                                        <span
                                                            class="{{ $u->role === 'admin' ? 'badge-active' : 'badge-inactive' }}">
                                                            {{ $u->role === 'admin' ? 'Admin' : 'User' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <button onclick="showForm(event, 'user', {{ $u->id }})"
                                                    class="edit-btn" data-name="{{ $u->name }}"
                                                    data-email="{{ $u->email }}"
                                                    data-role="{{ $u->role }}">Edit</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Pagination -->
                                    @if ($users->hasPages())
                                        <div
                                            style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                                            {{ $users->fragment('tab=users')->links() }}
                                        </div>
                                    @endif
                                @else
                                    <div class="empty-state">
                                        <div class="empty-icon">👤</div>
                                        <div class="empty-title">Belum ada User</div>
                                        <div class="empty-desc">Tambahkan user untuk mengakses admin panel</div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Form Panel -->
                        <div id="form-panel-user" class="card" style="display:none;">
                            <div class="card-header">
                                <h3 id="form-title-user">Tambah User</h3>
                                <button onclick="hideForm('user')" class="btn-cancel">Batal</button>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.users.store') }}" method="POST" id="form-user">
                                    @csrf
                                    <input type="hidden" name="_method" value="POST" id="user-method">
                                    <input type="hidden" name="user_id" id="user-id">
                                    <div class="form-group">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="name" id="user-name" class="form-input"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" id="user-email" class="form-input"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" id="user-password"
                                            class="form-input"
                                            placeholder="Kosongkan untuk tetap menggunakan password saat ini (mode edit)"
                                            oninput="checkPasswordStrength(this.value)">
                                        <div id="password-strength-bar"
                                            style="height:4px;border-radius:4px;margin-top:6px;background:#e5e7eb;overflow:hidden;">
                                            <div id="password-strength-fill"
                                                style="height:100%;width:0%;transition:width 0.3s,background 0.3s;border-radius:4px;">
                                            </div>
                                        </div>
                                        <p id="password-strength-text"
                                            style="font-size:11px;margin-top:4px;color:#9ca3af;"></p>
                                        <p style="font-size:11px;color:#6b7280;margin-top:4px;">
                                            Min. 8 karakter &bull; Huruf besar &amp; kecil &bull; Angka
                                        </p>
                                    </div>
                                    <div class="form-group" id="password-confirm-group">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation"
                                            id="user-password-confirm" class="form-input"
                                            placeholder="Ulangi password" oninput="checkPasswordMatch()">
                                        <p id="password-match-text" style="font-size:11px;margin-top:4px;"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Role</label>
                                        <select name="role" id="user-role" class="form-input">
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn-orange"
                                        style="width:100%;justify-content:center;margin-top:16px;">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ==================== PENGATURAN SITUS ==================== --}}
                <div id="tab-settings" class="tab-panel">
                    <div class="card">
                        <div class="card-header">
                            <h3>⚙️ Pengaturan Situs</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Kolom Kiri -->
                                    <div>
                                        <h4 style="font-size:14px;font-weight:700;margin-bottom:12px;color:#f97316;">
                                            Identitas Website</h4>
                                        <div class="form-group">
                                            <label class="form-label">Nama Website (Navbar)</label>
                                            <input type="text" name="site_title" class="form-input"
                                                value="{{ $site_settings['site_title'] ?? '' }}"
                                                placeholder="Contoh: Persatuan Insinyur Indonesia">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Logo Website (Utama)</label>
                                            <input type="file" name="site_logo" accept="image/*"
                                                class="form-input">
                                            @if (isset($site_settings['site_logo']))
                                                <div style="margin-top:8px;">
                                                    <img src="{{ asset($site_settings['site_logo']) }}"
                                                        style="height:40px; border-radius:4px; background:#f8fafc; padding:4px; border:1px solid #e2e8f0;">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Logo Website (Kedua)</label>
                                            <input type="file" name="site_logo_secondary" accept="image/*"
                                                class="form-input">
                                            @if (isset($site_settings['site_logo_secondary']))
                                                <div style="margin-top:8px;">
                                                    <img src="{{ asset($site_settings['site_logo_secondary']) }}"
                                                        style="height:40px; border-radius:4px; background:#f8fafc; padding:4px; border:1px solid #e2e8f0;">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Favicon (Icon Tab Browser)</label>
                                            <input type="file" name="site_favicon" accept="image/*,.ico"
                                                class="form-input">
                                            <p style="font-size:12px;color:#9ca3af;margin-top:4px;">Format: PNG, JPG,
                                                WEBP, ICO, SVG.
                                                Gambar besar akan otomatis dikompres ke 64x64px.</p>
                                            @if (isset($site_settings['site_favicon']))
                                                <div
                                                    style="margin-top:8px; display:flex; align-items:center; gap:8px;">
                                                    <img src="{{ asset($site_settings['site_favicon']) }}"
                                                        style="width:32px; height:32px; border-radius:4px; background:#f8fafc; padding:2px; border:1px solid #e2e8f0;">
                                                    <span style="font-size:12px;color:#6b7280;">Preview Favicon</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Link Daftar Anggota</label>
                                            <input type="url" name="member_registration_link"
                                                class="form-input"
                                                value="{{ $site_settings['member_registration_link'] ?? '' }}"
                                                placeholder="https://example.com/daftar-anggota">
                                            <p style="font-size:12px;color:#9ca3af;margin-top:4px;">Link untuk button
                                                "Daftar Anggota" di halaman utama. Contoh: https://forms.google.com/...
                                                atau
                                                https://pi.or.id/daftar</p>
                                        </div>

                                        <h4
                                            style="font-size:14px;font-weight:700;margin-top:24px;margin-bottom:12px;color:#f97316;">
                                            Footer Info</h4>
                                        <div class="form-group">
                                            <label class="form-label">Deskripsi Singkat</label>
                                            <textarea name="footer_description" class="form-input" rows="4">{{ $site_settings['footer_description'] ?? 'Wadah persatuan dan kesatuan insinyur Indonesia untuk memajukan profesi keinsinyuran dan berkontribusi bagi pembangunan bangsa.' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Teks Copyright</label>
                                            <input type="text" name="footer_copyright" class="form-input"
                                                value="{{ $site_settings['footer_copyright'] ?? 'Persatuan Insinyur Indonesia. Hak Cipta Dilindungi.' }}">
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div>
                                        <h4 style="font-size:14px;font-weight:700;margin-bottom:12px;color:#f97316;">
                                            Sosial Media</h4>
                                        <div class="form-group">
                                            <label class="form-label">Facebook URL</label>
                                            <input type="url" name="footer_facebook" class="form-input"
                                                value="{{ $site_settings['footer_facebook'] ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Twitter/X URL</label>
                                            <input type="url" name="footer_twitter" class="form-input"
                                                value="{{ $site_settings['footer_twitter'] ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Instagram URL</label>
                                            <input type="url" name="footer_instagram" class="form-input"
                                                value="{{ $site_settings['footer_instagram'] ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">YouTube URL</label>
                                            <input type="url" name="footer_youtube" class="form-input"
                                                value="{{ $site_settings['footer_youtube'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top:24px; border-top:1px solid #f1f5f9; padding-top:24px;">
                                    <h4 style="font-size:14px;font-weight:700;margin-bottom:12px;color:#f97316;">
                                        Tautan
                                        Cepat (Footer)</h4>
                                    @php
                                        $quick_links = [];
                                        if (isset($site_settings['footer_quick_links'])) {
                                            $quick_links =
                                                json_decode($site_settings['footer_quick_links'], true) ?? [];
                                        }
                                        $available_routes = [
                                            '' => '-- Pilih Halaman --',
                                            '/' => 'Beranda',
                                            '/tentang/sejarah' => 'Tentang PII - Sejarah',
                                            '/tentang/sekilas' => 'Tentang PII - Sekilas',
                                            '/tentang/struktur' => 'Tentang PII - Struktur Organisasi',
                                            '/tentang/kontak' => 'Tentang PII - Kontak',
                                            '/event' => 'Event & Pelatihan (Semua)',
                                            '/event/seminar' => 'Event - Seminar',
                                            '/event/pelatihan' => 'Event - Pelatihan',
                                            '/event/konferensi' => 'Event - Konferensi',
                                            '/artikel' => 'Berita & Artikel (Semua)',
                                            '/artikel/artikel-teknik' => 'Artikel Teknik',
                                            '/artikel/regulasi' => 'Artikel Regulasi',
                                            '/artikel/inovasi' => 'Artikel Inovasi',
                                            '/artikel/opini' => 'Artikel Opini',
                                            '/gallery' => 'Gallery',
                                            '/kemitraan' => 'Kemitraan (Semua)',
                                            '/kemitraan/kampus' => 'Kemitraan Kampus',
                                            '/kemitraan/industri' => 'Kemitraan Industri',
                                            '/kemitraan/pemerintah' => 'Kemitraan Pemerintah',
                                        ];
                                    @endphp
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div style="display:flex; gap:12px;">
                                                <div class="form-group" style="flex:1; margin-bottom:0;">
                                                    <input type="text"
                                                        name="quick_link_label_{{ $i }}"
                                                        class="form-input"
                                                        placeholder="Label Tautan {{ $i }}"
                                                        value="{{ $quick_links[$i - 1]['label'] ?? '' }}">
                                                </div>
                                                <div class="form-group" style="flex:2; margin-bottom:0;">
                                                    <select name="quick_link_url_{{ $i }}"
                                                        class="form-input">
                                                        @foreach ($available_routes as $url => $name)
                                                            <option value="{{ $url }}"
                                                                {{ ($quick_links[$i - 1]['url'] ?? '') == $url ? 'selected' : '' }}>
                                                                {{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                <div style="margin-top:32px;">
                                    <button type="submit" class="btn-orange"
                                        style="min-width:200px; justify-content:center;">
                                        <svg width="18" height="18" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Pengaturan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div><!-- end content-area -->
    </div><!-- end main-content -->

    <div id="toast-container" class="toast-container"></div>

    <!-- TinyMCE Rich Text Editor -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        const titles = {
            heroes: 'Hero Section',
            beritas: 'Berita',
            sejarahs: 'Sejarah & Ketua Umum',
            sekilas: 'Sekilas PII',
            strukturs: 'Struktur Organisasi',
            kontaks: 'Kontak',
            events: 'Event & Pelatihan',
            galleries: 'Gallery',
            kemitraans: 'Kemitraan',
            users: 'Manajemen User',
            settings: 'Pengaturan Situs'
        };

        const pluralMap = {
            hero: 'heroes',
            berita: 'beritas',
            sejarah: 'sejarahs',
            sekila: 'sekilas',
            struktur: 'strukturs',
            kontak: 'kontaks',
            event: 'events',
            gallery: 'galleries',
            kemitraan: 'kemitraans',
            user: 'users',
            setting: 'settings'
        };

        function toggleMobileSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('sidebar-open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth > 1024) return;
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.querySelector('#mobile-menu-toggle');
            const mainContent = document.querySelector('.main-content');
            if (!sidebar || !toggleBtn) return;
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target) && sidebar.classList.contains(
                    'active')) {
                sidebar.classList.remove('active');
                mainContent.classList.remove('sidebar-open');
            }
        });

        function showTab(tabName) {
            document.querySelectorAll('.tab-panel').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
            // Close mobile sidebar on tab change
            if (window.innerWidth <= 1024) {
                const sidebar = document.querySelector('.sidebar');
                const mainContent = document.querySelector('.main-content');
                sidebar.classList.remove('active');
                mainContent.classList.remove('sidebar-open');
            }
            const tab = document.getElementById('tab-' + tabName);
            const nav = document.getElementById('nav-' + tabName);
            if (tab) tab.classList.add('active');
            if (nav) nav.classList.add('active');
            document.getElementById('topbar-title').textContent = titles[tabName] || tabName;
            history.replaceState(null, null, '#tab=' + tabName);
        }

        // Restore tab from URL on load
        (function() {
            const hash = window.location.hash;
            if (hash && hash.startsWith('#tab=')) {
                const tabName = hash.replace('#tab=', '');
                if (document.getElementById('tab-' + tabName)) {
                    showTab(tabName);
                }
            }
        })();

        function previewEventImage(e) {
            const file = e.target.files && e.target.files[0];
            const wrap = document.getElementById('event-image-preview-wrap');
            const img = document.getElementById('event-image-preview');
            if (file && wrap && img) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    img.src = ev.target.result;
                    wrap.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (!preview) return;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        function previewHeroImage(input) {
            const wrap = document.getElementById('hero-image-preview-wrap');
            const img = document.getElementById('hero-image-preview');
            if (!wrap || !img || !input.files || !input.files[0]) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                wrap.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }

        function previewBeritaImage(event) {
            const file = event.target.files && event.target.files[0];
            const wrap = document.getElementById('berita-image-preview-wrap');
            const img = document.getElementById('berita-image-preview');
            const label = document.getElementById('berita-image-preview-label');
            const empty = document.getElementById('berita-image-empty');
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                wrap.style.display = 'block';
                if (label) label.textContent = 'Preview gambar baru';
                if (empty) empty.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        function previewGalleryImage(event) {
            const file = event.target.files && event.target.files[0];
            const wrap = document.getElementById('gallery-image-preview-wrap');
            const img = document.getElementById('gallery-image-preview');
            const label = document.getElementById('gallery-image-preview-label');
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                wrap.style.display = 'block';
                if (label) label.textContent = 'Preview gambar baru';
            };
            reader.readAsDataURL(file);
        }

        function setGalleryImagePreview(url) {
            const wrap = document.getElementById('gallery-image-preview-wrap');
            const img = document.getElementById('gallery-image-preview');
            const label = document.getElementById('gallery-image-preview-label');
            if (!wrap || !img) return;
            if (url) {
                // Handle both absolute URLs and relative paths
                img.src = url.startsWith('http') ? url : '/' + url.replace(/^\/+/, '');
                wrap.style.display = 'block';
                if (label) label.textContent = 'Gambar saat ini';
            } else {
                wrap.style.display = 'none';
                img.src = '';
            }
        }

        function setBeritaImagePreview(url) {
            const wrap = document.getElementById('berita-image-preview-wrap');
            const img = document.getElementById('berita-image-preview');
            const label = document.getElementById('berita-image-preview-label');
            const empty = document.getElementById('berita-image-empty');
            if (!wrap || !img) return;
            if (url) {
                img.src = url;
                wrap.style.display = 'block';
                if (label) label.textContent = 'Gambar saat ini';
                if (empty) empty.style.display = 'none';
            } else {
                img.src = '';
                wrap.style.display = 'none';
                if (empty) empty.style.display = 'block';
            }
        }

        async function showForm(event, type, id = null) {
            const panel = document.getElementById('form-panel-' + type);
            if (!panel) return;
            panel.style.display = 'block';
            panel.classList.add('active');

            const pluralType = pluralMap[type] || type + 's';
            const form = document.getElementById('form-' + type);
            if (!form) return;

            if (id) {
                document.getElementById('form-title-' + type).textContent = 'Edit ' + capitalize(type);
                const methodInput = document.getElementById(type + '-method');
                if (methodInput) methodInput.value = 'PUT';
                form.action = '/admin/' + pluralType + '/' + id;

                // Make all file inputs optional in edit mode
                form.querySelectorAll('input[type="file"]').forEach(input => {
                    input.required = false;
                });

                // Set image preview from data-current-image (berita / event)
                if (type === 'berita') {
                    const btnEl = event && event.currentTarget ? event.currentTarget : null;
                    const currentImage = btnEl ? btnEl.getAttribute('data-current-image') : '';
                    setBeritaImagePreview(currentImage || '');
                }
                if (type === 'event') {
                    const btnEl = event && event.currentTarget ? event.currentTarget : null;
                    const currentImage = btnEl ? btnEl.getAttribute('data-current-image') : '';
                    const wrap = document.getElementById('event-image-preview-wrap');
                    const img = document.getElementById('event-image-preview');
                    if (wrap && img && currentImage) {
                        img.src = currentImage;
                        wrap.style.display = 'block';
                    } else if (wrap) {
                        wrap.style.display = 'none';
                    }
                }

                // Set image preview for kemitraan
                if (type === 'kemitraan') {
                    const btnEl = event && event.currentTarget ? event.currentTarget : null;
                    const currentImage = btnEl ? btnEl.getAttribute('data-current-image') : '';
                    setKemitraanImagePreview(currentImage || '');
                }

                // Set image preview for gallery
                if (type === 'gallery') {
                    const btnEl = event && event.currentTarget ? event.currentTarget : null;
                    const currentImage = btnEl ? btnEl.getAttribute('data-current-image') : '';
                    setGalleryImagePreview(currentImage || '');
                }

                // Set image preview for hero
                if (type === 'hero') {
                    const btnEl = event && event.currentTarget ? event.currentTarget : null;
                    const currentImage = btnEl ? btnEl.getAttribute('data-image') : '';
                    const wrap = document.getElementById('hero-image-preview-wrap');
                    const img = document.getElementById('hero-image-preview');
                    if (wrap && img && currentImage) {
                        img.src = currentImage;
                        wrap.style.display = 'block';
                    } else if (wrap) {
                        wrap.style.display = 'none';
                    }
                }

                // Primary: populate from clicked button's data-* attributes
                const btn = event && event.currentTarget ? event.currentTarget : null;
                if (btn) {
                    for (let attr of btn.attributes) {
                        if (!attr.name.startsWith('data-')) continue;
                        const key = attr.name.slice(5); // remove 'data-' prefix
                        // Find checkbox first if exists, otherwise fall back to generic name match
                        let input = form.querySelector(`input[type="checkbox"][name="${key}"]`) || form.querySelector(
                            `[name="${key}"]`);
                        if (!input) continue;
                        const val = attr.value;
                        if (input.type === 'checkbox') {
                            input.checked = val === 'true' || val === '1';
                        } else if (input.classList.contains('tinymce-editor') && typeof tinymce !== 'undefined') {
                            // Handle TinyMCE editor
                            const editor = tinymce.get(input.id);
                            if (editor) {
                                editor.setContent(val);
                            } else {
                                input.value = val; // Fallback if editor not ready
                            }
                        } else {
                            input.value = val;
                        }
                    }
                }

                // Background: fetch from API to fill any missing fields
                try {
                    const res = await fetch('/admin/items/' + pluralType + '/' + id, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (res.ok) {
                        const data = await res.json();
                        for (let key in data) {
                            let input = form.querySelector(`input[type="checkbox"][name="${key}"]`) || form
                                .querySelector(`[name="${key}"]`);
                            if (!input) continue;
                            // Skip non-checkbox inputs if already filled by dataset; always update checkboxes
                            if (input.type !== 'checkbox' && input.value) continue;
                            const val = data[key];
                            if (input.type === 'checkbox') {
                                input.checked = !!val;
                            } else if (input.classList.contains('tinymce-editor') && typeof tinymce !== 'undefined') {
                                // Handle TinyMCE editor
                                const editor = tinymce.get(input.id);
                                if (editor) {
                                    editor.setContent((val !== null && val !== undefined) ? String(val) : '');
                                } else {
                                    input.value = (val !== null && val !== undefined) ? String(val) : '';
                                }
                            } else {
                                input.value = (val !== null && val !== undefined) ? String(val) : '';
                            }
                        }
                    }
                } catch (e) {
                    console.error('API fetch error (non-critical):', e);
                }
            } else {
                document.getElementById('form-title-' + type).textContent = 'Tambah ' + capitalize(type);
                const methodInput = document.getElementById(type + '-method');
                if (methodInput) methodInput.value = 'POST';
                form.action = '/admin/' + pluralType;
                form.reset();
                if (type === 'berita') setBeritaImagePreview('');
                if (type === 'event') {
                    const wrap = document.getElementById('event-image-preview-wrap');
                    if (wrap) wrap.style.display = 'none';
                }
                if (type === 'kemitraan') setKemitraanImagePreview('');
                if (type === 'gallery') setGalleryImagePreview('');
                if (type === 'user') resetPasswordUI();
                // Reset TinyMCE editors in this form
                form.querySelectorAll('.tinymce-editor').forEach(textarea => {
                    if (typeof tinymce !== 'undefined') {
                        const editor = tinymce.get(textarea.id);
                        if (editor) {
                            editor.setContent('');
                        }
                    }
                });
            }
        }

        function hideForm(type) {
            const panel = document.getElementById('form-panel-' + type);
            if (panel) {
                panel.classList.remove('active');
                panel.style.display = 'none';
            }
            if (type === 'user') resetPasswordUI();
        }

        // ---- KETUA UMUM EDIT FUNCTIONS ----
        function editKetuaUmum(event, id) {
            const btn = event.currentTarget;
            const form = document.getElementById('ketua-umum-form');
            if (!form || !btn) return;

            // Populate form from data attributes
            document.getElementById('ketua-umum-name').value = btn.dataset.name || '';
            document.getElementById('ketua-umum-period').value = btn.dataset.period || '';
            document.getElementById('ketua-umum-order').value = btn.dataset.order || '0';
            document.getElementById('ketua-umum-is_active').checked = btn.dataset.is_active === 'true';
            document.getElementById('ketua-umum-id').value = id;

            // Switch to edit mode
            document.getElementById('ketua-umum-method').value = 'PUT';
            form.action = '/admin/ketua-umums/' + id;
            form.querySelector('input[type="file"]').required = false;

            // Change button text
            const actions = document.getElementById('ketua-umum-form-actions');
            if (actions) actions.innerHTML =
                '<button type="submit" class="btn-orange" style="width:100%;justify-content:center;"><svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Simpan Perubahan</button>';

            // Show cancel button
            const cancelBtn = document.getElementById('ketua-umum-cancel');
            if (cancelBtn) cancelBtn.style.display = 'flex';

            // Scroll form into view
            form.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function cancelEditKetuaUmum() {
            const form = document.getElementById('ketua-umum-form');
            if (!form) return;

            // Reset to add mode
            document.getElementById('ketua-umum-method').value = 'POST';
            form.action = '{{ route('admin.ketuaUmums.store') }}';
            form.reset();
            document.getElementById('ketua-umum-id').value = '';
            form.querySelector('input[type="file"]').required = true;

            // Change button text back
            const actions = document.getElementById('ketua-umum-form-actions');
            if (actions) actions.innerHTML =
                '<button type="submit" class="btn-orange" style="width:100%;justify-content:center;"><svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> Tambah Ketua Umum</button>';

            // Hide cancel button
            const cancelBtn = document.getElementById('ketua-umum-cancel');
            if (cancelBtn) cancelBtn.style.display = 'none';
        }

        // ---- VISI MISI EDIT FUNCTIONS ----
        function editVisiMisi(event, id) {
            const btn = event.currentTarget;
            if (!btn) return;

            const form = document.getElementById('form-visi-misi');
            if (!form) return;

            document.getElementById('form-title-visi-misi').textContent = 'Edit Visi & Misi';
            document.getElementById('visi-misi-method').value = 'PUT';
            document.getElementById('visi-misi-id').value = id;
            form.action = '/admin/visi-misis/' + id;

            // Populate title
            const title = btn.getAttribute('data-title') || '';
            document.getElementById('visi-misi-title').value = title;

            // Populate is_active
            const isActive = btn.getAttribute('data-is_active');
            document.getElementById('is_active_visi_misi').checked = isActive === 'true' || isActive === '1';

            // Populate TinyMCE content
            const content = btn.getAttribute('data-content') || '';
            const editor = typeof tinymce !== 'undefined' ? tinymce.get('visi-misi-editor') : null;
            if (editor) {
                editor.setContent(content);
            } else {
                document.getElementById('visi-misi-editor').value = content;
            }

            // Show cancel button
            const cancelBtn = document.getElementById('visi-misi-cancel-btn');
            if (cancelBtn) cancelBtn.style.display = '';
        }

        function cancelVisiMisi() {
            const form = document.getElementById('form-visi-misi');
            if (!form) return;

            document.getElementById('form-title-visi-misi').textContent = 'Tambah Visi & Misi';
            document.getElementById('visi-misi-method').value = 'POST';
            document.getElementById('visi-misi-id').value = '';
            form.action = '{{ route('admin.visiMisis.store') }}';
            form.reset();

            const editor = typeof tinymce !== 'undefined' ? tinymce.get('visi-misi-editor') : null;
            if (editor) editor.setContent('');

            const cancelBtn = document.getElementById('visi-misi-cancel-btn');
            if (cancelBtn) cancelBtn.style.display = 'none';
        }

        // ---- TOAST SYSTEM ----
        function showToast(message, type = 'success', duration = 4000) {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = 'toast ' + type;

            const icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
            toast.innerHTML = '<span style="font-size:18px;font-weight:700;">' + icon + '</span><span>' + message +
                '</span>';

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('hiding');
                toast.addEventListener('animationend', () => {
                    if (toast.parentNode) toast.remove();
                });
            }, duration);
        }

        // ---- IMAGE COMPRESSION ----
        // Compresses image if it's larger than maxSize (in bytes). Returns a File object.
        async function compressImage(file, maxSizeBytes = 2 * 1024 * 1024, maxWidth = 1920, quality = 0.8) {
            // Skip if file is already small enough or not an image
            if (!file.type.startsWith('image/') || file.size <= maxSizeBytes) {
                return file;
            }

            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = new Image();
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        let width = img.width;
                        let height = img.height;

                        // Resize if width exceeds maxWidth
                        if (width > maxWidth) {
                            height = (maxWidth / width) * height;
                            width = maxWidth;
                        }

                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);

                        // Try with progressively lower quality until under max size
                        let currentQuality = quality;
                        const tryCompress = () => {
                            canvas.toBlob((blob) => {
                                if (!blob) {
                                    resolve(file);
                                    return;
                                }
                                // If still too big and quality can go lower, retry
                                if (blob.size > maxSizeBytes && currentQuality > 0.3) {
                                    currentQuality -= 0.1;
                                    tryCompress();
                                    return;
                                }
                                // Convert blob to File
                                const compressedFile = new File([blob], file.name, {
                                    type: 'image/jpeg',
                                    lastModified: Date.now(),
                                });
                                console.log(
                                    `Compressed: ${(file.size / 1024).toFixed(1)}KB → ${(compressedFile.size / 1024).toFixed(1)}KB (quality: ${currentQuality.toFixed(1)})`
                                );
                                resolve(compressedFile);
                            }, 'image/jpeg', currentQuality);
                        };
                        tryCompress();
                    };
                    img.onerror = () => resolve(file);
                    img.src = e.target.result;
                };
                reader.onerror = () => resolve(file);
                reader.readAsDataURL(file);
            });
        }

        // ---- AJAX FORM HANDLING ----
        function initAjaxForms() {
            document.querySelectorAll('form').forEach(form => {
                if (form.dataset.ajaxInit) return;
                // Skip logout form - let it submit normally
                if (form.action && form.action.includes('/logout')) return;
                form.dataset.ajaxInit = 'true';

                form.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    // Sync TinyMCE editors before collecting form data
                    if (typeof tinymce !== 'undefined') {
                        tinymce.triggerSave();
                    }

                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (!submitBtn) return;

                    const originalHTML = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="spinner"></span> Menyimpan...';

                    // Compress image files before upload
                    const fileInputs = form.querySelectorAll('input[type="file"]');
                    for (const input of fileInputs) {
                        if (input.files.length > 0 && input.files[0].type.startsWith('image/')) {
                            const original = input.files[0];
                            if (original.size > 2 * 1024 * 1024) {
                                submitBtn.innerHTML =
                                    '<span class="spinner"></span> Mengompres gambar...';
                                try {
                                    const compressed = await compressImage(original);
                                    // Replace file input with compressed file
                                    const dt = new DataTransfer();
                                    dt.items.add(compressed);
                                    input.files = dt.files;
                                    showToast(
                                        `Gambar dikompres: ${(original.size / 1024).toFixed(0)}KB → ${(compressed.size / 1024).toFixed(0)}KB`,
                                        'success', 2000);
                                } catch (err) {
                                    console.error('Compression error:', err);
                                }
                                submitBtn.innerHTML = '<span class="spinner"></span> Menyimpan...';
                            }
                        }
                    }

                    try {
                        // Sync TinyMCE editors before collecting form data
                        if (typeof tinymce !== 'undefined') {
                            tinymce.triggerSave();
                            // Also manually update textareas from TinyMCE editors
                            form.querySelectorAll('.tinymce-editor').forEach(textarea => {
                                const editor = tinymce.get(textarea.id);
                                if (editor) {
                                    textarea.value = editor.getContent();
                                }
                            });
                        }

                        // Create FormData after TinyMCE sync
                        const formData = new FormData(form);

                        // Debug: log form data for file uploads
                        const fileInput = form.querySelector('input[type="file"]');
                        if (fileInput && fileInput.files.length > 0) {
                            console.log('Uploading file:', fileInput.files[0].name, 'Size:', fileInput
                                .files[0].size);
                        }

                        const headers = {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        };

                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: headers,
                            credentials: 'same-origin'
                        });

                        let data = {};
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.includes('application/json')) {
                            data = await response.json();
                        }

                        if (response.ok) {
                            showToast(data.message || 'Data berhasil disimpan!', 'success');
                            // Only reset forms inside a form-panel (inline forms like sejarah should stay)
                            if (form.closest('[id^="form-panel-"]')) {
                                form.reset();
                                hideFormFromForm(form);
                            }
                            await refreshCurrentTab();
                        } else if (response.status === 422) {
                            const errors = data.errors || {};
                            const firstError = Object.values(errors).flat()[0];
                            showToast(firstError || data.message || 'Validasi gagal.', 'error');
                        } else {
                            showToast(data.message || 'Terjadi kesalahan saat menyimpan data.',
                                'error');
                        }
                    } catch (err) {
                        console.error('Form submit error:', err);
                        showToast('Terjadi kesalahan koneksi. Periksa jaringan Anda.', 'error');
                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalHTML;
                    }
                });
            });
        }

        function hideFormFromForm(form) {
            const panel = form.closest('[id^="form-panel-"]');
            if (panel) {
                const type = panel.id.replace('form-panel-', '');
                hideForm(type);
            }
        }

        // ---- TAB CONTENT REFRESH ----
        async function refreshCurrentTab() {
            try {
                const activeTab = document.querySelector('.tab-panel.active');
                if (!activeTab) return;
                const tabName = activeTab.id.replace('tab-', '');

                const contentArea = document.querySelector('.content-area');
                contentArea.style.opacity = '0.5';
                contentArea.style.pointerEvents = 'none';

                // Preserve all pagination query params (page, events_page, etc.)
                const fetchUrl = '/admin' + (window.location.search || '');

                const response = await fetch(fetchUrl, {
                    headers: {
                        'Accept': 'text/html'
                    },
                    credentials: 'same-origin'
                });

                if (!response.ok) throw new Error('Failed to refresh');

                const html = await response.text();
                const parser = new DOMParser();
                const newDoc = parser.parseFromString(html, 'text/html');

                // Replace active tab content
                const newTab = newDoc.getElementById('tab-' + tabName);
                if (newTab && activeTab) {
                    activeTab.innerHTML = newTab.innerHTML;
                }

                // Update stats
                const currentStats = document.querySelector('.stats-grid');
                const newStats = newDoc.querySelector('.stats-grid');
                if (currentStats && newStats) {
                    currentStats.innerHTML = newStats.innerHTML;
                }

                // Update sidebar counts
                const currentCounts = document.querySelectorAll('.nav-count');
                const newCounts = newDoc.querySelectorAll('.nav-count');
                currentCounts.forEach((el, i) => {
                    if (newCounts[i]) el.textContent = newCounts[i].textContent;
                });

                // Re-initialize AJAX on new forms
                initAjaxForms();

                // Re-initialize TinyMCE after DOM update
                initTinyMCE();

            } catch (err) {
                console.error('Refresh error:', err);
                showToast('Gagal memperbarui tampilan. Muat ulang halaman jika diperlukan.', 'error');
            } finally {
                const contentArea = document.querySelector('.content-area');
                contentArea.style.opacity = '1';
                contentArea.style.pointerEvents = '';
            }
        }

        // ---- TINYMCE INITIALIZER ----
        function initTinyMCE() {
            if (typeof tinymce === 'undefined') return;

            // Initialize all textareas with tinymce-editor class
            const editors = document.querySelectorAll('.tinymce-editor');
            editors.forEach(el => {
                // Skip if already initialized
                if (el.dataset.tinymceInit) return;
                el.dataset.tinymceInit = 'true';

                // Remove existing instance to avoid conflicts
                const existing = tinymce.get(el.id);
                if (existing) existing.remove();

                tinymce.init({
                    selector: '#' + el.id,
                    height: 400,
                    menubar: false,
                    plugins: 'lists link image codesample table code wordcount',
                    toolbar: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image codesample | table | removeformat code',
                    branding: false,
                    promotion: false,
                    skin: 'oxide',
                    content_css: 'default',
                    setup: function(editor) {
                        editor.on('change', function() {
                            editor.save();
                        });
                    }
                });
            });
        }

        // ---- KEMITRAAN IMAGE PREVIEW ----
        function previewKemitraanImage(input) {
            const wrap = document.getElementById('kemitraan-image-preview-wrap');
            const img = document.getElementById('kemitraan-image-preview');
            const label = document.getElementById('kemitraan-image-preview-label');
            if (!wrap || !img || !input.files || !input.files[0]) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                wrap.style.display = 'block';
                if (label) label.textContent = 'Preview gambar baru';
            };
            reader.readAsDataURL(input.files[0]);
        }

        function setKemitraanImagePreview(url) {
            const wrap = document.getElementById('kemitraan-image-preview-wrap');
            const img = document.getElementById('kemitraan-image-preview');
            const label = document.getElementById('kemitraan-image-preview-label');
            if (!wrap || !img) return;
            if (url) {
                img.src = url;
                wrap.style.display = 'block';
                if (label) label.textContent = 'Logo saat ini';
            } else {
                img.src = '';
                wrap.style.display = 'none';
            }
        }

        // ---- PASSWORD STRENGTH ----
        function checkPasswordStrength(value) {
            const fill = document.getElementById('password-strength-fill');
            const text = document.getElementById('password-strength-text');
            if (!fill || !text) return;

            if (!value) {
                fill.style.width = '0%';
                text.textContent = '';
                checkPasswordMatch();
                return;
            }

            let score = 0;
            if (value.length >= 8) score++;
            if (value.length >= 12) score++;
            if (/[a-z]/.test(value) && /[A-Z]/.test(value)) score++;
            if (/[0-9]/.test(value)) score++;
            if (/[^a-zA-Z0-9]/.test(value)) score++;

            const levels = [{
                    label: 'Sangat Lemah',
                    color: '#ef4444',
                    width: '20%'
                },
                {
                    label: 'Lemah',
                    color: '#f97316',
                    width: '40%'
                },
                {
                    label: 'Cukup',
                    color: '#eab308',
                    width: '60%'
                },
                {
                    label: 'Kuat',
                    color: '#22c55e',
                    width: '80%'
                },
                {
                    label: 'Sangat Kuat',
                    color: '#16a34a',
                    width: '100%'
                },
            ];
            const level = levels[Math.min(score - 1, 4)] || levels[0];
            fill.style.width = level.width;
            fill.style.background = level.color;
            text.style.color = level.color;
            text.textContent = level.label;
            checkPasswordMatch();
        }

        function checkPasswordMatch() {
            const pw = document.getElementById('user-password');
            const cfg = document.getElementById('user-password-confirm');
            const msg = document.getElementById('password-match-text');
            if (!pw || !cfg || !msg) return;
            if (!cfg.value) {
                msg.textContent = '';
                return;
            }
            if (pw.value === cfg.value) {
                msg.style.color = '#22c55e';
                msg.textContent = '✓ Password cocok';
            } else {
                msg.style.color = '#ef4444';
                msg.textContent = '✕ Password tidak cocok';
            }
        }

        function resetPasswordUI() {
            const fill = document.getElementById('password-strength-fill');
            const text = document.getElementById('password-strength-text');
            const match = document.getElementById('password-match-text');
            const cfg = document.getElementById('user-password-confirm');
            if (fill) {
                fill.style.width = '0%';
                fill.style.background = '';
            }
            if (text) text.textContent = '';
            if (match) match.textContent = '';
            if (cfg) cfg.value = '';
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            initAjaxForms();
            initTinyMCE();
        });
    </script>
</body>

</html>
