<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification - TN Multi Services</title>
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
            margin-top: 8px;
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

        /* Progress dots */
        .progress-dots {
            display: flex;
            gap: 5px;
            justify-content: center;
            margin-top: 22px;
            position: relative;
            z-index: 1;
        }
        .dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
        }
        .dot.active { background: #fff; width: 18px; border-radius: 4px; }

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
            margin-bottom: 26px;
            line-height: 1.6;
        }

        /* ── OTP Boxes ── */
        .otp-boxes {
            display: flex;
            gap: 9px;
            justify-content: center;
            margin-bottom: 8px;
        }
        .otp-box {
            width: 48px;
            height: 54px;
            border: 2px solid #ddd;
            border-radius: 11px;
            font-size: 1.35rem;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            color: #111;
            text-align: center;
            background: #fafafa;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            caret-color: transparent;
        }
        .otp-box:focus {
            border-color: var(--dark-green);
            box-shadow: 0 0 0 3px rgba(5, 94, 45, 0.1);
            background: #fff;
        }
        .otp-box.filled {
            border-color: var(--dark-green);
            background: #f0faf4;
        }
        .otp-box.error-box {
            border-color: #d32f2f;
            background: #fff5f5;
            animation: shake 0.4s ease;
        }
        @keyframes shake {
            0%,100% { transform: translateX(0); }
            20% { transform: translateX(-6px); }
            40% { transform: translateX(6px); }
            60% { transform: translateX(-4px); }
            80% { transform: translateX(4px); }
        }

        #otp { display: none; }

        /* Timer & resend */
        .otp-timer {
            text-align: center;
            font-size: 0.76rem;
            color: #999;
            margin-top: 6px;
            margin-bottom: 4px;
        }
        .otp-timer span { color: var(--dark-green); font-weight: 700; }

        .resend-link {
            font-size: 0.76rem;
            color: #aaa;
            text-align: center;
            margin-bottom: 20px;
            display: block;
        }
        .resend-link a {
            color: var(--dark-green);
            font-weight: 700;
            text-decoration: none;
            pointer-events: none;
            opacity: 0.4;
            transition: opacity 0.3s;
        }
        .resend-link a.active { pointer-events: auto; opacity: 1; }
        .resend-link a.active:hover { text-decoration: underline; }

        /* Buttons */
        .btn-verify {
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
            margin-top: 8px;
        }
        .btn-verify:hover {
            background: #044923;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(5, 94, 45, 0.25);
        }
        .btn-verify:active { transform: translateY(0); }

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
            .otp-boxes { gap: 7px; }
            .otp-box { width: 42px; height: 48px; font-size: 1.15rem; border-radius: 9px; }
            .step-badge { font-size: 0.7rem; padding: 5px 10px; }
        }

        @media (max-width: 380px) {
            .otp-box { width: 36px; height: 42px; font-size: 1rem; }
            .otp-boxes { gap: 5px; }
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
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h2>OTP Verification</h2>
                <p>A 6-digit code has been sent to your email. Please enter it to continue.</p>

                <div class="step-badge" style="margin-top: 24px; opacity: 0.5;">
                    <span>1</span> Enter Email
                </div>
                <div class="step-badge active-step">
                    <span style="background:#fff; color:var(--dark-green);">2</span> Enter OTP
                </div>
                <div class="step-badge" style="opacity: 0.5;">
                    <span>3</span> Reset Password
                </div>

                <div class="progress-dots">
                    <div class="dot"></div>
                    <div class="dot active"></div>
                    <div class="dot"></div>
                </div>
            </div>

            <!-- RIGHT PANEL -->
            <div class="verify-right">
                <p class="top-label">Step 2 of 3</p>
                <h1>Enter Your OTP</h1>
                <p class="subtitle">We've sent a 6-digit verification code to your registered email address. It expires in 10 minutes.</p>

                @if($errors->has('otp'))
                    <div class="alert-custom">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first('otp') }}
                    </div>
                @endif

                <form action="{{ route('otp.check') }}" method="POST" id="otpForm">
                    @csrf
                    <input type="text" name="otp" id="otp" required>

                    <div class="otp-boxes" id="otpBoxes">
                        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" autocomplete="off" data-index="0">
                        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" autocomplete="off" data-index="1">
                        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" autocomplete="off" data-index="2">
                        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" autocomplete="off" data-index="3">
                        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" autocomplete="off" data-index="4">
                        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" autocomplete="off" data-index="5">
                    </div>

                    <div class="otp-timer">Code expires in <span id="countdown">10:00</span></div>
                    <span class="resend-link">
                        Didn't receive it?
                        <a href="{{ route('otp.send') }}" id="resendLink">Resend OTP</a>
                    </span>

                    <button type="submit" class="btn-verify" id="verifyBtn">
                        <i class="fa-solid fa-circle-check"></i> Verify OTP
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
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        const boxes    = document.querySelectorAll('.otp-box');
        const hidden   = document.getElementById('otp');
        const form     = document.getElementById('otpForm');
        const verifyBtn = document.getElementById('verifyBtn');

        function syncHidden() {
            hidden.value = [...boxes].map(b => b.value).join('');
            boxes.forEach(b => b.classList.toggle('filled', b.value !== ''));
        }

        boxes.forEach((box, idx) => {
            box.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace') {
                    if (box.value) {
                        box.value = '';
                        syncHidden();
                    } else if (idx > 0) {
                        boxes[idx - 1].focus();
                        boxes[idx - 1].value = '';
                        syncHidden();
                    }
                    e.preventDefault();
                }
                if (e.key === 'ArrowLeft'  && idx > 0) boxes[idx - 1].focus();
                if (e.key === 'ArrowRight' && idx < 5) boxes[idx + 1].focus();
            });

            box.addEventListener('input', (e) => {
                const val = e.target.value.replace(/\D/g, '');
                box.value = val.slice(-1);
                syncHidden();
                if (val && idx < 5) boxes[idx + 1].focus();
            });

            box.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasted = (e.clipboardData || window.clipboardData)
                                .getData('text').replace(/\D/g, '').slice(0, 6);
                pasted.split('').forEach((ch, i) => { if (boxes[i]) boxes[i].value = ch; });
                syncHidden();
                boxes[Math.min(pasted.length, 5)].focus();
            });

            box.addEventListener('keypress', (e) => {
                if (!/[0-9]/.test(e.key)) e.preventDefault();
            });
        });

        boxes[0].focus();

        form.addEventListener('submit', (e) => {
            syncHidden();
            if (hidden.value.length < 6) {
                e.preventDefault();
                boxes.forEach(b => b.classList.add('error-box'));
                setTimeout(() => boxes.forEach(b => b.classList.remove('error-box')), 600);
                return;
            }
            verifyBtn.disabled = true;
            verifyBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Verifying...';
        });

        /* Countdown */
        const resendLink = document.getElementById('resendLink');
        let seconds = 600;
        const tick = setInterval(() => {
            seconds--;
            if (seconds <= 0) {
                clearInterval(tick);
                document.getElementById('countdown').textContent = '00:00';
                resendLink.classList.add('active');
                return;
            }
            const m = String(Math.floor(seconds / 60)).padStart(2, '0');
            const s = String(seconds % 60).padStart(2, '0');
            document.getElementById('countdown').textContent = `${m}:${s}`;
        }, 1000);

    });
    </script>
</body>
</html>