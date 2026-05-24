<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Bookings - TN Multi Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --custom-grey: #b3b3b3;
            --dark-green: #055e2d;
            --green-soft: #e8f4ee;
            --green-mid: #088a42;
            --status-pending: #ed6c02;
            --status-confirmed: #2e7d32;
            --status-cancelled: #d32f2f;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 0.88rem;
            background-color: #f4f4f4;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, .navbar-brand, .booking-title { font-family: 'Playfair Display', serif; }

        /* ── NAVBAR ── */
        .navbar {
            background-color: #ffffff !important;
            padding: 0.4rem 0;
            backdrop-filter: blur(10px);
        }

        .navbar > .container-fluid {
            padding-left: 0;
            padding-right: 16px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none !important;
            padding: 0;
            margin-left: 0;
        }

        .brand-logo {
            width: 52px;
            height: 52px;
            object-fit: contain;
            flex-shrink: 0;
            display: block;
        }

        .brand-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #000;
            line-height: 1.25;
            white-space: nowrap;
        }

        .nav-link {
            font-size: 0.88rem;
            font-weight: 600;
            color: #000 !important;
            opacity: 0.45;
            transition: opacity 0.3s;
            text-decoration: none !important;
        }
        .nav-link:hover { opacity: 1; }
        .nav-link.active-link { opacity: 1 !important; font-weight: 700; }

        .profile-icon-nav { font-size: 1.8rem; color: #000; cursor: pointer; }
        .dropdown-toggle::after { display: none; }
        .dropdown-menu {
            border-radius: 20px;
            padding: 15px 0;
            border: 1px solid #ddd;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-width: 160px;
            margin-top: 15px !important;
        }
        .dropdown-item { font-weight: 600; padding: 10px 25px; color: #333; font-size: 0.88rem; }
        .dropdown-item.logout { color: #ff4d4d; }

        .navbar-toggler { border: none; padding: 4px 8px; background: transparent; }
        .navbar-toggler:focus { box-shadow: none; outline: none; }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: rgba(179, 179, 179, 0.97);
                padding: 12px 16px 16px;
                border-top: 1px solid rgba(0,0,0,0.1);
                margin-top: 6px;
            }
            .navbar-nav .nav-link { padding: 8px 4px !important; border-bottom: 1px solid rgba(0,0,0,0.08); }
            .navbar-nav .nav-item:last-child .nav-link { border-bottom: none; }
            .d-flex.align-items-center { margin-top: 10px; padding-top: 10px; border-top: 1px solid rgba(0,0,0,0.1); }
        }

        /* ── PAGE WRAPPER ── */
        .page-wrapper {
            padding-top: 100px;
            padding-bottom: 80px;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            text-align: center;
            margin-bottom: 44px;
            padding: 0 20px;
            animation: fadeUp 0.5s ease both;
        }
        .page-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #000;
            margin-bottom: 6px;
        }
        .page-subtitle {
            color: #666;
            font-style: italic;
            font-size: 0.92rem;
        }

        /* ── BOOKINGS WRAPPER ── */
        .bookings-wrapper {
            max-width: 980px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ── MAIN CARD ── */
        .booking-card {
            background: #fff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(0,0,0,0.08);
            border: 1px solid #eaeaea;
            animation: fadeUp 0.55s 0.08s ease both;
        }

        .card-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px 40px 22px;
            border-bottom: 1px solid #f0f0f0;
            background: linear-gradient(to right, #fafaf8, #fff);
        }
        .booking-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #222;
        }
        .count-pill {
            font-size: 0.75rem;
            font-weight: 600;
            background: var(--green-soft);
            color: var(--dark-green);
            padding: 5px 14px;
            border-radius: 50px;
            letter-spacing: 0.04em;
        }

        /* ── TABLE ── */
        .table-responsive { padding: 8px 16px 0; }
        .table {
            --bs-table-bg: transparent;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0 6px;
        }
        .table thead th {
            font-family: 'Poppins', sans-serif;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #aaa;
            border-bottom: none;
            padding: 4px 16px 10px;
            background: transparent;
        }
        .table tbody tr {
            transition: box-shadow 0.2s, transform 0.18s;
        }
        .table tbody tr:hover {
            box-shadow: 0 4px 18px rgba(5,94,45,0.08);
            transform: translateY(-1px);
        }
        .table tbody td {
            padding: 16px 16px;
            font-size: 0.9rem;
            vertical-align: middle;
            color: #444;
            background: #fff;
            border-top: 1px solid #f0f0f0;
            border-bottom: none;
        }
        .table tbody td:first-child {
            border-left: 1px solid #f0f0f0;
            border-radius: 14px 0 0 14px;
            padding-left: 20px;
        }
        .table tbody td:last-child {
            border-right: 1px solid #f0f0f0;
            border-radius: 0 14px 14px 0;
            padding-right: 20px;
        }

        /* ── SERVICE CELL ── */
        .service-info { display: flex; align-items: center; gap: 12px; }
        .service-icon {
            width: 38px; height: 38px;
            border-radius: 11px;
            background: var(--green-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .service-icon i { color: var(--dark-green); font-size: 0.88rem; }
        .service-name { font-weight: 600; color: #222; font-size: 0.92rem; }
        .service-type { font-size: 0.78rem; color: #999; text-transform: capitalize; margin-top: 2px; }

        /* ── DATE CELL ── */
        .booking-date { font-weight: 600; color: #222; font-size: 0.88rem; }
        .booking-time { font-size: 0.8rem; color: #999; margin-top: 3px; }

        /* ── STATUS BADGES ── */
        .status-badge {
            padding: 5px 13px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            letter-spacing: 0.02em;
        }
        .status-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
        .status-pending  { background: #fff4e5; color: #a05a00; }
        .status-pending  .status-dot { background: #ed6c02; }
        .status-confirmed { background: #eaf5ee; color: #1a5c2a; }
        .status-confirmed .status-dot { background: #2e7d32; }
        .status-cancelled { background: #fdecea; color: #9b1c1c; }
        .status-cancelled .status-dot { background: #d32f2f; }

        /* ── ACTION BUTTONS ── */
        .action-btns {
            display: flex;
            align-items: center;
            gap: 6px;
            justify-content: flex-start;
            min-width: 160px;
        }

        .view-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            border: 1.5px solid #e2d9f3;
            background: #f5f0ff;
            color: #6b21a8;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .view-btn:hover {
            background: #ede9fe;
            border-color: #6b21a8;
            color: #6b21a8;
            box-shadow: 0 3px 12px rgba(107,33,168,0.15);
            transform: translateY(-1px);
        }
        .view-btn:active { transform: translateY(0); }

        .edit-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            border: 1.5px solid #c3d9ff;
            background: #f0f6ff;
            color: #1a56db;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .edit-btn:hover {
            background: #dbeafe;
            border-color: #1a56db;
            color: #1a56db;
            box-shadow: 0 3px 12px rgba(26,86,219,0.15);
            transform: translateY(-1px);
        }
        .edit-btn:active { transform: translateY(0); }

        .cancel-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            border: 1.5px solid #ffd0d0;
            background: #fff5f5;
            color: #c0392b;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .cancel-btn:hover {
            background: #ffe5e5;
            border-color: #c0392b;
            box-shadow: 0 3px 12px rgba(192,57,43,0.15);
            transform: translateY(-1px);
        }
        .cancel-btn:active { transform: translateY(0); }

        .cancel-btn.disabled,
        .cancel-btn:disabled {
            background: #f5f5f5 !important;
            border-color: #e8e8e8 !important;
            color: #c0c0c0 !important;
            cursor: not-allowed !important;
            opacity: 1 !important;
            transform: none !important;
            pointer-events: none !important;
            box-shadow: none !important;
        }

        .cancelled-text { color: #ccc; font-size: 1rem; font-weight: 500; }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 70px 40px 60px;
        }
        .empty-icon-box {
            width: 76px; height: 76px;
            border-radius: 22px;
            background: var(--green-soft);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
        }
        .empty-icon-box i { font-size: 1.9rem; color: var(--dark-green); opacity: 0.75; }
        .empty-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        .empty-message {
            color: #666;
            font-size: 0.95rem;
            max-width: 350px;
            margin: 0 auto 26px;
            line-height: 1.7;
        }
        .btn-explore {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--dark-green);
            color: #fff;
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: background 0.25s, box-shadow 0.25s, transform 0.2s;
        }
        .btn-explore:hover {
            background-color: #044923;
            color: #fff;
            box-shadow: 0 6px 20px rgba(5,94,45,0.25);
            transform: translateY(-2px);
        }

        /* ── PAGINATION ── */
        .pagination-wrap {
            padding: 16px 40px 8px;
            border-top: 1px solid #f0f0f0;
        }
        .pagination { justify-content: center; margin: 0; }
        .page-item .page-link {
            border: 1px solid #eee;
            color: #333;
            margin: 0 2px;
            border-radius: 8px !important;
            width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .page-item .page-link:hover { border-color: var(--dark-green); color: var(--dark-green); background: var(--green-soft); }
        .page-item.active .page-link { background: var(--dark-green); border-color: var(--dark-green); color: #fff; }
        .page-item.disabled .page-link { color: #ccc; border-color: #eee; }

        /* ── MODALS ── */
        .modal-content {
            border-radius: 24px;
            padding: 10px;
            border: none;
            box-shadow: 0 20px 60px rgba(0,0,0,0.13);
            font-family: 'Poppins', sans-serif;
        }
        .modal-header { padding: 24px 24px 10px; border-bottom: none; }
        .modal-body   { padding: 10px 24px 18px; }
        .modal-footer { padding: 12px 24px 24px; border-top: none; }
        .modal-title  { font-family: 'Playfair Display', serif; font-size: 1.35rem; font-weight: 700; }

        .modal-service-highlight {
            background: var(--green-soft);
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 600;
            color: var(--dark-green);
            font-size: 0.95rem;
            margin-bottom: 14px;
            text-align: center;
        }
        .modal-info-box {
            background: #f0faf4;
            border: 1px solid #c3e6cb;
            border-radius: 12px;
            padding: 11px 14px;
            font-size: 0.82rem;
            color: #1a5c2a;
            margin-bottom: 14px;
        }

        .btn-modal {
            border-radius: 12px;
            padding: 11px 24px;
            border: none;
            font-weight: 600;
            font-size: 0.88rem;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-confirm-cancel { background: #e03535; color: #fff; }
        .btn-confirm-cancel:hover { background: #c0392b; box-shadow: 0 4px 14px rgba(192,57,43,0.3); }
        .btn-cancel-no { background: #f0f0f0; color: #444; }
        .btn-cancel-no:hover { background: #e2e2e2; }
        .btn-back { background: #f0f0f0; color: #444; }
        .btn-back:hover { background: #e2e2e2; }
        .btn-send-cancel { background: #e03535; color: #fff; }
        .btn-send-cancel:hover { background: #c0392b; box-shadow: 0 4px 14px rgba(192,57,43,0.3); }

        .cancel-reason-textarea {
            width: 100%;
            min-height: 100px;
            padding: 13px 15px;
            border: 1.5px solid #e0e0e0;
            border-radius: 14px;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            resize: vertical;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fafafa;
        }
        .cancel-reason-textarea:focus {
            outline: none;
            border-color: var(--dark-green);
            box-shadow: 0 0 0 3px rgba(5,94,45,0.08);
            background: #fff;
        }
        .cancel-reason-textarea::placeholder { color: #bbb; }

        /* ── VIEW BOOKING MODAL ── */
        .view-modal-header {
            background: linear-gradient(135deg, #f0faf4 0%, #e8f4ee 100%);
            border-radius: 16px 16px 0 0;
            padding: 22px 24px 18px;
            border-bottom: 1px solid #d6eedd;
        }
        .view-modal-service-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid #c3e6cb;
            border-radius: 50px;
            padding: 6px 16px;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--dark-green);
            margin-bottom: 6px;
        }
        .view-modal-service-badge i { font-size: 0.85rem; }
        .view-modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #111;
            margin: 0;
        }
        .view-detail-section { margin-bottom: 18px; }
        .view-detail-section-label {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #aaa;
            margin-bottom: 8px;
        }
        .view-detail-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 9px 14px;
            background: #fafafa;
            border-radius: 10px;
            border: 1px solid #f0f0f0;
            margin-bottom: 6px;
        }
        .view-detail-row:last-child { margin-bottom: 0; }
        .view-detail-icon {
            width: 28px; height: 28px;
            border-radius: 8px;
            background: var(--green-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .view-detail-icon i { color: var(--dark-green); font-size: 0.78rem; }
        .view-detail-label { font-size: 0.76rem; color: #999; margin-bottom: 2px; }
        .view-detail-value { font-size: 0.88rem; font-weight: 600; color: #222; }
        .view-status-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: #fafafa;
            border-radius: 10px;
            border: 1px solid #f0f0f0;
        }
        .view-modal-divider {
            border: none;
            border-top: 1px solid #f0f0f0;
            margin: 16px 0;
        }

        /* Toast */
        .toast-container { z-index: 9999; }
        .spinner-sm { width: 1rem; height: 1rem; border-width: 0.15em; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .card-topbar { padding: 20px 22px 16px; flex-wrap: wrap; gap: 10px; }
            .table-responsive { padding: 4px 6px 0; }
            .table thead { display: none; }
            .table tbody tr { display: block; margin-bottom: 12px; }
            .table tbody td {
                display: block;
                text-align: center;
                padding: 10px 16px;
                border: none !important;
                border-bottom: 1px solid #f5f5f5 !important;
                border-radius: 0 !important;
            }
            .table tbody td:first-child  { border-radius: 14px 14px 0 0 !important; border-left: 1px solid #f0f0f0 !important; }
            .table tbody td:last-child   { border-radius: 0 0 14px 14px !important; border-right: 1px solid #f0f0f0 !important; border-bottom: none !important; }
            .service-info { justify-content: center; }
            .action-btns { justify-content: center; min-width: unset; flex-wrap: wrap; }
            .pagination-wrap { padding: 14px 16px 8px; }
            .page-title { font-size: 1.9rem; }
            .bookings-wrapper { padding: 0 14px; }
        }

        @media (max-width: 575.98px) {
            .page-wrapper { padding-top: 85px; }
            .action-btns { gap: 4px; }
            .view-btn, .edit-btn, .cancel-btn {
                padding: 6px 10px;
                font-size: 0.78rem;
            }
        }

        html { scroll-behavior: smooth; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top border-bottom">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ url('/home') }}">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="TN Logo"
                    class="brand-logo"
                    width="52"
                    height="52"
                >
                <span class="brand-text">TN Multi Services</span>
            </a>

            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="{{ url('/home') }}">HOME</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('restaurant') }}">RESTAURANT</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('lodging') }}">LODGING</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('spa') }}">SPA</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('contact') }}">CONTACT</a></li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active-link px-3" href="{{ route('my.bookings') }}">YOUR BOOKING</a>
                        </li>
                    @endauth
                </ul>

                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a class="dropdown-toggle nav-link px-3" href="#" role="button" data-bs-toggle="dropdown" style="opacity:1;">
                            <i class="fa-solid fa-circle-user profile-icon-nav"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="{{ route('custom.profile.show') }}">Profile Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item logout" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <div class="page-wrapper">

        <!-- HEADER -->
        <div class="container page-header">
            <h1 class="page-title">My Bookings</h1>
            <p class="page-subtitle">View and manage your reservations</p>
        </div>

        <!-- BOOKINGS -->
        <div class="bookings-wrapper">
            <div class="booking-card">

                <!-- Top bar -->
                <div class="card-topbar">
                    <h3 class="booking-title">Your Reservations</h3>
                    @if(isset($bookings) && $bookings->count() > 0)
                        <span class="count-pill">{{ $bookings->total() }} {{ $bookings->total() === 1 ? 'booking' : 'bookings' }}</span>
                    @endif
                </div>

                @if(isset($bookings) && $bookings->count() > 0)
                    <div class="table-responsive" style="padding-top:12px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Date &amp; Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    @php
                                        $serviceType = strtolower($booking->service_type);
                                        $status = strtolower($booking->status ?? 'pending');

                                        $bookingDateTime = null;
                                        if ($booking->booking_date) {
                                            $dt = \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d');
                                            if ($booking->booking_time) $dt .= ' ' . $booking->booking_time;
                                            try { $bookingDateTime = \Carbon\Carbon::parse($dt); } catch (\Exception $e) {}
                                        }

                                        $canCancel = false;
                                        if (in_array($status, ['pending', 'confirmed']) && $bookingDateTime) {
                                            $now = now();
                                            if ($serviceType === 'table' || $serviceType === 'restaurant') {
                                                $canCancel = $now->lessThan($bookingDateTime->copy()->subMinutes(20));
                                            } elseif (in_array($serviceType, ['spa', 'lodging'])) {
                                                $canCancel = $now->lessThan($bookingDateTime->copy()->subHours(3));
                                            } else {
                                                $canCancel = true;
                                            }
                                        } elseif (in_array($status, ['pending', 'confirmed'])) {
                                            $canCancel = true;
                                        }

                                        $canEdit = false;
                                        if ($status === 'pending' && $bookingDateTime) {
                                            $now = now();
                                            if (in_array($serviceType, ['table', 'restaurant'])) {
                                                $canEdit = $now->lessThan($bookingDateTime->copy()->subMinutes(30));
                                            } else {
                                                $canEdit = $now->lessThan($bookingDateTime->copy()->subHours(3));
                                            }
                                        } elseif ($status === 'pending') {
                                            $canEdit = true;
                                        }

                                        $icon = 'fa-concierge-bell';
                                        if (in_array($serviceType, ['table','restaurant'])) $icon = 'fa-utensils';
                                        elseif ($serviceType === 'spa') $icon = 'fa-spa';
                                        elseif ($serviceType === 'lodging') $icon = 'fa-bed';

                                        $viewData = [
                                            'id'             => $booking->id,
                                            'service_name'   => $booking->service_name,
                                            'service_type'   => $booking->service_type,
                                            'status'         => $booking->status ?? 'pending',
                                            'booking_date'   => $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') : null,
                                            'booking_time'   => $booking->booking_time ? \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') : null,
                                            'check_out_date' => $booking->check_out_date ? \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') : null,
                                            'guests'         => $booking->guests ?? $booking->number_of_guests ?? null,
                                            'table_no'       => $booking->table_no ?? $booking->table_number ?? null,
                                            'room_type'      => $booking->room_type ?? null,
                                            'spa_type'       => $booking->spa_type ?? $booking->treatment_type ?? null,
                                            'menu_items'     => $booking->order_items ?? null,
                                            'special_request'=> $booking->special_request ?? $booking->notes ?? null,
                                            'icon'           => $icon,
                                        ];
                                    @endphp
                                    <tr id="booking-row-{{ $booking->id }}">
                                        <td>
                                            <div class="service-info">
                                                <div class="service-icon">
                                                    <i class="fa-solid {{ $icon }}"></i>
                                                </div>
                                                <div>
                                                    <div class="service-name">{{ $booking->service_name }}</div>
                                                    <div class="service-type">{{ ucfirst($booking->service_type) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="booking-date">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                                            @if($booking->booking_time)
                                                <div class="booking-time">{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</div>
                                            @endif
                                            @if($booking->check_out_date)
                                                <div class="booking-time" style="margin-top:4px;">
                                                    <small>Check-out: {{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d') }}</small>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $status }}">
                                                <span class="status-dot"></span>
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>

                                        <td id="action-cell-{{ $booking->id }}">

                                            @if($status === 'cancelled')
                                                <div class="action-btns">
                                                    <button class="view-btn"
                                                            onclick='openViewModal(@json($viewData))'>
                                                        <i class="fa-solid fa-eye"></i> View
                                                    </button>
                                                </div>

                                            @elseif($status === 'pending')
                                                <div class="action-btns">
                                                    <button class="view-btn"
                                                            onclick='openViewModal(@json($viewData))'>
                                                        <i class="fa-solid fa-eye"></i> View
                                                    </button>

                                                    @if($canEdit)
                                                        <a href="{{ route('booking.edit', $booking->id) }}" class="edit-btn">
                                                            <i class="fa-solid fa-pen"></i> Edit
                                                        </a>
                                                    @endif

                                                    @if($canCancel)
                                                        <button class="cancel-btn"
                                                                onclick="openCancelModal({{ $booking->id }}, '{{ addslashes($booking->service_name) }}', '{{ $status }}')">
                                                            <i class="fa-solid fa-xmark"></i> Cancel
                                                        </button>
                                                    @else
                                                        <button class="cancel-btn disabled" disabled
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Cancellation closed: {{ in_array($serviceType, ['table','restaurant']) ? '20 min' : '3 hr' }} before scheduled time">
                                                            <i class="fa-solid fa-lock"></i> Closed
                                                        </button>
                                                    @endif
                                                </div>

                                            @elseif($status === 'confirmed')
                                                <div class="action-btns">
                                                    <button class="view-btn"
                                                            onclick='openViewModal(@json($viewData))'>
                                                        <i class="fa-solid fa-eye"></i> View
                                                    </button>

                                                    @if($canCancel)
                                                        <button class="cancel-btn"
                                                                onclick="openCancelModal({{ $booking->id }}, '{{ addslashes($booking->service_name) }}', '{{ $status }}')">
                                                            <i class="fa-solid fa-xmark"></i> Cancel
                                                        </button>
                                                    @else
                                                        <button class="cancel-btn disabled" disabled
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Cancellation closed: {{ in_array($serviceType, ['table','restaurant']) ? '20 min' : '3 hr' }} before scheduled time">
                                                            <i class="fa-solid fa-lock"></i> Closed
                                                        </button>
                                                    @endif
                                                </div>

                                            @else
                                                <div class="action-btns">
                                                    <button class="view-btn"
                                                            onclick='openViewModal(@json($viewData))'>
                                                        <i class="fa-solid fa-eye"></i> View
                                                    </button>
                                                </div>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($bookings->hasPages())
                        <div class="pagination-wrap">
                            {{ $bookings->links('pagination::bootstrap-5') }}
                        </div>
                    @endif

                @else
                    <div class="empty-state">
                        <div class="empty-icon-box">
                            <i class="fa-regular fa-calendar-xmark"></i>
                        </div>
                        <h4 class="empty-title">No Bookings Yet</h4>
                        <p class="empty-message">No booking is made yet. Please have a first booking for your experience.</p>
                        <a href="{{ route('spa') }}" class="btn-explore">Explore Services</a>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- ══ LOGOUT MODAL (copied from home page) ══ -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center shadow-lg" style="border-radius: 26px; padding: 26px;">
                <h2 class="mb-2">Log Out</h2>
                <p class="text-muted mb-4">Are you sure you want to log out?</p>
                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-pill px-4 text-white">Yes, Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW BOOKING MODAL -->
    <div class="modal fade" id="viewBookingModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 460px;">
            <div class="modal-content" style="padding: 0; overflow: hidden;">

                <div class="view-modal-header">
                    <div class="view-modal-service-badge" id="view-service-badge">
                        <i class="fa-solid fa-concierge-bell"></i>
                        <span id="view-service-type-label">Service</span>
                    </div>
                    <h5 class="view-modal-title" id="view-service-name">Booking Details</h5>
                </div>

                <div class="modal-body" style="padding: 20px 24px 24px;">

                    <div class="view-detail-section" id="view-section-datetime">
                        <div class="view-detail-section-label">Schedule</div>
                        <div class="view-detail-row" id="view-row-date" style="display:none;">
                            <div class="view-detail-icon"><i class="fa-solid fa-calendar"></i></div>
                            <div>
                                <div class="view-detail-label">Date</div>
                                <div class="view-detail-value" id="view-date">—</div>
                            </div>
                        </div>
                        <div class="view-detail-row" id="view-row-time" style="display:none;">
                            <div class="view-detail-icon"><i class="fa-solid fa-clock"></i></div>
                            <div>
                                <div class="view-detail-label">Time</div>
                                <div class="view-detail-value" id="view-time">—</div>
                            </div>
                        </div>
                        <div class="view-detail-row" id="view-row-checkout" style="display:none;">
                            <div class="view-detail-icon"><i class="fa-solid fa-calendar-check"></i></div>
                            <div>
                                <div class="view-detail-label">Check-out Date</div>
                                <div class="view-detail-value" id="view-checkout">—</div>
                            </div>
                        </div>
                    </div>

                    <div class="view-detail-section" id="view-section-details">
                        <div class="view-detail-section-label" id="view-details-label">Details</div>

                        <div class="view-detail-row" id="view-row-table" style="display:none;">
                            <div class="view-detail-icon"><i class="fa-solid fa-chair"></i></div>
                            <div>
                                <div class="view-detail-label">Table Number</div>
                                <div class="view-detail-value" id="view-table-no">—</div>
                            </div>
                        </div>

                        <div class="view-detail-row" id="view-row-room" style="display:none;">
                            <div class="view-detail-icon"><i class="fa-solid fa-bed"></i></div>
                            <div>
                                <div class="view-detail-label">Room Type</div>
                                <div class="view-detail-value" id="view-room-type">—</div>
                            </div>
                        </div>

                        <div class="view-detail-row" id="view-row-spa" style="display:none;">
                            <div class="view-detail-icon"><i class="fa-solid fa-spa"></i></div>
                            <div>
                                <div class="view-detail-label">Treatment / Spa Type</div>
                                <div class="view-detail-value" id="view-spa-type">—</div>
                            </div>
                        </div>

                        <div id="view-row-menus" style="display:none;">
                            <div class="view-detail-row" style="align-items: flex-start;">
                                <div class="view-detail-icon" style="margin-top:2px;"><i class="fa-solid fa-utensils"></i></div>
                                <div style="flex:1;">
                                    <div class="view-detail-label">Menu / Items</div>
                                    <div id="view-menu-items" style="font-size:0.88rem; font-weight:600; color:#222; line-height:1.6;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="view-detail-row" id="view-row-guests" style="display:none;">
                            <div class="view-detail-icon"><i class="fa-solid fa-users"></i></div>
                            <div>
                                <div class="view-detail-label">Guests</div>
                                <div class="view-detail-value" id="view-guests">—</div>
                            </div>
                        </div>

                        <div class="view-detail-row" id="view-row-special" style="display:none;" style="align-items:flex-start;">
                            <div class="view-detail-icon" style="margin-top:2px;"><i class="fa-solid fa-comment-dots"></i></div>
                            <div>
                                <div class="view-detail-label">Special Request</div>
                                <div class="view-detail-value" id="view-special" style="font-weight:400; color:#555; font-size:0.85rem; line-height:1.5;">—</div>
                            </div>
                        </div>
                    </div>

                    <hr class="view-modal-divider">
                    <div class="view-status-row">
                        <span style="font-size:0.8rem; color:#999; font-weight:500;">Booking Status</span>
                        <span class="status-badge" id="view-status-badge">
                            <span class="status-dot"></span>
                            <span id="view-status-text">Pending</span>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- CANCEL CONFIRMATION MODAL -->
    <div class="modal fade" id="cancelModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-triangle-exclamation text-warning me-2"></i>Cancel Booking
                    </h5>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-3" style="font-size:0.88rem;">Are you sure you want to cancel your booking for:</p>
                    <div class="modal-service-highlight" id="cancel-service-name">Service Name</div>

                    <div class="modal-info-box" id="cancel-notice">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        <span id="cancel-policy-text"></span>
                    </div>

                    <p class="text-muted" style="font-size:0.8rem;">This action cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center gap-3">
                    <button type="button" class="btn-modal btn-cancel-no rounded-pill px-4" data-bs-dismiss="modal">No, Keep It</button>
                    <button type="button" class="btn-modal btn-confirm-cancel rounded-pill px-4" id="confirm-cancel-btn">
                        <span id="cancel-btn-text">Yes, Cancel Booking</span>
                        <span class="spinner-border spinner-sm ms-2 d-none" id="cancel-spinner" role="status"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- CANCELLATION REASON MODAL -->
    <div class="modal fade" id="cancelReasonModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center" style="position:relative;">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-pen-to-square text-danger me-2"></i>Add Cancellation Reason
                    </h5>
                    <button type="button" class="btn-close" style="position:absolute;right:8px;" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-3" style="font-size:0.87rem;">Write a short message to explain the cancellation. This will be sent to the admin via email.</p>

                    <div class="modal-info-box mb-3" id="reason-notice">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        Service: <strong id="reason-service-name"></strong>
                    </div>

                    <textarea class="cancel-reason-textarea" id="cancel-reason-input"
                        placeholder="e.g., Sorry, the table is already booked. You can try rescheduling for tomorrow evening."></textarea>

                    <div class="text-danger small mt-2 d-none" id="reason-error">
                        <i class="fa-solid fa-circle-exclamation me-1"></i>Please provide a cancellation reason.
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn-modal btn-back" onclick="backToCancelModal()">Back</button>
                    <button type="button" class="btn-modal btn-send-cancel" id="submit-cancel-reason">
                        <span>Send &amp; Cancel</span>
                        <span class="spinner-border spinner-sm ms-2 d-none" id="reason-spinner" role="status"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto" id="toast-title">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body" id="toast-message"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentBookingId = null;
        let currentBookingStatus = null;
        let currentServiceName = '';
        const cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
        const cancelReasonModal = new bootstrap.Modal(document.getElementById('cancelReasonModal'));
        const viewBookingModal = new bootstrap.Modal(document.getElementById('viewBookingModal'));
        const toastEl = document.getElementById('liveToast');
        const toast = new bootstrap.Toast(toastEl);

        function openViewModal(data) {
            const type = (data.service_type || '').toLowerCase();
            const isRestaurant = (type === 'table' || type === 'restaurant');

            const iconMap = {
                table: 'fa-utensils', restaurant: 'fa-utensils',
                spa: 'fa-spa',
                lodging: 'fa-bed'
            };
            const iconClass = iconMap[type] || 'fa-concierge-bell';
            const badgeEl = document.getElementById('view-service-badge');
            badgeEl.querySelector('i').className = 'fa-solid ' + iconClass;
            document.getElementById('view-service-type-label').textContent = ucFirst(data.service_type || 'Service');
            document.getElementById('view-service-name').textContent = data.service_name || 'Booking Details';

            show('view-row-date', data.booking_date);
            document.getElementById('view-date').textContent = data.booking_date || '—';

            show('view-row-time', data.booking_time);
            document.getElementById('view-time').textContent = data.booking_time || '—';

            show('view-row-checkout', data.check_out_date);
            document.getElementById('view-checkout').textContent = data.check_out_date || '—';

            show('view-row-table', isRestaurant && data.table_no);
            document.getElementById('view-table-no').textContent = data.table_no || '—';

            show('view-row-room', type === 'lodging' && data.room_type);
            document.getElementById('view-room-type').textContent = data.room_type || '—';

            show('view-row-spa', type === 'spa' && data.spa_type);
            document.getElementById('view-spa-type').textContent = data.spa_type || '—';

            const menuEl = document.getElementById('view-row-menus');
            if (isRestaurant && data.menu_items) {
                menuEl.style.display = '';
                let items = data.menu_items;

                if (typeof items === 'string') {
                    try { items = JSON.parse(items); } catch(e) { items = null; }
                }

                const menuContainer = document.getElementById('view-menu-items');

                if (items && typeof items === 'object' && !Array.isArray(items)) {
                    const entries = Object.entries(items);
                    if (entries.length) {
                        menuContainer.innerHTML = entries.map(([name, detail]) => {
                            const qty = detail.qty ?? detail.quantity ?? 1;
                            const price = detail.price ?? null;
                            const priceText = price !== null ? ` &nbsp;<span style="color:#888;font-weight:400;font-size:0.76rem;">Nu.${price} × ${qty}</span>` : ` &nbsp;<span style="color:#888;font-weight:400;font-size:0.76rem;">×${qty}</span>`;
                            return `<div style="display:flex;align-items:center;gap:6px;padding:4px 0;border-bottom:1px solid #f0f0f0;">
                                <span style="display:inline-block;background:#f0faf4;border:1px solid #c3e6cb;border-radius:6px;padding:3px 10px;font-size:0.83rem;color:#1a5c2a;font-weight:600;">${name}</span>${priceText}
                            </div>`;
                        }).join('');
                    } else {
                        menuContainer.textContent = '—';
                    }
                } else if (Array.isArray(items) && items.length) {
                    menuContainer.innerHTML = items.map(item =>
                        `<span style="display:inline-block;background:#f0faf4;border:1px solid #c3e6cb;border-radius:6px;padding:2px 10px;margin:2px 3px 2px 0;font-size:0.82rem;color:#1a5c2a;">${item}</span>`
                    ).join('');
                } else {
                    menuContainer.textContent = typeof items === 'string' ? items : '—';
                }
            } else {
                menuEl.style.display = 'none';
            }

            show('view-row-guests', data.guests);
            document.getElementById('view-guests').textContent = data.guests ? data.guests + ' guest(s)' : '—';

            show('view-row-special', data.special_request);
            document.getElementById('view-special').textContent = data.special_request || '—';

            const detailsLabelMap = {
                table: 'Menu & Guests', restaurant: 'Menu & Guests',
                spa: 'Treatment Details',
                lodging: 'Room Details'
            };
            document.getElementById('view-details-label').textContent = detailsLabelMap[type] || 'Details';

            const st = (data.status || 'pending').toLowerCase();
            const statusBadge = document.getElementById('view-status-badge');
            statusBadge.className = 'status-badge status-' + st;
            document.getElementById('view-status-text').textContent = ucFirst(st);

            viewBookingModal.show();
        }

        function show(elementId, condition) {
            document.getElementById(elementId).style.display = condition ? '' : 'none';
        }

        function ucFirst(str) {
            if (!str) return '';
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        function openCancelModal(bookingId, serviceName, status) {
            currentBookingId = bookingId;
            currentBookingStatus = status;
            currentServiceName = serviceName;

            if (status === 'pending') {
                document.getElementById('cancel-service-name').textContent = serviceName;

                const policyText = document.getElementById('cancel-policy-text');
                const st = serviceName.toLowerCase();

                if (st.includes('table') || st.includes('restaurant') || st.includes('dining')) {
                    policyText.textContent = "Table reservations can be cancelled up to 20 minutes before the scheduled time.";
                } else if (st.includes('spa') || st.includes('lodging') || st.includes('room') || st.includes('stay')) {
                    policyText.textContent = "Spa and lodging bookings can be cancelled up to 3 hours before the scheduled time.";
                } else {
                    policyText.textContent = "Please contact us directly for cancellation policies on this service.";
                }

                const btn = document.getElementById('confirm-cancel-btn');
                btn.disabled = false;
                document.getElementById('cancel-btn-text').classList.remove('d-none');
                document.getElementById('cancel-spinner').classList.add('d-none');

                cancelModal.show();
            } else if (status === 'confirmed') {
                document.getElementById('reason-service-name').textContent = serviceName;
                document.getElementById('cancel-reason-input').value = '';
                document.getElementById('reason-error').classList.add('d-none');

                const btn = document.getElementById('submit-cancel-reason');
                btn.disabled = false;
                document.querySelector('#submit-cancel-reason span:first-child').classList.remove('d-none');
                document.getElementById('reason-spinner').classList.add('d-none');

                cancelReasonModal.show();
            }
        }

        function backToCancelModal() {
            cancelReasonModal.hide();
            document.getElementById('cancel-service-name').textContent = currentServiceName;
            cancelModal.show();
        }

        document.getElementById('confirm-cancel-btn').addEventListener('click', async function() {
            if (!currentBookingId) return;
            await submitCancellation('');
        });

        document.getElementById('submit-cancel-reason').addEventListener('click', async function() {
            const reason = document.getElementById('cancel-reason-input').value.trim();
            if (!reason) {
                document.getElementById('reason-error').classList.remove('d-none');
                return;
            }
            await submitCancellation(reason);
        });

        async function submitCancellation(cancellationMessage) {
            if (!currentBookingId) return;

            const btn = currentBookingStatus === 'confirmed'
                ? document.getElementById('submit-cancel-reason')
                : document.getElementById('confirm-cancel-btn');
            const btnText = btn.querySelector('span:first-child');
            const spinner = btn.querySelector('.spinner-border');

            btn.disabled = true;
            btnText.classList.add('d-none');
            spinner.classList.remove('d-none');

            try {
                const response = await fetch(`/booking/${currentBookingId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ cancellation_message: cancellationMessage })
                });

                const result = await response.json();

                if (result.success) {
                    const statusBadge = document.querySelector(`#booking-row-${currentBookingId} .status-badge`);
                    if (statusBadge) {
                        statusBadge.innerHTML = '<span class="status-dot"></span> Cancelled';
                        statusBadge.className = 'status-badge status-cancelled';
                    }

                    const actionCell = document.getElementById(`action-cell-${currentBookingId}`);
                    if (actionCell) {
                        const viewBtn = actionCell.querySelector('.view-btn');
                        const viewData = viewBtn ? viewBtn.getAttribute('onclick') : null;
                        actionCell.innerHTML = `<div class="action-btns">${viewData ? `<button class="view-btn" onclick="${viewData.replace(/^openViewModal\(/, 'openViewModal(').replace(/\)$/, ')')}" style="pointer-events:auto;"><i class="fa-solid fa-eye"></i> View</button>` : '<span class="cancelled-text">—</span>'}</div>`;
                    }

                    cancelModal.hide();
                    cancelReasonModal.hide();

                    showToast('✓ Success', 'Booking cancelled successfully!');

                    if (currentBookingStatus === 'confirmed') {
                        setTimeout(() => showToast('ℹ️ Note', 'Admin has been notified of your cancellation.'), 1500);
                    }

                } else {
                    showToast('✗ Error', result.message || 'Unable to cancel booking. Please try again.');
                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    spinner.classList.add('d-none');
                }
            } catch (error) {
                console.error('Cancellation error:', error);
                showToast('✗ Error', 'Network error. Please check your connection and try again.');
                btn.disabled = false;
                btnText.classList.remove('d-none');
                spinner.classList.add('d-none');
            }
        }

        function showToast(title, message) {
            document.getElementById('toast-title').textContent = title;
            document.getElementById('toast-message').textContent = message;
            toast.show();
        }

        toastEl.addEventListener('shown.bs.toast', function() {
            setTimeout(() => bootstrap.Toast.getInstance(this)?.hide(), 5000);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>