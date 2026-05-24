<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TN ADMIN - User Management</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-green: #005a2b;
            --bg-light: #f8f9fa;
            --border-line: #e0e0e0;
            --text-black: #000000;
            --top-bar-grey: #f8f9fa;
            --status-red: #d32f2f;
            --status-green: #2e7d32;
            --primary-blue: #0066cc;
            --content-bg: #e9ecef;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; background-color: #fff; }

        .wrapper { display: flex; height: 100vh; width: 100%; overflow: hidden; }

        /* ─── SIDEBAR ─── */
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

        .logo-text-block { display: flex; flex-direction: column; line-height: 1; }

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

        .nav-links { list-style: none; padding: 0 25px; }

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
        .main-container { flex: 1; display: flex; flex-direction: column; height: 100vh; overflow: hidden; min-width: 0; }

        /* ─── TOP BAR ─── */
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
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-color: var(--content-bg);
            padding: 30px 60px 0;
        }

        /* TABLE CARD */
        .table-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            flex: 1;
            margin-bottom: 30px;
        }

        /* STICKY THEAD */
        .table-head-wrap {
            flex-shrink: 0;
            background: white;
            border-radius: 25px 25px 0 0;
        }
        .table-head-wrap table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .table-head-wrap th {
            padding: 20px 20px 18px;
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            color: #000;
            border-bottom: 2px solid #000;
            background: white;
            text-align: left;
        }

        /* SCROLLABLE TBODY */
        .table-body-wrap {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #ccc transparent;
        }
        .table-body-wrap::-webkit-scrollbar { width: 6px; }
        .table-body-wrap::-webkit-scrollbar-track { background: transparent; }
        .table-body-wrap::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }

        .table-body-wrap table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .table-body-wrap td {
            padding: 20px;
            background: #fff;
            vertical-align: middle;
            border-bottom: 1px solid #f1f1f1;
            font-size: 16px;
        }
        .table-body-wrap tbody tr:last-child td { border-bottom: none; }

        /* Column widths */
        .col-user   { width: 28%; }
        .col-phone  { width: 17%; }
        .col-role   { width: 12%; }
        .col-status { width: 13%; }
        .col-joined { width: 16%; }
        .col-action { width: 14%; }

        .badge-status { padding: 6px 16px; border-radius: 50px; font-size: 13px; font-weight: 700; text-transform: uppercase; }
        .status-active-badge  { background-color: #e8f5e9; color: var(--status-green); }
        .status-blocked-badge { background-color: #ffebee; color: var(--status-red); }

        .eye-btn { background: #f1f3f5; border: none; width: 45px; height: 45px; border-radius: 12px; color: #333; transition: 0.3s; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; font-size: 20px; }
        .eye-btn:hover { background: var(--primary-green); color: white; }

        /* ── USER DETAIL MODAL ── */
        .modal-overlay { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; backdrop-filter: blur(5px); }
        .modal-card { background: white; width: 680px; max-width: 95vw; border-radius: 35px; padding: 50px; position: relative; box-shadow: 0 30px 60px rgba(0,0,0,0.2); }
        .close-icon { position: absolute; top: 30px; right: 35px; font-size: 24px; cursor: pointer; color: #999; }
        .modal-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 35px; margin-top: 45px; text-align: left; }
        .modal-item label { font-size: 14px; font-weight: 800; color: #999; text-transform: uppercase; display: block; margin-bottom: 5px; }
        .modal-item p { font-size: 18px; font-weight: 600; color: #111; }

        .btn-role-action { border: none; padding: 14px 25px; border-radius: 50px; font-weight: 700; transition: 0.3s; display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .btn-promote-style { background-color: #e3f2fd; color: var(--primary-blue); }
        .btn-promote-style:hover { background-color: var(--primary-blue); color: white; }
        .btn-rollback-style { background-color: #f5f5f5; color: #666; border: 1.5px solid #ddd; }
        .btn-rollback-style:hover { background-color: #666; color: white; }

        .btn-block-action { color: white; border: none; padding: 14px 40px; border-radius: 50px; font-weight: 700; display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .btn-red   { background-color: var(--status-red); }
        .btn-green { background-color: var(--status-green); }

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
            .content-area { padding: 20px 24px 0; }
            .top-bar { padding: 0 30px; }
            .admin-profile-dropdown { right: 30px; }
            .table-head-wrap th { font-size: 15px; padding: 16px 14px 14px; }
            .table-body-wrap td { padding: 14px; font-size: 14px; }
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

            /* Content */
            .content-area {
                padding: 16px 12px 0;
                flex: unset;
                overflow: visible;
            }

            /* Table card — remove fixed height so it grows naturally */
            .table-card {
                flex: unset;
                height: auto;
                margin-bottom: 20px;
                border-radius: 18px;
                overflow: visible;
            }

            /* Replace sticky header / scrollable body with simple layout */
            .table-head-wrap,
            .table-body-wrap {
                overflow: visible;
                flex: unset;
            }

            /* Hide less important columns on mobile */
            .col-phone,
            .col-joined,
            .table-head-wrap th.col-phone,
            .table-head-wrap th.col-joined,
            .table-body-wrap td.col-phone,
            .table-body-wrap td.col-joined { display: none; }

            .col-user   { width: 44%; }
            .col-role   { width: 16%; }
            .col-status { width: 22%; }
            .col-action { width: 18%; }

            .table-head-wrap th { font-size: 13px; padding: 14px 10px 12px; }
            .table-body-wrap td { padding: 12px 10px; font-size: 13px; }

            .badge-status { padding: 4px 10px; font-size: 11px; }
            .eye-btn { width: 36px; height: 36px; font-size: 16px; border-radius: 10px; }

            /* User detail modal */
            .modal-card {
                padding: 28px 20px;
                border-radius: 22px;
                width: 95vw;
            }
            .modal-info-grid { grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 28px; }
            .modal-item p { font-size: 15px; }
            .btn-role-action { padding: 11px 16px; font-size: 13px; border-radius: 40px; }
            .btn-block-action { padding: 11px 20px; font-size: 13px; border-radius: 40px; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤ 400px)
        ══════════════════════════════════════ */
        @media (max-width: 400px) {
            .top-bar h1 { font-size: 17px; }
            .col-role { display: none; }
            .table-head-wrap th.col-role,
            .table-body-wrap td.col-role { display: none; }
            .col-user   { width: 55%; }
            .col-status { width: 28%; }
            .col-action { width: 17%; }
            .modal-info-grid { grid-template-columns: 1fr; gap: 16px; }
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
            <li><a href="{{ route('admin.users') }}" class="nav-item active">
                <i class="fa-solid fa-circle-user"></i> Users
            </a></li>
            <li><a href="{{ route('admin.feedback') }}" class="nav-item">
                <i class="fa-solid fa-comments"></i> Feedback
            </a></li>
        </ul>
    </aside>

    <!-- ══════════════ MAIN ══════════════ -->
    <div class="main-container">

        <!-- TOP BAR -->
        <header class="top-bar">
            <!-- Hamburger (mobile only) -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <h1>User Management</h1>

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

        <!-- CONTENT -->
        <main class="content-area">
            <div class="table-card">

                <!-- STICKY HEADER -->
                <div class="table-head-wrap">
                    <table>
                        <colgroup>
                            <col class="col-user">
                            <col class="col-phone">
                            <col class="col-role">
                            <col class="col-status">
                            <col class="col-joined">
                            <col class="col-action">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="col-user">User</th>
                                <th class="col-phone">Phone</th>
                                <th class="col-role">Role</th>
                                <th class="col-status">Status</th>
                                <th class="col-joined">Joined</th>
                                <th class="col-action text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- SCROLLABLE ROWS -->
                <div class="table-body-wrap">
                    <table>
                        <colgroup>
                            <col class="col-user">
                            <col class="col-phone">
                            <col class="col-role">
                            <col class="col-status">
                            <col class="col-joined">
                            <col class="col-action">
                        </colgroup>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="col-user">
                                    <b>{{ $user->first_name }} {{ $user->last_name }}</b><br>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </td>
                                <td class="col-phone">{{ $user->phone }}</td>
                                <td class="col-role">{{ $user->usertype == '1' ? 'Admin' : 'User' }}</td>
                                <td class="col-status">
                                    <span class="badge-status {{ $user->status == 'Active' ? 'status-active-badge' : 'status-blocked-badge' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                <td class="col-joined">{{ $user->created_at->format('Y-m-d') }}</td>
                                <td class="col-action text-center">
                                    <button class="eye-btn"
                                        onclick="openUserModal(
                                            '{{ $user->id }}',
                                            '{{ $user->first_name }} {{ $user->last_name }}',
                                            '{{ $user->email }}',
                                            '{{ $user->phone }}',
                                            '{{ $user->usertype == '1' ? 'Admin' : 'User' }}',
                                            '{{ $user->status }}',
                                            '{{ $user->created_at->format('Y-m-d') }}'
                                        )">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div><!-- end .table-card -->
        </main>
    </div>
</div>


<!-- USER DETAIL MODAL -->
<div id="userModal" class="modal-overlay">
    <div class="modal-card">
        <span class="close-icon" onclick="closeModal()">&times;</span>
        <h2 id="m-name" style="font-family:'Playfair Display'; font-weight:800;"></h2>
        <p id="m-email" class="text-muted"></p>
        <div class="modal-info-grid">
            <div class="modal-item"><label>Phone</label><p id="m-phone"></p></div>
            <div class="modal-item"><label>Role</label><p id="m-role"></p></div>
            <div class="modal-item"><label>Status</label><p id="m-status"></p></div>
            <div class="modal-item"><label>Joined Date</label><p id="m-joined"></p></div>
        </div>
        <div class="d-flex justify-content-end gap-3 mt-5 flex-wrap">
            <form id="promoteForm" method="POST">
                @csrf
                <button type="submit" id="roleBtn" class="btn-role-action">
                    <i id="roleIcon"></i> <span id="roleText"></span>
                </button>
            </form>
            <form id="blockForm" method="POST">
                @csrf
                <button type="submit" id="blockActionBtn" class="btn-block-action">
                    <i id="blockIcon"></i> <span id="blockText"></span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ══════════════ LOGOUT MODAL ══════════════ -->
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
    function openUserModal(id, name, email, phone, role, status, joined) {
        document.getElementById('m-name').innerText   = name;
        document.getElementById('m-email').innerText  = email;
        document.getElementById('m-phone').innerText  = phone;
        document.getElementById('m-role').innerText   = role;
        document.getElementById('m-status').innerText = status;
        document.getElementById('m-joined').innerText = joined;

        document.getElementById('promoteForm').action = `/admin/users/${id}/promote`;
        document.getElementById('blockForm').action   = `/admin/users/${id}/toggle-status`;

        // Role button
        const roleBtn  = document.getElementById('roleBtn');
        const roleIcon = document.getElementById('roleIcon');
        const roleText = document.getElementById('roleText');
        if (role === 'Admin') {
            roleBtn.className  = 'btn-role-action btn-rollback-style';
            roleText.innerText = 'Rollback to User';
            roleIcon.className = 'fa-solid fa-user-minus';
        } else {
            roleBtn.className  = 'btn-role-action btn-promote-style';
            roleText.innerText = 'Promote to Admin';
            roleIcon.className = 'fa-solid fa-user-shield';
        }

        // Block / Unblock button
        const blockBtn = document.getElementById('blockActionBtn');
        blockBtn.className = 'btn-block-action ' + (status === 'Active' ? 'btn-red' : 'btn-green');
        document.getElementById('blockText').innerText = status === 'Active' ? 'Block User' : 'Unblock User';
        document.getElementById('blockIcon').className = status === 'Active' ? 'fa-solid fa-user-slash' : 'fa-solid fa-user-check';

        document.getElementById('userModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('userModal').style.display = 'none';
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