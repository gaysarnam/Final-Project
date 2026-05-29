<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lodging - TN Multi Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root { --custom-grey: #ffffff; --dark-green: #055e2d; --custom-beige: #f8f4ed; --status-available: #2e7d32; --status-booked: #d32f2f; }

        * { box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: #fff; overflow-x: hidden; font-size: 0.88rem; }
        h1, h2, h3, h4, .room-title, .section-title, .modal-title { font-family: 'Playfair Display', serif; }

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

        /* ── Hero ── */
        .lodging-hero {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url("{{ asset('images/lodging.jpeg') }}") center/cover no-repeat;
            height: 50vh; display: flex; align-items: center; justify-content: center; color: white; text-align: center; margin-top: 65px;
        }
        .lodging-hero h1 { font-size: clamp(1.6rem, 4vw, 2.6rem); }

        /* ── ROOM CARD ── */
        .room-card[data-color="1"] { --accent: #2563eb; }
        .room-card[data-color="2"] { --accent: #4fe023; }
        .room-card[data-color="3"] { --accent: #059669; }
        .room-card[data-color="4"] { --accent: #d97706; }
        .room-card[data-color="5"] { --accent: #dc2626; }
        .room-card[data-color="6"] { --accent: #0891b2; }

        /* Desktop card — fixed height */
        .room-card {
            border: 1px solid #999;
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 28px;
            height: 300px;
            transition: box-shadow 0.3s;
        }
        .room-card:hover { box-shadow: 0 8px 18px rgba(0,0,0,0.1); }

        .room-img { width: 100%; height: 300px; object-fit: cover; }

        .room-details {
            padding: 22px 26px;
            height: 300px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* ── MOBILE: stack image on top, auto height ── */
        @media (max-width: 767.98px) {
            .room-card {
                height: auto;      /* let content breathe */
            }
            .room-img {
                height: 190px;     /* image on top, fixed height */
                width: 100%;
            }
            .room-details {
                height: auto;
                padding: 16px;
            }
        }

        .available-badge { background-color: var(--dark-green); color: white; padding: 4px 14px; border-radius: 7px; font-size: 0.78rem; font-weight: 600; text-transform: capitalize; }
        .unavailable-badge { background-color: #d32f2f; color: white; padding: 4px 14px; border-radius: 7px; font-size: 0.78rem; font-weight: 600; text-transform: capitalize; }

        .amenity-tag { background-color: #e9e9e9; padding: 4px 10px; border-radius: 6px; font-size: 0.74rem; margin-right: 8px; margin-bottom: 4px; display: inline-flex; align-items: center; }
        .amenity-tag i { margin-right: 4px; color: var(--dark-green); }

        /* Runner line */
        .price-line {
            padding-top: 16px;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        .price-line::before {
            content: "";
            display: block;
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: #e5e7eb;
            border-radius: 99px;
        }
        .price-line::after {
            content: "";
            display: block;
            position: absolute;
            top: 0; left: 0;
            height: 2px;
            width: 0%;
            border-radius: 99px;
            background: var(--accent, #2563eb);
            transition: width 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .room-card:hover .price-line::after { width: 100%; }
        .room-card:hover .room-title { color: var(--accent, #2563eb); transition: color 0.3s ease; }

        .price-text { font-size: 1rem; font-weight: 500; color: #000; }

        .btn-book {
            background-color: var(--dark-green);
            color: white;
            padding: 8px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.82rem;
            transition: 0.3s;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            display: inline-block;
        }
        .btn-book:hover { background-color: #044923; color: white; transform: translateY(-2px); }
        .room-card:hover .btn-book { box-shadow: 0 4px 14px rgba(0,0,0,0.25); }
        .btn-book.disabled { background-color: #777 !important; cursor: not-allowed; }
        .btn-book.disabled:hover { background-color: #777 !important; transform: none; box-shadow: none; }

        /* ── MODAL ── */
        .modal-booking .modal-content { border-radius: 20px; padding: 28px; border: none; }
        .form-label { font-weight: 500; font-size: 0.92rem; margin-bottom: 6px; display: block; text-align: left; color: #333; }
        .form-control { border-radius: 9px; border: 1.5px solid #dee2e6; height: 46px; font-size: 0.88rem; }
        textarea.form-control { height: auto; }

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

        /* SUCCESS TOAST */
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

        /* UNAVAILABLE TOAST */
        #status-toast {
            position: fixed; top: 100px; left: 50%; transform: translateX(-50%);
            z-index: 9999; background: #ffebee; color: #d32f2f;
            padding: 10px 30px; border-radius: 50px; border: 1px solid #d32f2f;
            font-weight: 700; font-size: 0.82rem; display: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

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

        html { scroll-behavior: smooth; }
        .section-py { padding-top: 44px; padding-bottom: 44px; }
        .section-heading { font-size: clamp(1.35rem, 3.5vw, 2rem); }
        .room-title { font-size: 1.35rem; }
        .room-desc { font-size: 0.82rem; color: #666; }
    </style>
</head>
<body>

    <!-- SUCCESS TOAST -->
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

    <!-- UNAVAILABLE NOTIFICATION -->
    <div id="status-toast"><i class="fa-solid fa-circle-exclamation"></i> This room is currently unavailable</div>

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
                    <li class="nav-item"><a class="nav-link active-link px-3" href="{{ route('lodging') }}">LODGING</a></li>
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

    <!-- HERO -->
    <header class="lodging-hero">
        <div>
            <p class="text-uppercase mb-1" style="letter-spacing: 2px; font-size: 0.75rem; font-weight: 600;">ACCOMMODATION</p>
            <h1 class="fw-bold text-uppercase">Our Rooms & Suites</h1>
        </div>
    </header>

    <!-- ROOMS SECTION -->
    <section class="container section-py text-center">
        <h2 class="section-heading fw-bold mb-2">Choose Your Room</h2>
        <p class="text-muted mb-4 mx-auto" style="max-width: 550px; font-size: 0.83rem;">Each room is designed with comfort and elegance, offering everything you need for a memorable stay.</p>

        @php $roomColorIndex = 1; @endphp
        @forelse($rooms as $room)
        <div class="room-card text-start" data-color="{{ $roomColorIndex }}">
            <div class="row g-0">
                <div class="col-md-5 col-12">
                    <img src="{{ asset('images/rooms/' . $room->image) }}" class="room-img" alt="{{ $room->name }}">
                </div>
                <div class="col-md-7 col-12 room-details">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3 class="room-title mb-0">{{ $room->name }}</h3>
                            <span class="{{ $room->status == 'available' ? 'available-badge' : 'unavailable-badge' }}">{{ $room->status }}</span>
                        </div>
                        <p class="room-desc mb-3">{{ $room->description }}</p>
                        <div class="mb-2" id="amenities-{{ $room->id }}">
                            @foreach(explode(',', $room->amenities) as $amenity)
                                <span class="amenity-tag" data-amenity="{{ trim(strtolower($amenity)) }}">
                                    <i class="fa-solid fa-check-circle"></i> {{ trim($amenity) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="price-line">
                        <span class="price-text">NU. {{ $room->price }}</span>

                        @if($room->status == 'available')
                            @auth
                                <button class="btn-book" onclick="openBookingModal('{{ $room->name }}')">Book Now</button>
                            @else
                                <a href="{{ route('login') }}" class="btn-book text-center">Book Now</a>
                            @endauth
                        @else
                            <button class="btn-book disabled" onclick="showUnavailableToast()">Book Now</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @php $roomColorIndex = ($roomColorIndex % 6) + 1; @endphp
        @empty
        <p class="text-muted">No rooms added yet.</p>
        @endforelse
    </section>

    <!-- FOOTER -->
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
                        +975-77343125<br>
                        tnrestrocafe@gmail.com
                    </div>
                </div>
            </div>
            <div class="footer-bottom-line text-center">
                &copy; 2026 TN Multi Services. All rights reserved.
            </div>
        </div>
    </footer>

    @auth
    <!-- ROOM RESERVATION MODAL -->
    <div class="modal fade modal-booking" id="roomBookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content shadow-lg">
                <button type="button" class="btn-close position-absolute" style="top: 20px; right: 20px;" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-3">
                    <p class="small fw-bold text-uppercase mb-1" style="letter-spacing: 2px; font-size: 0.72rem;">{{ isset($booking) ? 'Edit' : 'Book' }}</p>
                    <h2 class="modal-title" style="font-size: 1.7rem; font-weight: 700; color: #333;">{{ isset($booking) ? 'Edit Booking' : 'Book a Room' }}</h2>
                    <p class="text-muted" style="font-size: 0.84rem;">{{ isset($booking) ? 'Update your reservation details below.' : 'Secure your spot for a memorable stay experience.' }}</p>
                </div>

                <form action="{{ isset($booking) ? route('booking.update', $booking->id) : route('book.service') }}" method="POST" id="lodForm">
                    @csrf
                    @if(isset($booking))
                        @method('PUT')
                    @endif
                    <input type="hidden" name="service_type" value="Lodging">
                    <input type="hidden" name="service_name" id="hiddenRoomType" value="{{ $booking->service_name ?? '' }}">

                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Check In <span style="color:#e53e3e;">*</span></label>
                            <input type="date" name="booking_date" id="lIn"
                                class="form-control"
                                min="{{ date('Y-m-d') }}"
                                value="{{ isset($booking) ? \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') : '' }}">
                            <div class="field-error" id="lInError">
                                <i class="fa-solid fa-circle-exclamation"></i>&nbsp; Please select a check-in date.
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label class="form-label">Check Out <span style="color:#e53e3e;">*</span></label>
                            <input type="date" name="check_out_date" id="lOut"
                                class="form-control"
                                min="{{ date('Y-m-d') }}"
                                value="{{ isset($booking) ? \Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d') : '' }}">
                            <div class="field-error" id="lOutError">
                                <i class="fa-solid fa-circle-exclamation"></i>&nbsp; Please select a check-out date.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Number of Guests <span style="color:#e53e3e;">*</span></label>
                        <input type="number" name="number_of_guests" id="lGuests"
                            class="form-control" min="1" max="4"
                            placeholder="Enter number of guests (1–4)"
                            value="{{ $booking->number_of_guests ?? '' }}">
                        <div class="field-error" id="lGuestsError">
                            <i class="fa-solid fa-circle-exclamation"></i>&nbsp; Please enter between 1 and 4 guests.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Special Request <span style="color:#aaa; font-size:0.76rem; font-weight:400;">(optional)</span></label>
                        <textarea name="special_request" class="form-control" rows="3"
                            placeholder="Any special requirements?">{{ $booking->special_request ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn w-100 py-2" id="submitBtn"
                        style="background-color: #055e2d; color: white; border-radius: 10px; font-weight: 700; font-size: 1rem; border: none;">
                        {{ isset($booking) ? 'Update Booking' : 'Confirm Booking' }}
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
        /* ── Amenity icons ── */
        const amenityIcons = {
            'tv': 'fa-tv', 'television': 'fa-tv',
            'ac': 'fa-snowflake', 'air conditioner': 'fa-snowflake', 'air conditioning': 'fa-snowflake',
            'fan': 'fa-fan', 'wifi': 'fa-wifi', 'internet': 'fa-wifi',
            'bed': 'fa-bed', 'king bed': 'fa-bed', 'queen bed': 'fa-bed', 'single bed': 'fa-bed', 'double bed': 'fa-bed',
            'bathroom': 'fa-bath', 'shower': 'fa-shower', 'bathtub': 'fa-bath',
            'kitchen': 'fa-kitchen-set', 'kitchenette': 'fa-kitchen-set',
            'parking': 'fa-car', 'free parking': 'fa-car',
            'pool': 'fa-water', 'swimming pool': 'fa-water',
            'gym': 'fa-dumbbell', 'fitness': 'fa-dumbbell', 'fitness center': 'fa-dumbbell',
            'spa': 'fa-spa', 'minibar': 'fa-wine-bottle', 'mini bar': 'fa-wine-bottle',
            'safe': 'fa-vault', 'safety box': 'fa-vault',
            'balcony': 'fa-home', 'terrace': 'fa-home',
            'view': 'fa-mountain', 'sea view': 'fa-water', 'ocean view': 'fa-water',
            'mountain view': 'fa-mountain', 'city view': 'fa-building',
            'heater': 'fa-fire', 'heating': 'fa-fire',
            'refrigerator': 'fa-temperature-low', 'fridge': 'fa-temperature-low',
            'coffee': 'fa-mug-hot', 'tea': 'fa-mug-hot', 'coffee maker': 'fa-mug-hot',
            'hair dryer': 'fa-wind', 'iron': 'fa-tshirt', 'ironing': 'fa-tshirt',
            'desk': 'fa-table', 'work desk': 'fa-table',
            'phone': 'fa-phone', 'telephone': 'fa-phone',
            'room service': 'fa-bell-concierge', 'concierge': 'fa-bell-concierge',
            'laundry': 'fa-shirt', 'washing machine': 'fa-shirt',
            'breakfast': 'fa-utensils', 'free breakfast': 'fa-utensils',
            'jacuzzi': 'fa-hot-tub-person', 'hot tub': 'fa-hot-tub-person',
            'beach': 'fa-umbrella-beach', 'beach access': 'fa-umbrella-beach',
            'airport shuttle': 'fa-bus', 'shuttle': 'fa-bus',
            'bicycle': 'fa-bicycle', 'bike': 'fa-bicycle',
            '24-hour': 'fa-clock', '24 hour': 'fa-clock',
            'reception': 'fa-user-tie', 'front desk': 'fa-user-tie'
        };

        function getAmenityIcon(name) {
            return amenityIcons[name.toLowerCase().trim()] || 'fa-check-circle';
        }

        function updateAmenityIcons() {
            document.querySelectorAll('.amenity-tag').forEach(tag => {
                const name = tag.getAttribute('data-amenity');
                if (name) {
                    const el = tag.querySelector('i');
                    if (el) { el.className = ''; el.classList.add('fa-solid', getAmenityIcon(name)); }
                }
            });
        }
        document.addEventListener('DOMContentLoaded', updateAmenityIcons);

        /* ── Unavailable toast ── */
        function showUnavailableToast() {
            const toast = document.getElementById('status-toast');
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, 2000);
        }

        /* ── Open booking modal ── */
        function openBookingModal(roomName) {
            document.getElementById('hiddenRoomType').value = roomName;

            ['lIn', 'lOut', 'lGuests'].forEach(id => {
                const el = document.getElementById(id);
                el.value = '';
                el.style.border = '1.5px solid #dee2e6';
                el.classList.remove('is-invalid');
            });

            const today = new Date().toISOString().split('T')[0];
            document.getElementById('lIn').min = today;
            document.getElementById('lOut').min = today;

            document.getElementById('lInError').classList.remove('show');
            document.getElementById('lOutError').classList.remove('show');
            document.getElementById('lGuestsError').classList.remove('show');

            new bootstrap.Modal(document.getElementById('roomBookingModal')).show();
        }

        /* ── Auto-open modal when editing ── */
        @if(isset($booking))
            document.addEventListener('DOMContentLoaded', function () {
                new bootstrap.Modal(document.getElementById('roomBookingModal')).show();
            });
        @endif

        /* ── Form validation ── */
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('lodForm');
            if (!form) return;

            const checkInInput  = document.getElementById('lIn');
            const checkOutInput = document.getElementById('lOut');
            const guestsInput   = document.getElementById('lGuests');
            const submitBtn     = document.getElementById('submitBtn');

            checkInInput.addEventListener('change', function () {
                const checkInDate = this.value;
                if (checkInDate) {
                    this.style.border = '1.5px solid #dee2e6';
                    document.getElementById('lInError').classList.remove('show');

                    const checkIn = new Date(checkInDate);
                    checkIn.setDate(checkIn.getDate() + 1);
                    const minCheckOut = checkIn.toISOString().split('T')[0];
                    checkOutInput.min = minCheckOut;
                    if (checkOutInput.value && checkOutInput.value < minCheckOut) {
                        checkOutInput.value = '';
                    }
                }
            });

            checkOutInput.addEventListener('change', function () {
                if (this.value) {
                    this.style.border = '1.5px solid #dee2e6';
                    document.getElementById('lOutError').classList.remove('show');
                }
            });

            guestsInput.addEventListener('input', function () {
                if (this.value >= 1 && this.value <= 4) {
                    this.style.border = '1.5px solid #dee2e6';
                    document.getElementById('lGuestsError').classList.remove('show');
                }
            });

            form.addEventListener('submit', function (e) {
                let isValid = true;

                [checkInInput, checkOutInput, guestsInput].forEach(el => {
                    el.style.border = '1.5px solid #dee2e6';
                });
                document.getElementById('lInError').classList.remove('show');
                document.getElementById('lOutError').classList.remove('show');
                document.getElementById('lGuestsError').classList.remove('show');

                if (!checkInInput.value) {
                    checkInInput.style.border = '2px solid #e53e3e';
                    document.getElementById('lInError').classList.add('show');
                    isValid = false;
                }
                if (!checkOutInput.value) {
                    checkOutInput.style.border = '2px solid #e53e3e';
                    document.getElementById('lOutError').classList.add('show');
                    isValid = false;
                }
                if (!guestsInput.value || guestsInput.value < 1 || guestsInput.value > 4) {
                    guestsInput.style.border = '2px solid #e53e3e';
                    document.getElementById('lGuestsError').classList.add('show');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    return false;
                }

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing...';
            });
        });
    </script>
</body>
</html>