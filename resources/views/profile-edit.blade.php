<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - TN Multi Services</title>
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

        /* ── NAVBAR ── */
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
        .edit-wrapper {
            display: flex;
            width: 100%;
            max-width: 950px;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        }

        /* ── LEFT GREEN PANEL ── */
        .edit-left {
            background: linear-gradient(160deg, #055e2d 0%, #088a42 100%);
            width: 36%;
            padding: 50px 35px;
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
        .edit-left::before {
            content: '';
            position: absolute;
            width: 220px; height: 220px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            top: -60px; left: -60px;
        }
        .edit-left::after {
            content: '';
            position: absolute;
            width: 160px; height: 160px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            bottom: -40px; right: -40px;
        }
        .edit-left .avatar-circle {
            width: 100px; height: 100px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
            position: relative;
            z-index: 1;
        }
        .edit-left .avatar-circle i { font-size: 2.8rem; color: #fff; }
        .edit-left h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }
        .edit-left p {
            font-size: 0.82rem;
            opacity: 0.85;
            line-height: 1.7;
            position: relative;
            z-index: 1;
            font-style: italic;
        }

        .info-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.12);
            border-radius: 50px;
            padding: 10px 18px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 14px;
            width: 100%;
            position: relative;
            z-index: 1;
            text-align: left;
        }
        .info-pill i { font-size: 0.9rem; width: 16px; flex-shrink: 0; opacity: 0.9; }

        /* ── RIGHT WHITE PANEL ── */
        .edit-right {
            background: #fff;
            width: 64%;
            padding: 50px 48px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .btn-cancel-x {
            position: absolute;
            top: 22px;
            right: 22px;
            background: none;
            border: none;
            font-size: 1.6rem;
            color: #bbb;
            cursor: pointer;
            transition: color 0.2s;
            z-index: 10;
            line-height: 1;
        }
        .btn-cancel-x:hover { color: #333; }

        .top-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--dark-green);
            margin-bottom: 6px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            font-weight: 800;
            color: #111;
            margin-bottom: 6px;
            line-height: 1.2;
        }
        .tagline {
            color: #999;
            font-size: 0.85rem;
            font-style: italic;
            margin-bottom: 30px;
        }

        .section-divider { border: none; border-top: 1px solid #f0f0f0; margin: 20px 0; }
        .section-heading {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #bbb;
            margin-bottom: 16px;
        }

        /* ── FORM FIELDS ── */
        .field-label { font-size: 0.82rem; font-weight: 600; color: #555; margin-bottom: 7px; display: block; }
        .field-label .required-star { color: #e53e3e; margin-left: 3px; display: none; }
        .field-label .required-star.visible { display: inline; }

        .input-wrap { position: relative; margin-bottom: 18px; }
        .input-wrap .input-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: #ccc; font-size: 0.9rem; pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border: 1.5px solid #e8e8e8;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            color: #333;
            background: #fafafa;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
        }
        .input-wrap input:focus {
            border-color: var(--dark-green);
            box-shadow: 0 0 0 4px rgba(5, 94, 45, 0.08);
            background: #fff;
        }
        .input-wrap input.has-eye { padding-right: 44px; }
        .input-wrap input.password-required { border-color: #f0a500; background: #fffdf5; }
        .input-wrap input.password-required:focus { border-color: #f0a500; box-shadow: 0 0 0 4px rgba(240,165,0,0.10); }
        .input-wrap input.input-error { border-color: #e53e3e !important; box-shadow: 0 0 0 4px rgba(229,62,62,0.08) !important; }
        .input-wrap input.input-valid { border-color: var(--dark-green) !important; box-shadow: 0 0 0 4px rgba(5,94,45,0.08) !important; }

        .toggle-icon {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            cursor: pointer; color: #ccc; font-size: 0.95rem; z-index: 5; transition: color 0.2s;
        }
        .toggle-icon:hover { color: var(--dark-green); }
        input::-ms-reveal, input::-ms-clear { display: none; }

        .email-error {
            font-size: 0.75rem; color: #e53e3e;
            margin-top: -12px; margin-bottom: 18px; padding-left: 2px;
            display: none; align-items: center; gap: 5px;
        }
        .email-error.show { display: flex; }
        .email-error i { font-size: 0.7rem; }

        .password-notice {
            font-size: 0.78rem; margin-top: -12px; margin-bottom: 18px;
            padding: 10px 14px; border-radius: 10px;
            display: none; align-items: center; gap: 8px; transition: all 0.3s;
        }
        .password-notice.show { display: flex; }
        .password-notice.warning { background: #fff8e6; border: 1px solid #f0a500; color: #8a5f00; }
        .password-notice.success { background: #edfaf2; border: 1px solid var(--dark-green); color: var(--dark-green); }
        .password-notice.error { background: #fff0f0; border: 1px solid #e53e3e; color: #c0392b; }
        .password-notice i { font-size: 0.85rem; flex-shrink: 0; }
        .password-notice span { font-weight: 500; line-height: 1.4; }

        .pass-strength-bar {
            height: 4px; border-radius: 4px; background: #eee;
            margin-top: -10px; margin-bottom: 8px; overflow: hidden; display: none;
        }
        .pass-strength-bar.show { display: block; }
        .pass-strength-fill { height: 100%; border-radius: 4px; transition: width 0.3s, background 0.3s; width: 0%; }

        /* ── PHONE ROW ── */
        .phone-row { display: flex; gap: 10px; margin-bottom: 18px; }

        .country-select-wrap { position: relative; flex-shrink: 0; width: 195px; }
        .country-select-wrap .input-icon {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            color: #ccc; font-size: 0.85rem; pointer-events: none; z-index: 2;
        }
        .country-select-wrap select {
            width: 100%; padding: 12px 30px 12px 34px;
            border: 1.5px solid #e8e8e8; border-radius: 12px;
            font-family: 'Poppins', sans-serif; font-size: 0.82rem; font-weight: 600; color: #333;
            background: #fafafa; outline: none; appearance: none; -webkit-appearance: none; cursor: pointer;
            transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
        }
        .country-select-wrap select:focus {
            border-color: var(--dark-green); box-shadow: 0 0 0 4px rgba(5,94,45,0.08); background: #fff;
        }
        .country-select-wrap .chevron {
            position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
            color: #bbb; font-size: 0.7rem; pointer-events: none;
        }

        .phone-number-wrap { position: relative; flex: 1; }
        .phone-number-wrap input {
            width: 100%; padding: 12px 14px;
            border: 1.5px solid #e8e8e8; border-radius: 12px;
            font-family: 'Poppins', sans-serif; font-size: 0.9rem; color: #333;
            background: #fafafa; outline: none;
            transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
        }
        .phone-number-wrap input:focus {
            border-color: var(--dark-green); box-shadow: 0 0 0 4px rgba(5,94,45,0.08); background: #fff;
        }
        .phone-number-wrap input.input-error { border-color: #e53e3e; box-shadow: 0 0 0 4px rgba(229,62,62,0.08); }

        .phone-hint {
            font-size: 0.75rem; color: #aaa;
            margin-top: -12px; margin-bottom: 18px; padding-left: 2px;
            display: flex; align-items: center; gap: 5px;
        }
        .phone-hint.error { color: #e53e3e; }
        .phone-hint i { font-size: 0.7rem; }

        /* ── SAVE BUTTON ── */
        .btn-save {
            width: 100%; background: var(--dark-green); color: #fff;
            border: none; border-radius: 13px; padding: 14px;
            font-size: 1rem; font-weight: 700; font-family: 'Poppins', sans-serif;
            cursor: pointer; transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
            display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 8px;
        }
        .btn-save:hover { background: #044923; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(5,94,45,0.25); }
        .btn-save:active { transform: translateY(0); }
        .btn-save:disabled { background: #ccc; cursor: not-allowed; transform: none; box-shadow: none; }

        /* ── MODALS ── */
        .modal-content { border-radius: 25px; padding: 10px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-header, .modal-footer { border: none; justify-content: center; }
        .modal-title { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 800; }
        .modal-body { color: #777; font-size: 0.9rem; text-align: center; }

        .btn-confirm-save {
            background-color: var(--dark-green); color: white;
            border-radius: 50px; padding: 10px 30px; border: none;
            cursor: pointer; font-weight: 600; font-family: 'Poppins', sans-serif; transition: background 0.2s;
        }
        .btn-confirm-save:hover { background: #044923; }

        .btn-confirm-cancel {
            background-color: #e53e3e; color: white;
            border-radius: 50px; padding: 10px 30px; border: none;
            text-decoration: none; font-weight: 600; font-family: 'Poppins', sans-serif;
            display: inline-block; transition: background 0.2s; cursor: pointer;
        }
        .btn-confirm-cancel:hover { background: #c0392b; color: #fff; }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .edit-wrapper { flex-direction: column; border-radius: 20px; }
            .edit-left { width: 100%; padding: 40px 30px; }
            .edit-right { width: 100%; padding: 40px 25px; }
            .page-title { font-size: 1.5rem; }
            .phone-row { flex-direction: column; }
            .country-select-wrap { width: 100%; }
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
                            <li><a class="dropdown-item text-danger fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- ══ PAGE CONTENT ══ -->
    <div class="page-wrapper">
        <div class="edit-wrapper">

            <!-- ── LEFT GREEN PANEL ── -->
            <div class="edit-left">
                <div class="avatar-circle">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                <h2>Your Account</h2>
                <p>Your profile says more than your words.</p>

                <div class="info-pill">
                    <i class="fa-solid fa-user"></i>
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
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
            <div class="edit-right">

                <button class="btn-cancel-x" id="cancelBtn" title="Cancel">
                    <i class="fa-solid fa-circle-xmark"></i>
                </button>

                <p class="top-label">Account Settings</p>
                <h1 class="page-title">Edit Your Profile</h1>
                <p class="tagline">Update your personal details below.</p>

                <form id="editForm" action="{{ route('custom.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Personal Info -->
                    <p class="section-heading">Personal Information</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="field-label">First Name</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-user input-icon"></i>
                                <input type="text" name="first_name" id="firstName"
                                       value="{{ Auth::user()->first_name }}"
                                       placeholder="First name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="field-label">Last Name</label>
                            <div class="input-wrap">
                                <i class="fa-solid fa-user input-icon"></i>
                                <input type="text" name="last_name" id="lastName"
                                       value="{{ Auth::user()->last_name }}"
                                       placeholder="Last name">
                            </div>
                        </div>
                    </div>

                    <hr class="section-divider">
                    <p class="section-heading">Contact Details</p>

                    <label class="field-label">Email Address</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" name="email" id="emailInput"
                               value="{{ Auth::user()->email }}"
                               placeholder="example@gmail.com or username@rub.edu.bt">
                    </div>
                    <p class="email-error" id="emailError">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span id="emailErrorText">Email must end with @gmail.com or @rub.edu.bt</span>
                    </p>

                    <!-- ── PHONE WITH COUNTRY CODE ── -->
                    <label class="field-label">WhatsApp Number</label>
                    <div class="phone-row">
                        <div class="country-select-wrap">
                            <i class="fa-solid fa-earth-asia input-icon"></i>
                            <select id="countryCode" name="country_code" onchange="updatePhoneRules(); onFormChange();">
                                <option value="975" selected>🇧🇹 Bhutan (+975)</option>
                                <option value="91">🇮🇳 India (+91)</option>
                                <option value="977">🇳🇵 Nepal (+977)</option>
                                <option value="880">🇧🇩 Bangladesh (+880)</option>
                                <option value="94">🇱🇰 Sri Lanka (+94)</option>
                                <option value="960">🇲🇻 Maldives (+960)</option>
                                <option value="66">🇹🇭 Thailand (+66)</option>
                                <option value="65">🇸🇬 Singapore (+65)</option>
                                <option value="60">🇲🇾 Malaysia (+60)</option>
                                <option value="1">🇺🇸 USA (+1)</option>
                                <option value="44">🇬🇧 UK (+44)</option>
                                <option value="81">🇯🇵 Japan (+81)</option>
                                <option value="82">🇰🇷 South Korea (+82)</option>
                            </select>
                            <i class="fa-solid fa-chevron-down chevron"></i>
                        </div>
                        <div class="phone-number-wrap">
                            <input type="tel" id="localPhone" name="local_phone"
                                   placeholder="17xxxxxx"
                                   inputmode="numeric"
                                   oninput="validatePhone(); onFormChange();"
                                   onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            <input type="hidden" name="phone" id="fullPhone">
                        </div>
                    </div>

                    <p class="phone-hint" id="phoneHint">
                        <i class="fa-solid fa-circle-info"></i>
                        <span id="phoneHintText">Bhutan: 8 digits, starts with 17, 16, or 77</span>
                    </p>

                    <hr class="section-divider">

                    <!-- ── SECURITY SECTION ── -->
                    <p class="section-heading">Security</p>

                    <label class="field-label" id="passwordLabel">
                        Change Password
                        <span class="required-star" id="passwordStar">*</span>
                    </label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="new_password" id="newPass"
                               class="has-eye"
                               placeholder="Leave blank to keep current password"
                               oninput="onPasswordInput()">
                        <i class="fa-solid fa-eye-slash toggle-icon"
                           onclick="togglePass('newPass', this)"></i>
                    </div>

                    <!-- Strength bar -->
                    <div class="pass-strength-bar" id="passStrengthBar">
                        <div class="pass-strength-fill" id="passStrengthFill"></div>
                    </div>

                    <!-- Password notice -->
                    <div class="password-notice" id="passwordNotice">
                        <i class="fa-solid fa-shield-halved" id="passwordNoticeIcon"></i>
                        <span id="passwordNoticeText">To save your changes, please enter your password (min. 8 characters).</span>
                    </div>

                    <button type="button" class="btn-save" id="saveBtn" onclick="attemptSave()">
                        <i class="fa-solid fa-floppy-disk"></i> Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ══ SAVE MODAL ══ -->
    <div class="modal fade" id="saveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header pt-4">
                    <h5 class="modal-title">Save Changes?</h5>
                </div>
                <div class="modal-body pb-2">
                    Are you sure you want to update your profile details?
                </div>
                <div class="modal-footer pb-4 gap-3">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn-confirm-save" onclick="submitForm()">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ══ CANCEL MODAL ══ -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header pt-4">
                    <h5 class="modal-title">Discard Changes?</h5>
                </div>
                <div class="modal-body pb-2">
                    Any unsaved changes will be lost. Are you sure?
                </div>
                <div class="modal-footer pb-4 gap-3">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">No</button>
                    <a href="{{ route('custom.profile.show') }}" class="btn-confirm-cancel">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ══ LOGOUT MODAL ══ -->
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
    <script>
        /* ══════════════════════════════════════════
           STORE ORIGINAL VALUES FOR CHANGE DETECTION
        ══════════════════════════════════════════ */
        const originalValues = {
            firstName:   "{{ Auth::user()->first_name }}",
            lastName:    "{{ Auth::user()->last_name }}",
            email:       "{{ Auth::user()->email }}",
            phone:       "{{ Auth::user()->phone ?? '' }}",
            countryCode: "975",
            localPhone:  ""
        };

        /* ══════════════════════════════════════════
           COUNTRY RULES
        ══════════════════════════════════════════ */
        const countryRules = {
            '975': { pattern: /^(17|16|77)\d+$/, length: 8, starts: ['17','16','77'], name: 'Bhutan', hint: '8 digits, starts with 17, 16, or 77', placeholder: '17XXXXXX' },
            '91':  { pattern: /^[6-9]\d+$/, length: 10, starts: ['6','7','8','9'], name: 'India', hint: '10 digits, starts with 6–9', placeholder: '9XXXXXXXXX' },
            '977': { pattern: /^(97|98)\d+$/, length: 10, starts: ['97','98'], name: 'Nepal', hint: '10 digits, starts with 97 or 98', placeholder: '98XXXXXXXX' },
            '880': { pattern: /^01\d+$/, length: 11, starts: ['01'], name: 'Bangladesh', hint: '11 digits, starts with 01', placeholder: '01XXXXXXXXX' },
            '94':  { pattern: /^07\d+$/, length: 10, starts: ['07'], name: 'Sri Lanka', hint: '10 digits, starts with 07', placeholder: '07XXXXXXXX' },
            '960': { pattern: /^[79]\d+$/, length: 7, starts: ['7','9'], name: 'Maldives', hint: '7 digits, starts with 7 or 9', placeholder: '7XXXXXX' },
            '66':  { pattern: /^0[689]\d+$/, length: 10, starts: ['06','08','09'], name: 'Thailand', hint: '10 digits, starts with 06, 08, or 09', placeholder: '08XXXXXXXX' },
            '65':  { pattern: /^[89]\d+$/, length: 8, starts: ['8','9'], name: 'Singapore', hint: '8 digits, starts with 8 or 9', placeholder: '8XXXXXXX' },
            '60':  { pattern: /^01\d+$/, lengthMin: 10, lengthMax: 11, starts: ['01'], name: 'Malaysia', hint: '10–11 digits, starts with 01', placeholder: '01XXXXXXXXX' },
            '1':   { pattern: /^[2-9]\d+$/, length: 10, starts: ['2–9'], name: 'USA', hint: '10 digits, starts with 2–9', placeholder: '2XXXXXXXXX' },
            '44':  { pattern: /^07\d+$/, length: 11, starts: ['07'], name: 'UK', hint: '11 digits, starts with 07', placeholder: '07XXXXXXXXX' },
            '81':  { pattern: /^0[789]\d+$/, length: 11, starts: ['07','08','09'], name: 'Japan', hint: '11 digits, starts with 07, 08, or 09', placeholder: '09XXXXXXXXX' },
            '82':  { pattern: /^01\d+$/, length: 11, starts: ['01'], name: 'South Korea', hint: '11 digits, starts with 01', placeholder: '01XXXXXXXXX' }
        };

        /* ══════════════════════════════════════════
           PRE-FILL PHONE FROM STORED VALUE
        ══════════════════════════════════════════ */
        (function prefillPhone() {
            @if(Auth::user()->phone)
                const stored = "{{ Auth::user()->phone }}".replace(/^\+/, '');
                const select = document.getElementById('countryCode');
                const options = select.options;
                const codes = Object.keys(countryRules).sort((a, b) => b.length - a.length);
                let matched = false;
                for (const code of codes) {
                    if (stored.startsWith(code)) {
                        for (let i = 0; i < options.length; i++) {
                            if (options[i].value === code) {
                                select.selectedIndex = i;
                                originalValues.countryCode = code;
                                break;
                            }
                        }
                        const local = stored.slice(code.length);
                        document.getElementById('localPhone').value = local;
                        originalValues.localPhone = local;
                        matched = true;
                        break;
                    }
                }
                if (!matched) {
                    document.getElementById('localPhone').value = stored;
                    originalValues.localPhone = stored;
                }
            @endif
            updatePhoneRules();
        })();

        /* ══════════════════════════════════════════
           UPDATE PLACEHOLDER / HINT ON COUNTRY CHANGE
        ══════════════════════════════════════════ */
        function updatePhoneRules() {
            const code  = document.getElementById('countryCode').value;
            const rule  = countryRules[code];
            const input = document.getElementById('localPhone');
            const hint  = document.getElementById('phoneHint');
            input.maxLength = rule.length || rule.lengthMax;
            input.placeholder = rule.placeholder;
            document.getElementById('phoneHintText').textContent = rule.name + ': ' + rule.hint;
            hint.classList.remove('error');
            input.classList.remove('input-error');
            if (input.value.length > 0) validatePhone();
        }

        /* ══════════════════════════════════════════
           PHONE VALIDATION
        ══════════════════════════════════════════ */
        function validatePhone() {
            const code   = document.getElementById('countryCode').value;
            const rule   = countryRules[code];
            const input  = document.getElementById('localPhone');
            const hint   = document.getElementById('phoneHint');
            const hintTx = document.getElementById('phoneHintText');
            const digits = input.value.replace(/\D/g, '');
            const maxLen = rule.length || rule.lengthMax;
            if (digits.length > maxLen) { input.value = digits.slice(0, maxLen); return; }
            if (digits.length === 0) {
                hint.classList.remove('error');
                input.classList.remove('input-error');
                hintTx.textContent = rule.name + ': ' + rule.hint;
                return;
            }
            let errorMsg = '';
            if (rule.length && digits.length < rule.length) {
                errorMsg = `Need ${rule.length} digits (${digits.length} entered)`;
            } else if (rule.lengthMin && (digits.length < rule.lengthMin || digits.length > rule.lengthMax)) {
                errorMsg = `Need ${rule.lengthMin}–${rule.lengthMax} digits (${digits.length} entered)`;
            } else if (!rule.pattern.test(digits)) {
                errorMsg = `Must start with ${rule.starts.join(', ')}`;
            }
            if (errorMsg) {
                hint.classList.add('error'); input.classList.add('input-error'); hintTx.textContent = errorMsg;
            } else {
                hint.classList.remove('error'); input.classList.remove('input-error'); hintTx.textContent = '✓ Looks good!';
            }
        }

        function isPhoneValid() {
            const localVal = document.getElementById('localPhone').value.trim();
            if (localVal === '') return true;
            const code   = document.getElementById('countryCode').value;
            const rule   = countryRules[code];
            const digits = localVal.replace(/\D/g, '');
            if (rule.length && digits.length !== rule.length) return false;
            if (rule.lengthMin && (digits.length < rule.lengthMin || digits.length > rule.lengthMax)) return false;
            if (!rule.pattern.test(digits)) return false;
            return true;
        }

        /* ══════════════════════════════════════════
           EMAIL VALIDATION
        ══════════════════════════════════════════ */
        function validateEmail() {
            const email     = document.getElementById('emailInput').value.trim();
            const errorEl   = document.getElementById('emailError');
            const errorText = document.getElementById('emailErrorText');
            const input     = document.getElementById('emailInput');
            if (email === '') { errorEl.classList.remove('show'); input.classList.remove('input-error'); return true; }
            const basicPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!basicPattern.test(email)) {
                errorText.textContent = 'Please enter a valid email address';
                errorEl.classList.add('show'); input.classList.add('input-error'); return false;
            }
            const allowedDomains = ['@gmail.com', '@rub.edu.bt'];
            const hasAllowedDomain = allowedDomains.some(domain => email.toLowerCase().endsWith(domain));
            if (!hasAllowedDomain) {
                errorText.textContent = 'Email must end with @gmail.com or @rub.edu.bt';
                errorEl.classList.add('show'); input.classList.add('input-error'); return false;
            }
            errorEl.classList.remove('show'); input.classList.remove('input-error'); return true;
        }

        document.getElementById('emailInput').addEventListener('input', function() { validateEmail(); onFormChange(); });
        document.getElementById('emailInput').addEventListener('blur', validateEmail);

        /* ══════════════════════════════════════════
           CHANGE DETECTION
        ══════════════════════════════════════════ */
        function hasChanges() {
            const firstName   = document.getElementById('firstName').value.trim();
            const lastName    = document.getElementById('lastName').value.trim();
            const email       = document.getElementById('emailInput').value.trim();
            const localPhone  = document.getElementById('localPhone').value.trim();
            const countryCode = document.getElementById('countryCode').value;
            const newPass     = document.getElementById('newPass').value;
            if (firstName !== originalValues.firstName) return true;
            if (lastName  !== originalValues.lastName)  return true;
            if (email     !== originalValues.email)      return true;
            const currentFullPhone  = localPhone ? '+' + countryCode + localPhone.replace(/\D/g, '') : '';
            const originalFullPhone = originalValues.phone
                ? '+' + originalValues.countryCode + originalValues.localPhone.replace(/\D/g, '') : '';
            if (currentFullPhone !== originalFullPhone && localPhone !== originalValues.localPhone) return true;
            if (newPass !== '') return true;
            return false;
        }

        /* ══════════════════════════════════════════
           PASSWORD
        ══════════════════════════════════════════ */
        function isPasswordValid() { return document.getElementById('newPass').value.length >= 8; }

        function onPasswordInput() { updatePasswordNotice(); onFormChange(); }

        function updatePasswordNotice() {
            const passInput  = document.getElementById('newPass');
            const notice     = document.getElementById('passwordNotice');
            const noticeIcon = document.getElementById('passwordNoticeIcon');
            const noticeTxt  = document.getElementById('passwordNoticeText');
            const star       = document.getElementById('passwordStar');
            const bar        = document.getElementById('passStrengthBar');
            const fill       = document.getElementById('passStrengthFill');
            const passVal    = passInput.value;
            const changes    = hasChanges();
            if (!changes && passVal === '') {
                notice.className = 'password-notice'; star.classList.remove('visible');
                passInput.classList.remove('password-required', 'input-error', 'input-valid');
                bar.classList.remove('show'); return;
            }
            star.classList.add('visible'); bar.classList.add('show');
            const len = passVal.length;
            let strength = 0;
            if (len >= 8)  strength++;
            if (len >= 12) strength++;
            if (/[A-Z]/.test(passVal)) strength++;
            if (/[0-9]/.test(passVal)) strength++;
            if (/[^A-Za-z0-9]/.test(passVal)) strength++;
            fill.style.width = Math.min(100, (strength / 5) * 100) + '%';
            if (len === 0) {
                fill.style.background = '#ddd'; fill.style.width = '0%';
                passInput.classList.remove('input-error', 'input-valid');
                passInput.classList.add('password-required');
                notice.className = 'password-notice warning show';
                noticeIcon.className = 'fa-solid fa-shield-halved';
                noticeTxt.textContent = 'To save your changes, please enter your password (min. 8 characters).';
            } else if (len < 8) {
                fill.style.background = '#e53e3e'; fill.style.width = (len / 8 * 40) + '%';
                passInput.classList.remove('password-required', 'input-valid'); passInput.classList.add('input-error');
                notice.className = 'password-notice error show';
                noticeIcon.className = 'fa-solid fa-circle-exclamation';
                noticeTxt.textContent = `Password too short — ${8 - len} more character${8 - len > 1 ? 's' : ''} needed.`;
            } else {
                const colors = ['#f0a500', '#7db900', '#2e8b57'];
                fill.style.background = strength <= 2 ? colors[0] : strength <= 4 ? colors[1] : colors[2];
                passInput.classList.remove('password-required', 'input-error'); passInput.classList.add('input-valid');
                notice.className = 'password-notice success show';
                noticeIcon.className = 'fa-solid fa-circle-check';
                noticeTxt.textContent = strength <= 2
                    ? '✓ Minimum met. Consider adding uppercase letters, numbers, or symbols.'
                    : strength <= 4 ? '✓ Good password!' : '✓ Strong password!';
            }
        }

        function onFormChange() { updatePasswordNotice(); }

        /* ══════════════════════════════════════════
           SMART CANCEL — only confirm if changes exist
        ══════════════════════════════════════════ */
        document.getElementById('cancelBtn').addEventListener('click', function(e) {
            e.preventDefault();
            if (hasChanges()) {
                new bootstrap.Modal(document.getElementById('cancelModal')).show();
            } else {
                window.location.href = "{{ route('custom.profile.show') }}";
            }
        });

        /* ══════════════════════════════════════════
           SAVE
        ══════════════════════════════════════════ */
        function attemptSave() {
            if (!validateEmail()) { document.getElementById('emailInput').focus(); return; }
            const localVal = document.getElementById('localPhone').value.trim();
            if (localVal !== '' && !isPhoneValid()) { validatePhone(); document.getElementById('localPhone').focus(); return; }
            if (hasChanges() && !isPasswordValid()) {
                updatePasswordNotice();
                document.getElementById('newPass').focus();
                document.getElementById('newPass').scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }
            if (localVal !== '') {
                const code = document.getElementById('countryCode').value;
                document.getElementById('fullPhone').value = '+' + code + localVal.replace(/\D/g, '');
            } else {
                document.getElementById('fullPhone').value = '';
            }
            new bootstrap.Modal(document.getElementById('saveModal')).show();
        }

        function submitForm() { document.getElementById('editForm').submit(); }

        function togglePass(inputId, iconElement) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') { input.type = 'text'; iconElement.classList.replace('fa-eye-slash', 'fa-eye'); }
            else { input.type = 'password'; iconElement.classList.replace('fa-eye', 'fa-eye-slash'); }
        }

        /* ══════════════════════════════════════════
           INIT
        ══════════════════════════════════════════ */
        document.addEventListener('DOMContentLoaded', function() {
            originalValues.localPhone = document.getElementById('localPhone').value;
            ['firstName', 'lastName'].forEach(id => {
                document.getElementById(id).addEventListener('input', onFormChange);
            });
        });
    </script>
</body>
</html>