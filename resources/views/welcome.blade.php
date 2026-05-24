<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TN Multi Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --custom-beige: #f2e6e4;
            --custom-grey: #ffffff;
            --dark-green: #055e2d;
            --star-gold: #FFC107;
        }

        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: #fff; overflow-x: hidden; font-size: 0.88rem; }
        h1, h2, h3, h4, .number { font-family: 'Playfair Display', serif; }

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

        /* ── HERO ── */
        .hero-section {
            position: relative;
            height: 50vh;
            margin-top: 65px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .hero-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.2s ease-in-out;
            z-index: 0;
        }
        .hero-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
        }
        .hero-slide.active { opacity: 1; z-index: 1; }
        .hero-content { position: relative; z-index: 10; }
        .hero-content p { letter-spacing: 2px; font-size: 0.75rem; font-weight: 600; }
        .hero-content h1 { font-size: clamp(1.6rem, 4vw, 2.6rem); }

        /* ── SERVICES ── */
        .service-card-link {
            display: block;
            text-decoration: none !important;
            color: inherit !important;
            cursor: pointer;
            transition: color 0.3s;
        }
        .service-card-link:hover { color: inherit !important; }

        .service-img-wrap {
            border-radius: 12px;
            overflow: hidden;
            height: 220px;
            margin-bottom: 1rem;
        }
        .service-img {
            height: 100%; width: 100%; object-fit: cover; border-radius: 12px;
            transform: scale(0.88); opacity: 0;
            transition: transform 0.85s cubic-bezier(0.22, 0.61, 0.36, 1), opacity 0.85s ease;
        }
        .service-img.loaded { transform: scale(1); opacity: 1; }

        /* hover zoom now triggered by the anchor, not col-md-4 */
        .service-card-link:hover .service-img.loaded { transform: scale(1.07); }

        @media (max-width: 767.98px) {
            .service-img-wrap { height: 180px; }
        }

        /* ── WHY CHOOSE US ── */
        .why-choose-section { background-color: var(--custom-beige); padding: 60px 0; }
        .number {
            font-size: 2.4rem; color: #000; opacity: 0.15;
            display: block; margin-bottom: 5px; text-align: center;
        }
        .feature-text {
            font-size: 0.88rem; line-height: 1.6; color: #333;
            max-width: 350px; margin: 0 auto;
            min-height: 3.5em;
        }
        .typing-cursor {
            display: inline-block;
            width: 2px;
            height: 1em;
            background: #555;
            margin-left: 1px;
            vertical-align: middle;
            animation: cursorBlink 0.65s step-end infinite;
        }
        @keyframes cursorBlink { 0%,100%{opacity:1} 50%{opacity:0} }

        /* ── FEEDBACK ── */
        .feedback-section { padding: 50px 0; }
        .testimonial-card {
            background-color: #fcfcfc; border: 1.1px solid #ddd; border-radius: 15px;
            padding: 24px; margin-bottom: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            opacity: 0; transform: translateY(40px);
            transition: opacity 0.55s ease, transform 0.55s ease;
        }
        .testimonial-card.visible { opacity: 1; transform: translateY(0); }
        .testimonial-name { font-weight: 700; font-size: 1rem; margin-bottom: 2px; }
        .testimonial-service { font-size: 0.82rem; color: #666; margin-bottom: 10px; }
        .stars { color: var(--star-gold); font-size: 1.2rem; margin-top: 12px; display: flex; align-items: center; gap: 4px; }
        .stars .date { font-size: 0.78rem; color: #888; margin-left: 12px; font-family: 'Poppins', sans-serif; font-weight: 400; }

        /* ── FOOTER ── */
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
        }

        /* ── LOGOUT MODAL ── */
        .modal-content { border-radius: 25px; padding: 20px; }
        .btn-confirm-logout { background: #ff4d4d; color: #fff; border-radius: 12px; padding: 10px 30px; border: none; font-weight: 600; text-decoration: none; }

        html { scroll-behavior: smooth; }
        .section-py { padding-top: 44px; padding-bottom: 44px; }
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
                    <li class="nav-item"><a class="nav-link active-link px-3" href="{{ url('/') }}">HOME</a></li>
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

    <!-- ══ HERO ══ -->
    <header class="hero-section">
        <div class="hero-slide active"  style="background-image: url('{{ asset('images/tn.jpeg') }}')"></div>
        <div class="hero-slide"         style="background-image: url('{{ asset('images/burger.jpeg') }}')"></div>
        <div class="hero-slide"         style="background-image: url('{{ asset('images/coffee.jpeg') }}')"></div>
        <div class="hero-slide"         style="background-image: url('{{ asset('images/lodging.jpeg') }}')"></div>
        <div class="hero-slide"         style="background-image: url('{{ asset('images/login.jpeg') }}')"></div>
        <div class="hero-slide"         style="background-image: url('{{ asset('images/spa1.jpeg') }}')"></div>
        <div class="hero-slide"         style="background-image: url('{{ asset('images/spa2.jpeg') }}')"></div>
        <div class="hero-slide"         style="background-image: url('{{ asset('images/spa3.jpeg') }}')"></div>

        <div class="hero-content">
            <p class="text-uppercase mb-1">Welcome to</p>
            <h1 class="fw-bold text-uppercase">TN Multi Services</h1>
        </div>
    </header>

    <!-- ══ SERVICES SECTION ══ -->
    <section id="services" class="container section-py text-center">
        <p class="text-muted fw-bold small text-uppercase mb-1">Our Services</p>
        <h2 class="fw-bold mb-2" style="font-size: clamp(1.35rem, 3.5vw, 2rem);">Three Experiences, One Destination</h2>
        <p class="text-muted mx-auto mb-4" style="max-width: 600px; font-size: 0.83rem;">Discover everything TN has to offer, from culinary delights to peaceful retreats.</p>
        <div class="row g-4">
            <div class="col-md-4 col-12">
                <a href="{{ route('restaurant') }}" class="service-card-link">
                    <div class="service-img-wrap">
                        <img src="{{ asset('images/restaurant.jpeg') }}" class="service-img" alt="Fine Dining">
                    </div>
                    <h3 class="h5 fw-bold">Fine Dining</h3>
                    <p class="text-muted px-2" style="font-size: 0.82rem;">Savor exquisite cuisines crafted by our experienced chefs using the freshest local ingredients.</p>
                    <span class="text-dark fw-bold" style="font-size: 0.82rem;">View Menu &rarr;</span>
                </a>
            </div>
            <div class="col-md-4 col-12">
                <a href="{{ route('lodging') }}" class="service-card-link">
                    <div class="service-img-wrap">
                        <img src="{{ asset('images/lodging.jpeg') }}" class="service-img" alt="Lodging">
                    </div>
                    <h3 class="h5 fw-bold">Lodging</h3>
                    <p class="text-muted px-2" style="font-size: 0.82rem;">Rest in beautifully appointed rooms with premium amenities. Choose from standard rooms to suites.</p>
                    <span class="text-dark fw-bold" style="font-size: 0.82rem;">View Rooms &rarr;</span>
                </a>
            </div>
            <div class="col-md-4 col-12">
                <a href="{{ route('spa') }}" class="service-card-link">
                    <div class="service-img-wrap">
                        <img src="{{ asset('images/spa.jpeg') }}" class="service-img" alt="Spa">
                    </div>
                    <h3 class="h5 fw-bold">Spa & Wellness</h3>
                    <p class="text-muted px-2" style="font-size: 0.82rem;">Indulge in a curated selection of spa treatments designed to relax, restore, and rejuvenate.</p>
                    <span class="text-dark fw-bold" style="font-size: 0.82rem;">View Packages &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ══ WHY CHOOSE US ══ -->
    <section class="why-choose-section">
        <div class="container text-center">
            <p class="text-muted fw-bold small text-uppercase mb-1">Why Choose Us</p>
            <h2 class="fw-bold mb-4" style="font-size: clamp(1.35rem, 3.5vw, 2rem);">A Legacy Of Excellence</h2>
            <div class="row g-4">
                <div class="col-md-6 col-12 text-center">
                    <span class="number">01</span>
                    <p class="feature-text" data-text="Nestled in the heart of the community with easy access to local attractions."></p>
                </div>
                <div class="col-md-6 col-12 text-center">
                    <span class="number">02</span>
                    <p class="feature-text" data-text="Enjoy dining, lodging, and spa services without leaving the property."></p>
                </div>
                <div class="col-md-6 col-12 text-center">
                    <span class="number">03</span>
                    <p class="feature-text" data-text="Our dedicated team ensures every guest receives exceptional care and attention."></p>
                </div>
                <div class="col-md-6 col-12 text-center">
                    <span class="number">04</span>
                    <p class="feature-text" data-text="Experience the warmth and culture of our community through our curated services."></p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ FEEDBACK SECTION ══ -->
    <section class="container feedback-section">
        <p class="text-center text-muted fw-bold small text-uppercase mb-1">Guest Experiences</p>
        <h2 class="text-center fw-bold mb-4" style="font-size: clamp(1.35rem, 3.5vw, 2rem);">What Our Guests Say</h2>

        @if(isset($feedbacks) && $feedbacks->count() > 0)
            @foreach($feedbacks as $item)
            <div class="testimonial-card">
                <p class="testimonial-name">{{ ucwords(strtolower($item->full_name)) }}</p>
                <p class="testimonial-service">{{ $item->service }}</p>
                <p class="mb-0 text-muted" style="font-size: 0.83rem; font-style: italic;">"{{ $item->feedback }}"</p>
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $item->rating)
                            <i class="fa-solid fa-star"></i>
                        @else
                            <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
                    <span class="date">{{ $item->created_at->format('d.m.Y') }}</span>
                </div>
            </div>
            @endforeach
        @else
            <p class="text-center text-muted">No guest reviews yet. Be the first to share your experience!</p>
        @endif
    </section>

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
    document.addEventListener('DOMContentLoaded', () => {

        /* 1. HERO SLIDESHOW */
        const slides = document.querySelectorAll('.hero-slide');
        let current = 0;
        setInterval(() => {
            slides[current].classList.remove('active');
            current = (current + 1) % slides.length;
            slides[current].classList.add('active');
        }, 3000);

        /* 2. SERVICE IMAGES — staggered zoom in */
        document.querySelectorAll('.service-img').forEach((img, i) => {
            setTimeout(() => img.classList.add('loaded'), i * 120);
        });

        /* 3. FEEDBACK CARDS — slide up on scroll */
        const cards = document.querySelectorAll('.testimonial-card');
        if ('IntersectionObserver' in window) {
            const cardObs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const idx = [...entry.target.parentElement
                            .querySelectorAll('.testimonial-card')]
                            .indexOf(entry.target);
                        setTimeout(() => entry.target.classList.add('visible'), idx * 100);
                        cardObs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            cards.forEach(c => cardObs.observe(c));
        } else {
            cards.forEach(c => c.classList.add('visible'));
        }

        /* 4. TYPEWRITER — why choose us */
        function typeWriter(el, staggerDelay) {
            const text = el.getAttribute('data-text');
            el.innerHTML = '';
            let i = 0;
            const cursor = document.createElement('span');
            cursor.className = 'typing-cursor';
            el.appendChild(cursor);
            setTimeout(() => {
                const timer = setInterval(() => {
                    if (i < text.length) {
                        cursor.insertAdjacentText('beforebegin', text[i]);
                        i++;
                    } else {
                        clearInterval(timer);
                        setTimeout(() => cursor.remove(), 900);
                    }
                }, 30);
            }, staggerDelay);
        }

        const featureEls = document.querySelectorAll('.feature-text');
        if ('IntersectionObserver' in window) {
            const section = document.querySelector('.why-choose-section');
            let triggered = false;
            const sectionObs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !triggered) {
                        triggered = true;
                        featureEls.forEach((el, idx) => typeWriter(el, idx * 300));
                        sectionObs.unobserve(section);
                    }
                });
            }, { threshold: 0.25 });
            sectionObs.observe(section);
        } else {
            featureEls.forEach(el => el.textContent = el.getAttribute('data-text'));
        }

    });
    </script>
</body>
</html>