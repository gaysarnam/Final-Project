<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact & Feedback - TN Multi Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root { --custom-grey: #ffffff; --dark-green: #055e2d; --custom-beige: #f8f4ed; --status-available: #2e7d32; }

        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: #fff; overflow-x: hidden; font-size: 0.88rem; }
        h1, h2, h3, h4, .contact-title, .box-title, .reserve-title { font-family: 'Playfair Display', serif; }

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

        /* ── Contact header ── */
        .contact-header { margin-top: 100px; margin-bottom: 36px; text-align: center; }
        .small-cap { text-transform: uppercase; letter-spacing: 2px; font-weight: 600; font-size: 0.75rem; color: #555; }
        .contact-title { font-size: clamp(1.6rem, 4vw, 2.4rem); font-weight: 800; margin-bottom: 8px; }
        .tagline { font-style: italic; color: #555; font-size: 0.83rem; }

        .contact-container { margin-bottom: 60px; }

        /* ── Contact boxes ── */
        .contact-box {
            border: 1px solid #999;
            border-radius: 20px;
            padding: 28px 16px;
            text-align: center;
            height: 100%;
            background: #fff;
            transition: transform 0.35s ease, box-shadow 0.35s ease, background 0.35s ease, border-color 0.35s ease;
            cursor: default;
            position: relative;
            overflow: hidden;
        }
        .contact-box:hover { transform: translateY(-6px) scale(1.02); }
        .contact-box.box-address,
        .contact-box.box-whatsapp,
        .contact-box.box-email { cursor: pointer; }

        /* Taller boxes on desktop */
        @media (min-width: 768px) {
            .contact-box {
                padding: 48px 24px;
                min-height: 220px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
        }

        .contact-icon-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 14px;
            margin-bottom: 14px;
            background: #f0f0f0;
            transition: background 0.35s ease, box-shadow 0.35s ease;
        }
        .contact-icon { font-size: 1.4rem; color: #555; transition: color 0.35s ease; }
        .box-title { font-size: 1.15rem; font-weight: 700; margin-bottom: 8px; }
        .box-text { font-size: 0.88rem; color: #333; }

        .contact-box.box-address:hover { background: #eef3ff; border-color: #4f80f7; box-shadow: 0 12px 30px rgba(79,128,247,0.22); }
        .contact-box.box-address:hover .contact-icon-wrap { background: #4f80f7; box-shadow: 0 4px 14px rgba(79,128,247,0.4); }
        .contact-box.box-address:hover .contact-icon { color: #fff; }

        /* WhatsApp green hover */
        .contact-box.box-whatsapp:hover { background: #edfaf3; border-color: #25d366; box-shadow: 0 12px 30px rgba(37,211,102,0.22); }
        .contact-box.box-whatsapp:hover .contact-icon-wrap { background: #25d366; box-shadow: 0 4px 14px rgba(37,211,102,0.4); }
        .contact-box.box-whatsapp:hover .contact-icon { color: #fff; }

        .contact-box.box-email:hover { background: #fff8ed; border-color: #f5a623; box-shadow: 0 12px 30px rgba(245,166,35,0.22); }
        .contact-box.box-email:hover .contact-icon-wrap { background: #f5a623; box-shadow: 0 4px 14px rgba(245,166,35,0.4); }
        .contact-box.box-email:hover .contact-icon { color: #fff; }

        .contact-box.box-hours:hover { background: #f5eeff; border-color: #9b59b6; box-shadow: 0 12px 30px rgba(155,89,182,0.22); }
        .contact-box.box-hours:hover .contact-icon-wrap { background: #9b59b6; box-shadow: 0 4px 14px rgba(155,89,182,0.4); }
        .contact-box.box-hours:hover .contact-icon { color: #fff; }

        /* ── Feedback form ── */
        .feedback-form-section { background-color: var(--custom-beige); padding: 55px 0; margin-top: 10px; }
        .feedback-card {
            background: #fff; border: 1px solid #ccc; border-radius: 20px;
            padding: 36px 32px; max-width: 660px; margin: 0 auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        @media (max-width: 575.98px) {
            .feedback-card { padding: 24px 18px; }
        }

        .form-label { font-weight: 600; font-size: 0.88rem; margin-bottom: 6px; display: block; text-align: left; color: #333; }
        .form-control, .form-select {
            border-radius: 9px; padding: 10px 12px;
            border: 1.5px solid #dee2e6; font-size: 0.88rem; height: 44px;
        }
        textarea.form-control { height: auto; }

        /* ── Star rating ── */
        .star-rating-wrapper {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 4px;
            margin-bottom: 16px;
        }
        .star-rating-wrapper input[type="radio"] { display: none; }
        .star-rating-wrapper label {
            cursor: pointer;
            font-size: 2rem;
            color: #d1d5db;
            transition: color 0.2s ease, transform 0.15s ease;
            line-height: 1;
            user-select: none;
        }
        .star-rating-wrapper input:checked ~ label,
        .star-rating-wrapper label:hover,
        .star-rating-wrapper label:hover ~ label { color: #f5c518; }
        .star-rating-wrapper label:hover { transform: scale(1.12); }

        .char-count { font-size: 0.74rem; color: #888; text-align: right; margin-top: 4px; }

        .btn-submit-feedback {
            background-color: var(--dark-green); color: white; border: none;
            width: 100%; padding: 11px; font-size: 1rem; border-radius: 10px;
            font-weight: 700; margin-top: 10px; transition: 0.3s; cursor: pointer;
        }
        .btn-submit-feedback:hover { background-color: #044923; transform: translateY(-2px); }

        /* ── Success toast ── */
        .p-toast {
            min-width: 280px; background: white; padding: 14px;
            border-radius: 14px; box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            display: flex; align-items: center; gap: 12px; border-left: 5px solid #ccc;
        }
        .toast-success { border-left-color: var(--status-available); }

        /* ── Footer ── */
        footer { background-color: #000; color: #fff; padding: 55px 40px 24px 40px; }
        .footer-logo { font-size: 1.3rem; font-weight: 800; margin-bottom: 10px; font-family: 'Playfair Display', serif; }
        .footer-desc { font-size: 0.83rem; color: #bbb; line-height: 1.6; max-width: 260px; }
        .footer-title { font-size: 0.95rem; font-weight: 700; margin-bottom: 18px; color: #fff; font-family: 'Inter', sans-serif; }
        footer a { color: #bbb; text-decoration: none; font-size: 0.86rem; display: block; margin-bottom: 9px; transition: 0.3s; cursor: pointer; }
        footer a:hover { color: #fff; }
        .contact-info { color: #bbb; font-size: 0.86rem; line-height: 2; }
        .footer-bottom-line { border-top: 1px solid #333; margin-top: 45px; padding-top: 16px; color: #777; font-size: 0.8rem; }

        @media (max-width: 575.98px) {
            footer { padding: 40px 20px 20px 20px; }
            .contact-header { margin-top: 85px; margin-bottom: 24px; }
        }

        html { scroll-behavior: smooth; }
    </style>
</head>
<body>

    <!-- SUCCESS TOAST -->
    @if(session('feedback_success'))
    <div id="booking-toast" class="p-toast show toast-success"
         style="position: fixed; top: 100px; right: 24px; z-index: 9999;">
        <i class="fa-solid fa-circle-check" style="font-size:1.2rem; color: var(--status-available);"></i>
        <div>
            <div class="fw-bold">Success</div>
            <div class="small text-muted">{{ session('feedback_success') }}</div>
        </div>
    </div>
    <script>setTimeout(() => { document.getElementById('booking-toast').remove(); }, 6000);</script>
    @endif

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
                    <li class="nav-item"><a class="nav-link active-link px-3" href="{{ route('contact') }}">CONTACT</a></li>
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

    <!-- ══ CONTACT INFO ══ -->
    <div class="container contact-container">
        <div class="contact-header">
            <p class="small-cap">Get in Touch</p>
            <h1 class="contact-title">Contact & Feedback</h1>
            <p class="tagline">We value your feedback and are here to answer any questions you may have.</p>
        </div>

        <div class="row g-3 justify-content-center">

            <!-- Address -->
            <div class="col-md-5 col-sm-6 col-12">
                <a href="https://www.google.com/maps/place/TN+Caf%C3%A9,+Restaurant+%26+Hotel/@26.8624002,91.4721414,17z/data=!4m7!3m6!1s0x375beb7cc1a54deb:0x97e3922c9fc6ade1!4b1!8m2!3d26.8624002!4d91.4721414!16s%2Fg%2F11r8vlvqyn?entry=ttu&g_ep=EgoyMDI2MDQyNi4wIKXMDSoASAFQAw%3D%3D"
                   target="_blank" rel="noopener noreferrer"
                   class="contact-box box-address text-decoration-none text-dark d-block">
                    <div class="contact-icon-wrap"><i class="fa-solid fa-location-dot contact-icon"></i></div>
                    <h3 class="box-title">Address</h3>
                    <p class="box-text">Dewathang, Samdrupjongkhar</p>
                </a>
            </div>

            <!-- WhatsApp -->
            <div class="col-md-5 col-sm-6 col-12">
                <a href="https://wa.me/97577343125"
                   target="_blank" rel="noopener noreferrer"
                   class="contact-box box-whatsapp text-decoration-none text-dark d-block">
                    <div class="contact-icon-wrap"><i class="fa-brands fa-whatsapp contact-icon"></i></div>
                    <h3 class="box-title">WhatsApp</h3>
                    <p class="box-text">+975-77343125</p>
                </a>
            </div>

            <!-- Email -->
            <div class="col-md-5 col-sm-6 col-12">
                <a href="mailto:tn@gmail.com?subject=Enquiry%20-%20TN%20Multi%20Services"
                   class="contact-box box-email text-decoration-none text-dark d-block">
                    <div class="contact-icon-wrap"><i class="fa-solid fa-envelope contact-icon"></i></div>
                    <h3 class="box-title">Email</h3>
                    <p class="box-text">tn@gmail.com</p>
                </a>
            </div>

            <!-- Hours -->
            <div class="col-md-5 col-sm-6 col-12">
                <div class="contact-box box-hours">
                    <div class="contact-icon-wrap"><i class="fa-solid fa-clock contact-icon"></i></div>
                    <h3 class="box-title">Hours</h3>
                    <p class="box-text">Mon - Sun: 10AM–9PM<br>Reception: 24 Hours</p>
                </div>
            </div>

        </div>
    </div>

    <!-- ══ FEEDBACK FORM ══ -->
    @auth
    <section class="feedback-form-section text-center">
        <div class="container">
            <p class="small-cap">Your Experience</p>
            <h2 class="reserve-title" style="font-size: clamp(1.35rem, 3.5vw, 2rem);">Submit Feedback</h2>
            <p class="tagline mb-4">Let us know about your experience.</p>

            <div class="feedback-card text-start">
                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Service</label>
                        <select name="service" class="form-select" required>
                            <option value="" selected disabled>Select Service</option>
                            <option value="Restaurant">Restaurant</option>
                            <option value="Lodging">Lodging</option>
                            <option value="Spa & Wellness">Spa & Wellness</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div class="star-rating-wrapper">
                            <input type="radio" name="rating" id="star5" value="5" required>
                            <label for="star5" title="5 stars">★</label>
                            <input type="radio" name="rating" id="star4" value="4">
                            <label for="star4" title="4 stars">★</label>
                            <input type="radio" name="rating" id="star3" value="3">
                            <label for="star3" title="3 stars">★</label>
                            <input type="radio" name="rating" id="star2" value="2">
                            <label for="star2" title="2 stars">★</label>
                            <input type="radio" name="rating" id="star1" value="1">
                            <label for="star1" title="1 star">★</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Your Feedback</label>
                        <textarea name="feedback" id="feedback-text" class="form-control" rows="4"
                            maxlength="100" placeholder="Tell us about your experience..." required></textarea>
                        <div class="char-count"><span id="chars">0</span>/100 characters</div>
                    </div>

                    <button type="submit" class="btn-submit-feedback">Submit Feedback</button>
                </form>
            </div>
        </div>
    </section>
    @endauth

    <!-- ══ FOOTER ══ -->
    <footer>
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
        const textarea = document.getElementById('feedback-text');
        const charCount = document.getElementById('chars');
        if (textarea) {
            textarea.addEventListener('input', () => {
                charCount.textContent = textarea.value.length;
            });
        }
    </script>
</body>
</html>