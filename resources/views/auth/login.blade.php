<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TN Multi Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 0.88rem;
            background: url("{{ asset('images/login.jpeg') }}") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            overflow-x: hidden;
        }

        *, *::before, *::after { box-sizing: border-box; }

        h1, h2, h3, h4, .form-label {
            font-family: 'Playfair Display', serif;
        }

        .navbar {
            background-color: rgb(255, 255, 255) !important;
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
        .active-link { opacity: 1 !important; font-weight: 700; }

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

        .login-container {
            margin-top: 100px;
            margin-bottom: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .form-header h2 {
            font-size: clamp(1.6rem, 4vw, 2.4rem);
            font-weight: 800;
            margin-bottom: 5px;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .form-header p {
            font-style: italic;
            color: #f0f0f0;
            font-size: 0.83rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .login-card {
            width: 100%;
            max-width: 520px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.15);
        }

        @media (max-width: 575.98px) {
            .login-card { padding: 24px 18px; }
            .login-container { margin-top: 85px; }
        }

        .form-label {
            font-weight: 600;
            font-size: 0.88rem;
            margin-bottom: 6px;
            margin-top: 12px;
            display: block;
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .form-control {
            height: 44px;
            border-radius: 9px !important;
            padding: 10px 12px;
            border: 1.5px solid rgba(255, 255, 255, 0.5) !important;
            margin-bottom: 4px;
            font-size: 0.88rem;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #3399ff !important;
            box-shadow: 0 0 0 3px rgba(51, 153, 255, 0.25) !important;
            outline: none;
            background: rgba(255, 255, 255, 1);
        }

        .password-wrapper { position: relative; width: 100%; }
        .toggle-icon {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #333;
            z-index: 10;
            font-size: 0.9rem;
        }
        .password-wrapper .form-control { padding-right: 40px; }
        input::-ms-reveal, input::-ms-clear { display: none; }

        .forgot-link {
            text-decoration: none;
            color: #f0f0f0;
            font-size: 0.82rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            font-family: 'Poppins', sans-serif;
        }
        .forgot-link:hover { color: #fff; }

        .btn-signin {
            background-color: #055e2d;
            color: white;
            border: none;
            width: 100%;
            padding: 11px;
            font-size: 1rem;
            border-radius: 10px;
            font-weight: 700;
            margin-top: 10px;
            transition: background 0.3s, transform 0.2s;
            cursor: pointer;
            font-family: 'Playfair Display', serif;
        }

        .btn-signin:hover {
            background-color: #044923;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 102, 51, 0.4);
        }

        .register-text {
            text-align: center;
            margin-top: 16px;
            font-size: 0.88rem;
            color: #f0f0f0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        .register-text a { color: #fff; text-decoration: none; font-weight: 600; }
        .register-text a:hover { text-decoration: underline; }

        .error-msg {
            color: #ffcccc;
            font-size: 0.83rem;
            margin-bottom: 14px;
            list-style: none;
            padding: 10px 14px;
            border-radius: 8px;
            background: rgba(220, 53, 69, 0.3);
            backdrop-filter: blur(5px);
        }
        .error-msg li { margin-bottom: 4px; }
        .error-msg li:last-child { margin-bottom: 0; }

        html { scroll-behavior: smooth; }

        /* ── Divider ── */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 22px 0 18px;
            color: rgba(255,255,255,0.7);
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            font-family: 'Poppins', sans-serif;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        }
        .divider:not(:empty)::before { margin-right: 0.75em; }
        .divider:not(:empty)::after  { margin-left: 0.75em; }

        /* ── Google Button ── */
        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center; /* centers the inner group */
            width: 100%;
            padding: 11px 16px;
            background-color: #ffffff;
            color: #3c3c3c;
            border: 1.5px solid #dadce0;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.92rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .btn-google:hover {
            background-color: #f8f8f8;
            border-color: #c5c8cc;
            color: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.18);
            text-decoration: none;
        }

        .btn-google:active {
            transform: translateY(0px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }

        /* Inner group — icon + text sit together, centered as one unit */
        .btn-google .google-inner {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-google .google-inner svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
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
                    <a href="{{ route('login') }}" class="nav-link px-3 active-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link p-0">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ══ LOGIN CONTENT ══ -->
    <div class="container login-container">
        <div class="form-header">
            <h2>Welcome Back</h2>
            <p>Login to book rooms, tables and spa appointments.</p>
        </div>

        <div class="login-card">
            @if ($errors->any())
                <ul class="error-msg">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control w-100"
                        value="{{ old('email') }}" required autofocus placeholder="example@gmail.com">
                </div>

                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label mb-0">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                        @endif
                    </div>
                    <div class="password-wrapper" style="margin-top: 6px;">
                        <input type="password" name="password" id="passwordField" class="form-control w-100" required>
                        <i class="fa-solid fa-eye-slash toggle-icon" onclick="togglePass('passwordField', this)"></i>
                    </div>
                </div>

                <button type="submit" class="btn-signin">Sign In</button>

                <div class="divider">or continue with</div>

                <!-- ── Google Button: icon + text centered together ── -->
                <a href="{{ route('google.login') }}" class="btn-google">
                    <div class="google-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                            <path fill="none" d="M0 0h48v48H0z"/>
                        </svg>
                        <span>Google</span>
                    </div>
                </a>

                <p class="register-text">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePass(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                input.type = "password";
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    </script>
</body>
</html>