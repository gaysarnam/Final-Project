<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TN ADMIN - Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Premium Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>

    <style>
        :root {
            --primary-green: #005a2b;
            --bg-light: #ffffff;
            --card-bg: #f5f6f7;
            --border-line: #e0e0e0;
            --text-black: #000000;
            --top-bar-grey: #f8f9fa;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body, html { height: 100%; overflow: hidden; }

        .wrapper { display: flex; height: 100vh; width: 100%; }

        /* ─── SIDEBAR — original sizing ─── */
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

        /* ─── NAV — original ─── */
        .nav-links { list-style: none; padding: 0 25px; flex-grow: 1; }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 14px 25px;
            margin-bottom: 15px;
            cursor: pointer;
            border-radius: 50px;
            font-weight: 700;
            color: var(--text-black);
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-item i { margin-right: 23px; font-size: 30px; width: 33px; text-align: center; }
        .nav-item:hover { background-color: #f1f3f5; }
        .nav-item.active { background-color: var(--primary-green); color: white !important; }

        /* ─── MAIN CONTAINER ─── */
        .main-container { flex: 1; display: flex; flex-direction: column; height: 100%; min-width: 0; }

        /* ─── TOP BAR — original ─── */
        .top-bar {
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 60px;
            background-color: var(--top-bar-grey);
            border-bottom: 1.5px solid var(--border-line);
            position: relative;
            flex-shrink: 0;
        }

        .top-bar h1 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; margin: 0; }

        /* ─── HAMBURGER BUTTON (mobile only) ─── */
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

        /* ─── SIDEBAR OVERLAY (mobile) ─── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.active { opacity: 1; }

        /* ─── ADMIN PROFILE — original ─── */
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

        /* ─── CONTENT AREA — original ─── */
        .content-area { padding: 60px; flex-grow: 1; overflow-y: auto; }

        /* 2-col × 2-row grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 40px;
            width: 100%;
        }

        /* ─── STAT CARDS — original sizing ─── */
        .stat-card {
            background-color: var(--card-bg);
            border-radius: 20px;
            padding: 80px 40px;
            text-align: center;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            transition: transform 0.35s ease, box-shadow 0.35s ease, background 0.35s ease, border-color 0.35s ease;
            text-decoration: none;
            color: inherit;
            border: 2px solid transparent;
            cursor: pointer;
            overflow: hidden;
        }

        .stat-card:hover { transform: translateY(-8px) scale(1.03); }

        .card-icon-wrap {
            position: absolute;
            top: 28px;
            right: 28px;
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #e8e9ea;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.35s ease, box-shadow 0.35s ease;
        }

        .card-icon { font-size: 22px; color: #555; transition: color 0.35s ease; }

        .stat-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 700;
            transition: color 0.35s ease;
        }

        .stat-card .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 58px;
            font-weight: 700;
            color: var(--primary-green);
            transition: color 0.35s ease;
        }

        /* Bookings → Blue */
        .stat-card.card-bookings:hover {
            background: #eef3ff; border-color: #4f80f7;
            box-shadow: 0 20px 50px rgba(79,128,247,0.25);
        }
        .stat-card.card-bookings:hover .card-icon-wrap { background: #4f80f7; box-shadow: 0 6px 18px rgba(79,128,247,0.45); }
        .stat-card.card-bookings:hover .card-icon      { color: #fff; }
        .stat-card.card-bookings:hover .stat-number    { color: #4f80f7; }

        /* Users → Amber */
        .stat-card.card-users:hover {
            background: #fff8ed; border-color: #f5a623;
            box-shadow: 0 20px 50px rgba(245,166,35,0.25);
        }
        .stat-card.card-users:hover .card-icon-wrap { background: #f5a623; box-shadow: 0 6px 18px rgba(245,166,35,0.45); }
        .stat-card.card-users:hover .card-icon      { color: #fff; }
        .stat-card.card-users:hover .stat-number    { color: #f5a623; }

        /* Feedback → Purple */
        .stat-card.card-feedback:hover {
            background: #f5eeff; border-color: #9b59b6;
            box-shadow: 0 20px 50px rgba(155,89,182,0.25);
        }
        .stat-card.card-feedback:hover .card-icon-wrap { background: #9b59b6; box-shadow: 0 6px 18px rgba(155,89,182,0.45); }
        .stat-card.card-feedback:hover .card-icon      { color: #fff; }
        .stat-card.card-feedback:hover .stat-number    { color: #9b59b6; }

        /* ─── CHART CARD ─── */
        .chart-card {
            background-color: var(--card-bg);
            border-radius: 20px;
            padding: 32px 36px 28px;
            border: 2px solid transparent;
            display: flex;
            flex-direction: column;
            transition: border-color 0.35s ease, box-shadow 0.35s ease;
        }

        .chart-card:hover {
            border-color: var(--primary-green);
            box-shadow: 0 20px 50px rgba(0,90,43,0.12);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 14px;
        }

        .chart-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--text-black);
            margin-bottom: 4px;
        }

        .chart-subtitle { font-size: 12px; color: #aaa; font-weight: 500; }

        /* colour legend */
        .chart-legend {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 600;
            color: #555;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 3px;
            flex-shrink: 0;
        }

        /* year switcher */
        .year-switcher { display: flex; gap: 5px; flex-shrink: 0; }

        .yr-btn {
            font-size: 11.5px;
            font-weight: 700;
            padding: 5px 13px;
            border-radius: 8px;
            border: 1.5px solid #ddd;
            background: #fff;
            color: #888;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.18s;
        }
        .yr-btn:hover  { border-color: #bbb; color: #333; }
        .yr-btn.active { color: #fff; border-color: transparent; }

        .chart-wrap { position: relative; width: 100%; flex-grow: 1; min-height: 190px; }

        /* ─── MODAL — original ─── */
        .modal-content { border-radius: 25px; border: none; padding: 20px; }
        .modal-footer  { border: none; justify-content: center; gap: 15px; }
        .btn-confirm   { background: #dc3545; color: white; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }
        .btn-cancel    { background: #eee; color: #333; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }

        /* ══════════════════════════════════════
           RESPONSIVE — TABLET  (≤ 1024px)
        ══════════════════════════════════════ */
        @media (max-width: 1024px) {
            .sidebar { width: 260px; }
            .content-area { padding: 40px 30px; }
            .top-bar { padding: 0 30px; }
            .admin-profile-dropdown { right: 30px; }
            .dashboard-grid { gap: 24px; }
            .stat-card { padding: 60px 28px; }
            .stat-card h3 { font-size: 20px; }
            .stat-card .stat-number { font-size: 48px; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — MOBILE  (≤ 768px)
        ══════════════════════════════════════ */
        @media (max-width: 768px) {
            body, html { overflow: auto; }

            .wrapper { flex-direction: column; height: auto; min-height: 100vh; }

            /* Sidebar slides in as a drawer */
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 280px;
                transform: translateX(-100%);
                overflow-y: auto;
                padding: 30px 0;
                box-shadow: 4px 0 24px rgba(0,0,0,0.12);
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; pointer-events: none; }
            .sidebar-overlay.active { pointer-events: auto; }

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
            }
            .top-bar h1 { font-size: 20px; }
            .hamburger-btn { display: flex; align-items: center; }
            .admin-profile-dropdown { right: 16px; }
            .admin-profile { padding: 6px 12px 6px 6px; gap: 8px; }
            .admin-profile strong { display: none; } /* hide name on small screens */

            /* Content */
            .content-area { padding: 24px 16px; overflow-y: visible; flex-grow: unset; }

            /* Grid → single column */
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            /* Stat cards */
            .stat-card { padding: 44px 24px 36px; }
            .stat-card h3 { font-size: 18px; margin-bottom: 10px; }
            .stat-card .stat-number { font-size: 52px; }
            .card-icon-wrap { width: 44px; height: 44px; top: 20px; right: 20px; }
            .card-icon { font-size: 18px; }

            /* Chart card */
            .chart-card { padding: 22px 18px 18px; }
            .chart-title { font-size: 17px; }
            .chart-header { flex-wrap: wrap; gap: 10px; }
            .year-switcher { flex-wrap: wrap; }
            .yr-btn { padding: 4px 10px; font-size: 11px; }
            .chart-wrap { min-height: 220px; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — SMALL MOBILE  (≤ 400px)
        ══════════════════════════════════════ */
        @media (max-width: 400px) {
            .stat-card .stat-number { font-size: 44px; }
            .stat-card h3 { font-size: 16px; }
            .top-bar h1 { font-size: 18px; }
        }
    </style>
</head>
<body>

{{-- ══════════════════════════════════════════════════════
     BUILD MONTHLY BOOKING DATA DIRECTLY IN BLADE
     This works even if your controller does NOT pass
     $monthlyBookings — it queries the DB right here.

     Change 'bookings' to your actual table name if different,
     and 'created_at' to the column that records booking date.
══════════════════════════════════════════════════════ --}}
@php
    use Illuminate\Support\Facades\DB;

    // ── 1. Find every year that has at least one booking ──
    $bookingYears = DB::table('bookings')
        ->selectRaw('YEAR(created_at) as yr')
        ->groupBy('yr')
        ->orderBy('yr')
        ->pluck('yr')
        ->map(fn($y) => (int)$y)
        ->toArray();

    // If the DB has no bookings yet, show the current year
    if (empty($bookingYears)) {
        $bookingYears = [(int)date('Y')];
    }

    $currentYear  = (int)date('Y');
    $currentMonth = (int)date('n');   // 1-12

    // ── 2. For each year, build a 12-slot array [jan..dec] ──
    $monthlyBookings = [];

    foreach ($bookingYears as $yr) {
        // Fetch real counts grouped by month
        $rows = DB::table('bookings')
            ->selectRaw('MONTH(created_at) as mo, COUNT(*) as total')
            ->whereYear('created_at', $yr)
            ->groupBy('mo')
            ->pluck('total', 'mo');   // [ '5' => 12, '3' => 4, ... ]

        $counts = [];
        for ($m = 1; $m <= 12; $m++) {
            if ($yr < $currentYear) {
                // Past year — show all 12 months (use 0 if no bookings)
                $counts[] = (int)($rows[$m] ?? 0);
            } elseif ($yr === $currentYear) {
                if ($m <= $currentMonth) {
                    // Current year, month already passed or is now — show real count
                    $counts[] = (int)($rows[$m] ?? 0);
                } else {
                    // Future month in current year — hide (null = not plotted)
                    $counts[] = null;
                }
            } else {
                // Future year — hide everything
                $counts[] = null;
            }
        }

        $monthlyBookings[$yr] = $counts;
    }
@endphp

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
            <li><a href="{{ route('admin.dashboard') }}" class="nav-item active">
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
            <!-- Hamburger (visible on mobile only) -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <h1>Dashboard</h1>

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
            <div class="dashboard-grid">

                <!-- Bookings Card -->
                <a href="{{ route('admin.bookings') }}" class="stat-card card-bookings">
                    <div class="card-icon-wrap">
                        <i class="fa-regular fa-calendar-check card-icon"></i>
                    </div>
                    <h3>Total Bookings</h3>
                    <div class="stat-number" data-target="{{ $totalBookings ?? \App\Models\Booking::count() }}">0</div>
                </a>

                <!-- Users Card -->
                <a href="{{ route('admin.users') }}" class="stat-card card-users">
                    <div class="card-icon-wrap">
                        <i class="fa-regular fa-circle-user card-icon"></i>
                    </div>
                    <h3>Registered Users</h3>
                    <div class="stat-number" data-target="{{ \App\Models\User::where('usertype', 0)->count() }}">0</div>
                </a>

                <!-- Feedback Card -->
                <a href="{{ route('admin.feedback') }}" class="stat-card card-feedback">
                    <div class="card-icon-wrap">
                        <i class="fa-regular fa-comments card-icon"></i>
                    </div>
                    <h3>Total Feedback</h3>
                    <div class="stat-number" data-target="{{ \App\Models\Feedback::count() }}">0</div>
                </a>

                <!-- ══ BOOKING FLOW CHART (row-2 col-2) ══ -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div>
                            <div class="chart-title">Booking Flow</div>
                            <div class="chart-subtitle">Monthly bookings — Jan to Dec</div>
                        </div>
                        <div class="year-switcher" id="yearSwitcher"></div>
                    </div>
                    <div class="chart-legend" id="chartLegend"></div>
                    <div class="chart-wrap">
                        <canvas id="bookingChart"
                                role="img"
                                aria-label="Line chart of monthly bookings per year">
                            Monthly booking data by year.
                        </canvas>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<!-- LOGOUT MODAL -->
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
/* ─── REAL data from DB — built in the @php block above ─── */
const BOOKING_DATA = @json($monthlyBookings);
/*
  Shape: { "2025": [0,0,4,7,12,null,null,...], "2026": [...] }
  null  = future month, not plotted
  0     = month happened but no bookings
  N     = real count
*/

/* ── Distinct professional colour per year ── */
const YEAR_PALETTE = {
    2020: { line: '#a855f7', fill: 'rgba(168,85,247,0.08)'  },  // violet
    2021: { line: '#6366f1', fill: 'rgba(99,102,241,0.08)'  },  // indigo
    2022: { line: '#f59e0b', fill: 'rgba(245,158,11,0.08)'  },  // amber
    2023: { line: '#ec4899', fill: 'rgba(236,72,153,0.08)'  },  // pink
    2024: { line: '#3b82f6', fill: 'rgba(59,130,246,0.08)'  },  // blue
    2025: { line: '#10b981', fill: 'rgba(16,185,129,0.08)'  },  // emerald
    2026: { line: '#005a2b', fill: 'rgba(0,90,43,0.08)'     },  // brand green
    2027: { line: '#f97316', fill: 'rgba(249,115,22,0.08)'  },  // orange
};
const FALLBACK_PAL = [
    { line: '#14b8a6', fill: 'rgba(20,184,166,0.08)' },
    { line: '#8b5cf6', fill: 'rgba(139,92,246,0.08)' },
    { line: '#ef4444', fill: 'rgba(239,68,68,0.08)'  },
];

function pal(yr, idx) {
    return YEAR_PALETTE[yr] || FALLBACK_PAL[idx % FALLBACK_PAL.length];
}

const MONTHS   = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
const allYears = Object.keys(BOOKING_DATA).map(Number).sort();

// Default to the latest year with any non-null, non-zero data — else most recent year
let currentYear = (function () {
    for (let i = allYears.length - 1; i >= 0; i--) {
        const yr  = allYears[i];
        const raw = BOOKING_DATA[yr] || [];
        if (raw.some(v => v !== null && v > 0)) return yr;
    }
    return allYears[allYears.length - 1];
})();

let chartInst = null;

/* ── Count-up animation ── */
function animateCount(el) {
    const target = parseInt(el.getAttribute('data-target'), 10) || 0;
    if (target === 0) { el.textContent = '0'; return; }
    const dur = 1400, t0 = performance.now();
    (function tick(now) {
        const p = Math.min((now - t0) / dur, 1);
        const e = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.floor(e * target).toLocaleString();
        p < 1 ? requestAnimationFrame(tick) : (el.textContent = target.toLocaleString());
    })(performance.now());
}

/* ── x-axis labels: months present in the selected year ── */
function labelsFor(yr) {
    const raw = BOOKING_DATA[yr] || [];
    return MONTHS.filter((_, i) => raw[i] !== null && raw[i] !== undefined);
}

/* ── data array aligned to the active year's labels ── */
function dataFor(yr) {
    const raw    = BOOKING_DATA[yr] || [];
    const labels = labelsFor(currentYear);
    return labels.map(m => {
        const v = raw[MONTHS.indexOf(m)];
        return (v !== null && v !== undefined) ? v : null;
    });
}

/* ── datasets: every year on one chart, active = bold+filled ── */
function buildDatasets() {
    return allYears.map((yr, idx) => {
        const p        = pal(yr, idx);
        const isActive = yr === currentYear;
        return {
            label:                     String(yr),
            data:                      dataFor(yr),
            spanGaps:                  false,
            borderColor:               p.line,
            backgroundColor:           isActive ? p.fill : 'transparent',
            pointBackgroundColor:      p.line,
            pointBorderColor:          '#ffffff',
            pointBorderWidth:          isActive ? 2.5 : 1.5,
            pointRadius:               isActive ? 5   : 3,
            pointHoverRadius:          isActive ? 8   : 5,
            pointHoverBackgroundColor: p.line,
            pointHoverBorderColor:     '#ffffff',
            pointHoverBorderWidth:     2,
            borderWidth:               isActive ? 2.5 : 1.5,
            borderDash:                isActive ? []  : [5, 4],
            fill:                      isActive,
            tension:                   0.42,
            order:                     isActive ? 0   : 1,
        };
    });
}

/* ── Year switcher ── */
function buildYearButtons() {
    const wrap = document.getElementById('yearSwitcher');
    allYears.forEach((yr, idx) => {
        const p   = pal(yr, idx);
        const btn = document.createElement('button');
        btn.className   = 'yr-btn' + (yr === currentYear ? ' active' : '');
        btn.textContent = yr;
        if (yr === currentYear) btn.style.background = p.line;
        btn.addEventListener('click', () => {
            currentYear = yr;
            wrap.querySelectorAll('.yr-btn').forEach(b => {
                b.classList.remove('active');
                b.style.background = '';
            });
            btn.classList.add('active');
            btn.style.background = p.line;
            updateChart();
        });
        wrap.appendChild(btn);
    });
}

/* ── Legend ── */
function buildLegend() {
    const wrap = document.getElementById('chartLegend');
    wrap.innerHTML = '';
    allYears.forEach((yr, idx) => {
        const p    = pal(yr, idx);
        const item = document.createElement('div');
        item.className = 'legend-item';
        item.innerHTML =
            `<span class="legend-dot" style="background:${p.line}"></span>${yr}`;
        wrap.appendChild(item);
    });
}

/* ── Create / refresh chart ── */
function updateChart() {
    const labels   = labelsFor(currentYear);
    const datasets = buildDatasets();

    if (chartInst) {
        chartInst.data.labels   = labels;
        chartInst.data.datasets = datasets;
        chartInst.update('active');
        return;
    }

    chartInst = new Chart(document.getElementById('bookingChart'), {
        type: 'line',
        data: { labels, datasets },
        options: {
            responsive:          true,
            maintainAspectRatio: false,
            interaction:         { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#ffffff',
                    titleColor:      '#111111',
                    bodyColor:       '#333333',
                    borderColor:     'rgba(0,0,0,0.10)',
                    borderWidth:     1,
                    padding:         { top:12, right:16, bottom:12, left:16 },
                    cornerRadius:    12,
                    displayColors:   true,
                    boxWidth:        10,
                    boxHeight:       10,
                    boxPadding:      5,
                    usePointStyle:   true,
                    titleFont: { size:12, weight:'700', family:'Inter,sans-serif' },
                    bodyFont:  { size:12, weight:'600', family:'Inter,sans-serif' },
                    callbacks: {
                        title: ctx => ctx[0].label,
                        label: ctx => {
                            const v = ctx.parsed.y;
                            if (v === null || v === undefined) return null;
                            return `  ${ctx.dataset.label}: ${v.toLocaleString()} bookings`;
                        },
                        labelColor: ctx => {
                            const c = pal(Number(ctx.dataset.label),
                                         allYears.indexOf(Number(ctx.dataset.label)));
                            return {
                                borderColor:     c.line,
                                backgroundColor: c.line,
                                borderRadius:    3,
                                borderWidth:     0
                            };
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid:   { display: false },
                    border: { display: false },
                    ticks:  {
                        color:       '#aaa',
                        font:        { size:11, weight:'500', family:'Inter,sans-serif' },
                        maxRotation: 0,
                        autoSkip:    false
                    }
                },
                y: {
                    grid:        { color: 'rgba(0,0,0,0.05)' },
                    border:      { display: false },
                    beginAtZero: true,
                    ticks: {
                        color:         '#aaa',
                        font:          { size:11, family:'Inter,sans-serif' },
                        maxTicksLimit: 6,
                        callback:      v => Number.isInteger(v) ? v.toLocaleString() : ''
                    }
                }
            }
        }
    });
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

    // Close sidebar when a nav link is tapped on mobile
    document.querySelectorAll('.nav-item').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) closeSidebar();
        });
    });
})();

/* ── Init on DOM ready ── */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.stat-number[data-target]').forEach(animateCount);
    buildYearButtons();
    buildLegend();
    updateChart();
});
</script>

</body>
</html>