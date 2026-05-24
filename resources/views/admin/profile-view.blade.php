<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TN ADMIN - Profile</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Premium Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
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

        /* ─── SIDEBAR — matched to dashboard ─── */
        .sidebar {
            width: 320px;
            min-width: 320px;
            background: white;
            display: flex;
            flex-direction: column;
            padding: 40px 0;
            border-right: 1.5px solid var(--border-line);
            height: 100%;
            overflow: hidden;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .logo-area {
            padding: 0 40px;
            margin-bottom: 70px;
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: var(--text-black);
        }

        .logo-img-wrap {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--primary-green);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .logo-img-wrap img {
            width: 30px;
            height: 30px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .logo-text-block {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .logo-panel-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-black);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .logo-admin-name {
            font-size: 12px;
            font-weight: 500;
            color: #888;
            margin-top: 5px;
        }

        .nav-links { list-style: none; padding: 0 25px; flex-grow: 1; }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 14px 25px;
            margin-bottom: 15px;
            border-radius: 50px;
            font-weight: 700;
            color: var(--text-black);
            text-decoration: none;
            transition: 0.3s;
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

        /* ─── TOP BAR — matched to dashboard ─── */
        .top-bar {
            height: 100px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 60px;
            background-color: var(--top-bar-grey);
            border-bottom: 1.5px solid var(--border-line);
            position: relative;
            z-index: 100;
        }

        .top-bar h1 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; margin: 0; }

        .admin-profile-dropdown { position: absolute; right: 60px; }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 8px 18px 8px 8px;
            border-radius: 50px;
            border: 1px solid var(--border-line);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .avatar {
            width: 32px; height: 32px;
            background-color: var(--primary-green);
            color: white; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold;
        }

        .dropdown-menu {
            border-radius: 15px;
            border: 1px solid var(--border-line);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 10px 0;
            margin-top: 10px !important;
        }
        .dropdown-item { font-weight: 600; padding: 10px 20px; font-size: 14px; }

        /* ─── CONTENT AREA ─── */
        .content-area {
            flex: 1;
            overflow-y: auto;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        /* ─── PROFILE CARD — two-panel layout ─── */
        .profile-card {
            display: flex;
            width: 100%;
            max-width: 860px;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            background: white;
        }

        /* LEFT PANEL — green */
        .profile-left {
            width: 290px;
            flex-shrink: 0;
            background: var(--primary-green);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 30px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        .profile-left::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            border: 40px solid rgba(255,255,255,0.07);
            top: -60px;
            left: -60px;
        }

        .profile-left::after {
            content: '';
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 35px solid rgba(255,255,255,0.07);
            bottom: -50px;
            right: -50px;
        }

        .profile-avatar-wrap {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .profile-avatar-wrap i {
            font-size: 52px;
            color: white;
        }

        .profile-left h3 {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: white;
            text-align: center;
            margin-bottom: 6px;
            position: relative;
            z-index: 1;
        }

        .profile-left .tagline {
            font-size: 13px;
            color: rgba(255,255,255,0.75);
            font-style: italic;
            font-family: 'Playfair Display', serif;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .profile-info-pill {
            background: rgba(255,255,255,0.15);
            border-radius: 50px;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .profile-info-pill i {
            font-size: 14px;
            color: rgba(255,255,255,0.8);
            width: 16px;
            text-align: center;
        }

        .profile-info-pill span {
            font-size: 13px;
            font-weight: 600;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* RIGHT PANEL — white */
        .profile-right {
            flex: 1;
            padding: 45px 45px 40px;
            background: white;
            display: flex;
            flex-direction: column;
        }

        .section-eyebrow {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--primary-green);
            margin-bottom: 6px;
        }

        .profile-right h2 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            font-weight: 800;
            color: #111;
            margin-bottom: 4px;
        }

        .profile-right .subtitle {
            font-size: 14px;
            color: #aaa;
            margin-bottom: 28px;
        }

        .info-section-label {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #bbb;
            margin-bottom: 10px;
            margin-top: 4px;
        }

        .info-field {
            background: #f7f7f8;
            border: 1px solid #ebebeb;
            border-radius: 12px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 10px;
        }

        .info-field i {
            font-size: 15px;
            color: #bbb;
            width: 18px;
            text-align: center;
        }

        .info-field-inner {
            display: flex;
            flex-direction: column;
        }

        .info-field-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #bbb;
            margin-bottom: 2px;
        }

        .info-field-value {
            font-size: 15px;
            font-weight: 600;
            color: #111;
        }

        .role-badge {
            display: inline-block;
            background: #e8f5e9;
            color: var(--primary-green);
            font-size: 12px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 50px;
            letter-spacing: 0.04em;
        }

        .edit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: auto;
            padding-top: 24px;
            background-color: var(--primary-green);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 16px;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.25s;
            margin-top: 24px;
        }
        .edit-btn:hover { background-color: var(--primary-green-hover); color: white; }

        /* ─── LOGOUT MODAL — matched exactly to dashboard ─── */
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
            .profile-left { width: 240px; padding: 40px 20px; }
            .profile-right { padding: 35px 30px 30px; }
            .profile-right h2 { font-size: 26px; }
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
            }

            /* Profile card stacks vertically */
            .profile-card {
                flex-direction: column;
                border-radius: 20px;
                max-width: 100%;
            }

            /* Left panel becomes a compact header strip */
            .profile-left {
                width: 100%;
                padding: 32px 24px 28px;
                justify-content: flex-start;
                align-items: center;
            }

            .profile-left::before {
                width: 160px;
                height: 160px;
                top: -50px;
                left: -50px;
            }

            .profile-left::after {
                width: 130px;
                height: 130px;
                bottom: -40px;
                right: -40px;
            }

            .profile-avatar-wrap {
                width: 80px;
                height: 80px;
                margin-bottom: 14px;
            }

            .profile-avatar-wrap i { font-size: 40px; }

            .profile-left h3 { font-size: 20px; margin-bottom: 4px; }
            .profile-left .tagline { font-size: 12px; margin-bottom: 20px; }

            .profile-info-pill { padding: 8px 14px; margin-bottom: 8px; }
            .profile-info-pill span { font-size: 12px; }

            /* Right panel */
            .profile-right {
                padding: 28px 20px 24px;
            }

            .profile-right h2 { font-size: 24px; }
            .section-eyebrow { font-size: 10px; }
            .info-section-label { font-size: 10px; }

            .info-field { padding: 12px 14px; gap: 12px; margin-bottom: 8px; }
            .info-field-value { font-size: 14px; }

            .edit-btn { font-size: 15px; padding: 14px; border-radius: 12px; margin-top: 20px; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤ 400px)
        ══════════════════════════════════════ */
        @media (max-width: 400px) {
            .top-bar h1 { font-size: 17px; }
            .profile-right h2 { font-size: 21px; }
            .profile-left { padding: 24px 16px 20px; }
            .profile-right { padding: 22px 16px 20px; }
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
            <li><a href="{{ route('admin.dashboard') }}" class="nav-item">
                <i class="fa-solid fa-table-cells-large"></i> Dashboard
            </a></li>
            <li><a href="{{ route('admin.bookings') }}" class="nav-item">
                <i class="fa-solid fa-calendar-check"></i> Bookings
            </a></li>
            <li><a href="{{ route('admin.menu') }}" class="nav-item">
                <i class="fa-solid fa-utensils"></i> Restaurant
            </a></li>
            <li><a href="{{ route('admin.rooms') }}" class="nav-item">
                <i class="fa-solid fa-bed"></i> Rooms
            </a></li>
            <li><a href="{{ route('admin.spa') }}" class="nav-item">
                <i class="fa-solid fa-spa"></i> Spa Services
            </a></li>
            <li><a href="{{ route('admin.users') }}" class="nav-item">
                <i class="fa-solid fa-circle-user"></i> Users
            </a></li>
            <li><a href="{{ route('admin.feedback') }}" class="nav-item">
                <i class="fa-solid fa-comments"></i> Feedback
            </a></li>
        </ul>
    </aside>

    <!-- ══════════════ MAIN ══════════════ -->
    <div class="main-container">

        <header class="top-bar">
            <!-- Hamburger (mobile only) -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <h1>Profile</h1>

            <div class="admin-profile-dropdown dropdown">
                <div class="admin-profile dropdown-toggle"
                     id="adminDropdown"
                     data-bs-toggle="dropdown"
                     aria-expanded="false">
                    <div class="avatar">{{ substr(Auth::user()->first_name, 0, 1) }}</div>
                    <strong style="font-size:13px;">{{ Auth::user()->first_name }}</strong>
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="adminDropdown">
                    <li><a class="dropdown-item" href="{{ route('custom.profile.show') }}">Profile Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#"
                           data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Log Out</a></li>
                </ul>
            </div>
        </header>

        <main class="content-area">
            <div class="profile-card">

                <!-- LEFT PANEL -->
                <div class="profile-left">
                    <div class="profile-avatar-wrap">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <h3>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <p class="tagline">Profile says more than your words.</p>

                    <div class="profile-info-pill">
                        <i class="fa-solid fa-user"></i>
                        <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                    </div>
                    <div class="profile-info-pill">
                        <i class="fa-solid fa-envelope"></i>
                        <span>{{ Auth::user()->email }}</span>
                    </div>
                    <div class="profile-info-pill">
                        <i class="fa-solid fa-phone"></i>
                        <span>{{ Auth::user()->phone }}</span>
                    </div>
                </div>

                <!-- RIGHT PANEL -->
                <div class="profile-right">
                    <div class="section-eyebrow">Account Overview</div>
                    <h2>Admin Profile</h2>

                    <!-- Personal Information -->
                    <div class="info-section-label">Personal Information</div>
                    <div class="info-field">
                        <i class="fa-regular fa-user"></i>
                        <div class="info-field-inner">
                            <span class="info-field-label">Full Name</span>
                            <span class="info-field-value">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        </div>
                    </div>

                    <!-- Contact Details -->
                    <div class="info-section-label">Contact Details</div>
                    <div class="info-field">
                        <i class="fa-regular fa-envelope"></i>
                        <div class="info-field-inner">
                            <span class="info-field-label">Email</span>
                            <span class="info-field-value">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <div class="info-field">
                        <i class="fa-solid fa-phone"></i>
                        <div class="info-field-inner">
                            <span class="info-field-label">WhatsApp Number</span>
                            <span class="info-field-value">{{ Auth::user()->phone }}</span>
                        </div>
                    </div>

                    <!-- Account -->
                    <div class="info-section-label">Account</div>
                    <div class="info-field">
                        <i class="fa-solid fa-shield-halved"></i>
                        <div class="info-field-inner">
                            <span class="info-field-label">Role</span>
                            <span class="info-field-value"><span class="role-badge">Admin</span></span>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <a href="{{ route('custom.profile.edit') }}" class="edit-btn">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                    </a>
                </div>

            </div>
        </main>
    </div>
</div>

<!-- ══════════════ LOGOUT MODAL — matched exactly to dashboard ══════════════ -->
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
    /* ── Mobile sidebar toggle ── */
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
</script>
</body>
</html>