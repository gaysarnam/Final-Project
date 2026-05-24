<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TN ADMIN - Feedback</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Premium Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-green: #005a2b;
            --bg-light: #ffffff;
            --card-bg: #f5f6f7;
            --border-line: #e0e0e0;
            --text-black: #000000;
            --top-bar-grey: #f8f9fa;
            --feedback-card-bg: #f9f4f4;
            --feedback-border: #dcd0d0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; }
        .wrapper { display: flex; height: 100vh; width: 100%; }

        /* ─── SIDEBAR — matched to dashboard ─── */
        .sidebar {
            width: 320px;
            background: white;
            display: flex;
            flex-direction: column;
            padding: 40px 0;
            border-right: 1.5px solid var(--border-line);
            height: 100%;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        /* ── Logo area: image + two-line text ── */
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

        /* ─── NAV — matched to dashboard ─── */
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
        .main-container { flex: 1; display: flex; flex-direction: column; height: 100%; }

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
        }

        .top-bar h1 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; margin: 0; }

        /* ─── ADMIN PROFILE — matched to dashboard ─── */
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

        /* ─── FEEDBACK CONTENT AREA ─── */
        .content-area { padding: 40px 60px; flex-grow: 1; overflow-y: auto; background-color: white; }

        .feedback-card {
            background-color: var(--feedback-card-bg);
            border: 1px solid var(--feedback-border);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        }

        .feedback-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .user-info h5 { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 20px; margin: 0; }
        .service-tag { font-size: 14px; color: #555; margin-left: 10px; font-weight: 500; }
        .feedback-date { font-size: 14px; color: #333; margin-right: 40px; }
        .delete-icon { position: absolute; top: 25px; right: 25px; cursor: pointer; font-size: 18px; color: #333; transition: 0.2s; }
        .delete-icon:hover { color: #d93025; }
        .feedback-text { font-size: 15px; color: #1a1a1a; margin-bottom: 15px; line-height: 1.6; }
        .stars { color: #ffc107; font-size: 18px; }

        /* ─── DELETE FEEDBACK MODAL ─── */
        .modal-delete .modal-content { border-radius: 12px; border: none; padding: 20px; }
        .modal-delete .modal-header { border: none; }
        .modal-delete .modal-title { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 22px; }
        .btn-cancel-outline { background: white; color: #000; border: 1px solid #ccc; padding: 10px 35px; border-radius: 10px; font-weight: 600; }
        .btn-delete-solid { background: #d93025; color: white; border: none; padding: 10px 35px; border-radius: 10px; font-weight: 600; }
        .btn-close-custom { background: none; border: none; font-size: 24px; }

        /* ─── LOGOUT MODAL — matched exactly to dashboard ─── */
        .modal-content { border-radius: 25px; border: none; padding: 20px; }
        .modal-footer  { border: none; justify-content: center; gap: 15px; }
        .btn-confirm   { background: #dc3545; color: white; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }
        .btn-cancel    { background: #eee; color: #333; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }

        /* ══════════════════════════════════════
           RESPONSIVE — TABLET (≤ 1100px)
        ══════════════════════════════════════ */
        @media (max-width: 1100px) {
            .sidebar { width: 260px; }
            .content-area { padding: 30px 36px; }
            .top-bar { padding: 0 30px; }
            .admin-profile-dropdown { right: 30px; }
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
                padding: 20px 14px;
                flex-grow: unset;
                overflow-y: visible;
            }

            /* Feedback cards */
            .feedback-card { padding: 20px 16px; margin-bottom: 18px; border-radius: 12px; }

            /* Header row — stack on very small screens */
            .feedback-header {
                flex-wrap: wrap;
                gap: 6px;
                padding-right: 32px; /* room for the trash icon */
            }

            .user-info h5 { font-size: 16px; }
            .service-tag { font-size: 13px; }
            .feedback-date { font-size: 13px; margin-right: 0; }
            .delete-icon { top: 18px; right: 16px; font-size: 16px; }
            .feedback-text { font-size: 14px; }
            .stars { font-size: 16px; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤ 400px)
        ══════════════════════════════════════ */
        @media (max-width: 400px) {
            .top-bar h1 { font-size: 17px; }
            .user-info h5 { font-size: 15px; }
            .feedback-text { font-size: 13px; }
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
                <li><a href="{{ route('admin.feedback') }}" class="nav-item active">
                    <i class="fa-solid fa-comments"></i> Feedback
                </a></li>
            </ul>
        </aside>

        <!-- ══════════════ MAIN CONTAINER ══════════════ -->
        <div class="main-container">

            <header class="top-bar">
                <!-- Hamburger (mobile only) -->
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <h1>Feedback</h1>

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
                @forelse($feedbacks as $item)
                <div class="feedback-card">
                    <div class="feedback-header">
                        <div class="user-info">
                            <h5>{{ $item->full_name }} <span class="service-tag">| {{ $item->service }}</span></h5>
                        </div>
                        <div class="feedback-date">{{ $item->created_at->format('Y-m-d') }}</div>
                        <div class="delete-icon" onclick="openDeleteModal('{{ $item->id }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                    </div>
                    <div class="feedback-text">{{ $item->feedback }}</div>
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= $item->rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                        @endfor
                    </div>
                </div>
                @empty
                <p class="text-center text-muted py-5">No feedback found in the database.</p>
                @endforelse
            </main>
        </div>
    </div>

    <!-- DELETE FEEDBACK MODAL -->
    <div class="modal fade modal-delete" id="deleteFeedbackModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Feedback</h5>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to remove this item?</div>
                <div class="modal-footer" style="border-top: 1px solid #eee; justify-content: flex-end;">
                    <button type="button" class="btn-cancel-outline" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-solid">Delete</button>
                    </form>
                </div>
            </div>
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
        function openDeleteModal(id) {
            document.getElementById('deleteForm').action = '/admin/feedback/' + id;
            new bootstrap.Modal(document.getElementById('deleteFeedbackModal')).show();
        }

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