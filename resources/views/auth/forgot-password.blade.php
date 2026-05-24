<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - TN Multi Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --dark-green: #055e2d;
            --light-green: #e8f5ee;
            --custom-grey: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 0.88rem;
            background-color: #f4f4f4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* ── Navbar (matches contact page) ── */
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
        .nav-link.active-link { color: #000 !important; opacity: 1 !important; font-weight: 700; text-decoration: none !important; }
        .nav-link { font-size: 0.88rem; font-weight: 600; color: #000 !important; opacity: 0.45; transition: opacity 0.3s; text-decoration: none !important; }
        .nav-link:hover { opacity: 1; }

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
            .navbar-collapse .d-flex { margin-top: 10px; padding-top: 10px; border-top: 1px solid rgba(0,0,0,0.1); }
        }

        .profile-icon-nav { font-size: 1.6rem; color: #000; cursor: pointer; }
        .dropdown-toggle::after { display: none; }
        .dropdown-menu { border-radius: 16px; padding: 12px 0; border: 1px solid #ddd; box-shadow: 0 4px 15px rgba(0,0,0,0.1); min-width: 150px; margin-top: 12px !important; }
        .dropdown-item { font-weight: 600; padding: 8px 22px; color: #333; font-size: 0.88rem; }

        /* ── Page body ── */
        .page-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 16px;
            margin-top: 60px;
        }

        /* Split card */
        .verify-wrapper {
            display: flex;
            width: 100%;
            max-width: 780px;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 14px 45px rgba(0,0,0,0.11);
        }

        /* Left green panel */
        .verify-left {
            background: linear-gradient(160deg, #055e2d 0%, #088a42 100%);
            width: 38%;
            padding: 38px 26px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .verify-left::before {
            content: '';
            position: absolute;
            width: 180px; height: 180px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            top: -50px; left: -50px;
        }
        .verify-left::after {
            content: '';
            position: absolute;
            width: 130px; height: 130px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            bottom: -35px; right: -35px;
        }

        .icon-wrap {
            width: 72px; height: 72px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }
        .icon-wrap i { font-size: 1.7rem; color: #fff; }

        .verify-left h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }
        .verify-left p {
            font-size: 0.78rem;
            opacity: 0.85;
            line-height: 1.65;
            position: relative;
            z-index: 1;
        }

        .step-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255,255,255,0.15);
            border-radius: 50px;
            padding: 6px 14px;
            font-size: 0.74rem;
            font-weight: 600;
            margin-top: 20px;
            position: relative;
            z-index: 1;
            width: 100%;
            justify-content: center;
        }
        .step-badge span {
            width: 19px; height: 19px;
            background: #fff;
            color: var(--dark-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
        }
        .step-badge.active-step {
            background: rgba(255,255,255,0.30);
            box-shadow: 0 0 0 2px rgba(255,255,255,0.5);
        }

        /* Right white panel */
        .verify-right {
            background: #fff;
            width: 62%;
            padding: 40px 36px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .verify-right .top-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--dark-green);
            margin-bottom: 6px;
        }
        .verify-right h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.35rem, 3vw, 1.75rem);
            font-weight: 800;
            color: #111;
            margin-bottom: 6px;
            line-height: 1.2;
        }
        .verify-right .subtitle {
            color: #888;
            font-size: 0.8rem;
            margin-bottom: 22px;
            line-height: 1.6;
        }

        /* Input group */
        .input-group-custom {
            position: relative;
            margin-bottom: 8px;
        }
        .input-group-custom .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 0.88rem;
            pointer-events: none;
        }
        .input-group-custom input {
            width: 100%;
            padding: 10px 12px 10px 38px;
            border: 1.5px solid #ddd;
            border-radius: 9px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.88rem;
            color: #333;
            background: #fafafa;
            transition: border-color 0.25s, box-shadow 0.25s;
            outline: none;
            height: 44px;
        }
        .input-group-custom input:focus {
            border-color: var(--dark-green);
            box-shadow: 0 0 0 3px rgba(5, 94, 45, 0.08);
            background: #fff;
        }

        .form-label-custom {
            font-size: 0.83rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
            display: block;
        }

        /* Buttons */
        .btn-send {
            width: 100%;
            background: var(--dark-green);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 11px;
            font-size: 0.88rem;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 18px;
        }
        .btn-send:hover {
            background: #044923;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(5, 94, 45, 0.25);
        }
        .btn-send:active { transform: translateY(0); }

        .btn-back-login {
            width: 100%;
            background: transparent;
            color: #555;
            border: 1.5px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            font-size: 0.83rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
            text-decoration: none;
        }
        .btn-back-login:hover {
            border-color: #aaa;
            color: #222;
            background: #f5f5f5;
        }

        /* Alert */
        .alert-custom {
            background: #fff0f0;
            border: 1px solid #f5c6cb;
            border-left: 4px solid #d32f2f;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.8rem;
            color: #c0392b;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }

        /* ── Responsive ── */
        @media (max-width: 600px) {
            .verify-wrapper { flex-direction: column; border-radius: 18px; }
            .verify-left { width: 100%; padding: 28px 20px; }
            .verify-left h2 { font-size: 1.1rem; }
            .verify-right { width: 100%; padding: 28px 20px; }
            .verify-right h1 { font-size: 1.3rem; }
            .step-badge { font-size: 0.7rem; padding: 5px 10px; margin-top: 10px; }
        }
    </style>
</head>
<body>

    <!-- ══ NAVBAR ══ -->
    <nav class="navbar navbar-expand-lg fixed-top border-bottom">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="TN Logo" class="brand-logo" width="52" height="52">
                <span class="brand-text">TN Multi Services</span>
            </a>

            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="{{ url('/') }}">HOME</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('restaurant') }}">RESTAURANT</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('lodging') }}">LODGING</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('spa') }}">SPA</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('contact') }}">CONTACT</a></li>
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

    <!-- ══ PAGE BODY ══ -->
    <div class="page-body">
        <div class="verify-wrapper">

            <!-- LEFT PANEL -->
            <div class="verify-left">
                <div class="icon-wrap">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <h2>Verify Your Email</h2>
                <p>We'll send a one-time password to your registered email address to confirm your identity.</p>

                <div class="step-badge active-step">
                    <span style="background:#fff; color:var(--dark-green);">1</span> Enter Email
                </div>
                <div class="step-badge" style="margin-top: 8px; opacity: 0.5;">
                    <span>2</span> Enter OTP
                </div>
                <div class="step-badge" style="margin-top: 8px; opacity: 0.5;">
                    <span>3</span> Reset Password
                </div>
            </div>

            <!-- RIGHT PANEL -->
            <div class="verify-right">
                <p class="top-label">Account Recovery</p>
                <h1>Email Verification</h1>
                <p class="subtitle">Enter the email address linked to your account and we'll send you a verification code.</p>

                @if($errors->has('email'))
                    <div class="alert-custom">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form action="{{ route('otp.send') }}" method="POST">
                    @csrf
                    <label class="form-label-custom">Email Address <span style="color:#e53e3e;">*</span></label>
                    <div class="input-group-custom">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                            autocomplete="email"
                        >
                    </div>

                    <button type="submit" class="btn-send">
                        <i class="fa-solid fa-paper-plane"></i> Send OTP
                    </button>
                </form>

                <a href="{{ route('login') }}" class="btn-back-login">
                    <i class="fa-solid fa-arrow-left"></i> Back to Login
                </a>
            </div>

        </div>
    </div>

    <!-- ══ LOGOUT MODAL (smaller) ══ -->
    @auth
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content text-center shadow-lg" style="border-radius: 20px; padding: 20px;">
                <h2 style="font-family:'Playfair Display',serif; font-size:1.3rem; margin-bottom:6px;">Log Out</h2>
                <p class="text-muted mb-3" style="font-size:0.83rem;">Are you sure you want to log out?</p>
                <div class="d-flex justify-content-center gap-2">
                    <button class="btn btn-light rounded-pill px-3" style="font-size:0.83rem;" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-pill px-3 text-white" style="font-size:0.83rem;">Yes, Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>