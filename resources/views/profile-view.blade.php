<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Profile - TN Multi Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --custom-grey: #fff;
            --dark-green: #055e2d;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            min-height: 100vh;
            font-size: 0.88rem;
        }

        h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }

        /* ── NAVBAR — matches lodging page exactly ── */
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

        .nav-link { font-size: 0.88rem; font-weight: 600; color: #000 !important; opacity: 0.45; transition: opacity 0.3s; text-decoration: none !important; }
        .nav-link:hover { opacity: 1; }
        .nav-link.active-link { color: #000 !important; opacity: 1 !important; font-weight: 700; text-decoration: none !important; }

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
        .dropdown-item.logout { color: #ff4d4d; }

        /* ── PAGE WRAPPER ── */
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 90px 20px 50px;
        }

        /* ── SPLIT CARD ── */
        .profile-wrapper {
            display: flex;
            width: 100%;
            max-width: 860px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 16px 48px rgba(0,0,0,0.12);
        }

        /* ── LEFT GREEN PANEL ── */
        .profile-left {
            background: linear-gradient(160deg, #055e2d 0%, #088a42 100%);
            width: 34%;
            padding: 38px 28px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }
        .profile-left::before {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            top: -55px; left: -55px;
        }
        .profile-left::after {
            content: '';
            position: absolute;
            width: 140px; height: 140px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            bottom: -35px; right: -35px;
        }
        .avatar-circle {
            width: 82px; height: 82px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }
        .avatar-circle i { font-size: 2.3rem; color: #fff; }

        .profile-left h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }
        .profile-left p.tagline-left {
            font-size: 0.78rem;
            opacity: 0.85;
            line-height: 1.6;
            position: relative;
            z-index: 1;
            font-style: italic;
        }

        .info-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border-radius: 50px;
            padding: 8px 14px;
            font-size: 0.76rem;
            font-weight: 500;
            margin-top: 10px;
            width: 100%;
            position: relative;
            z-index: 1;
            text-align: left;
            word-break: break-word;
        }
        .info-pill i {
            font-size: 0.82rem;
            width: 14px;
            flex-shrink: 0;
            opacity: 0.9;
        }

        /* ── RIGHT WHITE PANEL ── */
        .profile-right {
            background: #fff;
            width: 66%;
            padding: 38px 40px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .top-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--dark-green);
            margin-bottom: 4px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.65rem;
            font-weight: 800;
            color: #111;
            margin-bottom: 4px;
            line-height: 1.2;
        }
        .tagline {
            color: #999;
            font-size: 0.8rem;
            font-style: italic;
            margin-bottom: 22px;
        }

        .section-divider {
            border: none;
            border-top: 1px solid #f0f0f0;
            margin: 14px 0;
        }
        .section-heading {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #bbb;
            margin-bottom: 12px;
        }

        /* ── INFO ROWS ── */
        .info-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 10px;
            background: #fafafa;
            border: 1.5px solid #f0f0f0;
            margin-bottom: 10px;
        }
        .info-row .row-icon {
            color: #ccc;
            font-size: 0.9rem;
            width: 16px;
            flex-shrink: 0;
        }
        .info-row .row-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #bbb;
            display: block;
            margin-bottom: 1px;
        }
        .info-row .row-value {
            font-size: 0.86rem;
            font-weight: 600;
            color: #222;
        }

        .role-badge {
            display: inline-block;
            padding: 2px 12px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
            background: rgba(5, 94, 45, 0.1);
            color: var(--dark-green);
            letter-spacing: 0.5px;
        }

        /* ── EDIT BUTTON ── */
        .btn-edit-profile {
            width: 100%;
            background: var(--dark-green);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 6px;
            text-decoration: none;
        }
        .btn-edit-profile:hover {
            background: #044923;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(5, 94, 45, 0.25);
            color: #fff;
        }
        .btn-edit-profile:active { transform: translateY(0); }

        /* ── MODAL ── */
        .modal-content {
            border-radius: 22px;
            padding: 18px;
            border: none;
            box-shadow: 0 16px 50px rgba(0,0,0,0.15);
        }


        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .profile-wrapper { flex-direction: column; border-radius: 18px; }
            .profile-left { width: 100%; padding: 32px 24px; }
            .profile-right { width: 100%; padding: 30px 22px; }
            .page-title { font-size: 1.35rem; }
        }

        html { scroll-behavior: smooth; }
    </style>
</head>
<body>

    <!-- ══ NAVBAR — same as lodging page ══ -->
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
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('spa') }}">SPA</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('contact') }}">CONTACT</a></li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link px-3" href="{{ route('my.bookings') }}">YOUR BOOKING</a>
                        </li>
                    @endauth
                </ul>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-circle-user profile-icon-nav"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item fw-bold" href="{{ route('custom.profile.show') }}">Profile Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger fw-bold logout" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <div class="page-wrapper">
        <div class="profile-wrapper">

            <!-- ── LEFT GREEN PANEL ── -->
            <div class="profile-left">
                <div class="avatar-circle">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                <h2>Your Profile</h2>
                <p class="tagline-left">Your profile says more than your words.</p>

                <div class="info-pill">
                    <i class="fa-solid fa-user"></i>
                    {{ ucwords(strtolower(Auth::user()->first_name)) }} {{ ucwords(strtolower(Auth::user()->last_name)) }}
                </div>
                <div class="info-pill">
                    <i class="fa-solid fa-envelope"></i>
                    {{ Auth::user()->email }}
                </div>
                @if(Auth::user()->phone)
                <div class="info-pill">
                    <i class="fa-solid fa-phone"></i>
                    {{ Auth::user()->phone }}
                </div>
                @endif
            </div>

            <!-- ── RIGHT WHITE PANEL ── -->
            <div class="profile-right">

                <p class="top-label">Account Overview</p>
                <h1 class="page-title">Your Profile</h1>
                <p class="tagline">Here's what we know about you.</p>

                <!-- Personal Info -->
                <p class="section-heading">Personal Information</p>

                <div class="info-row">
                    <i class="fa-solid fa-user row-icon"></i>
                    <div>
                        <span class="row-label">Full Name</span>
                        <span class="row-value">{{ ucwords(strtolower(Auth::user()->first_name)) }} {{ ucwords(strtolower(Auth::user()->last_name)) }}</span>
                    </div>
                </div>

                <hr class="section-divider">
                <p class="section-heading">Contact Details</p>

                <div class="info-row">
                    <i class="fa-solid fa-envelope row-icon"></i>
                    <div>
                        <span class="row-label">Email</span>
                        <span class="row-value">{{ Auth::user()->email }}</span>
                    </div>
                </div>

                <div class="info-row">
                    <i class="fa-solid fa-phone row-icon"></i>
                    <div>
                        <span class="row-label">WhatsApp Number</span>
                        <span class="row-value">{{ Auth::user()->phone ?? 'Not provided' }}</span>
                    </div>
                </div>

                <hr class="section-divider">
                <p class="section-heading">Account</p>

                <div class="info-row">
                    <i class="fa-solid fa-shield-halved row-icon"></i>
                    <div>
                        <span class="row-label">Role</span>
                        <span class="row-value">
                            <span class="role-badge">
                                {{ Auth::user()->usertype == '1' ? 'Admin' : 'User' }}
                            </span>
                        </span>
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <a href="{{ route('custom.profile.edit') }}" class="btn-edit-profile">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Profile
                </a>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>