<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TN Multi Services</title>
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

        /* ── Navbar (matches contact page) ── */
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

        /* ── Register layout ── */
        .register-container { 
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

        .register-card { 
            width: 100%; 
            max-width: 600px; 
            border: 1px solid rgba(255, 255, 255, 0.3); 
            border-radius: 20px; 
            padding: 36px 32px; 
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.15);
        }

        @media (max-width: 575.98px) {
            .register-card { padding: 24px 18px; }
            .register-container { margin-top: 85px; }
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
        
        .form-control, .form-select { 
            height: 44px;
            border-radius: 9px !important; 
            padding: 10px 12px; 
            border: 1.5px solid rgba(255, 255, 255, 0.5) !important; 
            margin-bottom: 4px;
            font-size: 0.88rem;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus, .form-select:focus { 
            border-color: #3399ff !important; 
            box-shadow: 0 0 0 3px rgba(51, 153, 255, 0.25) !important; 
            outline: none; 
            background: rgba(255, 255, 255, 1);
        }

        /* Phone row responsive */
        .phone-row {
            display: flex;
            gap: 8px;
            align-items: stretch;
        }
        .phone-row .form-select {
            width: 180px;
            flex-shrink: 0;
        }
        .phone-row .form-control {
            flex: 1;
            min-width: 0;
        }

        @media (max-width: 400px) {
            .phone-row { flex-direction: column; }
            .phone-row .form-select { width: 100%; }
        }

        /* Password eye */
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

        .btn-create { 
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
        
        .btn-create:hover { 
            background-color: #044923; 
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 102, 51, 0.4);
        }

        .signin-text { 
            text-align: center; 
            margin-top: 16px; 
            font-size: 0.88rem; 
            color: #f0f0f0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        .signin-text a { color: #fff; text-decoration: none; font-weight: 600; }
        .signin-text a:hover { text-decoration: underline; }

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

        /* Phone help/error — only one shows at a time */
        #phone_help {
            font-size: 0.74rem;
            color: #f0f0f0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            margin-top: 4px;
            display: block;
        }

        #phone_error {
            display: none;
            font-size: 0.74rem;
            color: #ffcccc;
            margin-top: 4px;
        }

        html { scroll-behavior: smooth; }
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
                    <a href="{{ route('login') }}" class="nav-link px-3">Login</a>
                    <a href="{{ route('register') }}" class="nav-link p-0 active-link">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ══ REGISTER CONTENT ══ -->
    <div class="container register-container">
        <div class="form-header">
            <h2>Create Your Account</h2>
        </div>

        <div class="register-card">
            @if ($errors->any())
                <ul class="error-msg">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6 col-12">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control w-100" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control w-100" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control w-100" value="{{ old('email') }}" required placeholder="example@gmail.com">
                </div>

                <div>
                    <label class="form-label">WhatsApp Number</label>
                    <div class="phone-row">
                        <select id="country_code" name="country_code" class="form-select">
                            <option value="975" selected>Bhutan (+975)</option>
                            <option value="91">India (+91)</option>
                            <option value="977">Nepal (+977)</option>
                            <option value="880">Bangladesh (+880)</option>
                            <option value="94">Sri Lanka (+94)</option>
                            <option value="960">Maldives (+960)</option>
                            <option value="66">Thailand (+66)</option>
                            <option value="65">Singapore (+65)</option>
                            <option value="60">Malaysia (+60)</option>
                            <option value="1">USA (+1)</option>
                            <option value="44">UK (+44)</option>
                            <option value="81">Japan (+81)</option>
                            <option value="82">South Korea (+82)</option>
                        </select>
                        <input id="phone_number" class="form-control" type="text" name="phone_number"
                            value="{{ old('phone_number') }}" required placeholder="XXXXXXXX"
                            onkeypress="return isNumber(event)" maxlength="8" />
                    </div>
                    <small id="phone_help">Bhutan: starts with 17, 16, or 77 — exactly 8 digits.</small>
                    <div id="phone_error"></div>
                </div>

                <label class="form-label">Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="regPass" class="form-control w-100" required>
                    <i class="fa-solid fa-eye-slash toggle-icon" onclick="togglePass('regPass', this)"></i>
                </div>

                <label class="form-label">Confirm Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password_confirmation" id="confirmPass" class="form-control w-100" required>
                    <i class="fa-solid fa-eye-slash toggle-icon" onclick="togglePass('confirmPass', this)"></i>
                </div>

                <button type="submit" class="btn-create">Create Account</button>
                
                <p class="signin-text">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ── Phone rules per country code ──
        const phoneRules = {
            "975": {
                pattern: /^(17|16|77)\d+$/,
                length: 8,
                placeholder: "XXXXXXXX",
                help: "Bhutan: starts with 17, 16, or 77 — exactly 8 digits."
            },
            "91": {
                pattern: /^[6-9]\d+$/,
                length: 10,
                placeholder: "XXXXXXXXXX",
                help: "India: starts with 6–9 — exactly 10 digits."
            },
            "977": {
                pattern: /^(97|98)\d+$/,
                length: 10,
                placeholder: "XXXXXXXXXX",
                help: "Nepal: starts with 97 or 98 — exactly 10 digits."
            },
            "880": {
                pattern: /^01\d+$/,
                length: 11,
                placeholder: "XXXXXXXXXXX",
                help: "Bangladesh: starts with 01 — exactly 11 digits."
            },
            "94": {
                pattern: /^07\d+$/,
                length: 10,
                placeholder: "XXXXXXXXXX",
                help: "Sri Lanka: starts with 07 — exactly 10 digits."
            },
            "960": {
                pattern: /^[79]\d+$/,
                length: 7,
                placeholder: "XXXXXXX",
                help: "Maldives: starts with 7 or 9 — exactly 7 digits."
            },
            "66": {
                pattern: /^0[689]\d+$/,
                length: 10,
                placeholder: "XXXXXXXXXX",
                help: "Thailand: starts with 06, 08, or 09 — exactly 10 digits."
            },
            "65": {
                pattern: /^[89]\d+$/,
                length: 8,
                placeholder: "XXXXXXXX",
                help: "Singapore: starts with 8 or 9 — exactly 8 digits."
            },
            "60": {
                pattern: /^01\d+$/,
                lengthMin: 10,
                lengthMax: 11,
                placeholder: "XXXXXXXXXXX",
                help: "Malaysia: starts with 01 — 10 to 11 digits."
            },
            "1": {
                pattern: /^[2-9]\d+$/,
                length: 10,
                placeholder: "XXXXXXXXXX",
                help: "USA: starts with 2–9 — exactly 10 digits."
            },
            "44": {
                pattern: /^07\d+$/,
                length: 11,
                placeholder: "XXXXXXXXXXX",
                help: "UK: starts with 07 — exactly 11 digits."
            },
            "81": {
                pattern: /^0[789]\d+$/,
                length: 11,
                placeholder: "XXXXXXXXXXX",
                help: "Japan: starts with 07, 08, or 09 — exactly 11 digits."
            },
            "82": {
                pattern: /^01\d+$/,
                length: 11,
                placeholder: "XXXXXXXXXXX",
                help: "South Korea: starts with 01 — exactly 11 digits."
            }
        };

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

        const countrySelect = document.getElementById('country_code');
        const phoneInput    = document.getElementById('phone_number');
        const phoneHelp     = document.getElementById('phone_help');
        const phoneError    = document.getElementById('phone_error');

        function isNumber(evt) {
            evt = evt || window.event;
            var charCode = evt.which ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
            return true;
        }

        function applyRules(code) {
            const rule = phoneRules[code];
            phoneInput.value = "";
            phoneError.style.display = "none";
            phoneHelp.style.display = "block";   // show help text when country changes
            if (rule) {
                const maxLen = rule.length || rule.lengthMax;
                phoneInput.maxLength = maxLen;
                phoneInput.placeholder = rule.placeholder;
                phoneHelp.innerText = rule.help;
            } else {
                phoneInput.maxLength = 15;
                phoneInput.placeholder = "XXXXXXXXXXXXXXX";
                phoneHelp.innerText = "Enter your mobile number.";
            }
        }

        function validatePhone() {
            const code = countrySelect.value;
            const val  = phoneInput.value.trim();
            const rule = phoneRules[code];

            if (!rule) return true; // no rule defined, allow

            // Check length
            if (rule.length && val.length !== rule.length) {
                showPhoneError(rule.help);
                return false;
            }
            if (rule.lengthMin && (val.length < rule.lengthMin || val.length > rule.lengthMax)) {
                showPhoneError(rule.help);
                return false;
            }

            // Check prefix pattern
            if (!rule.pattern.test(val)) {
                showPhoneError(rule.help);
                return false;
            }

            // Valid — hide error, show help
            phoneError.style.display = "none";
            phoneHelp.style.display = "block";
            return true;
        }

        function showPhoneError(msg) {
            // Show error, hide help so there's no duplicate
            phoneHelp.style.display = "none";
            phoneError.innerText = "⚠ " + msg;
            phoneError.style.display = "block";
        }

        countrySelect.addEventListener('change', function () {
            applyRules(this.value);
        });

        phoneInput.addEventListener('blur', validatePhone);

        phoneInput.addEventListener('input', function () {
            if (phoneError.style.display === "block") validatePhone();
        });

        document.getElementById('registerForm').addEventListener('submit', function (e) {
            if (!validatePhone()) {
                e.preventDefault();
                phoneInput.focus();
            }
        });

        // Init on load
        window.onload = function () {
            applyRules(countrySelect.value);
        };
    </script>
</body>
</html>