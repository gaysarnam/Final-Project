<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TN ADMIN - Restaurant Menu & Inventory</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-green: #005a2b;
            --bg-light: #ffffff;
            --card-bg: #f5f6f7;
            --border-line: #e0e0e0;
            --text-black: #000000;
            --top-bar-grey: #f8f9fa;
            --dark-green: #065f32;
            --menu-blue: #151516c4;
            --content-bg: #e9ecef;
            --status-red: #d32f2f;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; background-color: #fff; }
        .wrapper { display: flex; height: 100vh; width: 100%; overflow: hidden; }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: 320px; min-width: 320px;
            background: white; display: flex; flex-direction: column;
            padding: 40px 0; border-right: 1.5px solid var(--border-line);
            height: 100%; overflow: hidden;
            transition: transform 0.3s ease;
            z-index: 1000;
            flex-shrink: 0;
        }
        .logo-area {
            padding: 0 40px; margin-bottom: 70px;
            display: flex; align-items: center; gap: 14px;
            text-decoration: none; color: var(--text-black);
        }
        .logo-img-wrap {
            width: 48px; height: 48px; border-radius: 12px;
            background: var(--primary-green);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; flex-shrink: 0;
        }
        .logo-img-wrap img { width: 30px; height: 30px; object-fit: contain; filter: brightness(0) invert(1); }
        .logo-text-block { display: flex; flex-direction: column; line-height: 1; }
        .logo-panel-title { font-size: 15px; font-weight: 800; color: var(--text-black); letter-spacing: 0.06em; text-transform: uppercase; }
        .logo-admin-name  { font-size: 12px; font-weight: 500; color: #888; margin-top: 5px; }

        /* ─── NAV ─── */
        .nav-links { list-style: none; padding: 0 25px; }
        .nav-item {
            display: flex; align-items: center;
            padding: 14px 25px; margin-bottom: 15px;
            border-radius: 50px; font-weight: 700;
            color: var(--text-black); text-decoration: none;
            transition: 0.3s; cursor: pointer;
            border: none; background: none;
            width: 100%; text-align: left;
            position: relative;
        }
        .nav-item i { margin-right: 23px; font-size: 30px; width: 33px; text-align: center; }
        .nav-item:hover { background-color: #f1f3f5; }
        .nav-item.active { background-color: var(--primary-green); color: white !important; }

        /* ── NEW BOOKING BADGE ── */
        .new-booking-badge {
            position: absolute; right: 18px; top: 50%;
            transform: translateY(-50%);
            background: #d32f2f; color: white;
            border-radius: 50%; width: 24px; height: 24px;
            font-size: 11px; font-weight: 800;
            display: none; align-items: center; justify-content: center;
            line-height: 1; box-shadow: 0 2px 8px rgba(211,47,47,0.55);
            animation: badgePulse 2s infinite; z-index: 10;
        }
        @keyframes badgePulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(211,47,47,0.55); }
            50%       { box-shadow: 0 0 0 6px rgba(211,47,47,0); }
        }

        /* ── SIDEBAR OVERLAY (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        .sidebar-overlay.active { opacity: 1; pointer-events: auto; }

        /* ── MAIN ── */
        .main-container { flex: 1; display: flex; flex-direction: column; height: 100vh; overflow: hidden; min-width: 0; }

        /* ─── TOP BAR ─── */
        .top-bar {
            height: 100px; flex-shrink: 0;
            display: flex; justify-content: center; align-items: center;
            padding: 0 60px; background-color: var(--top-bar-grey);
            border-bottom: 1.5px solid var(--border-line);
            position: relative; z-index: 100;
        }
        .top-bar h1 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; margin: 0; }

        /* Hamburger (mobile only) */
        .hamburger-btn {
            display: none;
            position: absolute;
            left: 20px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
            color: var(--text-black);
            font-size: 22px;
            line-height: 1;
            transition: background 0.2s;
        }
        .hamburger-btn:hover { background: #f1f3f5; }

        .admin-profile-dropdown { position: absolute; right: 60px; }
        .admin-profile {
            display: flex; align-items: center; gap: 12px;
            background: white; padding: 8px 18px 8px 8px;
            border-radius: 50px; border: 1px solid var(--border-line);
            cursor: pointer; text-decoration: none; color: inherit;
        }
        .avatar {
            width: 32px; height: 32px; background-color: var(--primary-green);
            color: white; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold;
        }
        .dropdown-menu { border-radius: 15px; border: 1px solid var(--border-line); box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 10px 0; margin-top: 10px !important; }
        .dropdown-item { font-weight: 600; padding: 10px 20px; font-size: 14px; }

        /* CONTENT */
        .content-area { flex: 1; display: flex; flex-direction: column; overflow: hidden; background-color: var(--content-bg); }

        /* SEARCH BAR */
        .menu-header-bar-wrapper { flex-shrink: 0; padding: 30px 60px 0; background-color: var(--content-bg); }
        .menu-header-bar {
            background: white; padding: 25px 30px; border-radius: 20px;
            border: 2.5px solid var(--menu-blue);
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 25px;
        }
        .search-box { position: relative; width: 45%; }
        .search-box i { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); font-size: 20px; color: #666; }
        .search-box input { width: 100%; padding: 15px 15px 15px 55px; border: 1.5px solid #ccc; border-radius: 15px; font-size: 17px; outline: none; transition: 0.3s; }

        .manage-btn { background-color: var(--primary-green); color: white; border: none; padding: 12px 25px; border-radius: 12px; font-weight: 700; cursor: pointer; font-size: 17px; }
        .manage-btn:hover { background-color: var(--dark-green); }
        .manage-btn.active-manage { background-color: var(--dark-green); box-shadow: 0 4px 16px rgba(0,90,43,0.3); }
        .add-items-btn { background-color: var(--dark-green); color: white; border: none; padding: 12px 28px; border-radius: 12px; font-weight: 700; cursor: pointer; font-size: 18px; }

        /* COLUMN HEADERS */
        .table-header-wrapper { flex-shrink: 0; padding: 0 60px; background-color: var(--content-bg); }
        .table-header-card { background: white; border-radius: 20px 20px 0 0; overflow: hidden; }
        .table-header-card table { width: 100%; border-collapse: collapse; }
        .table-header-card table th {
            padding: 15px 25px; font-family: 'Playfair Display', serif;
            font-size: 19px; color: #000; border-bottom: 2px solid #000;
            text-align: left; background: white;
        }

        /* SCROLL ZONE */
        .table-rows-wrapper {
            flex: 1; overflow-y: auto; overflow-x: hidden;
            padding: 0 60px 30px; background-color: var(--content-bg);
            scrollbar-width: thin; scrollbar-color: #ccc transparent;
        }
        .table-rows-wrapper::-webkit-scrollbar { width: 6px; }
        .table-rows-wrapper::-webkit-scrollbar-track { background: transparent; }
        .table-rows-wrapper::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }

        .table-rows-card { background: white; border-radius: 0 0 20px 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 10px; }
        .menu-table { width: 100%; border-collapse: collapse; }
        .menu-table td { padding: 22px 25px; border-bottom: 1px solid #f1f1f1; font-size: 16px; vertical-align: middle; }
        .menu-table tbody tr:last-child td { border-bottom: none; }
        .item-font { font-family: 'Inter', sans-serif; font-size: 18px; font-weight: 700; color: #000; }

        /* ── UNIFORM ACTION BUTTONS ── */
        .btn-action-edit {
            background: white; border: 2px solid var(--primary-green);
            color: var(--primary-green); border-radius: 50px;
            padding: 7px 20px; font-weight: 700; font-size: 13px;
            cursor: pointer; transition: 0.2s; white-space: nowrap;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-action-edit:hover { background: var(--primary-green); color: white; }

        .btn-action-delete {
            background: white; border: 2px solid #ff4d4d;
            color: #ff4d4d; border-radius: 50px;
            padding: 7px 20px; font-weight: 700; font-size: 13px;
            cursor: pointer; transition: 0.2s; white-space: nowrap;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-action-delete:hover { background: #ff4d4d; color: white; }

        .action-btn-group { display: flex; align-items: center; gap: 10px; justify-content: flex-end; }

        /* VIEW PANELS */
        .view-section { display: none; background: white; border-radius: 25px; padding: 50px; max-width: 900px; margin: 0 auto 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); position: relative; }
        .close-x { position: absolute; top: 25px; right: 30px; font-size: 28px; color: #ccc; cursor: pointer; transition: color 0.2s; }
        .close-x:hover { color: #999; }

        /* MANAGE CATEGORIES */
        .manage-page-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 10px; }
        .manage-page-header { display: flex; justify-content: flex-end; padding: 16px 25px 8px; }

        .cat-list { list-style: none; padding: 0 25px 25px; margin: 0; }
        .cat-list-item { display: flex; align-items: center; justify-content: space-between; padding: 18px 22px; border-radius: 16px; margin-bottom: 10px; background: #f9fafb; border: 1.5px solid #eee; transition: border-color 0.2s, box-shadow 0.2s; }
        .cat-list-item:hover { border-color: #d0e9da; box-shadow: 0 2px 12px rgba(0,90,43,0.07); }
        .cat-list-item:last-child { margin-bottom: 0; }
        .cat-item-left { display: flex; align-items: center; gap: 16px; }
        .cat-icon-circle { width: 42px; height: 42px; border-radius: 50%; background: #e8f5ee; color: var(--primary-green); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
        .cat-name-text { font-size: 16px; font-weight: 700; color: #111; text-transform: capitalize; }
        .cat-name-sub  { font-size: 12px; color: #888; margin-top: 2px; }
        .cat-actions   { display: flex; gap: 10px; }
        .cat-empty-state { text-align: center; padding: 40px 0 20px; color: #aaa; font-size: 15px; }

        /* FORMS */
        .form-label { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 18px; margin-bottom: 8px; display: block; text-align: left; }
        .input-custom, .form-select { background-color: #f1f3f5; border: 1.2px solid #ccc; border-radius: 12px; padding: 15px; width: 100%; margin-bottom: 20px; outline: none; height: 52px; }
        .upload-box { border: 2px dashed #999; height: 130px; border-radius: 15px; display: flex; align-items: center; justify-content: center; cursor: pointer; background: #f9f9f9; position: relative; overflow: hidden; }
        .upload-box img { position: absolute; width: 100%; height: 100%; object-fit: cover; }
        .validation-warning { background-color: #fff3f3; color: #d32f2f; padding: 15px; border-radius: 12px; border: 1px solid #f8d7da; margin-bottom: 25px; display: none; font-weight: 700; text-align: left; }
        .duplicate-warning  { background-color: #fff3e0; color: #e65100; padding: 15px; border-radius: 12px; border: 1px solid #ffe0b2; margin-bottom: 25px; display: none; font-weight: 700; text-align: left; }
        .duplicate-warning i { margin-right: 8px; }

        /* MODALS */
        .modal-content { border-radius: 25px; border: none; padding: 20px; }
        .modal-header  { border: none; justify-content: center; }
        .modal-footer  { border: none; justify-content: center; gap: 15px; }
        .btn-modal-green { background: var(--primary-green); color: white; border-radius: 12px; padding: 12px 45px; border: none; font-weight: 700; cursor: pointer; }
        .btn-modal-red   { background: var(--status-red); color: white; border-radius: 12px; padding: 12px 45px; border: none; font-weight: 700; cursor: pointer; }
        .btn-modal-grey  { background: #f8f9fa; color: #333; border-radius: 12px; padding: 12px 45px; border: none; font-weight: 700; cursor: pointer; }

        .btn-confirm { background: #dc3545; color: white; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; cursor: pointer; }
        .btn-cancel  { background: #eee; color: #333; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; cursor: pointer; }

        .fa-pencil, .fa-trash-can, .fa-circle-xmark, .btn, button, .nav-item { cursor: pointer !important; }

        /* TOAST */
        #toast-container { position: fixed; top: 30px; right: 30px; z-index: 3000; }
        .custom-toast {
            min-width: 300px; background: white; padding: 18px 25px;
            border-radius: 15px; box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            display: flex; align-items: center; gap: 15px;
            border-left: 6px solid var(--primary-green);
            animation: slideInToast 0.45s cubic-bezier(0.22,1,0.36,1) both;
        }
        .custom-toast.toast-error { border-left-color: var(--status-red); }
        @keyframes slideInToast {
            from { opacity: 0; transform: translateX(60px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .toast-icon { font-size: 1.4rem; flex-shrink: 0; color: var(--primary-green); }
        .toast-error .toast-icon { color: var(--status-red); }
        .toast-title { font-weight: 700; font-size: 0.95rem; color: #111; margin-bottom: 2px; }
        .toast-msg   { font-size: 0.83rem; color: #555; }

        /* ══════════════════════════════════════
           RESPONSIVE — TABLET (≤ 1100px)
        ══════════════════════════════════════ */
        @media (max-width: 1100px) {
            .sidebar { width: 260px; min-width: 260px; }
            .menu-header-bar-wrapper { padding: 20px 30px 0; }
            .table-header-wrapper { padding: 0 30px; }
            .table-rows-wrapper { padding: 0 30px 30px; }
            .top-bar { padding: 0 30px; }
            .admin-profile-dropdown { right: 30px; }
            .search-box { width: 50%; }
            .manage-btn { padding: 10px 16px; font-size: 15px; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — MOBILE (≤ 768px)
        ══════════════════════════════════════ */
        @media (max-width: 768px) {
            body, html { overflow: auto; }

            .wrapper { flex-direction: column; height: auto; min-height: 100vh; }

            /* Sidebar becomes a fixed off-screen drawer */
            .sidebar {
                position: fixed;
                top: 0; left: 0;
                height: 100%;
                width: 280px; min-width: unset;
                transform: translateX(-100%);
                overflow-y: auto;
                padding: 30px 0;
                box-shadow: 4px 0 24px rgba(0,0,0,0.12);
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }

            .logo-area { margin-bottom: 40px; padding: 0 24px; }
            .nav-links { padding: 0 14px; }
            .nav-item { padding: 12px 18px; margin-bottom: 8px; font-size: 14px; }
            .nav-item i { font-size: 22px; margin-right: 16px; width: 26px; }

            .main-container { width: 100%; height: auto; overflow: visible; }

            /* Top bar */
            .top-bar {
                height: 70px;
                padding: 0 16px;
                justify-content: center;
                position: sticky;
                top: 0;
                z-index: 100;
                flex-shrink: 0;
            }
            .top-bar h1 { font-size: 20px; }
            .hamburger-btn { display: flex; align-items: center; }
            .admin-profile-dropdown { right: 16px; }
            .admin-profile { padding: 6px 12px 6px 6px; gap: 8px; }
            .admin-profile strong { display: none; }

            /* Content layout */
            .content-area { overflow: visible; flex: unset; }

            /* Search/action bar — stack vertically */
            .menu-header-bar-wrapper { padding: 16px 12px 0; }
            .menu-header-bar {
                flex-direction: column;
                gap: 14px;
                padding: 18px 16px;
                align-items: stretch;
            }
            .search-box { width: 100%; }
            .search-box input { font-size: 15px; padding: 12px 12px 12px 46px; }
            .search-box i { font-size: 17px; left: 14px; }

            /* Manage buttons — wrap into a scrollable row */
            .menu-header-bar .d-flex { flex-wrap: wrap; gap: 8px !important; justify-content: flex-start; }
            .manage-btn { padding: 9px 14px; font-size: 13px; border-radius: 10px; }
            .add-items-btn { font-size: 14px; padding: 9px 18px; }

            /* Column headers — hide on mobile (context is shown inline) */
            .table-header-wrapper { padding: 0 12px; }
            .table-header-card table th { font-size: 14px; padding: 12px 14px; }

            /* Scroll zone */
            .table-rows-wrapper {
                padding: 0 12px 20px;
                overflow-y: visible;
                overflow-x: hidden;
                flex: unset;
            }

            /* Table rows — card-like on mobile */
            .menu-table thead { display: none; }
            .menu-table tbody tr {
                display: flex;
                flex-direction: column;
                padding: 16px 14px;
                border-bottom: 1px solid #f1f1f1;
                gap: 4px;
            }
            .menu-table tbody tr:last-child { border-bottom: none; }
            .menu-table td {
                padding: 0;
                border-bottom: none;
                font-size: 14px;
                width: 100% !important;
            }
            .item-font { font-size: 15px; }

            /* Action buttons inline on mobile */
            .action-btn-group { justify-content: flex-start; margin-top: 8px; gap: 8px; }
            .btn-action-edit,
            .btn-action-delete { padding: 6px 14px; font-size: 12px; }

            /* Also hide TI table headers on mobile */
            #tiTable thead { display: none; }
            #tiTable tbody tr {
                display: flex;
                flex-direction: column;
                padding: 16px 14px;
                border-bottom: 1px solid #f1f1f1;
                gap: 4px;
            }
            #tiTable td {
                padding: 0;
                border-bottom: none;
                font-size: 14px;
                width: 100% !important;
            }

            /* Cat list wraps on small screens */
            .cat-list-item { flex-wrap: wrap; gap: 10px; }
            .cat-actions { flex-wrap: wrap; gap: 6px; }

            /* View section (Add/Edit forms) */
            .view-section { padding: 30px 18px; margin: 0 0 20px; border-radius: 18px; max-width: 100%; }
            .close-x { top: 16px; right: 18px; font-size: 24px; }
            .form-label { font-size: 15px; }
            .input-custom, .form-select { height: 46px; padding: 12px; font-size: 14px; }

            /* Toast smaller on mobile */
            #toast-container { top: 16px; right: 16px; left: 16px; }
            .custom-toast { min-width: unset; width: 100%; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤ 400px)
        ══════════════════════════════════════ */
        @media (max-width: 400px) {
            .top-bar h1 { font-size: 17px; }
            .manage-btn { font-size: 12px; padding: 8px 11px; }
            .cat-name-text { font-size: 14px; }
            .btn-action-edit,
            .btn-action-delete { padding: 5px 11px; font-size: 11px; }
        }
    </style>
</head>
<body>

<!-- TOAST NOTIFICATION -->
<div id="toast-container">
    @if(session('success'))
        <div class="custom-toast" id="successToast">
            <i class="fa-solid fa-circle-check toast-icon"></i>
            <div>
                <div class="toast-title">Success</div>
                <div class="toast-msg">{{ session('success') }}</div>
            </div>
        </div>
    @endif
</div>

@php $redirectView = session('redirect_view', 'manageItemsView'); @endphp

{{-- Pass all existing names to JS for duplicate detection --}}
<script>
    const existingTableNames = @json($tables->pluck('table_no')->map(fn($v) => strtolower($v))->values());
    const existingCatNames   = @json($categories->pluck('name')->map(fn($v) => strtolower($v))->values());
    const existingMenuNames  = @json($menus->pluck('name')->map(fn($v) => strtolower($v))->values());
    let editingTableId = null;
    let editingCatId   = null;
    let editingMenuId  = null;
    let editingTableOrigName = '';
    let editingCatOrigName   = '';
    let editingMenuOrigName  = '';
</script>

<!-- Sidebar overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="wrapper">

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="logo-area">
            <div class="logo-img-wrap">
                <img src="{{ asset('images/logo.png') }}" alt="TN Logo">
            </div>
            <div class="logo-text-block">
                <span class="logo-panel-title">Admin Panel</span>
                <span class="logo-admin-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
            </div>
        </a>

        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('admin.dashboard') }}"  class="nav-item"><i class="fa-solid fa-table-cells-large"></i> Dashboard</a></li>
                <li>
                    <a href="{{ route('admin.bookings') }}" class="nav-item" onclick="clearNewBookingBadge()">
                        <i class="fa-solid fa-calendar-check"></i> Bookings
                        <span class="new-booking-badge" id="newBookingBadge"></span>
                    </a>
                </li>
                <li><a href="{{ route('admin.menu') }}"       class="nav-item active"><i class="fa-solid fa-utensils"></i> Restaurant</a></li>
                <li><a href="{{ route('admin.rooms') }}"      class="nav-item"><i class="fa-solid fa-bed"></i> Rooms</a></li>
                <li><a href="{{ route('admin.spa') }}"        class="nav-item"><i class="fa-solid fa-spa"></i> Spa Services</a></li>
                <li><a href="{{ route('admin.users') }}"      class="nav-item"><i class="fa-solid fa-circle-user"></i> Users</a></li>
                <li><a href="{{ route('admin.feedback') }}"   class="nav-item"><i class="fa-solid fa-comments"></i> Feedback</a></li>
            </ul>
        </nav>
    </aside>

    <!-- ══ MAIN ══ -->
    <div class="main-container">

        <header class="top-bar">
            <!-- Hamburger (mobile only) -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <h1 id="viewTitle">Restaurant Menu</h1>
            <div class="admin-profile-dropdown dropdown">
                <div class="admin-profile dropdown-toggle" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar">{{ substr(Auth::user()->first_name, 0, 1) }}</div>
                    <strong style="font-size:13px;">{{ Auth::user()->first_name }}</strong>
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="adminDropdown">
                    <li><a class="dropdown-item" href="{{ route('custom.profile.show') }}">Profile Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Log Out</a></li>
                </ul>
            </div>
        </header>

        <main class="content-area">

            <div class="menu-header-bar-wrapper">
                <div class="menu-header-bar">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchInput" placeholder="Search items..." onkeyup="searchGlobal()">
                    </div>
                    <div class="d-flex gap-3">
                        <button class="manage-btn" id="btnManageTables"   onclick="switchToView('tableInventoryView')">Manage Tables</button>
                        <button class="manage-btn" id="btnManageCategory" onclick="switchToView('manageCategoryView')">Manage Category</button>
                        <button class="manage-btn" id="btnManageItems"    onclick="switchToView('manageItemsView')">Manage Items</button>
                    </div>
                </div>
            </div>

            <!-- Column headers for Menu Items -->
            <div class="table-header-wrapper" id="menuColHeaders">
                <div class="table-header-card">
                    <table><thead><tr>
                        <th style="width:35%;">Item</th>
                        <th style="width:25%;">Category</th>
                        <th style="width:20%;">Price</th>
                        <th class="text-end" style="width:20%;">Action</th>
                    </tr></thead></table>
                </div>
            </div>

            <!-- Column headers for Table Inventory -->
            <div class="table-header-wrapper" id="tiColHeaders" style="display:none;">
                <div class="table-header-card">
                    <table><thead><tr>
                        <th style="width:25%;">Table No.</th>
                        <th style="width:15%;">Chairs</th>
                        <th style="width:40%;">Description</th>
                        <th class="text-end" style="width:20%;">Action</th>
                    </tr></thead></table>
                </div>
            </div>

            <!-- SCROLL ZONE -->
            <div class="table-rows-wrapper" id="mainScroll">

                <!-- VIEW 1: MANAGE ITEMS (default) -->
                <div id="manageItemsView">
                    <div class="table-rows-card">
                        <div style="display:flex; justify-content:flex-end; padding:16px 25px 8px;">
                            <button class="add-items-btn" onclick="openAddItemView()"><i class="fa-solid fa-plus"></i> Add Item</button>
                        </div>
                        <table class="menu-table" id="menuTable">
                            <tbody>
                                @foreach($menus as $menu)
                                <tr>
                                    <td class="item-font" style="width:35%;">
                                        {{ $menu->name }}<br>
                                        <small class="text-muted">{{ $menu->item_types }}</small>
                                    </td>
                                    <td style="width:25%;">{{ $menu->category->name }}</td>
                                    <td style="width:20%; font-weight:800;">{{ $menu->price }}</td>
                                    <td style="width:20%;">
                                        <div class="action-btn-group">
                                            <button class="btn-action-edit"
                                                onclick="openEdit('{{ $menu->id }}', '{{ addslashes($menu->name) }}', '{{ $menu->price }}', '{{ $menu->category_id }}', '{{ $menu->image }}', '{{ $menu->item_types }}')">
                                                <i class="fa-solid fa-pencil" style="font-size:12px;"></i> Edit
                                            </button>
                                            <button class="btn-action-delete"
                                                onclick="askDelete('{{ route('admin.menu.delete', $menu->id) }}', '{{ addslashes($menu->name) }}', 'manageItemsView')">
                                                <i class="fa-solid fa-trash-can" style="font-size:12px;"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- VIEW 2: TABLE INVENTORY -->
                <div id="tableInventoryView" style="display:none;">
                    <div class="table-rows-card">
                        <div style="display:flex; justify-content:flex-end; padding:16px 25px 8px;">
                            <button class="add-items-btn" onclick="openTableAddModal()"><i class="fa-solid fa-plus"></i> Add Table</button>
                        </div>
                        <table class="menu-table" id="tiTable">
                            <tbody>
                                @foreach($tables as $t)
                                <tr>
                                    <td class="fw-bold" style="width:25%;">{{ $t->table_no }}</td>
                                    <td style="width:15%;">{{ $t->chairs }} Chairs</td>
                                    <td style="width:40%;">{{ $t->description }}</td>
                                    <td style="width:20%;">
                                        <div class="action-btn-group">
                                            <button class="btn-action-edit"
                                                onclick="openEditTable('{{ $t->id }}', '{{ $t->table_no }}', '{{ $t->chairs }}', '{{ addslashes($t->description) }}')">
                                                <i class="fa-solid fa-pencil" style="font-size:12px;"></i> Edit
                                            </button>
                                            <button class="btn-action-delete"
                                                onclick="askDelete('{{ route('admin.table.delete', $t->id) }}', 'Table {{ $t->table_no }}', 'tableInventoryView')">
                                                <i class="fa-solid fa-trash-can" style="font-size:12px;"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- VIEW 3: MANAGE CATEGORIES -->
                <div id="manageCategoryView" style="display:none;">
                    <div class="manage-page-card">
                        <div class="manage-page-header">
                            <button class="add-items-btn" onclick="openAddCatModal()"><i class="fa-solid fa-plus"></i> Add Category</button>
                        </div>
                        <ul class="cat-list">
                            @foreach($categories as $cat)
                            <li class="cat-list-item">
                                <div class="cat-item-left">
                                    <div class="cat-icon-circle"><i class="fa-solid fa-layer-group"></i></div>
                                    <div>
                                        <div class="cat-name-text">{{ $cat->name }}</div>
                                        @if($cat->item_types)<div class="cat-name-sub">{{ $cat->item_types }}</div>@endif
                                    </div>
                                </div>
                                <div class="cat-actions">
                                    <button class="btn-action-edit"
                                        onclick="openEditCatModal('{{ $cat->id }}', '{{ addslashes($cat->name) }}', '{{ addslashes($cat->item_types) }}')">
                                        <i class="fa-solid fa-pencil" style="font-size:12px;"></i> Edit
                                    </button>
                                    <button class="btn-action-delete"
                                        onclick="askDelete('{{ route('admin.category.delete', $cat->id) }}', 'Category: {{ $cat->name }}', 'manageCategoryView')">
                                        <i class="fa-solid fa-trash-can" style="font-size:12px;"></i> Delete
                                    </button>
                                </div>
                            </li>
                            @endforeach
                            @if(count($categories) === 0)
                            <li class="cat-empty-state">
                                <i class="fa-solid fa-inbox" style="font-size:32px; margin-bottom:10px; display:block;"></i>
                                No categories found.
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- VIEW 4: ADD ITEM -->
                <div id="addView" class="view-section">
                    <i class="fa-solid fa-circle-xmark close-x" onclick="smartDiscard('manageItemsView', 'addItemForm')"></i>
                    <h2 class="mb-4" style="font-family:'Playfair Display'; font-weight:800;">Add New Item</h2>
                    <div id="addItemWarning" class="validation-warning">Please fill all fields and select an image before saving.</div>
                    <div id="addItemDuplicate" class="duplicate-warning"><i class="fa-solid fa-triangle-exclamation"></i><span id="addItemDupMsg"></span></div>
                    <form id="addItemForm" action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="redirect_view" value="manageItemsView">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Item Name</label>
                                <input type="text" name="name" id="addName" class="input-custom">
                                <label class="form-label">Price (Nu)</label>
                                <input type="text" name="price" id="addPrice" class="input-custom">
                                <label class="form-label">Item Type</label>
                                <select name="item_types" id="addItemType" class="form-select input-custom" required>
                                    <option value="" disabled selected>Select Type</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select name="category_id" id="addCategorySelect" class="form-select input-custom" required
                                        onchange="updateItemTypes(this.value, 'addItemType')">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" data-types="{{ $cat->item_types }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <label class="form-label">Upload Image</label>
                                <div class="upload-box" onclick="document.getElementById('fileAdd').click()">
                                    <i class="fa-solid fa-upload" id="upIconAdd"></i>
                                    <img id="imgPrevAdd" style="display:none;">
                                    <input type="file" name="image" id="fileAdd" hidden
                                           onchange="preview(this, 'imgPrevAdd', 'upIconAdd')">
                                </div>
                                <p class="text-center mt-2 fw-bold text-success small">Add Image</p>
                            </div>
                        </div>
                        <button type="button" class="add-items-btn w-100 py-3 mt-4"
                                onclick="validateAndAskSave('addItemForm', 'addItemWarning', true)">Save Item</button>
                    </form>
                </div>

                <!-- VIEW 5: EDIT ITEM -->
                <div id="editView" class="view-section">
                    <i class="fa-solid fa-circle-xmark close-x" onclick="smartDiscard('manageItemsView', 'editFormReal')"></i>
                    <h2 class="mb-1" style="font-family:'Playfair Display'; font-weight:800;">Edit Menu Item</h2>
                    <div id="editItemWarning"   class="validation-warning">Please fill in all fields before saving changes.</div>
                    <div id="editItemDuplicate" class="duplicate-warning"><i class="fa-solid fa-triangle-exclamation"></i><span id="editItemDupMsg"></span></div>
                    <form id="editFormReal" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <input type="hidden" name="redirect_view" value="manageItemsView">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Item Name</label>
                                <input type="text" name="name" id="editName" class="input-custom" required>
                                <label class="form-label">Price (Nu)</label>
                                <input type="text" name="price" id="editPrice" class="input-custom" required>
                                <label class="form-label">Item Type</label>
                                <select name="item_types" id="editItemType" class="form-select input-custom" required></select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select name="category_id" id="editCat" class="form-select input-custom" required
                                        onchange="updateItemTypes(this.value, 'editItemType')">
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" data-types="{{ $cat->item_types }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <label class="form-label">Upload Image</label>
                                <div class="upload-box" onclick="document.getElementById('fileEdit').click()">
                                    <img id="imgPrevEdit" style="display:none;">
                                    <input type="file" name="image" id="fileEdit" hidden
                                           onchange="preview(this, 'imgPrevEdit')">
                                </div>
                                <p class="text-center mt-2 fw-bold text-muted small">Current image shown above — upload new to replace</p>
                            </div>
                        </div>
                        <button type="button" class="add-items-btn w-100 py-3 mt-4" onclick="validateEditItem()">Save Changes</button>
                    </form>
                </div>

            </div><!-- end #mainScroll -->
        </main>
    </div>
</div>


<!-- ══ MODALS ══ -->

<!-- Confirm Save -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg text-center">
            <div class="modal-header pt-4">
                <h5 class="modal-title" style="font-family:'Playfair Display'; font-weight:800; font-size:1.4rem;">Are you sure?</h5>
            </div>
            <div class="modal-body pb-2"><p id="modalMsg" class="text-muted"></p></div>
            <div class="modal-footer pb-4 gap-3">
                <button class="btn-cancel" data-bs-dismiss="modal">No, Go Back</button>
                <button id="modalConfirmBtn" class="btn-modal-green">Yes, Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg text-center">
            <div class="modal-header pt-4">
                <h5 class="modal-title" style="font-family:'Playfair Display'; font-weight:800; font-size:1.4rem; color:var(--status-red);">Confirm Delete</h5>
            </div>
            <div class="modal-body pb-2"><p class="text-muted">Remove <b id="delObjName"></b>?</p></div>
            <form id="delForm" method="POST">
                @csrf @method('DELETE')
                <input type="hidden" name="redirect_view" id="delRedirectView" value="manageItemsView">
                <div class="modal-footer pb-4 gap-3">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-confirm">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Discard Changes -->
<div class="modal fade" id="discardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg text-center">
            <div class="modal-header pt-4">
                <h5 class="modal-title" style="font-family:'Playfair Display'; font-weight:800; font-size:1.4rem;">Discard Changes?</h5>
            </div>
            <div class="modal-body pb-2"><p class="text-muted">All unsaved data will be lost. Proceed?</p></div>
            <div class="modal-footer pb-4 gap-3">
                <button class="btn-cancel" data-bs-dismiss="modal">No</button>
                <button id="discardBtn" class="btn-confirm">Yes, Discard</button>
            </div>
        </div>
    </div>
</div>

<!-- Logout -->
<div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center shadow-lg">
            <div class="modal-header border-0 justify-content-center pt-4">
                <h5 class="modal-title h3" style="font-family:'Playfair Display'; font-weight:700;">Are you sure?</h5>
            </div>
            <div class="modal-body py-0"><p class="text-muted">Do you really want to log out of the admin panel?</p></div>
            <div class="modal-footer pb-4 gap-3">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">No, stay</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-confirm">Yes, Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Table Modal -->
<div class="modal fade" id="addTableModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header pt-4">
                <h5 class="modal-title" style="font-family:'Playfair Display'; font-weight:800;">Add New Table</h5>
            </div>
            <div class="modal-body">
                <div id="addTableWarning"   class="validation-warning">Please fill in all fields before adding.</div>
                <div id="addTableDuplicate" class="duplicate-warning"><i class="fa-solid fa-triangle-exclamation"></i> A table with this name already exists. Please use a different table number.</div>
                <form id="addTableForm" action="{{ route('admin.table.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="redirect_view" value="tableInventoryView">
                    <label class="form-label">Table Number</label>
                    <input type="text" name="table_no" id="t_no" class="input-custom"
                           oninput="checkTableDuplicate(this.value, 'addTableDuplicate', null)">
                    <label class="form-label">Chairs</label>
                    <input type="number" name="chairs" id="t_chairs" class="input-custom">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="t_desc" class="input-custom" style="height:80px; resize:none;"></textarea>
                    <button type="button" class="add-items-btn w-100" onclick="validateAndAskTable()">Confirm Add Table</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Table Modal -->
<div class="modal fade" id="editTableModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header pt-4">
                <h5 class="modal-title" style="font-family:'Playfair Display'; font-weight:800;">Edit Table</h5>
            </div>
            <div class="modal-body">
                <div id="editTableWarning"   class="validation-warning">Please fill in all fields before saving.</div>
                <div id="editTableDuplicate" class="duplicate-warning"><i class="fa-solid fa-triangle-exclamation"></i> A table with this name already exists. Please use a different table number.</div>
                <form id="editTableForm" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="redirect_view" value="tableInventoryView">
                    <label class="form-label">Table Number</label>
                    <input type="text" name="table_no" id="et_no" class="input-custom"
                           oninput="checkTableDuplicate(this.value, 'editTableDuplicate', editingTableOrigName)">
                    <label class="form-label">Chairs</label>
                    <input type="number" name="chairs" id="et_chairs" class="input-custom">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="et_desc" class="input-custom" style="height:80px; resize:none;"></textarea>
                    <button type="button" class="add-items-btn w-100" onclick="validateAndSaveEditTable()">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header pt-4">
                <h5 class="modal-title" style="font-family:'Playfair Display'; font-weight:800;">Add Category</h5>
            </div>
            <div class="modal-body">
                <div id="addCatWarning"   class="validation-warning">Please fill in both Category Name and Item Types.</div>
                <div id="addCatDuplicate" class="duplicate-warning"><i class="fa-solid fa-triangle-exclamation"></i> A category with this name already exists.</div>
                <form id="addCatForm" action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="redirect_view" value="manageCategoryView">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" id="newCatName" class="input-custom"
                           oninput="checkCatDuplicate(this.value, 'addCatDuplicate', null)">
                    <label class="form-label">Item Types (comma separated)</label>
                    <input type="text" name="item_types" id="newCatTypes" class="input-custom">
                    <button type="button" class="add-items-btn w-100" onclick="validateAndAskAddCat()">Save Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header pt-4">
                <h5 class="modal-title" style="font-family:'Playfair Display'; font-weight:800;">Edit Category</h5>
            </div>
            <div class="modal-body">
                <div id="editCatWarning"   class="validation-warning">Please fill in both Category Name and Item Types.</div>
                <div id="editCatDuplicate" class="duplicate-warning"><i class="fa-solid fa-triangle-exclamation"></i> A category with this name already exists.</div>
                <form id="editCatForm" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="redirect_view" value="manageCategoryView">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" id="editCatName" class="input-custom"
                           oninput="checkCatDuplicate(this.value, 'editCatDuplicate', editingCatOrigName)">
                    <label class="form-label">Item Types (comma separated)</label>
                    <input type="text" name="item_types" id="editCatTypes" class="input-custom">
                    <button type="button" class="add-items-btn w-100" onclick="validateAndAskEditCat()">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

/* ══════════════════════════════════════════════
   BADGE (cross-page)
══════════════════════════════════════════════ */
const BADGE_KEY       = 'tn_last_booking_seen_at';
const BADGE_COUNT_KEY = 'tn_new_booking_count';

function initNewBookingBadge() {
    const count = parseInt(localStorage.getItem(BADGE_COUNT_KEY) || '0', 10);
    const badge = document.getElementById('newBookingBadge');
    if (!badge) return;
    if (count > 0) { badge.textContent = count > 99 ? '99+' : count; badge.style.display = 'flex'; }
    else             { badge.style.display = 'none'; }
}

function clearNewBookingBadge() {
    localStorage.setItem(BADGE_KEY,       String(Date.now()));
    localStorage.setItem(BADGE_COUNT_KEY, '0');
    const badge = document.getElementById('newBookingBadge');
    if (badge) badge.style.display = 'none';
}

/* ══════════════════════════════════════════════
   INIT — restore the last active view after redirect
══════════════════════════════════════════════ */
const VIEW_STORAGE_KEY = 'tn_menu_active_view';

document.addEventListener('DOMContentLoaded', () => {
    initNewBookingBadge();

    const phpRedirect   = '{{ $redirectView }}';
    const localStored   = localStorage.getItem(VIEW_STORAGE_KEY);
    const targetView    = (phpRedirect && phpRedirect !== '') ? phpRedirect : (localStored || 'manageItemsView');

    switchToView(targetView);

    // Auto-dismiss success toast
    const toast = document.getElementById('successToast');
    if (toast) {
        setTimeout(() => {
            toast.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            toast.style.opacity    = '0';
            toast.style.transform  = 'translateX(60px)';
            setTimeout(() => toast.remove(), 500);
        }, 5000);
    }
});

/* ══════════════════════════════════════════════
   MOBILE SIDEBAR TOGGLE
══════════════════════════════════════════════ */
(function () {
    const btn     = document.getElementById('hamburgerBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (btn)     btn.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    document.querySelectorAll('.nav-item').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) closeSidebar();
        });
    });
})();

/* ══════════════════════════════════════════════
   DUPLICATE DETECTION HELPERS
══════════════════════════════════════════════ */
function isDuplicate(newVal, existingList, origVal) {
    const v = newVal.trim().toLowerCase();
    if (!v) return false;
    if (origVal && origVal.toLowerCase() === v) return false;
    return existingList.includes(v);
}

function checkTableDuplicate(val, warningId, origVal) {
    const el = document.getElementById(warningId);
    el.style.display = isDuplicate(val, existingTableNames, origVal) ? 'block' : 'none';
}

function checkCatDuplicate(val, warningId, origVal) {
    const el = document.getElementById(warningId);
    el.style.display = isDuplicate(val, existingCatNames, origVal) ? 'block' : 'none';
}

function checkMenuDuplicate(val, warningId, origVal) {
    const el = document.getElementById(warningId);
    el.style.display = isDuplicate(val, existingMenuNames, origVal) ? 'block' : 'none';
}

/* ══════════════════════════════════════════════
   CHANGE DETECTION
══════════════════════════════════════════════ */
const _snapshots = {};

function snapshotForm(formId) {
    if (!formId) return;
    const form = document.getElementById(formId);
    if (!form) return;
    const data = {};
    form.querySelectorAll('input:not([type=hidden]):not([type=file]), select, textarea')
        .forEach(el => { data[el.name || el.id] = el.value; });
    form.querySelectorAll('input[type=file]')
        .forEach(f => { data['__file__' + f.id] = false; });
    _snapshots[formId] = JSON.stringify(data);
}

function formHasChanged(formId) {
    if (!formId) return false;
    const form = document.getElementById(formId);
    if (!form || !_snapshots[formId]) return false;
    const data = {};
    form.querySelectorAll('input:not([type=hidden]):not([type=file]), select, textarea')
        .forEach(el => { data[el.name || el.id] = el.value; });
    form.querySelectorAll('input[type=file]')
        .forEach(f => { data['__file__' + f.id] = f.files.length > 0; });
    return JSON.stringify(data) !== _snapshots[formId];
}

function smartDiscard(target, formId) {
    if (formHasChanged(formId)) {
        document.getElementById('discardBtn').onclick = () => {
            switchToView(target);
            bootstrap.Modal.getInstance(document.getElementById('discardModal')).hide();
        };
        new bootstrap.Modal(document.getElementById('discardModal')).show();
    } else {
        switchToView(target);
    }
}

/* ══════════════════════════════════════════════
   VIEW SWITCHER
══════════════════════════════════════════════ */
function switchToView(id) {
    const allInlineViews  = ['manageItemsView', 'tableInventoryView', 'manageCategoryView'];
    const allSectionViews = ['addView', 'editView'];

    allInlineViews.forEach(v  => { document.getElementById(v).style.display = 'none'; });
    allSectionViews.forEach(v => { document.getElementById(v).style.display = 'none'; });

    const isMenu = (id === 'manageItemsView');
    const isTI   = (id === 'tableInventoryView');
    const isCat  = (id === 'manageCategoryView');

    document.getElementById('menuColHeaders').style.display = isMenu ? 'block' : 'none';
    document.getElementById('tiColHeaders').style.display   = isTI   ? 'block' : 'none';

    document.getElementById(id).style.display = 'block';
    document.getElementById('viewTitle').innerText =
        isTI  ? 'Table Inventory' :
        isCat ? 'Manage Categories' :
        'Restaurant Menu';

    document.getElementById('mainScroll').scrollTop = 0;

    localStorage.setItem(VIEW_STORAGE_KEY, id);

    document.getElementById('btnManageTables').classList.toggle('active-manage',   isTI);
    document.getElementById('btnManageCategory').classList.toggle('active-manage', isCat);
    document.getElementById('btnManageItems').classList.toggle('active-manage',    isMenu);
}

/* ══════════════════════════════════════════════
   ADD / EDIT ITEM VIEWS
══════════════════════════════════════════════ */
function openAddItemView() {
    editingMenuId       = null;
    editingMenuOrigName = '';
    document.getElementById('addItemForm').reset();
    document.getElementById('imgPrevAdd').style.display    = 'none';
    document.getElementById('upIconAdd').style.display     = 'block';
    document.getElementById('addItemWarning').style.display   = 'none';
    document.getElementById('addItemDuplicate').style.display = 'none';
    switchToView('addView');
    snapshotForm('addItemForm');
}

function openEdit(id, name, price, catId, img, currentType) {
    editingMenuId       = id;
    editingMenuOrigName = name;
    document.getElementById('editItemWarning').style.display   = 'none';
    document.getElementById('editItemDuplicate').style.display = 'none';
    document.getElementById('editFormReal').action = '/admin/menu/update/' + id;
    document.getElementById('editName').value  = name;
    document.getElementById('editPrice').value = price.replace('Nu.', '').trim();
    document.getElementById('editCat').value   = catId;
    updateItemTypes(catId, 'editItemType');
    document.getElementById('editItemType').value = currentType;
    const prev = document.getElementById('imgPrevEdit');
    if (img) { prev.src = '/images/menu/' + img; prev.style.display = 'block'; }
    else       { prev.style.display = 'none'; }
    document.getElementById('fileEdit').value = '';
    switchToView('editView');
    snapshotForm('editFormReal');
}

/* ══════════════════════════════════════════════
   TABLE MODALS
══════════════════════════════════════════════ */
function openTableAddModal() {
    editingTableId       = null;
    editingTableOrigName = '';
    document.getElementById('addTableWarning').style.display   = 'none';
    document.getElementById('addTableDuplicate').style.display = 'none';
    document.getElementById('addTableForm').reset();
    new bootstrap.Modal(document.getElementById('addTableModal')).show();
}

function openEditTable(id, tableNo, chairs, description) {
    editingTableId       = id;
    editingTableOrigName = tableNo.toLowerCase();
    document.getElementById('editTableWarning').style.display   = 'none';
    document.getElementById('editTableDuplicate').style.display = 'none';
    document.getElementById('editTableForm').action = '/admin/table/update/' + id;
    document.getElementById('et_no').value     = tableNo;
    document.getElementById('et_chairs').value = chairs;
    document.getElementById('et_desc').value   = description;
    new bootstrap.Modal(document.getElementById('editTableModal')).show();
}

/* ══════════════════════════════════════════════
   CATEGORY MODALS
══════════════════════════════════════════════ */
function openAddCatModal() {
    editingCatId       = null;
    editingCatOrigName = '';
    document.getElementById('addCatWarning').style.display   = 'none';
    document.getElementById('addCatDuplicate').style.display = 'none';
    document.getElementById('addCatForm').reset();
    new bootstrap.Modal(document.getElementById('addCatModal')).show();
}

function openEditCatModal(id, name, itemTypes) {
    editingCatId       = id;
    editingCatOrigName = name.toLowerCase();
    document.getElementById('editCatWarning').style.display   = 'none';
    document.getElementById('editCatDuplicate').style.display = 'none';
    document.getElementById('editCatForm').action = '/admin/menu/category/' + id;
    document.getElementById('editCatName').value  = name;
    document.getElementById('editCatTypes').value = itemTypes;
    new bootstrap.Modal(document.getElementById('editCatModal')).show();
}

/* ══════════════════════════════════════════════
   VALIDATION
══════════════════════════════════════════════ */
function validateAndAskSave(formId, warningId, isItem) {
    let isValid = true;
    const form = document.getElementById(formId);
    form.querySelectorAll('input:not([type=hidden]):not([type=file]), select, textarea')
        .forEach(el => { if (!el.value.trim()) isValid = false; });
    if (isItem && document.getElementById('fileAdd').files.length === 0) isValid = false;

    const dupEl = document.getElementById('addItemDuplicate');
    if (isDuplicate(document.getElementById('addName').value, existingMenuNames, editingMenuOrigName)) {
        document.getElementById('addItemDupMsg').innerText = 'An item with this name already exists.';
        dupEl.style.display = 'block';
        dupEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
    dupEl.style.display = 'none';

    if (!isValid) {
        document.getElementById(warningId).style.display = 'block';
        document.getElementById(warningId).scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
    document.getElementById(warningId).style.display = 'none';
    askSave(formId, isItem ? 'Add this item to the menu?' : 'Create this category?');
}

function validateEditItem() {
    const name  = document.getElementById('editName').value.trim();
    const price = document.getElementById('editPrice').value.trim();
    const cat   = document.getElementById('editCat').value;
    const type  = document.getElementById('editItemType').value;
    const warn  = document.getElementById('editItemWarning');
    const dupEl = document.getElementById('editItemDuplicate');

    if (isDuplicate(name, existingMenuNames, editingMenuOrigName)) {
        document.getElementById('editItemDupMsg').innerText = 'An item with this name already exists.';
        dupEl.style.display = 'block';
        dupEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
    dupEl.style.display = 'none';

    if (!name || !price || !cat || !type) {
        warn.style.display = 'block';
        warn.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
    warn.style.display = 'none';
    askSave('editFormReal', 'Save changes to this menu item?');
}

function validateAndAskTable() {
    const no   = document.getElementById('t_no').value.trim();
    const ch   = document.getElementById('t_chairs').value.trim();
    const desc = document.getElementById('t_desc').value.trim();
    const warn = document.getElementById('addTableWarning');
    const dup  = document.getElementById('addTableDuplicate');

    if (isDuplicate(no, existingTableNames, null)) {
        dup.style.display = 'block';
        return;
    }
    dup.style.display = 'none';

    if (!no || !ch || !desc) { warn.style.display = 'block'; return; }
    warn.style.display = 'none';

    bootstrap.Modal.getInstance(document.getElementById('addTableModal')).hide();
    askSave('addTableForm', 'Add this table?');
}

function validateAndSaveEditTable() {
    const no   = document.getElementById('et_no').value.trim();
    const ch   = document.getElementById('et_chairs').value.trim();
    const desc = document.getElementById('et_desc').value.trim();
    const warn = document.getElementById('editTableWarning');
    const dup  = document.getElementById('editTableDuplicate');

    if (isDuplicate(no, existingTableNames, editingTableOrigName)) {
        dup.style.display = 'block';
        return;
    }
    dup.style.display = 'none';

    if (!no || !ch || !desc) { warn.style.display = 'block'; return; }
    warn.style.display = 'none';

    bootstrap.Modal.getInstance(document.getElementById('editTableModal')).hide();
    askSave('editTableForm', 'Save changes to this table?');
}

function validateAndAskAddCat() {
    const name  = document.getElementById('newCatName').value.trim();
    const types = document.getElementById('newCatTypes').value.trim();
    const warn  = document.getElementById('addCatWarning');
    const dup   = document.getElementById('addCatDuplicate');

    if (isDuplicate(name, existingCatNames, null)) {
        dup.style.display = 'block';
        return;
    }
    dup.style.display = 'none';

    if (!name || !types) { warn.style.display = 'block'; return; }
    warn.style.display = 'none';

    bootstrap.Modal.getInstance(document.getElementById('addCatModal')).hide();
    askSave('addCatForm', 'Create this category?');
}

function validateAndAskEditCat() {
    const name  = document.getElementById('editCatName').value.trim();
    const types = document.getElementById('editCatTypes').value.trim();
    const warn  = document.getElementById('editCatWarning');
    const dup   = document.getElementById('editCatDuplicate');

    if (isDuplicate(name, existingCatNames, editingCatOrigName)) {
        dup.style.display = 'block';
        return;
    }
    dup.style.display = 'none';

    if (!name || !types) { warn.style.display = 'block'; return; }
    warn.style.display = 'none';

    bootstrap.Modal.getInstance(document.getElementById('editCatModal')).hide();
    askSave('editCatForm', 'Save changes to this category?');
}

/* ══════════════════════════════════════════════
   CONFIRM SAVE
══════════════════════════════════════════════ */
function askSave(formId, msg) {
    document.getElementById('modalMsg').innerText = msg;
    document.getElementById('modalConfirmBtn').onclick = () => {
        const viewMap = {
            addTableForm:  'tableInventoryView',
            editTableForm: 'tableInventoryView',
            addCatForm:    'manageCategoryView',
            editCatForm:   'manageCategoryView',
            addItemForm:   'manageItemsView',
            editFormReal:  'manageItemsView',
        };
        if (viewMap[formId]) localStorage.setItem(VIEW_STORAGE_KEY, viewMap[formId]);
        document.getElementById(formId).submit();
    };
    new bootstrap.Modal(document.getElementById('confirmModal')).show();
}

/* ══════════════════════════════════════════════
   CONFIRM DELETE
══════════════════════════════════════════════ */
function askDelete(url, name, returnView) {
    document.getElementById('delObjName').innerText = name;
    document.getElementById('delForm').action = url;
    document.getElementById('delRedirectView').value = returnView || 'manageItemsView';
    if (returnView) localStorage.setItem(VIEW_STORAGE_KEY, returnView);
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

/* ══════════════════════════════════════════════
   ITEM TYPES DROPDOWN
══════════════════════════════════════════════ */
function updateItemTypes(categoryId, targetDropdownId) {
    const catSelect = document.getElementById(targetDropdownId === 'addItemType' ? 'addCategorySelect' : 'editCat');
    const dropdown  = document.getElementById(targetDropdownId);
    const sel       = catSelect.options[catSelect.selectedIndex];
    dropdown.innerHTML = '<option value="" disabled selected>Select Type</option>';
    if (sel && sel.getAttribute('data-types')) {
        sel.getAttribute('data-types').split(',').forEach(type => {
            const opt = document.createElement('option');
            opt.value = type.trim(); opt.innerText = type.trim();
            dropdown.appendChild(opt);
        });
    }
}

/* ══════════════════════════════════════════════
   IMAGE PREVIEW
══════════════════════════════════════════════ */
function preview(input, imgId, iconId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById(imgId);
            img.src = e.target.result;
            img.style.display = 'block';
            if (iconId) document.getElementById(iconId).style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/* ══════════════════════════════════════════════
   SEARCH
══════════════════════════════════════════════ */
function searchGlobal() {
    const val = document.getElementById('searchInput').value.toUpperCase();
    for (const row of document.querySelector('#menuTable tbody').rows)
        row.style.display = row.cells[0].innerText.toUpperCase().includes(val) ? '' : 'none';
    for (const row of document.querySelector('#tiTable tbody').rows)
        row.style.display = row.cells[0].innerText.toUpperCase().includes(val) ? '' : 'none';
}

</script>
</body>
</html>