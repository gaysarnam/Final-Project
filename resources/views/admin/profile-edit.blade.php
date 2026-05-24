<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TN ADMIN - Edit Profile</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-green: #005a2b;
            --primary-green-hover: #004d26;
            --bg-light: #ffffff;
            --card-bg: #f5f6f7;
            --border-line: #e0e0e0;
            --text-black: #000000;
            --top-bar-grey: #f8f9fa;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; background-color: #fff; }
        .wrapper { display: flex; height: 100vh; width: 100%; }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: 320px; min-width: 320px;
            background: white;
            display: flex; flex-direction: column;
            padding: 40px 0;
            border-right: 1.5px solid var(--border-line);
            height: 100%; overflow: hidden;
            transition: transform 0.3s ease;
            z-index: 1000;
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

        .nav-links { list-style: none; padding: 0 25px; flex-grow: 1; }

        .nav-item {
            display: flex; align-items: center;
            padding: 14px 25px; margin-bottom: 15px;
            border-radius: 50px; font-weight: 700;
            color: var(--text-black); text-decoration: none; transition: 0.3s;
        }
        .nav-item i { margin-right: 23px; font-size: 30px; width: 33px; text-align: center; }
        .nav-item:hover { background-color: #f1f3f5; }
        .nav-item.active { background-color: var(--primary-green); color: white !important; }

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

        /* ── HAMBURGER (mobile only) ── */
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

        /* ─── MAIN CONTAINER ─── */
        .main-container { flex: 1; display: flex; flex-direction: column; height: 100%; min-width: 0; }

        /* ─── TOP BAR ─── */
        .top-bar {
            height: 100px; flex-shrink: 0;
            display: flex; justify-content: center; align-items: center;
            padding: 0 60px;
            background-color: var(--top-bar-grey);
            border-bottom: 1.5px solid var(--border-line);
            position: relative; z-index: 100;
        }
        .top-bar h1 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; margin: 0; }

        .admin-profile-dropdown { position: absolute; right: 60px; }

        .admin-profile {
            display: flex; align-items: center; gap: 12px;
            background: white; padding: 8px 18px 8px 8px;
            border-radius: 50px; border: 1px solid var(--border-line);
            cursor: pointer; text-decoration: none; color: inherit;
        }

        .avatar {
            width: 32px; height: 32px;
            background-color: var(--primary-green); color: white;
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; font-weight: bold;
        }

        .dropdown-menu {
            border-radius: 15px; border: 1px solid var(--border-line);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 10px 0; margin-top: 10px !important;
        }
        .dropdown-item { font-weight: 600; padding: 10px 20px; font-size: 14px; }

        /* ─── CONTENT AREA ─── */
        .content-area {
            flex: 1; overflow-y: auto;
            background-color: #f0f0f0;
            display: flex; align-items: center; justify-content: center;
            padding: 40px;
        }

        /* ─── TWO-PANEL CARD ─── */
        .edit-card {
            display: flex;
            width: 100%; max-width: 860px;
            border-radius: 28px; overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            background: white;
            position: relative;
        }

        /* Close X */
        .close-x-btn {
            position: absolute; top: 18px; right: 18px;
            width: 32px; height: 32px;
            background: #f1f1f1; border: none; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #555; cursor: pointer;
            z-index: 10; transition: background 0.2s;
        }
        .close-x-btn:hover { background: #e0e0e0; color: #111; }

        /* LEFT PANEL */
        .edit-left {
            width: 290px; flex-shrink: 0;
            background: var(--primary-green);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 50px 30px; position: relative; overflow: hidden;
        }

        .edit-left::before {
            content: ''; position: absolute;
            width: 220px; height: 220px; border-radius: 50%;
            border: 40px solid rgba(255,255,255,0.07);
            top: -60px; left: -60px;
        }
        .edit-left::after {
            content: ''; position: absolute;
            width: 180px; height: 180px; border-radius: 50%;
            border: 35px solid rgba(255,255,255,0.07);
            bottom: -50px; right: -50px;
        }

        .edit-avatar-wrap {
            width: 100px; height: 100px; border-radius: 50%;
            background: rgba(255,255,255,0.18);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px; position: relative; z-index: 1;
        }
        .edit-avatar-wrap i { font-size: 52px; color: white; }

        .edit-left h3 {
            font-family: 'Playfair Display', serif;
            font-size: 22px; font-weight: 700; color: white;
            text-align: center; margin-bottom: 6px;
            position: relative; z-index: 1;
        }
        .edit-left .tagline {
            font-size: 13px; color: rgba(255,255,255,0.75);
            font-style: italic; font-family: 'Playfair Display', serif;
            text-align: center; margin-bottom: 30px;
            position: relative; z-index: 1;
        }

        .info-pill {
            background: rgba(255,255,255,0.15); border-radius: 50px;
            padding: 10px 18px;
            display: flex; align-items: center; gap: 10px;
            width: 100%; margin-bottom: 10px;
            position: relative; z-index: 1;
        }
        .info-pill i { font-size: 14px; color: rgba(255,255,255,0.8); width: 16px; text-align: center; }
        .info-pill span { font-size: 13px; font-weight: 600; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        /* RIGHT PANEL */
        .edit-right {
            flex: 1; padding: 40px 40px 36px;
            background: white; overflow-y: auto;
            max-height: calc(100vh - 100px - 80px);
        }

        .section-eyebrow { font-size: 11px; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase; color: var(--primary-green); margin-bottom: 6px; }
        .edit-right h2 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 800; color: #111; margin-bottom: 4px; }
        .edit-right .subtitle { font-size: 14px; color: #aaa; margin-bottom: 22px; }

        .field-section-label { font-size: 11px; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase; color: #bbb; margin-bottom: 10px; margin-top: 6px; }

        /* Form fields */
        .field-row { display: flex; gap: 14px; margin-bottom: 12px; }
        .field-wrap { flex: 1; margin-bottom: 12px; }
        .field-wrap label { display: block; font-size: 12px; font-weight: 700; color: #777; margin-bottom: 6px; letter-spacing: 0.04em; }

        .input-icon-wrap {
            display: flex; align-items: center;
            background: #f7f7f8; border: 1.5px solid #ebebeb;
            border-radius: 12px; padding: 0 14px; gap: 10px;
            transition: border-color 0.2s;
        }
        .input-icon-wrap:focus-within { border-color: var(--primary-green); background: #fff; }
        .input-icon-wrap i { font-size: 14px; color: #ccc; flex-shrink: 0; }
        .input-icon-wrap input {
            flex: 1; border: none; background: transparent;
            padding: 13px 0; font-size: 15px; font-weight: 500; color: #111;
            outline: none;
        }

        /* Phone row */
        .phone-row { display: flex; gap: 10px; }

        .country-select-wrap {
            display: flex; align-items: center;
            background: #f7f7f8; border: 1.5px solid #ebebeb;
            border-radius: 12px; padding: 0 12px; gap: 8px;
            min-width: 155px; flex-shrink: 0;
            transition: border-color 0.2s; cursor: pointer;
        }
        .country-select-wrap:focus-within { border-color: var(--primary-green); background: #fff; }
        .country-flag { font-size: 18px; line-height: 1; }
        .country-select-wrap select {
            flex: 1; border: none; background: transparent;
            font-size: 13px; font-weight: 600; color: #111;
            outline: none; cursor: pointer; padding: 13px 0;
            appearance: none; -webkit-appearance: none;
        }
        .country-select-wrap .chevron { font-size: 11px; color: #aaa; flex-shrink: 0; }

        .phone-input-wrap {
            flex: 1;
            display: flex; align-items: center;
            background: #f7f7f8; border: 1.5px solid #ebebeb;
            border-radius: 12px; padding: 0 14px; gap: 10px;
            transition: border-color 0.2s;
        }
        .phone-input-wrap:focus-within { border-color: var(--primary-green); background: #fff; }
        .phone-input-wrap i { font-size: 14px; color: #ccc; flex-shrink: 0; }
        .phone-input-wrap input {
            flex: 1; border: none; background: transparent;
            padding: 13px 0; font-size: 15px; font-weight: 500; color: #111; outline: none;
        }

        /* Validation hints */
        .field-hint {
            font-size: 12px; font-weight: 600;
            margin-top: 5px; display: none;
        }
        .field-hint.ok    { color: #2e7d32; display: block; }
        .field-hint.error { color: #d32f2f; display: block; }

        /* Password */
        .pw-wrap {
            display: flex; align-items: center;
            background: #f7f7f8; border: 1.5px solid #ebebeb;
            border-radius: 12px; padding: 0 14px; gap: 10px;
            transition: border-color 0.2s;
        }
        .pw-wrap:focus-within { border-color: var(--primary-green); background: #fff; }
        .pw-wrap input {
            flex: 1; border: none; background: transparent;
            padding: 13px 0; font-size: 15px; font-weight: 500; color: #111; outline: none;
        }
        .pw-toggle { background: none; border: none; cursor: pointer; padding: 0; color: #bbb; font-size: 16px; flex-shrink: 0; line-height: 1; }
        .pw-toggle:hover { color: #555; }
        #pwField::-ms-reveal,
        #pwField::-ms-clear { display: none !important; width: 0; height: 0; }
        #pwField::-webkit-contacts-auto-fill-button,
        #pwField::-webkit-credentials-auto-fill-button { visibility: hidden; display: none !important; pointer-events: none; }
        .input-password-toggle { display: none !important; }

        /* Save button */
        .save-btn {
            width: 100%; padding: 16px;
            background-color: var(--primary-green); color: white;
            border: none; border-radius: 14px;
            font-size: 16px; font-weight: 700; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            margin-top: 20px; transition: background 0.25s;
        }
        .save-btn:hover { background-color: var(--primary-green-hover); }

        /* ─── PROMPT OVERLAYS ─── */
        .prompt-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.55); display: none;
            align-items: center; justify-content: center; z-index: 2000;
            backdrop-filter: blur(4px);
        }
        .prompt-box {
            background: white; padding: 40px 45px;
            border-radius: 25px; width: 420px; max-width: 90vw; text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.2);
        }
        .prompt-box h3 { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; margin-bottom: 8px; color: #000; }
        .prompt-box p  { font-size: 14px; color: #888; margin-bottom: 28px; }
        .prompt-buttons { display: flex; gap: 12px; justify-content: center; }
        .p-btn { padding: 12px 36px; border-radius: 12px; cursor: pointer; font-weight: 700; border: none; font-size: 14px; }
        .p-yes { background-color: var(--primary-green); color: white; }
        .p-yes:hover { background-color: var(--primary-green-hover); }
        .p-no  { background-color: #eee; color: #333; }

        /* ─── LOGOUT MODAL ─── */
        .modal-content { border-radius: 25px; border: none; padding: 20px; }
        .modal-footer  { border: none; justify-content: center; gap: 15px; }
        .btn-confirm   { background: #dc3545; color: white; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }
        .btn-cancel    { background: #eee; color: #333; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }

        /* ══════════════════════════════════════
           RESPONSIVE — TABLET (≤ 1100px)
        ══════════════════════════════════════ */
        @media (max-width: 1100px) {
            .sidebar { width: 260px; min-width: 260px; }
            .content-area { padding: 30px 24px; }
            .top-bar { padding: 0 30px; }
            .admin-profile-dropdown { right: 30px; }
            .edit-left { width: 240px; padding: 40px 20px; }
            .edit-left h3 { font-size: 19px; }
            .edit-right { padding: 32px 28px 28px; }
            .edit-right h2 { font-size: 24px; }
            .country-select-wrap { min-width: 130px; }
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
                width: 280px;
                min-width: unset;
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

            .main-container { width: 100%; height: auto; }

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

            /* Content */
            .content-area {
                padding: 20px 14px 30px;
                align-items: flex-start;
                flex: unset;
                overflow-y: visible;
            }

            /* Card stacks vertically */
            .edit-card {
                flex-direction: column;
                border-radius: 20px;
                max-width: 100%;
            }

            /* Close X repositioned for stacked layout */
            .close-x-btn {
                top: 14px;
                right: 14px;
            }

            /* Left panel becomes compact header strip */
            .edit-left {
                width: 100%;
                padding: 30px 20px 24px;
                justify-content: flex-start;
                align-items: center;
            }

            .edit-left::before {
                width: 160px; height: 160px;
                top: -50px; left: -50px;
            }
            .edit-left::after {
                width: 130px; height: 130px;
                bottom: -40px; right: -40px;
            }

            .edit-avatar-wrap {
                width: 76px; height: 76px;
                margin-bottom: 12px;
            }
            .edit-avatar-wrap i { font-size: 38px; }

            .edit-left h3 { font-size: 19px; margin-bottom: 4px; }
            .edit-left .tagline { font-size: 12px; margin-bottom: 18px; }

            .info-pill { padding: 8px 14px; margin-bottom: 8px; }
            .info-pill span { font-size: 12px; }

            /* Right panel */
            .edit-right {
                padding: 24px 18px 20px;
                max-height: none;
                overflow-y: visible;
            }

            .edit-right h2 { font-size: 22px; }
            .section-eyebrow { font-size: 10px; }
            .edit-right .subtitle { font-size: 13px; margin-bottom: 16px; }
            .field-section-label { font-size: 10px; }

            /* First/Last name row stacks on very small screens */
            .field-row { gap: 10px; }

            /* Phone row stacks */
            .phone-row { flex-direction: column; gap: 8px; }
            .country-select-wrap { min-width: unset; width: 100%; }

            .input-icon-wrap input,
            .phone-input-wrap input,
            .pw-wrap input { font-size: 14px; padding: 11px 0; }

            .save-btn { font-size: 15px; padding: 14px; border-radius: 12px; margin-top: 16px; }

            /* Prompt box */
            .prompt-box { padding: 30px 24px; border-radius: 18px; }
            .prompt-box h3 { font-size: 19px; }
            .p-btn { padding: 11px 24px; font-size: 13px; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤ 400px)
        ══════════════════════════════════════ */
        @media (max-width: 400px) {
            .top-bar h1 { font-size: 17px; }
            .edit-right h2 { font-size: 19px; }
            .edit-left { padding: 24px 14px 20px; }
            .edit-right { padding: 20px 14px 16px; }
            /* Stack first/last name fields vertically */
            .field-row { flex-direction: column; gap: 0; }
        }
    </style>
</head>
<body>

<!-- Sidebar overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="wrapper">

    <!-- ══════════════ SIDEBAR ══════════════ -->
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

        <ul class="nav-links">
            <li><a href="{{ route('admin.dashboard') }}" class="nav-item"><i class="fa-solid fa-table-cells-large"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.bookings') }}" class="nav-item"><i class="fa-solid fa-calendar-check"></i> Bookings</a></li>
            <li><a href="{{ route('admin.menu') }}" class="nav-item"><i class="fa-solid fa-utensils"></i> Restaurant</a></li>
            <li><a href="{{ route('admin.rooms') }}" class="nav-item"><i class="fa-solid fa-bed"></i> Rooms</a></li>
            <li><a href="{{ route('admin.spa') }}" class="nav-item"><i class="fa-solid fa-spa"></i> Spa Services</a></li>
            <li><a href="{{ route('admin.users') }}" class="nav-item"><i class="fa-solid fa-circle-user"></i> Users</a></li>
            <li><a href="{{ route('admin.feedback') }}" class="nav-item"><i class="fa-solid fa-comments"></i> Feedback</a></li>
        </ul>
    </aside>

    <!-- ══════════════ MAIN ══════════════ -->
    <div class="main-container">

        <header class="top-bar">
            <!-- Hamburger (mobile only) -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <h1>Edit Profile</h1>
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
            <div class="edit-card">

                <!-- Close X -->
                <button class="close-x-btn" id="closeX" title="Discard changes">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <!-- LEFT PANEL -->
                <div class="edit-left">
                    <div class="edit-avatar-wrap">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <h3>Your Account</h3>
                    <p class="tagline">Your profile says more than your words.</p>

                    <div class="info-pill">
                        <i class="fa-solid fa-user"></i>
                        <span id="leftName">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                    </div>
                    <div class="info-pill">
                        <i class="fa-solid fa-envelope"></i>
                        <span>{{ Auth::user()->email }}</span>
                    </div>
                    <div class="info-pill">
                        <i class="fa-solid fa-phone"></i>
                        <span id="leftPhone">{{ Auth::user()->phone }}</span>
                    </div>
                </div>

                <!-- RIGHT PANEL -->
                <div class="edit-right">
                    <div class="section-eyebrow">Account Settings</div>
                    <h2>Edit Your Profile</h2>
                    <p class="subtitle">Update your personal details below.</p>

                    <form id="editForm" action="{{ route('custom.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- PERSONAL INFORMATION -->
                        <div class="field-section-label">Personal Information</div>
                        <div class="field-row">
                            <div class="field-wrap">
                                <label>First Name</label>
                                <div class="input-icon-wrap">
                                    <i class="fa-regular fa-user"></i>
                                    <input type="text" name="first_name" id="fName" value="{{ Auth::user()->first_name }}" required oninput="updateLeftName()">
                                </div>
                            </div>
                            <div class="field-wrap">
                                <label>Last Name</label>
                                <div class="input-icon-wrap">
                                    <i class="fa-regular fa-user"></i>
                                    <input type="text" name="last_name" id="lName" value="{{ Auth::user()->last_name }}" required oninput="updateLeftName()">
                                </div>
                            </div>
                        </div>

                        <!-- CONTACT DETAILS -->
                        <div class="field-section-label">Contact Details</div>

                        <div class="field-wrap">
                            <label>Email Address</label>
                            <div class="input-icon-wrap">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="email" name="email" id="emailField" value="{{ Auth::user()->email }}" required oninput="validateEmail()">
                            </div>
                            <div class="field-hint" id="emailHint"></div>
                        </div>

                        <div class="field-wrap">
                            <label>WhatsApp Number</label>
                            <div class="phone-row">
                                <div class="country-select-wrap">
                                    <span class="country-flag" id="countryFlag">🇧🇹</span>
                                    <select id="countryCode" name="country_code" onchange="onCountryChange()">
                                        <option value="975"  data-flag="🇧🇹" selected>BT Bhutan (+975)</option>
                                        <option value="91"   data-flag="🇮🇳"         >IN India (+91)</option>
                                        <option value="977"  data-flag="🇳🇵"         >NP Nepal (+977)</option>
                                        <option value="880"  data-flag="🇧🇩"         >BD Bangladesh (+880)</option>
                                        <option value="94"   data-flag="🇱🇰"         >LK Sri Lanka (+94)</option>
                                        <option value="960"  data-flag="🇲🇻"         >MV Maldives (+960)</option>
                                        <option value="66"   data-flag="🇹🇭"         >TH Thailand (+66)</option>
                                        <option value="65"   data-flag="🇸🇬"         >SG Singapore (+65)</option>
                                        <option value="60"   data-flag="🇲🇾"         >MY Malaysia (+60)</option>
                                        <option value="1"    data-flag="🇺🇸"         >US USA (+1)</option>
                                        <option value="44"   data-flag="🇬🇧"         >GB UK (+44)</option>
                                        <option value="81"   data-flag="🇯🇵"         >JP Japan (+81)</option>
                                        <option value="82"   data-flag="🇰🇷"         >KR South Korea (+82)</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down chevron"></i>
                                </div>
                                <div class="phone-input-wrap">
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                    <input type="text" name="phone" id="phoneField"
                                           value="{{ Auth::user()->phone }}"
                                           placeholder="Enter number"
                                           inputmode="numeric"
                                           onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                           oninput="validatePhone()">
                                </div>
                            </div>
                            <div class="field-hint" id="phoneHint"></div>
                        </div>

                        <!-- SECURITY -->
                        <div class="field-section-label">Security</div>

                        <div class="field-wrap">
                            <label>Change Password</label>
                            <div class="pw-wrap">
                                <input type="password" name="new_password" id="pwField"
                                       placeholder="Leave blank to keep current password"
                                       autocomplete="new-password"
                                       oninput="validatePassword()">
                                <button type="button" class="pw-toggle" id="pwToggleBtn" onclick="togglePw()" tabindex="-1">
                                    <i class="fa-regular fa-eye-slash" id="pwEyeIcon"></i>
                                </button>
                            </div>
                            <div class="field-hint" id="pwHint"></div>
                        </div>

                        <!-- hidden full phone field -->
                        <input type="hidden" name="phone_full" id="phoneFull">

                        <button type="submit" class="save-btn">
                            <i class="fa-solid fa-floppy-disk"></i> Save Changes
                        </button>
                    </form>
                </div>

            </div>
        </main>
    </div>
</div>

<!-- ══ SAVE PROMPT ══ -->
<div class="prompt-overlay" id="savePrompt">
    <div class="prompt-box">
        <h3>Save Changes?</h3>
        <p>Are you sure you want to update your profile?</p>
        <div class="prompt-buttons">
            <button class="p-btn p-yes" id="confirmSave">Yes, Save</button>
            <button class="p-btn p-no"  id="cancelSave">Cancel</button>
        </div>
    </div>
</div>

<!-- ══ EXIT PROMPT ══ -->
<div class="prompt-overlay" id="exitPrompt">
    <div class="prompt-box">
        <h3>Discard Changes?</h3>
        <p>Any unsaved information will be lost.</p>
        <div class="prompt-buttons">
            <button class="p-btn p-yes" id="keepEditing">Keep Editing</button>
            <button class="p-btn p-no"  id="exitConfirm">Yes, Discard</button>
        </div>
    </div>
</div>

<!-- ══ LOGOUT MODAL ══ -->
<div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center shadow">
            <div class="modal-header border-0 justify-content-center">
                <h5 class="modal-title h3" style="font-family:'Playfair Display';font-weight:700;">Are you sure?</h5>
            </div>
            <div class="modal-body py-0">
                <p class="text-muted">Do you really want to log out of the admin panel?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">No, stay</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-confirm">Yes, Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

    const countryRules = {
        '975': { pattern: /^(17|16|77)\d+$/, length: 8,  starts: ['17', '16', '77'], name: 'Bhutan',      hint: '8 digits, starts with 17, 16, or 77', placeholder: '17XXXXXX'    },
        '91':  { pattern: /^[6-9]\d+$/,      length: 10, starts: ['6','7','8','9'],  name: 'India',       hint: '10 digits, starts with 6–9',          placeholder: '9XXXXXXXXX'  },
        '977': { pattern: /^(97|98)\d+$/,    length: 10, starts: ['97','98'],        name: 'Nepal',       hint: '10 digits, starts with 97 or 98',     placeholder: '98XXXXXXXX'  },
        '880': { pattern: /^01\d+$/,         length: 11, starts: ['01'],             name: 'Bangladesh',  hint: '11 digits, starts with 01',           placeholder: '01XXXXXXXXX' },
        '94':  { pattern: /^07\d+$/,         length: 10, starts: ['07'],             name: 'Sri Lanka',   hint: '10 digits, starts with 07',           placeholder: '07XXXXXXXX'  },
        '960': { pattern: /^[79]\d+$/,       length: 7,  starts: ['7','9'],          name: 'Maldives',    hint: '7 digits, starts with 7 or 9',        placeholder: '7XXXXXX'     },
        '66':  { pattern: /^0[689]\d+$/,     length: 10, starts: ['06','08','09'],   name: 'Thailand',    hint: '10 digits, starts with 06, 08, or 09',placeholder: '08XXXXXXXX'  },
        '65':  { pattern: /^[89]\d+$/,       length: 8,  starts: ['8','9'],          name: 'Singapore',   hint: '8 digits, starts with 8 or 9',        placeholder: '8XXXXXXX'    },
        '60':  { pattern: /^01\d+$/,         lengthMin: 10, lengthMax: 11, starts: ['01'], name: 'Malaysia', hint: '10–11 digits, starts with 01',    placeholder: '01XXXXXXXXX' },
        '1':   { pattern: /^[2-9]\d+$/,      length: 10, starts: ['2–9'],            name: 'USA',         hint: '10 digits, starts with 2–9',          placeholder: '2XXXXXXXXX'  },
        '44':  { pattern: /^07\d+$/,         length: 11, starts: ['07'],             name: 'UK',          hint: '11 digits, starts with 07',           placeholder: '07XXXXXXXXX' },
        '81':  { pattern: /^0[789]\d+$/,     length: 11, starts: ['07','08','09'],   name: 'Japan',       hint: '11 digits, starts with 07, 08, or 09',placeholder: '09XXXXXXXXX' },
        '82':  { pattern: /^01\d+$/,         length: 11, starts: ['01'],             name: 'South Korea', hint: '11 digits, starts with 01',           placeholder: '01XXXXXXXXX' }
    };

    const ALLOWED_EMAIL_DOMAINS = ['gmail.com', 'rub.edu.bt'];
    const BACK_URL = "{{ route('custom.profile.show') }}";

    let originalSnapshot = '';

    function getSnapshot() {
        return JSON.stringify({
            fName:       document.getElementById('fName').value.trim(),
            lName:       document.getElementById('lName').value.trim(),
            email:       document.getElementById('emailField').value.trim(),
            countryCode: document.getElementById('countryCode').value,
            phone:       document.getElementById('phoneField').value.trim(),
            pw:          document.getElementById('pwField').value,
        });
    }

    function isDirty() { return getSnapshot() !== originalSnapshot; }

    function onCountryChange() {
        const sel  = document.getElementById('countryCode');
        const opt  = sel.options[sel.selectedIndex];
        const code = sel.value;
        const rule = countryRules[code];
        document.getElementById('countryFlag').textContent = opt.getAttribute('data-flag');
        const phoneInput = document.getElementById('phoneField');
        phoneInput.value       = '';
        phoneInput.maxLength   = rule ? (rule.length || rule.lengthMax) : 15;
        phoneInput.placeholder = rule ? rule.placeholder : 'Enter number';
        const hint = document.getElementById('phoneHint');
        hint.textContent = '';
        hint.className   = 'field-hint';
    }

    function validatePhone() {
        const code  = document.getElementById('countryCode').value;
        const input = document.getElementById('phoneField');
        const num   = input.value.trim();
        const hint  = document.getElementById('phoneHint');
        const rule  = countryRules[code];
        if (!rule || num === '') { hint.className = 'field-hint'; hint.textContent = ''; return; }
        const digits = num.replace(/\D/g, '');
        const maxLen = rule.length || rule.lengthMax;
        if (digits.length > maxLen) { input.value = digits.slice(0, maxLen); return; }
        let lengthOk = rule.length ? digits.length === rule.length : digits.length >= rule.lengthMin && digits.length <= rule.lengthMax;
        const patternOk = rule.pattern.test(digits);
        if (lengthOk && patternOk) {
            hint.textContent = '✓ Looks good!';
            hint.className   = 'field-hint ok';
            document.getElementById('leftPhone').textContent = '+' + code + digits;
        } else {
            let msg = '✗ ' + rule.hint;
            if (lengthOk && !patternOk) msg = '✗ Must start with ' + rule.starts.join(', ');
            else if (!lengthOk) {
                const expected = rule.length ? `${rule.length} digits` : `${rule.lengthMin}–${rule.lengthMax} digits`;
                msg = `✗ ${rule.name}: needs ${expected} (${digits.length} entered)`;
            }
            hint.textContent = msg;
            hint.className   = 'field-hint error';
        }
    }

    function isPhoneValid() {
        const code = document.getElementById('countryCode').value;
        const num  = document.getElementById('phoneField').value.trim();
        const rule = countryRules[code];
        if (!num) return true;
        if (!rule) return true;
        const digits   = num.replace(/\D/g, '');
        const lengthOk = rule.length ? digits.length === rule.length : digits.length >= rule.lengthMin && digits.length <= rule.lengthMax;
        return lengthOk && rule.pattern.test(digits);
    }

    function validateEmail() {
        const raw  = document.getElementById('emailField').value.trim().toLowerCase();
        const hint = document.getElementById('emailHint');
        if (raw === '') { hint.className = 'field-hint'; hint.textContent = ''; return; }
        const formatOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(raw);
        if (!formatOk) { hint.textContent = '✗ Please enter a valid email address.'; hint.className = 'field-hint error'; return; }
        const domain = raw.split('@')[1] || '';
        if (!ALLOWED_EMAIL_DOMAINS.includes(domain)) {
            hint.textContent = '✗ Email must end with @gmail.com or @rub.edu.bt';
            hint.className   = 'field-hint error';
        } else {
            hint.textContent = '✓ Email looks good!';
            hint.className   = 'field-hint ok';
        }
    }

    function validatePassword() {
        const email  = document.getElementById('emailField').value.trim().toLowerCase();
        const pw     = document.getElementById('pwField').value;
        const hint   = document.getElementById('pwHint');
        const domain = email.split('@')[1] || '';
        if (pw === '') { hint.className = 'field-hint'; hint.textContent = ''; return; }
        if (!ALLOWED_EMAIL_DOMAINS.includes(domain)) {
            hint.textContent = '✗ Password changes are only allowed for @gmail.com or @rub.edu.bt accounts.';
            hint.className   = 'field-hint error'; return;
        }
        if (pw.length < 8) { hint.textContent = '✗ Password must be at least 8 characters.'; hint.className = 'field-hint error'; }
        else                { hint.textContent = '✓ Password looks good!';                    hint.className = 'field-hint ok'; }
    }

    function togglePw() {
        const input = document.getElementById('pwField');
        const icon  = document.getElementById('pwEyeIcon');
        if (input.type === 'password') { input.type = 'text';     icon.className = 'fa-regular fa-eye'; }
        else                           { input.type = 'password'; icon.className = 'fa-regular fa-eye-slash'; }
    }

    function updateLeftName() {
        const f = document.getElementById('fName').value.trim();
        const l = document.getElementById('lName').value.trim();
        document.getElementById('leftName').textContent = (f + ' ' + l).trim();
    }

    document.getElementById('editForm').onsubmit = function(e) {
        e.preventDefault();
        const email  = document.getElementById('emailField').value.trim().toLowerCase();
        const domain = email.split('@')[1] || '';
        if (!ALLOWED_EMAIL_DOMAINS.includes(domain)) {
            document.getElementById('emailHint').textContent = '✗ Email must end with @gmail.com or @rub.edu.bt';
            document.getElementById('emailHint').className   = 'field-hint error';
            document.getElementById('emailField').focus(); return;
        }
        if (!isPhoneValid()) { validatePhone(); document.getElementById('phoneField').focus(); return; }
        const pw = document.getElementById('pwField').value;
        if (pw !== '') {
            if (!ALLOWED_EMAIL_DOMAINS.includes(domain)) {
                document.getElementById('pwHint').textContent = '✗ Password changes only allowed for @gmail.com or @rub.edu.bt.';
                document.getElementById('pwHint').className   = 'field-hint error'; return;
            }
            if (pw.length < 8) {
                document.getElementById('pwHint').textContent = '✗ Password must be at least 8 characters.';
                document.getElementById('pwHint').className   = 'field-hint error'; return;
            }
        }
        const code = document.getElementById('countryCode').value;
        const num  = document.getElementById('phoneField').value.trim();
        document.getElementById('phoneFull').value = num ? ('+' + code + num.replace(/\D/g, '')) : '';
        document.getElementById('savePrompt').style.display = 'flex';
    };

    document.getElementById('confirmSave').onclick = function() { document.getElementById('editForm').submit(); };
    document.getElementById('cancelSave').onclick  = function() { document.getElementById('savePrompt').style.display = 'none'; };

    document.getElementById('closeX').onclick = function() {
        if (isDirty()) { document.getElementById('exitPrompt').style.display = 'flex'; }
        else           { window.location.href = BACK_URL; }
    };
    document.getElementById('keepEditing').onclick = function() { document.getElementById('exitPrompt').style.display = 'none'; };
    document.getElementById('exitConfirm').onclick  = function() { window.location.href = BACK_URL; };

    /* ── Mobile sidebar toggle ── */
    (function () {
        const btn     = document.getElementById('hamburgerBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() { sidebar.classList.add('open'); overlay.classList.add('active'); document.body.style.overflow = 'hidden'; }
        function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('active'); document.body.style.overflow = ''; }

        if (btn)     btn.addEventListener('click', openSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);
        document.querySelectorAll('.nav-item').forEach(link => {
            link.addEventListener('click', () => { if (window.innerWidth <= 768) closeSidebar(); });
        });
    })();

    /* ── Init country from stored phone ── */
    (function initCountry() {
        const raw = "{{ Auth::user()->phone ?? '' }}";
        const sel = document.getElementById('countryCode');
        if (raw) {
            const sorted = Array.from(sel.options).sort((a, b) => b.value.length - a.value.length);
            for (const opt of sorted) {
                const prefix = '+' + opt.value;
                if (raw.startsWith(prefix)) {
                    sel.value = opt.value;
                    document.getElementById('countryFlag').textContent = opt.getAttribute('data-flag');
                    document.getElementById('phoneField').value = raw.replace(prefix, '');
                    break;
                }
            }
        }
        const code = sel.value;
        const rule = countryRules[code];
        if (rule) {
            const phoneInput       = document.getElementById('phoneField');
            phoneInput.maxLength   = rule.length || rule.lengthMax;
            phoneInput.placeholder = rule.placeholder;
        }
        originalSnapshot = getSnapshot();
    })();

</script>
</body>
</html>