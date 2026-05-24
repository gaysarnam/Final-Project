<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa & Wellness - TN Multi Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --custom-grey: #ffffff;
            --dark-green: #055e2d;
            --light-beige: #f8f6f1;
            --custom-beige: #f8f4ed;
            --status-available: #2e7d32;
            --status-booked: #d32f2f;
        }

        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: #fff; overflow-x: hidden; font-size: 0.88rem; }
        h1, h2, h3, h4, .navbar-brand, .service-title, .package-title, .modal-title { font-family: 'Playfair Display', serif; }

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
        .spa-hero {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
                        url("{{ asset('images/spa.jpeg') }}") center/cover no-repeat;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-top: 65px;
        }
        .spa-hero h1 { font-size: clamp(1.6rem, 4vw, 2.6rem); }

        /* ── SUCCESS TOAST ── */
        .p-toast {
            min-width: 280px;
            background: white;
            padding: 14px;
            border-radius: 14px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 5px solid #ccc;
        }
        .toast-success { border-left-color: var(--status-available); }

        /* ── SERVICE CARD — image LEFT, content RIGHT, 2-column grid ── */
        .service-card[data-color="1"] { --accent: #2563eb; }
        .service-card[data-color="2"] { --accent: #7c3aed; }
        .service-card[data-color="3"] { --accent: #059669; }
        .service-card[data-color="4"] { --accent: #d97706; }
        .service-card[data-color="5"] { --accent: #dc2626; }
        .service-card[data-color="6"] { --accent: #0891b2; }

        .service-card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            background: #fff;
            overflow: hidden;
            display: flex;
            flex-direction: row;          /* image left, content right */
            transition: box-shadow 0.3s ease, transform 0.25s ease;
            position: relative;
            height: 100%;
        }
        .service-card:hover {
            box-shadow: 0 6px 22px rgba(0,0,0,0.1);
            transform: translateY(-3px);
        }

        /* LEFT: image panel */
        .service-img-wrap {
            width: 130px;
            min-width: 130px;
            flex-shrink: 0;
            overflow: hidden;
            border-radius: 14px 0 0 14px;
            background: #e9e9e9;
        }
        .service-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }
        .service-card:hover .service-img-wrap img { transform: scale(1.05); }

        /* RIGHT: content panel */
        .service-content {
            padding: 14px 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
            min-width: 0;
        }

        .service-icon { font-size: 1rem; color: #333; }
        .service-time { font-size: 0.72rem; color: #666; font-weight: 500; }
        .service-title { font-size: 1rem; font-weight: 700; margin: 6px 0 5px; }
        .service-title-hover { transition: color 0.3s ease; }
        .service-card:hover .service-title-hover { color: var(--accent, #2563eb); }
        .service-desc { font-size: 0.76rem; color: #777; margin-bottom: 12px; line-height: 1.5; }

        /* Animated runner line at bottom */
        .card-footer-price {
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        .card-footer-price::before {
            content: "";
            display: block;
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: #e5e7eb;
            border-radius: 99px;
        }
        .card-footer-price::after {
            content: "";
            display: block;
            position: absolute;
            top: 0; left: 0;
            height: 2px;
            width: 0%;
            border-radius: 99px;
            background: var(--accent, #2563eb);
            transition: width 0.65s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .service-card:hover .card-footer-price::after { width: 100%; }

        .price-text { font-weight: 700; font-size: 0.9rem; }
        .btn-spa {
            background-color: var(--dark-green);
            color: white;
            border-radius: 7px;
            padding: 5px 16px;
            font-weight: 600;
            font-size: 0.78rem;
            text-decoration: none;
            transition: background-color 0.3s, box-shadow 0.3s;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }
        .btn-spa:hover { background-color: #044923; color: white; }
        .service-card:hover .btn-spa { box-shadow: 0 4px 12px rgba(0,0,0,0.2); }

        /* Status badge */
        .status-badge {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-available { background: #e8f5e9; color: var(--status-available); }
        .status-booked    { background: #ffebee; color: var(--status-booked); }

        /* Mobile: stack image on top */
        @media (max-width: 575.98px) {
            .service-card { flex-direction: column; }
            .service-img-wrap {
                width: 100%;
                min-width: unset;
                height: 130px;
                border-radius: 14px 14px 0 0;
            }
        }

        /* ── WELLNESS PACKAGES ── */
        .packages-section { background-color: var(--light-beige); padding: 55px 0; }
        .package-card {
            background: #fff;
            border: 1px solid #ddd;
            border-top: 4px solid var(--dark-green);
            border-radius: 14px;
            padding: 26px 22px;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .package-title { font-size: 1.35rem; font-weight: 700; margin-bottom: 20px; }
        .package-list { list-style: none; padding: 0; margin-bottom: 26px; text-align: left; }
        .package-list li { padding: 6px 0; font-size: 0.82rem; border-bottom: 1px solid #eee; color: #444; }

        /* ── INLINE VALIDATION ── */
        .field-error {
            color: #e53e3e;
            font-size: 0.76rem;
            font-weight: 500;
            margin-top: 5px;
            display: none;
            align-items: center;
            gap: 5px;
        }
        .field-error.show { display: flex; }

        /* ── FOOTER ── */
        footer { background-color: #000; color: #fff; padding: 55px 40px 24px 40px; }
        .footer-logo { font-size: 1.3rem; font-weight: 800; margin-bottom: 10px; }
        .footer-desc { font-size: 0.83rem; color: #bbb; line-height: 1.6; max-width: 260px; }
        .footer-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 18px; color: #fff; font-family: 'Inter', sans-serif; }
        footer a { color: #bbb; text-decoration: none; font-size: 0.86rem; display: block; margin-bottom: 9px; transition: 0.3s; cursor: pointer; }
        footer a:hover { color: #fff; }
        .contact-info { color: #bbb; font-size: 0.86rem; line-height: 2; }
        .footer-bottom-line { border-top: 1px solid #333; margin-top: 45px; padding-top: 16px; color: #777; font-size: 0.8rem; }

        html { scroll-behavior: smooth; }

        .section-py { padding-top: 44px; padding-bottom: 44px; }
        .section-heading { font-size: clamp(1.35rem, 3.5vw, 2rem); }
    </style>
</head>
<body>

@if(session('booking_success'))
    <div id="booking-toast" class="p-toast show toast-success"
         style="position: fixed; top: 100px; right: 24px; z-index: 9999;">
        <i class="fa-solid fa-circle-check" style="font-size:1.2rem; color: var(--status-available);"></i>
        <div>
            <div class="fw-bold">Success</div>
            <div class="small text-muted">{{ session('booking_success') }}</div>
        </div>
    </div>
    <script>setTimeout(() => { document.getElementById('booking-toast').remove(); }, 6000);</script>
@endif

    <!-- NAVBAR -->
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
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('restaurant') }}">RESTAURANT</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('lodging') }}">LODGING</a></li>
                    <li class="nav-item"><a class="nav-link active-link px-3" href="{{ route('spa') }}">SPA</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('contact') }}">CONTACT</a></li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('my.bookings') }}">YOUR BOOKING</a>
                        </li>
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
                                <li><a class="dropdown-item text-danger fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Log Out</a></li>
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

    <!-- HERO -->
    <header class="spa-hero">
        <div>
            <p class="text-uppercase mb-1" style="letter-spacing: 2px; font-size: 0.75rem; font-weight: 600;">RELAX & REJUVENATE</p>
            <h1 class="fw-bold text-uppercase">Spa and Wellness</h1>
        </div>
    </header>

    <!-- SPA SERVICES — 2-column grid matching screenshot -->
    <section class="container section-py">
        <div class="text-center mb-4">
            <p class="fw-bold small text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 1px;">TREATMENTS</p>
            <h2 class="section-heading fw-bold mb-2">Our Spa Services</h2>
            <p class="text-muted mx-auto" style="max-width: 500px; font-size: 0.83rem;">
                Choose from our range of carefully designed treatments for total relaxation.
            </p>
        </div>

        <div class="row g-3">
            @php $colorIndex = 1; @endphp
            @foreach($categories as $cat)
                @if(!str_contains(strtolower($cat->name), 'package'))
                    @foreach($cat->services as $service)
                    {{-- 2 columns on md+, 1 column on mobile --}}
                    <div class="col-12 col-md-6">
                        <div class="service-card" data-color="{{ $colorIndex }}">

                            <!-- TOP: image -->
                            <div class="service-img-wrap">
                                @if($service->image)
                                     <img src="{{ asset('images/spa/' . $service->image) }}" alt="{{ $service->name }}">
                                @else
                                    <img src="{{ asset('images/spa.jpeg') }}" alt="{{ $service->name }}">
                                @endif
                            </div>

                            <!-- BOTTOM: details -->
                            <div class="service-content">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="fa-solid fa-spa service-icon"></i>
                                        <span class="service-time">
                                            <i class="fa-regular fa-clock me-1"></i>{{ $service->duration }}
                                        </span>
                                    </div>
                                    <h3 class="service-title service-title-hover">{{ $service->name }}</h3>
                                    <p class="service-desc">{{ $service->description }}</p>
                                </div>
                                <div class="card-footer-price">
                                    <span class="price-text">{{ $service->price }}</span>
                                    @auth
                                        <button class="btn-spa" onclick="openSpaBooking('{{ $service->name }}')">Book Now</button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn-spa">Book Now</a>
                                    @endauth
                                </div>
                            </div>

                        </div>
                    </div>
                    @php $colorIndex = ($colorIndex % 6) + 1; @endphp
                    @endforeach
                @endif
            @endforeach
        </div>
    </section>

    <!-- WELLNESS PACKAGES -->
    <section class="packages-section">
        <div class="container">
            <div class="text-center mb-4">
                <p class="fw-bold small text-uppercase mb-1" style="font-size: 0.72rem; letter-spacing: 1px;">SPECIAL OFFERS</p>
                <h2 class="section-heading fw-bold mb-2">Wellness Packages</h2>
            </div>
            <div class="row g-4">
                @foreach($categories as $cat)
                    @if(str_contains(strtolower($cat->name), 'package'))
                        @foreach($cat->services as $service)
                        <div class="col-md-4">
                            <div class="package-card">
                                <h3 class="package-title">{{ $service->name }}</h3>
                                <ul class="package-list">
                                    @foreach(explode(',', $service->description) as $item)
                                        <li>{{ trim($item) }}</li>
                                    @endforeach
                                </ul>
                                @auth
                                    <button class="btn-spa py-2" onclick="openSpaBooking('{{ $service->name }}')">Book Package</button>
                                @else
                                    <a href="{{ route('login') }}" class="btn-spa py-2 d-block text-center">Book Package</a>
                                @endauth
                            </div>
                        </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container-fluid">
            <div class="row g-4">
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
                        +975-17388263<br>
                        tn@gmail.com
                    </div>
                </div>
            </div>
            <div class="footer-bottom-line text-center">
                &copy; 2026 TN Multi Services. All rights reserved.
            </div>
        </div>
    </footer>

    @auth
    <!-- SPA BOOKING MODAL -->
    <div class="modal fade" id="spaBookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg" style="border-radius: 20px; padding: 28px; border: none;">
                <button type="button" class="btn-close position-absolute" style="top: 20px; right: 20px;" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-3">
                    <h2 id="modalServiceTitle" style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.7rem; color: #333;">Reserve Spa</h2>
                    <p class="text-muted" style="font-size: 0.84rem;">Date and time are required for your reservation.</p>
                </div>

                <form action="{{ isset($booking) ? route('booking.update', $booking->id) : route('book.service') }}" method="POST" id="spaForm">
                    @csrf
                    @if(isset($booking))
                        @method('PUT')
                    @endif
                    <input type="hidden" name="service_type" value="Spa">
                    <input type="hidden" name="service_name" id="hiddenSpaService" value="{{ $booking->service_name ?? '' }}">

                    <!-- Date -->
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #333; font-size: 0.92rem;">
                            Pick Date <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="date" name="booking_date" id="spaDate"
                            class="form-control"
                            style="border-radius: 9px; border: 1.5px solid #dee2e6; height: 46px;"
                            min="{{ date('Y-m-d') }}"
                            value="{{ isset($booking) ? \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') : '' }}">
                        <div class="field-error" id="dateError">
                            <i class="fa-solid fa-circle-exclamation"></i>&nbsp; Please select a date.
                        </div>
                    </div>

                    <!-- Time -->
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 500; color: #333; font-size: 0.92rem;">
                            Select Time (10AM–10PM) <span style="color: #e53e3e;">*</span>
                        </label>
                        <input type="time" name="booking_time" id="spaTime"
                            class="form-control"
                            style="border-radius: 9px; border: 1.5px solid #dee2e6; height: 46px;"
                            min="10:00" max="22:00" step="900"
                            value="{{ isset($booking) ? \Carbon\Carbon::parse($booking->booking_time)->format('H:i') : '' }}">
                        <div class="field-error" id="timeError">
                            <i class="fa-solid fa-circle-exclamation"></i>&nbsp; Please select a time between 10:00 AM – 10:00 PM.
                        </div>
                    </div>

                    <!-- Special Request -->
                    <div class="mb-4">
                        <label class="form-label" style="font-weight: 500; color: #333; font-size: 0.92rem;">
                            Special Request
                            <span style="color: #aaa; font-size: 0.76rem; font-weight: 400;">(optional)</span>
                        </label>
                        <textarea name="special_request" id="spaRequest"
                            class="form-control" rows="3"
                            placeholder="Enter any allergies or special requests…"
                            style="border-radius: 9px; border: 1.5px solid #dee2e6;">{{ $booking->special_request ?? '' }}</textarea>
                    </div>

                    <button type="button" class="btn w-100 py-2" onclick="validateSpaForm()"
                        style="background-color: #055e2d; color: white; border-radius: 10px; font-weight: 700; font-size: 1rem; border: none;">
                        {{ isset($booking) ? 'Update Reservation' : 'Confirm Reservation' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- LOGOUT MODAL -->
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
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openSpaBooking(serviceName) {
            const titleElement = document.getElementById('modalServiceTitle');
            const hiddenInput  = document.getElementById('hiddenSpaService');
            const modalElement = document.getElementById('spaBookingModal');

            if (titleElement && hiddenInput && modalElement) {
                titleElement.innerText = "Reserve " + serviceName;
                hiddenInput.value = serviceName;
                clearSpaErrors();
                new bootstrap.Modal(modalElement).show();
            }
        }

        function clearSpaErrors() {
            const dateIn  = document.getElementById('spaDate');
            const timeIn  = document.getElementById('spaTime');
            dateIn.value  = '';
            timeIn.value  = '';
            dateIn.style.border  = '1.5px solid #dee2e6';
            timeIn.style.border  = '1.5px solid #dee2e6';
            document.getElementById('dateError').classList.remove('show');
            document.getElementById('timeError').classList.remove('show');
            document.getElementById('spaRequest').value = '';
        }

        function validateSpaForm() {
            const dateIn  = document.getElementById('spaDate');
            const timeIn  = document.getElementById('spaTime');
            const dateErr = document.getElementById('dateError');
            const timeErr = document.getElementById('timeError');
            let isValid   = true;

            dateIn.style.border = '1.5px solid #dee2e6';
            timeIn.style.border = '1.5px solid #dee2e6';
            dateErr.classList.remove('show');
            timeErr.classList.remove('show');

            if (!dateIn.value.trim()) {
                dateIn.style.border = '2px solid #e53e3e';
                dateErr.classList.add('show');
                isValid = false;
            }

            if (!timeIn.value.trim()) {
                timeIn.style.border = '2px solid #e53e3e';
                timeErr.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i>&nbsp; Please select a time between 10:00 AM – 10:00 PM.';
                timeErr.classList.add('show');
                isValid = false;
            } else if (timeIn.value < "10:00" || timeIn.value > "22:00") {
                timeIn.style.border = '2px solid #e53e3e';
                timeErr.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i>&nbsp; Time must be between 10:00 AM – 10:00 PM.';
                timeErr.classList.add('show');
                isValid = false;
            }

            if (isValid) document.getElementById('spaForm').submit();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const dateIn = document.getElementById('spaDate');
            const timeIn = document.getElementById('spaTime');

            if (dateIn) {
                dateIn.addEventListener('change', function () {
                    if (this.value) {
                        this.style.border = '1.5px solid #dee2e6';
                        document.getElementById('dateError').classList.remove('show');
                    }
                });
            }

            if (timeIn) {
                timeIn.addEventListener('change', function () {
                    if (this.value) {
                        const timeErr = document.getElementById('timeError');
                        if (this.value >= "10:00" && this.value <= "22:00") {
                            this.style.border = '1.5px solid #dee2e6';
                            timeErr.classList.remove('show');
                        } else {
                            this.style.border = '2px solid #e53e3e';
                            timeErr.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i>&nbsp; Time must be between 10:00 AM – 10:00 PM.';
                            timeErr.classList.add('show');
                        }
                    }
                });
            }

            @if(isset($booking))
                new bootstrap.Modal(document.getElementById('spaBookingModal')).show();
            @endif
        });
    </script>
</body>
</html>