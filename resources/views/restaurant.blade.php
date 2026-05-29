<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant - TN Multi Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --custom-grey: #ffffff;
            --primary-green: #005a2b;
            --dark-green: #055e2d;
            --custom-beige: #f8f4ed;
            --room-floor: #f1ede6;
            --status-available: #2e7d32;
        }
        body { font-family: 'Poppins', sans-serif; background-color: #fff; overflow-x: hidden; font-size: 0.88rem; }
        h1, h2, h3, h4, .menu-title, .food-name, .reserve-title { font-family: 'Playfair Display', serif; }

        /* ── Navbar ── */
        .navbar {
            background-color: var(--custom-grey) !important;
            padding: 0.4rem 0;
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

        /* Desktop nav links */
        .nav-link.active-link { color: #000 !important; opacity: 1 !important; font-weight: 700; text-decoration: none !important; }
        .nav-link { font-size: 0.88rem; font-weight: 600; color: #000 !important; opacity: 0.45; transition: opacity 0.3s; text-decoration: none !important; }
        .nav-link:hover { opacity: 1; }

        /* Hamburger toggler */
        .navbar-toggler { border: none; padding: 4px 8px; background: transparent; }
        .navbar-toggler:focus { box-shadow: none; outline: none; }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: var(--custom-grey);
                padding: 12px 16px 16px;
                border-top: 1px solid rgba(0,0,0,0.1);
                margin-top: 6px;
            }
            .navbar-nav .nav-link { padding: 8px 4px !important; border-bottom: 1px solid rgba(0,0,0,0.08); }
            .navbar-nav .nav-item:last-child .nav-link { border-bottom: none; }
            .d-flex.align-items-center { margin-top: 10px; padding-top: 10px; border-top: 1px solid rgba(0,0,0,0.1); }
        }

        .profile-icon-nav { font-size: 1.6rem; color: #000; cursor: pointer; }
        .dropdown-toggle::after { display: none; }
        .dropdown-menu { border-radius: 16px; padding: 12px 0; border: 1px solid #ddd; box-shadow: 0 4px 15px rgba(0,0,0,0.1); min-width: 150px; margin-top: 12px !important; }
        .dropdown-item { font-weight: 600; padding: 8px 22px; color: #333; font-size: 0.88rem; }

        /* ── Hero ── */
        .restaurant-hero { background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url("{{ asset('images/restaurant.jpeg') }}") center/cover no-repeat; height: 50vh; display: flex; align-items: center; justify-content: center; color: white; text-align: center; margin-top: 65px; }

        /* ── Tabs ── */
        .menu-tabs-container { background-color: #e0e0e0; border-radius: 50px; display: inline-flex; padding: 5px; margin-bottom: 50px; }
        .menu-tab { padding: 10px 40px; border-radius: 40px; text-decoration: none; color: #000; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: 0.3s; }
        .menu-tab.active { background-color: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }

        /* ── Section header ── */
        .section-header { text-align: left; margin-top: 40px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; min-height: 56px; }
        .section-header-left h3 { font-size: 1.5rem; font-weight: 700; display: inline-block; position: relative; text-transform: capitalize; margin: 0; }
        .section-header-left h3::after { content: ""; display: block; width: 70%; height: 2px; background: #000; margin-top: 5px; }

        /* ════ FOOD CARD ════ */
        .food-card[data-color="1"] { --accent: #2563eb; }
        .food-card[data-color="2"] { --accent: #7c3aed; }
        .food-card[data-color="3"] { --accent: #059669; }
        .food-card[data-color="4"] { --accent: #d97706; }
        .food-card[data-color="5"] { --accent: #dc2626; }
        .food-card[data-color="6"] { --accent: #0891b2; }

        @keyframes cardReveal {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .food-card { border: 1px solid #ddd; border-radius: 20px; overflow: hidden; background: #fff; height: 100%; opacity: 0; transition: transform 0.35s ease, box-shadow 0.35s ease; cursor: default; position: relative; }
        .cards-visible .food-card { animation: cardReveal 0.55s ease forwards; }
        .food-card:hover { transform: translateY(-7px); box-shadow: 0 16px 40px rgba(0,90,43,0.18), 0 4px 16px rgba(0,90,43,0.12); }
        .food-card img { width: 100%; height: 160px; object-fit: cover; transition: transform 0.35s ease; }
        .food-card:hover img { transform: scale(1.04); }
        .food-info { background-color: #fff; padding: 12px 14px; text-align: center; transition: background-color 0.35s ease; }
        .food-card:hover .food-info { background-color: #f8fffe; }
        .food-name { font-size: 0.88rem; font-weight: 700; margin-bottom: 12px; color: #222; transition: color 0.3s; }
        .food-card:hover .food-name { color: var(--accent, #059669); }
        .price-order-row { display: flex; align-items: center; justify-content: space-between; position: relative; padding-top: 12px; }
        .price-order-row::before { content: ""; display: block; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: #e5e7eb; border-radius: 99px; }
        .price-order-row::after { content: ""; display: block; position: absolute; top: 0; left: 0; height: 3px; width: 0%; border-radius: 99px; background: var(--accent, #059669); transition: width 0.7s cubic-bezier(0.4, 0, 0.2, 1); }
        .food-card:hover .price-order-row::after { width: 100%; }
        .btn-order-item { background-color: var(--primary-green); color: #fff; border: none; border-radius: 7px; padding: 4px 14px; font-size: 0.7rem; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: background 0.2s, box-shadow 0.2s; white-space: nowrap; }
        .btn-order-item:hover { background-color: var(--dark-green); box-shadow: 0 4px 14px rgba(0,0,0,0.22); }
        .food-card:hover .btn-order-item { box-shadow: 0 4px 14px rgba(0,90,43,0.32); }
        .price { font-size: 0.75rem; color: #555; font-weight: 600; }

        /* ════ FLOATING ORDER BUTTON ════ */
        #floatingOrderBtn { display: none; position: fixed; bottom: 36px; right: 36px; z-index: 4000; width: 64px; height: 64px; border-radius: 50%; background-color: var(--primary-green); color: #fff; border: none; font-size: 1.45rem; cursor: pointer; box-shadow: 0 6px 28px rgba(0,90,43,0.38); transition: background 0.2s, transform 0.2s, box-shadow 0.2s, bottom 0.2s; align-items: center; justify-content: center; }
        #floatingOrderBtn:hover { background-color: var(--dark-green); transform: scale(1.08); box-shadow: 0 10px 36px rgba(0,90,43,0.48); }
        #floatingOrderBtn .float-badge { position: absolute; top: -4px; right: -4px; background: #e53e3e; color: #fff; border-radius: 50%; width: 22px; height: 22px; font-size: 0.68rem; font-weight: 800; display: flex; align-items: center; justify-content: center; border: 2px solid #fff; line-height: 1; }

        /* ════ SIDE PANEL ════ */
        #sideOverlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.38); z-index: 4500; cursor: pointer; }
        #sidePanel { position: fixed; top: 0; right: -520px; width: 480px; max-width: 96vw; height: 100%; background: #fff; z-index: 4600; display: flex; flex-direction: column; box-shadow: -8px 0 50px rgba(0,0,0,0.18); transition: right 0.38s cubic-bezier(0.4,0,0.2,1); cursor: default; border-radius: 24px 0 0 24px; overflow: hidden; }
        #sidePanel.open { right: 0; }
        .side-panel-header { background: var(--primary-green); color: #fff; padding: 22px 28px; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
        .side-panel-header-title { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .side-panel-close { background: rgba(255,255,255,0.18); border: none; color: #fff; width: 36px; height: 36px; border-radius: 50%; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; }
        .side-panel-close:hover { background: rgba(255,255,255,0.3); }
        .side-panel-body { flex: 1; overflow-y: auto; padding: 24px 28px; }
        .sp-empty { text-align: center; color: #aaa; font-size: 0.9rem; padding: 36px 0; }
        .sp-item-row { display: flex; align-items: center; gap: 10px; padding: 12px 0; border-bottom: 1px solid #f0f0f0; }
        .sp-item-name { flex: 1; font-size: 0.85rem; font-weight: 600; color: #222; line-height: 1.4; }
        .sp-item-sub { font-size: 0.72rem; color: #888; display: block; margin-top: 2px; }
        .sp-qty-btn { width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; font-weight: 700; cursor: pointer; flex-shrink: 0; transition: background 0.15s; }
        .sp-qty-btn.minus { border: 1.8px solid #e53e3e; background: #fff; color: #e53e3e; }
        .sp-qty-btn.minus:hover { background: #fff0f0; }
        .sp-qty-btn.plus  { border: 1.8px solid #333; background: #fff; color: #333; }
        .sp-qty-btn.plus:hover  { background: #f0f0f0; }
        .sp-qty-count { font-size: 0.9rem; font-weight: 700; min-width: 22px; text-align: center; }
        .sp-total-row { display: flex; justify-content: space-between; align-items: center; padding: 16px 0 6px; border-top: 2px solid #e0e0e0; margin-top: 8px; font-weight: 700; font-size: 0.95rem; color: #222; }
        .sp-total-amount { color: var(--primary-green); font-size: 1.05rem; font-weight: 800; }
        .sp-special-req { width: 100%; border: 1.5px solid #ddd; border-radius: 12px; padding: 12px 14px; font-size: 0.85rem; font-family: 'Poppins', sans-serif; resize: none; outline: none; margin-top: 8px; }
        .sp-special-req:focus { border-color: var(--primary-green); }
        .side-panel-footer { padding: 18px 28px 24px; border-top: 1px solid #eee; flex-shrink: 0; background: #fafafa; }
        .sp-action-btns { display: flex; gap: 12px; }
        .sp-btn-takeaway, .sp-btn-book-table { flex: 1; padding: 13px 0; border-radius: 28px; font-size: 0.85rem; font-weight: 700; font-family: 'Poppins', sans-serif; border: none; cursor: pointer; transition: 0.2s; }
        .sp-btn-takeaway { background: #f0f0f0; color: #333; }
        .sp-btn-takeaway:hover { background: #e0e0e0; }
        .sp-btn-book-table { background: var(--primary-green); color: #fff; }
        .sp-btn-book-table:hover { background: var(--dark-green); }

        /* ── Dining floor ── */
        .booking-section { background-color: var(--custom-beige); padding: 80px 0; }
        .dining-hall { background-color: var(--room-floor); border: 10px solid #fff; border-radius: 40px; padding: 80px 40px; box-shadow: inset 0 0 50px rgba(0,0,0,0.03); max-width: 1000px; margin: 0 auto; }
        .floor-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 100px 20px; justify-items: center; }
        .table-unit { display: flex; flex-direction: column; align-items: center; cursor: pointer; transition: 0.3s; position: relative; }
        .table-unit:hover { transform: scale(1.05); }
        .table-top {
            background: #fff;
            border: 4px solid var(--status-available);
            color: var(--status-available);
            border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            position: relative; z-index: 2;
            font-family: 'Playfair Display', serif;
        }
        .cap-2 { width: 90px; height: 60px; }
        .cap-4 { width: 120px; height: 85px; }
        .cap-6 { width: 150px; height: 95px; }
        .cap-8 { width: 180px; height: 95px; }
        .chair { width: 22px; height: 10px; background: #aaa; position: absolute; border-radius: 3px; z-index: 1; }
        .seat-label { margin-top: 15px; font-weight: 800; font-size: 12px; color: #555; text-transform: uppercase; }

        /* ── Toasts ── */
        #notification-center { position: fixed; top: 110px; right: 30px; z-index: 9999; pointer-events: none; }
        .p-toast { min-width: 240px; background: white; padding: 13px 18px; border-radius: 14px; box-shadow: 0 12px 35px rgba(0,0,0,0.13); display: flex; align-items: center; gap: 12px; margin-bottom: 10px; transform: translateX(130%); transition: 0.4s; border-left: 5px solid #ccc; pointer-events: all; }
        .p-toast.show { transform: translateX(0); }
        .toast-success { border-left-color: var(--status-available); }
        .toast-error   { border-left-color: #d32f2f; }
        .toast-info    { border-left-color: var(--primary-green); }
        .field-error { color: #e53e3e; font-size: 0.8rem; font-weight: 500; margin-top: 6px; display: none; align-items: center; gap: 5px; }
        .field-error.show { display: flex; }
        .order-summary-box { background: #f8f4ed; border-radius: 15px; padding: 14px; margin-bottom: 16px; }
        .order-summary-box .summary-title { font-weight: 700; font-size: 0.85rem; margin-bottom: 10px; color: #333; }
        .order-summary-item { display: flex; justify-content: space-between; font-size: 0.8rem; color: #555; padding: 3px 0; }
        .no-order-hint { font-size: 0.8rem; color: #888; font-style: italic; text-align: center; padding: 8px 0; }
        .btn-confirm-takeaway, .btn-confirm-table { display: block; width: 100%; padding: 13px; background-color: var(--primary-green); color: #fff; border: none; border-radius: 25px; font-size: 0.9rem; font-weight: 700; font-family: 'Poppins', sans-serif; cursor: pointer; transition: background 0.2s; }
        .btn-confirm-takeaway:hover, .btn-confirm-table:hover { background-color: var(--dark-green); }

        /* ── Footer ── */
        footer { background-color: #000; color: #fff; padding: 55px 40px 24px 40px; }
        .footer-logo { font-size: 1.3rem; font-weight: 800; margin-bottom: 10px; font-family: 'Playfair Display', serif; }
        .footer-desc { font-size: 0.83rem; color: #bbb; line-height: 1.6; max-width: 260px; }
        .footer-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 18px; color: #fff; }
        footer a { color: #bbb; text-decoration: none; font-size: 0.86rem; display: block; margin-bottom: 9px; transition: 0.3s; cursor: pointer; }
        footer a:hover { color: #fff; }
        .contact-info { color: #bbb; font-size: 0.86rem; line-height: 2; }
        .footer-bottom-line { border-top: 1px solid #333; margin-top: 45px; padding-top: 16px; color: #777; font-size: 0.8rem; }

        html { scroll-behavior: smooth; }
    </style>
</head>
<body>

@if(session('booking_success'))
    <div id="booking-toast" class="p-toast show toast-success" style="position:fixed;top:110px;right:30px;z-index:9999;transform:translateX(0);">
        <i class="fa-solid fa-circle-check"></i>
        <div><div class="fw-bold">Success</div><div class="small text-muted">{{ session('booking_success') }}</div></div>
    </div>
    {{-- ✅ Only clear the saved order on genuine booking success --}}
    <script>
        try { localStorage.removeItem('tn_restaurant_order'); } catch(e) {}
        setTimeout(()=>{ document.getElementById('booking-toast').remove(); }, 6000);
    </script>
@endif

@if(session('error_conflict'))
    <div id="conflict-toast" class="p-toast show toast-error" style="position:fixed;top:110px;right:30px;z-index:9999;transform:translateX(0);">
        <i class="fa-solid fa-circle-exclamation"></i>
        <div><div class="fw-bold">Booking Conflict</div><div class="small text-muted">{{ session('error_conflict') }}</div></div>
    </div>
    <script>setTimeout(()=>{ document.getElementById('conflict-toast').remove(); }, 6000);</script>
@endif

    <div id="notification-center"></div>

    @auth
    <button id="floatingOrderBtn" onclick="toggleSidePanel()" title="Your Order" style="display:inline-flex;">
        <i class="fa-solid fa-bag-shopping"></i>
        <span class="float-badge" id="floatBadge">0</span>
    </button>
    @endauth

    <div id="sideOverlay" onclick="closeSidePanel()"></div>

    <div id="sidePanel">
        <div class="side-panel-header">
            <div class="side-panel-header-title">
                <i class="fa-solid fa-bag-shopping"></i> Your Order
            </div>
            <button class="side-panel-close" onclick="closeSidePanel()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="side-panel-body" id="sidePanelBody">
            <div class="sp-empty" id="spEmptyMsg">No items added yet.</div>
        </div>
        <div class="side-panel-footer">
            <textarea id="spSpecialReq" class="sp-special-req" rows="2"
                placeholder="Special request (optional)…"></textarea>
            <div class="sp-action-btns mt-3">
                <button class="sp-btn-takeaway" onclick="openTakeaway()">
                    <i class="fa-solid fa-bag-shopping me-1"></i>Takeaway
                </button>
                <button class="sp-btn-book-table" onclick="goToTableSection()">
                    <i class="fa-solid fa-chair me-1"></i>Book Table
                </button>
            </div>
        </div>
    </div>

    <!-- ══ NAVBAR ══ -->
    <nav class="navbar navbar-expand-lg fixed-top border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="TN Logo" class="brand-logo" width="52" height="52">
                <span class="brand-text">TN Multi Services</span>
            </a>

            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="{{ url('/') }}">HOME</a></li>
                    <li class="nav-item"><a class="nav-link active-link px-3" href="{{ route('restaurant') }}">RESTAURANT</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('lodging') }}">LODGING</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('spa') }}">SPA</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('contact') }}">CONTACT</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link px-3" href="{{ route('my.bookings') }}">YOUR BOOKING</a></li>
                    @endauth
                </ul>
                <div class="d-flex align-items-center">
                    @auth
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-circle-user profile-icon-nav"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item fw-bold" href="{{ route('custom.profile.show') }}">Profile Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#logoutModal">Log Out</a></li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link px-3">Login</a>
                        <a href="{{ route('register') }}" class="nav-link p-0">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="restaurant-hero">
        <div>
            <p class="text-uppercase mb-1" style="letter-spacing: 2px; font-size: 0.75rem; font-weight: 600;">DINNING</p>
            <h1 class="fw-bold text-uppercase" style="font-size: clamp(1.6rem, 4vw, 2.6rem);">Our Restaurant</h1>
        </div>
    </header>

    <!-- ── MENU SECTION ── -->
    <section class="container py-5 text-center">
        <h2 class="menu-title fw-bold mb-5" style="font-size: clamp(1.35rem, 3.5vw, 2rem);">Explore Our Dishes</h2>

        <div class="menu-tabs-container">
            @foreach($categories as $cat)
                <div class="menu-tab {{ $loop->first ? 'active' : '' }}"
                     data-category="cat-{{ $cat->id }}">{{ ucfirst($cat->name) }}</div>
            @endforeach
        </div>

        @foreach($categories as $cat)
        <div id="cat-{{ $cat->id }}" class="menu-content-section" style="{{ $loop->first ? '' : 'display:none;' }}">

            @forelse($cat->restaurantMenus->groupBy('item_types') as $itemType => $items)
                <div class="section-header">
                    <div class="section-header-left">
                        <h3>{{ ucfirst($itemType) }}</h3>
                    </div>
                </div>

                @php $colorIdx = 1; @endphp
                <div class="row row-cols-2 row-cols-md-5 g-3 mb-5 food-card-row">
                    @foreach($items as $menu)
                    <div class="col">
                        <div class="food-card" data-color="{{ $colorIdx }}">
                            <img src="{{ asset('images/menu/' . $menu->image) }}" alt="{{ ucfirst($menu->name) }}">
                            <div class="food-info">
                                <p class="food-name">{{ ucfirst($menu->name) }}</p>
                                <div class="price-order-row">
                                    @php
                                        $rawPrice = $menu->price;
                                        if (is_string($rawPrice)) {
                                            $cleanPrice = str_replace(['Nu.', 'nu.', 'NU.', ' '], '', $rawPrice);
                                            $numericPrice = is_numeric($cleanPrice) ? floatval($cleanPrice) : 0;
                                        } else {
                                            $numericPrice = floatval($rawPrice);
                                        }
                                    @endphp
                                    <button class="btn-order-item"
                                        onclick="addToOrder('{{ addslashes(ucfirst($menu->name)) }}', {{ $numericPrice }})"
                                        data-price="{{ $numericPrice }}"
                                        data-name="{{ ucfirst($menu->name) }}">
                                        Order
                                    </button>
                                    <span class="price">Nu. {{ number_format($numericPrice, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $colorIdx = ($colorIdx % 6) + 1; @endphp
                    @endforeach
                </div>

            @empty
                <p class="text-center w-100 py-5 text-muted">No items in this category yet.</p>
            @endforelse
        </div>
        @endforeach
    </section>

    <!-- ── DINING FLOOR PLAN ── -->
    <section class="booking-section text-center" id="tableSection">
        <div class="container">
            <p class="small fw-bold text-uppercase mb-1" style="letter-spacing:2px;">Click on a table to reserve it</p>
            <h1 class="reserve-title mb-5">Book a Table</h1>
            <div class="dining-hall">
                <div class="floor-grid">
                    @foreach($tables as $table)
                    @php
                        $capClass = 'cap-4';
                        if ($table->chairs <= 2)     $capClass = 'cap-2';
                        elseif ($table->chairs >= 8) $capClass = 'cap-8';
                        elseif ($table->chairs >= 6) $capClass = 'cap-6';
                        $topChairs    = ceil($table->chairs / 2);
                        $bottomChairs = floor($table->chairs / 2);
                    @endphp
                    <div class="table-unit"
                         onclick="handleTableClick('{{ ucfirst($table->table_no) }}', {{ $table->chairs }})">
                        <div class="table-top {{ $capClass }}">
                            @for($i = 0; $i < $topChairs; $i++)
                                <div class="chair" style="top:-12px;left:{{ 15+($i*35) }}px;"></div>
                            @endfor
                            @for($i = 0; $i < $bottomChairs; $i++)
                                <div class="chair" style="bottom:-12px;left:{{ 15+($i*35) }}px;"></div>
                            @endfor
                            {{ ucfirst($table->table_no) }}
                        </div>
                        <div class="seat-label">{{ $table->chairs }} Seats ({{ ucfirst($table->description) }})</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ── -->
    <footer id="mainFooter">
        <div class="container-fluid">
            <div class="row g-4 text-start">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-logo">TN</div>
                    <p class="footer-desc">Premier destination for luxury lodging, fine dining, and rejuvenating spa experiences.</p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <p class="footer-title">Services</p>
                    <a href="{{ route('restaurant') }}">Restaurant</a>
                    <a href="{{ route('lodging') }}">Lodging</a>
                    <a href="{{ route('spa') }}">Spa & Wellness</a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <p class="footer-title">Quick Links</p>
                    <a href="{{ route('contact') }}">Contact Us</a>
                    @auth
                        <a href="{{ route('custom.profile.show') }}">Profile</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
                <div class="col-md-3 col-sm-6">
                    <p class="footer-title">Contact</p>
                    <div class="contact-info">
                        Dewathang, Samdrupjongkhar<br>
                        +975-77343125<br>
                        tnrestrocafe@gmail.com
                    </div>
                </div>
            </div>
            <div class="footer-bottom-line text-center">&copy; 2026 TN Multi Services. All rights reserved.</div>
        </div>
    </footer>

    <!-- LOGOUT MODAL -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center shadow-lg" style="border-radius:26px;padding:26px;">
                <h2 class="mb-2">Log Out</h2>
                <p class="text-muted mb-4">Are you sure you want to log out?</p>
                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <button type="submit" class="btn btn-danger rounded-pill px-4 text-white">Yes, Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TAKEAWAY MODAL -->
    <div class="modal fade" id="takeawayModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg" style="border-radius:30px;padding:10px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title h3" style="font-weight:800;font-family:'Playfair Display',serif;">Takeaway Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-4">Select your pickup date and time.</p>
                    <form action="{{ isset($booking) ? route('booking.update', $booking->id) : route('book.service') }}" method="POST" id="takeawayForm">
                        @csrf
                        @if(isset($booking)) @method('PUT') @endif
                        <input type="hidden" name="service_type" value="Restaurant">
                        <input type="hidden" name="service_name" value="Takeaway Order">
                        <input type="hidden" name="order_items" id="hiddenTakeawayItems">
                        <input type="hidden" name="special_request" id="hiddenTakeawaySpecial">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Pickup Date <span style="color:#e53e3e;">*</span></label>
                            <input type="date" name="booking_date" id="twDate" class="form-control"
                                min="{{ date('Y-m-d') }}"
                                style="border-radius:10px;border:1.5px solid #ccc;padding:12px;">
                            <div class="field-error" id="twDateError">
                                <i class="fa-solid fa-circle-exclamation"></i>&nbsp;Please select a date.
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pickup Time <span style="color:#e53e3e;">*</span></label>
                            <input type="time" name="booking_time" id="twTime" class="form-control"
                                min="10:00" max="21:00"
                                style="border-radius:10px;border:1.5px solid #ccc;padding:12px;">
                            <div class="field-error" id="twTimeError">
                                <i class="fa-solid fa-circle-exclamation"></i>&nbsp;Please select a time (10 AM – 9 PM).
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="button" class="btn btn-light rounded-pill px-4 flex-fill" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn-confirm-takeaway flex-fill" onclick="confirmTakeaway()">Confirm Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLE BOOKING MODAL -->
    @auth
    <div class="modal fade" id="tableBookingModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg" style="border-radius:30px;padding:10px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title h3" style="font-weight:800;font-family:'Playfair Display',serif;">
                        Reserve Table <span id="m-tid"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-3">Capacity: <span id="m-cap"></span> Guests</p>

                    <div class="order-summary-box">
                        <div class="summary-title"><i class="fa-solid fa-bag-shopping me-1"></i> Your Order</div>
                        <div id="modalOrderSummary">
                            <div class="no-order-hint">Go and select items if you want your order to be ready when you arrive.</div>
                        </div>
                    </div>

                    <form action="{{ isset($booking) ? route('booking.update', $booking->id) : route('book.service') }}" method="POST" id="resForm">
                        @csrf
                        @if(isset($booking)) @method('PUT') @endif
                        <input type="hidden" name="service_type" value="Restaurant">
                        <input type="hidden" name="service_name" id="hiddenTableNo">
                        <input type="hidden" name="order_items" id="hiddenOrderItems">
                        <input type="hidden" name="special_request" id="hiddenSpecialRequest">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Pick Date <span style="color:#e53e3e;">*</span></label>
                            <input type="date" name="booking_date" id="rDate" class="form-control"
                                min="{{ date('Y-m-d') }}"
                                style="border-radius:10px;border:1.5px solid #ccc;padding:12px;">
                            <div class="field-error" id="rDateError">
                                <i class="fa-solid fa-circle-exclamation"></i>&nbsp;Please select a date.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Time <span style="color:#e53e3e;">*</span></label>
                            <input type="time" name="booking_time" id="rTime" class="form-control"
                                min="10:00" max="21:00"
                                style="border-radius:10px;border:1.5px solid #ccc;padding:12px;">
                            <div class="field-error" id="rTimeError">
                                <i class="fa-solid fa-circle-exclamation"></i>&nbsp;Please select a time (10 AM – 9 PM).
                            </div>
                        </div>
                        <button type="button" class="btn-confirm-table" onclick="validateAndSubmitTable()">
                            {{ isset($booking) ? 'Update Booking' : 'Confirm Booking' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    /* ═══════════════════════════════════════════════════
       AUTH & CONFIG
    ═══════════════════════════════════════════════════ */
    const IS_LOGGED_IN = {{ auth()->check() ? 'true' : 'false' }};
    const LOGIN_URL    = "{{ route('login') }}";

    /* ═══════════════════════════════════════════════════
       EDIT MODE DETECTION
    ═══════════════════════════════════════════════════ */
    @if(isset($booking))
        const IS_EDIT_MODE     = true;
        const EDIT_IS_TAKEAWAY = {{ ($booking->service_name === 'Takeaway Order') ? 'true' : 'false' }};
        const EDIT_TABLE_NO    = {!! json_encode($booking->service_name !== 'Takeaway Order' ? $booking->service_name : '') !!};
        const EDIT_CHAIRS      = {{ $booking->number_of_guests ?? 4 }};
        const EDIT_DATE        = {!! json_encode(\Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d')) !!};
        const EDIT_TIME        = {!! json_encode(\Carbon\Carbon::parse($booking->booking_time)->format('H:i')) !!};
        const EDIT_SPECIAL     = {!! json_encode($booking->special_request ?? '') !!};
        const SERVER_ORDER_ITEMS = {!! json_encode($booking->order_items ?? new stdClass()) !!};
    @else
        const IS_EDIT_MODE     = false;
        const EDIT_IS_TAKEAWAY = false;
        const EDIT_TABLE_NO    = '';
        const EDIT_CHAIRS      = 4;
        const EDIT_DATE        = '';
        const EDIT_TIME        = '';
        const EDIT_SPECIAL     = '';
        const SERVER_ORDER_ITEMS = null;
    @endif

    /* ═══════════════════════════════════════════════════
       ORDER STATE
       ─ Order is ONLY cleared from localStorage when the
         server confirms a successful booking via
         session('booking_success'). Conflicts, validation
         failures, and page reloads all preserve the order.
    ═══════════════════════════════════════════════════ */
    const ORDER_STORAGE_KEY = 'tn_restaurant_order';

    function loadSavedOrder() {
        try {
            const raw = localStorage.getItem(ORDER_STORAGE_KEY);
            if (!raw) return {};
            const parsed = JSON.parse(raw);
            return (typeof parsed === 'object' && !Array.isArray(parsed)) ? parsed : {};
        } catch(e) { return {}; }
    }

    function saveOrder() {
        try { localStorage.setItem(ORDER_STORAGE_KEY, JSON.stringify(orderMap)); } catch(e) {}
    }

    function normaliseServerItems(raw) {
        if (!raw || typeof raw !== 'object') return {};
        const first = Object.values(raw)[0];
        if (first && typeof first === 'object' && 'price' in first && 'qty' in first) {
            const out = {};
            Object.entries(raw).forEach(([k, v]) => {
                out[k] = { price: parseFloat(v.price) || 0, qty: parseInt(v.qty) || 1 };
            });
            return out;
        }
        return {};
    }

    // Edit mode always wins over localStorage
    let orderMap;
    if (IS_EDIT_MODE && SERVER_ORDER_ITEMS) {
        orderMap = normaliseServerItems(SERVER_ORDER_ITEMS);
        saveOrder();
    } else {
        orderMap = loadSavedOrder();
    }

    let panelOpen = false;

    function getTotalQty()    { return Object.values(orderMap).reduce((s, v) => s + v.qty, 0); }
    function getTotalAmount() { return Object.values(orderMap).reduce((s, v) => s + (v.price * v.qty), 0); }

    /* ── Add item ── */
    function addToOrder(name, price) {
        if (!IS_LOGGED_IN) { window.location.href = LOGIN_URL; return; }
        const numericPrice = parseFloat(price);
        if (isNaN(numericPrice) || numericPrice <= 0) { showToast('Invalid price for ' + name, 'error'); return; }
        if (orderMap[name]) orderMap[name].qty += 1;
        else orderMap[name] = { price: numericPrice, qty: 1 };
        saveOrder(); updateBadge();
        showToast(`${name} added to order`, 'info');
        if (panelOpen) renderSidePanel();
    }

    function updateBadge() {
        const b = document.getElementById('floatBadge');
        if (b) b.textContent = getTotalQty();
    }

    /* ── Side panel render ── */
    function renderSidePanel() {
        const body     = document.getElementById('sidePanelBody');
        const emptyMsg = document.getElementById('spEmptyMsg');
        body.querySelectorAll('.sp-item-row, .sp-total-row').forEach(r => r.remove());
        const keys = Object.keys(orderMap);
        if (keys.length === 0) { emptyMsg.style.display = 'block'; return; }
        emptyMsg.style.display = 'none';
        const frag = document.createDocumentFragment();
        keys.forEach(name => {
            const item = orderMap[name];
            const row  = document.createElement('div');
            row.className = 'sp-item-row';
            row.innerHTML = `
                <div class="sp-item-name">${name}
                    <span class="sp-item-sub">Nu. ${item.price.toFixed(2)} × ${item.qty} = <strong>Nu. ${(item.price * item.qty).toFixed(2)}</strong></span>
                </div>
                <button class="sp-qty-btn minus" onclick="changeQty('${esc(name)}', -1)">−</button>
                <span class="sp-qty-count">${item.qty}</span>
                <button class="sp-qty-btn plus"  onclick="changeQty('${esc(name)}', 1)">+</button>`;
            frag.appendChild(row);
        });
        const totalRow = document.createElement('div');
        totalRow.className = 'sp-total-row';
        totalRow.innerHTML = `<span>Total</span><span class="sp-total-amount">Nu. ${getTotalAmount().toFixed(2)}</span>`;
        frag.appendChild(totalRow);
        body.insertBefore(frag, emptyMsg);
    }

    function changeQty(name, delta) {
        if (!orderMap[name]) return;
        orderMap[name].qty += delta;
        if (orderMap[name].qty <= 0) delete orderMap[name];
        saveOrder(); updateBadge(); renderSidePanel();
    }

    function esc(str) { return String(str).replace(/\\/g, '\\\\').replace(/'/g, "\\'"); }

    /* ── Floating button stays above footer ── */
    (function () {
        function adjust() {
            const btn    = document.getElementById('floatingOrderBtn');
            const footer = document.getElementById('mainFooter');
            if (!btn || !footer) return;
            const over = window.innerHeight - footer.getBoundingClientRect().top + 16;
            btn.style.bottom = (over > 36 ? over : 36) + 'px';
        }
        window.addEventListener('scroll', adjust, { passive: true });
        window.addEventListener('resize', adjust, { passive: true });
        document.addEventListener('DOMContentLoaded', adjust);
    })();

    /* ── Side panel ── */
    function toggleSidePanel() { panelOpen ? closeSidePanel() : openSidePanel(); }
    function openSidePanel() {
        renderSidePanel();
        document.getElementById('sideOverlay').style.display = 'block';
        document.getElementById('sidePanel').classList.add('open');
        panelOpen = true;
    }
    function closeSidePanel() {
        document.getElementById('sideOverlay').style.display = 'none';
        document.getElementById('sidePanel').classList.remove('open');
        panelOpen = false;
    }

    /* ── Menu tabs ── */
    document.querySelectorAll('.menu-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.getAttribute('data-category');
            document.querySelectorAll('.menu-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            document.querySelectorAll('.menu-content-section').forEach(s => s.style.display = 'none');
            const section = document.getElementById(target);
            section.style.display = 'block';
            section.querySelectorAll('.food-card-row').forEach(row => {
                row.classList.remove('cards-visible');
                row.querySelectorAll('.food-card').forEach(c => c.style.opacity = '0');
                requestAnimationFrame(() => requestAnimationFrame(() => row.classList.add('cards-visible')));
            });
        });
    });

    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('cards-visible'); observer.unobserve(e.target); } });
    }, { threshold: 0.08 });
    document.querySelectorAll('.food-card-row').forEach(r => observer.observe(r));

    /* ═══════════════════════════════════════════════════
       TAKEAWAY
       ─ clearSavedOrder() removed from here.
         Order is cleared only on booking_success (above).
    ═══════════════════════════════════════════════════ */
    function openTakeaway() {
        if (!IS_LOGGED_IN) { window.location.href = LOGIN_URL; return; }
        if (getTotalQty() === 0) { showToast("Your order is empty. Please add items.", "error"); return; }
        closeSidePanel();
        ['twDate','twTime'].forEach(id => document.getElementById(id).value = '');
        ['twDateError','twTimeError'].forEach(id => document.getElementById(id).classList.remove('show'));
        document.getElementById('hiddenTakeawayItems').value   = JSON.stringify(orderMap);
        document.getElementById('hiddenTakeawaySpecial').value = document.getElementById('spSpecialReq').value || '';
        new bootstrap.Modal(document.getElementById('takeawayModal')).show();
    }

    function confirmTakeaway() {
        const dateIn = document.getElementById('twDate');
        const timeIn = document.getElementById('twTime');
        let valid = true;
        document.getElementById('twDateError').classList.remove('show');
        document.getElementById('twTimeError').classList.remove('show');
        if (!dateIn.value) { document.getElementById('twDateError').classList.add('show'); valid = false; }
        const t = timeIn.value;
        if (!t) { document.getElementById('twTimeError').classList.add('show'); valid = false; }
        else { const [h] = t.split(':').map(Number); if (h < 10 || h >= 21) { document.getElementById('twTimeError').classList.add('show'); valid = false; } }
        if (valid) {
            document.getElementById('hiddenTakeawayItems').value   = JSON.stringify(orderMap);
            document.getElementById('hiddenTakeawaySpecial').value = document.getElementById('spSpecialReq').value || '';
            // ✅ Do NOT clear the order here — only cleared on confirmed booking_success
            document.getElementById('takeawayForm').submit();
        }
    }

    /* ═══════════════════════════════════════════════════
       TABLE HANDLING
       ─ clearSavedOrder() removed from here.
         Order is cleared only on booking_success (above).
    ═══════════════════════════════════════════════════ */
    function handleTableClick(tableNo, chairs) {
        if (!IS_LOGGED_IN) { window.location.href = LOGIN_URL; return; }
        openTableBooking(tableNo, chairs);
    }

    function goToTableSection() {
        closeSidePanel();
        setTimeout(() => document.getElementById('tableSection').scrollIntoView({ behavior: 'smooth' }), 350);
    }

    function openTableBooking(tableNo, chairs) {
        document.getElementById('m-tid').innerText     = tableNo;
        document.getElementById('hiddenTableNo').value = tableNo;
        document.getElementById('m-cap').innerText     = chairs;
        document.getElementById('rDateError').classList.remove('show');
        document.getElementById('rTimeError').classList.remove('show');
        refreshModalOrderSummary();
        syncTableHiddenFields();
        new bootstrap.Modal(document.getElementById('tableBookingModal')).show();
    }

    function refreshModalOrderSummary() {
        const summaryDiv = document.getElementById('modalOrderSummary');
        const keys = Object.keys(orderMap);
        if (keys.length === 0) {
            summaryDiv.innerHTML = '<div class="no-order-hint">Go and select items if you want your order to be ready.</div>';
            return;
        }
        let html = keys.map(n => `
            <div class="order-summary-item">
                <span>${n} (×${orderMap[n].qty})</span>
                <span>Nu. ${(orderMap[n].price * orderMap[n].qty).toFixed(2)}</span>
            </div>`).join('');
        html += `<div class="order-summary-item" style="font-weight:700;border-top:1px solid #ddd;margin-top:6px;padding-top:6px;">
                    <span>Total</span>
                    <span style="color:var(--primary-green);">Nu. ${getTotalAmount().toFixed(2)}</span>
                 </div>`;
        summaryDiv.innerHTML = html;
    }

    function syncTableHiddenFields() {
        document.getElementById('hiddenOrderItems').value     = JSON.stringify(orderMap);
        document.getElementById('hiddenSpecialRequest').value = document.getElementById('spSpecialReq').value || '';
    }

    function validateAndSubmitTable() {
        const dateIn = document.getElementById('rDate');
        const timeIn = document.getElementById('rTime');
        let valid = true;
        document.getElementById('rDateError').classList.remove('show');
        document.getElementById('rTimeError').classList.remove('show');
        if (!dateIn.value) { document.getElementById('rDateError').classList.add('show'); valid = false; }
        const t = timeIn.value;
        if (!t) { document.getElementById('rTimeError').classList.add('show'); valid = false; }
        else { const [h] = t.split(':').map(Number); if (h < 10 || h >= 21) { document.getElementById('rTimeError').classList.add('show'); valid = false; } }
        if (valid) {
            syncTableHiddenFields();
            // ✅ Do NOT clear the order here — only cleared on confirmed booking_success
            document.getElementById('resForm').submit();
        }
    }

    /* ═══════════════════════════════════════════════════
       TOASTS
    ═══════════════════════════════════════════════════ */
    function showToast(msg, type) {
        const center = document.getElementById('notification-center');
        const toast  = document.createElement('div');
        toast.className = `p-toast show toast-${type}`;
        toast.innerHTML = `<i class="fa-solid ${type === 'error' ? 'fa-circle-exclamation' : 'fa-circle-check'}"></i>
            <div><div class="fw-bold">${type.toUpperCase()}</div><div class="small text-muted">${msg}</div></div>`;
        center.appendChild(toast);
        setTimeout(() => { toast.classList.remove('show'); setTimeout(() => toast.remove(), 400); }, 3000);
    }

    /* ═══════════════════════════════════════════════════
       SINGLE DOMContentLoaded — normal + edit mode
    ═══════════════════════════════════════════════════ */
    document.addEventListener('DOMContentLoaded', function () {
        updateBadge();

        if (!IS_EDIT_MODE) return;

        document.getElementById('spSpecialReq').value = EDIT_SPECIAL;

        if (EDIT_IS_TAKEAWAY) {
            document.getElementById('hiddenTakeawayItems').value   = JSON.stringify(orderMap);
            document.getElementById('hiddenTakeawaySpecial').value = EDIT_SPECIAL;
            const twModal = new bootstrap.Modal(document.getElementById('takeawayModal'));
            twModal.show();
            document.getElementById('twDate').value = EDIT_DATE;
            document.getElementById('twTime').value = EDIT_TIME;
        } else if (EDIT_TABLE_NO) {
            openTableBooking(EDIT_TABLE_NO, EDIT_CHAIRS);
            document.getElementById('rDate').value = EDIT_DATE;
            document.getElementById('rTime').value = EDIT_TIME;
        }
    });
    </script>
</body>
</html>