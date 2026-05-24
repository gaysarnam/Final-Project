<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TN ADMIN - Rooms Management</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Premium Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-green: #005a2b;
            --bg-light: #ffffff;
            --card-bg: #f5f6f7;
            --container-bg: #e9e9e9;
            --border-line: #e0e0e0;
            --text-black: #000000;
            --top-bar-grey: #f8f9fa;
            --input-bg: #f2f2f2;
            --status-red: #d32f2f;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body, html { height: 100%; overflow: hidden; background-color: #fff; }

        .wrapper { display: flex; height: 100vh; width: 100%; }

        /* ─── SIDEBAR — matched to dashboard ─── */
        .sidebar {
            width: 320px;
            background: white;
            display: flex;
            flex-direction: column;
            padding: 40px 0;
            border-right: 1.5px solid var(--border-line);
            height: 100%;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        /* ── Logo area: image + two-line text ── */
        .logo-area {
            padding: 0 40px;
            margin-bottom: 70px;
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: var(--text-black);
        }

        .logo-img-wrap {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--primary-green);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .logo-img-wrap img {
            width: 30px;
            height: 30px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .logo-text-block {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .logo-panel-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-black);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .logo-admin-name {
            font-size: 12px;
            font-weight: 500;
            color: #888;
            margin-top: 5px;
        }

        /* ─── NAV — matched to dashboard ─── */
        .nav-links { list-style: none; padding: 0 25px; flex-grow: 1; }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 14px 25px;
            margin-bottom: 15px;
            cursor: pointer;
            border-radius: 50px;
            font-weight: 700;
            color: var(--text-black);
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-item i { margin-right: 23px; font-size: 30px; width: 33px; text-align: center; }
        .nav-item:hover { background-color: #f1f3f5; }
        .nav-item.active { background-color: var(--primary-green); color: white !important; }

        /* ── SIDEBAR OVERLAY (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        .sidebar-overlay.active { opacity: 1; pointer-events: auto; }

        /* ── HAMBURGER (mobile only) ── */
        .hamburger-btn {
            display: none;
            position: absolute;
            left: 20px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
            color: var(--text-black);
            font-size: 22px;
            line-height: 1;
            transition: background 0.2s;
        }
        .hamburger-btn:hover { background: #f1f3f5; }

        /* ─── MAIN CONTAINER ─── */
        .main-container { flex: 1; display: flex; flex-direction: column; height: 100%; min-width: 0; }

        /* ─── TOP BAR — matched to dashboard ─── */
        .top-bar {
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 60px;
            background-color: var(--top-bar-grey);
            border-bottom: 1.5px solid var(--border-line);
            position: relative;
            flex-shrink: 0;
        }

        .top-bar h1 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; margin: 0; }

        /* ─── ADMIN PROFILE — matched to dashboard ─── */
        .admin-profile-dropdown { position: absolute; right: 60px; }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 8px 18px 8px 8px;
            border-radius: 50px;
            border: 1px solid var(--border-line);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .avatar {
            width: 32px; height: 32px;
            background-color: var(--primary-green);
            color: white; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold;
        }

        .dropdown-menu {
            border-radius: 15px;
            border: 1px solid var(--border-line);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 10px 0;
            margin-top: 10px !important;
        }
        .dropdown-item { font-weight: 600; padding: 10px 20px; font-size: 14px; }

        /* ─── CONTENT AREA ─── */
        .content-area {
            flex-grow: 1;
            overflow-y: auto;
            padding: 40px 60px;
            background-color: #fff;
        }

        /* Sticky Add Button Bar */
        .content-header {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }

        .btn-add-room {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-add-room:hover { opacity: 0.9; }

        /* ─── ROOM GRID ─── */
        .room-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 30px; }

        .room-card {
            background: white;
            border-radius: 25px;
            padding: 30px;
            position: relative;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1.5px solid var(--border-line);
        }

        .room-title { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; }
        .action-icons { position: absolute; top: 30px; right: 30px; display: flex; gap: 15px; font-size: 18px; color: #555; }
        .action-icons i { cursor: pointer; }
        .price-tag { text-align: right; font-weight: 700; margin-bottom: 15px; color: var(--primary-green); }
        .amenity-badge { background: #f0f0f0; padding: 5px 12px; border-radius: 8px; font-size: 12px; margin-right: 5px; display: inline-block; margin-bottom: 5px; font-weight: 600; }
        .status-label { font-size: 14px; font-weight: 700; text-transform: capitalize; color: #333; margin-right: 10px; }

        /* ─── TOAST ─── */
        #toast-container { position: fixed; top: 30px; right: 30px; z-index: 3000; }
        .custom-toast { min-width: 300px; background: white; padding: 15px 25px; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); border-left: 6px solid var(--primary-green); transition: 0.5s; }
        .toast-hide { transform: translateX(150%); }

        /* ─── VALIDATION WARNING ─── */
        .validation-warning { background-color: #fff3f3; color: #d32f2f; padding: 12px; border-radius: 10px; border: 1px solid #f8d7da; margin-bottom: 20px; display: none; font-weight: 600; }

        /* ─── MODALS ─── */
        .modal-content { border-radius: 25px; border: none; padding: 35px; }
        .modal-title-custom { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 32px; margin-bottom: 5px; }
        .form-label { font-family: 'Inter', sans-serif; font-weight: 600; font-size: 16px; margin-bottom: 8px; display: block; text-align: left; }
        .custom-input { background-color: var(--input-bg); border: 1px solid #ddd; border-radius: 12px; padding: 15px; width: 100%; margin-bottom: 20px; outline: none; }
        .upload-box { background-color: var(--input-bg); border: 1px dashed #999; height: 110px; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; overflow: hidden; position: relative; }
        .upload-box img { position: absolute; width: 100%; height: 100%; object-fit: cover; }

        /* ─── LOGOUT MODAL — matched exactly to dashboard ─── */
        .modal-footer  { border: none; justify-content: center; gap: 15px; }
        .btn-confirm   { background: #dc3545; color: white; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }
        .btn-cancel    { background: #eee; color: #333; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }

        /* ══════════════════════════════════════
           RESPONSIVE — TABLET (≤ 1100px)
        ══════════════════════════════════════ */
        @media (max-width: 1100px) {
            .sidebar { width: 260px; }
            .content-area { padding: 30px 36px; }
            .top-bar { padding: 0 30px; }
            .admin-profile-dropdown { right: 30px; }
            .room-grid { grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — MOBILE (≤ 768px)
        ══════════════════════════════════════ */
        @media (max-width: 768px) {
            body, html { overflow: auto; }
            .wrapper { flex-direction: column; height: auto; min-height: 100vh; }

            /* Sidebar becomes a fixed off-screen drawer */
            .sidebar {
                position: fixed;
                top: 0; left: 0;
                height: 100%;
                width: 280px;
                transform: translateX(-100%);
                overflow-y: auto;
                padding: 30px 0;
                box-shadow: 4px 0 24px rgba(0,0,0,0.12);
            }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: block; }

            .logo-area { margin-bottom: 40px; padding: 0 24px; }
            .nav-links { padding: 0 14px; }
            .nav-item { padding: 12px 18px; margin-bottom: 8px; font-size: 14px; }
            .nav-item i { font-size: 22px; margin-right: 16px; width: 26px; }

            .main-container { width: 100%; height: auto; }

            /* Top bar */
            .top-bar {
                height: 70px;
                padding: 0 16px;
                justify-content: center;
                position: sticky;
                top: 0;
                z-index: 100;
                flex-shrink: 0;
            }
            .top-bar h1 { font-size: 20px; }
            .hamburger-btn { display: flex; align-items: center; }
            .admin-profile-dropdown { right: 16px; }
            .admin-profile { padding: 6px 12px 6px 6px; gap: 8px; }
            .admin-profile strong { display: none; }

            /* Content */
            .content-area {
                padding: 20px 14px;
                flex-grow: unset;
                overflow-y: visible;
            }

            /* Room grid — single column */
            .room-grid { grid-template-columns: 1fr; gap: 16px; }

            /* Room cards */
            .room-card { padding: 20px 16px; border-radius: 18px; }
            .room-title { font-size: 18px; padding-right: 60px; /* avoid overlap with action icons */ }
            .action-icons { top: 20px; right: 16px; gap: 12px; font-size: 16px; }
            .price-tag { font-size: 14px; }
            .amenity-badge { font-size: 11px; padding: 4px 10px; }
            .status-label { font-size: 13px; }

            /* Modals — full width on mobile */
            .modal-content { padding: 24px 18px; border-radius: 18px; }
            .modal-title-custom { font-size: 24px; }
            .form-label { font-size: 14px; }
            .custom-input { padding: 12px; font-size: 14px; }

            /* Toast */
            #toast-container { top: 80px; right: 14px; left: 14px; }
            .custom-toast { min-width: unset; width: 100%; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤ 400px)
        ══════════════════════════════════════ */
        @media (max-width: 400px) {
            .top-bar h1 { font-size: 17px; }
            .room-title { font-size: 16px; }
            .btn-add-room { padding: 10px 18px; font-size: 13px; }
        }
    </style>
</head>
<body>

    <!-- Notification Toast -->
    <div id="toast-container">
        @if(session('success'))
            <div class="custom-toast" id="successToast">
                <i class="fa-solid fa-circle-check" style="color: var(--primary-green); font-size: 20px; margin-right: 10px;"></i>
                <span><b>{{ session('success') }}</b></span>
            </div>
        @endif
    </div>

    <!-- Sidebar overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="wrapper">

        <!-- ══════════════ SIDEBAR ══════════════ -->
        <aside class="sidebar" id="sidebar">

            <a href="{{ route('admin.dashboard') }}" class="logo-area">
                <div class="logo-img-wrap">
                    <img src="{{ asset('images/logo.png') }}" alt="TN Logo">
                </div>
                <div class="logo-text-block">
                    <span class="logo-panel-title">Admin Panel</span>
                    <span class="logo-admin-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="fa-solid fa-table-cells-large"></i> Dashboard
                </a></li>
                <li><a href="{{ route('admin.bookings') }}" class="nav-item">
                    <i class="fa-solid fa-calendar-check"></i> Bookings
                </a></li>
                <li><a href="{{ route('admin.menu') }}" class="nav-item">
                    <i class="fa-solid fa-utensils"></i> Restaurant
                </a></li>
                <li><a href="{{ route('admin.rooms') }}" class="nav-item active">
                    <i class="fa-solid fa-bed"></i> Rooms
                </a></li>
                <li><a href="{{ route('admin.spa') }}" class="nav-item">
                    <i class="fa-solid fa-spa"></i> Spa Services
                </a></li>
                <li><a href="{{ route('admin.users') }}" class="nav-item">
                    <i class="fa-solid fa-circle-user"></i> Users
                </a></li>
                <li><a href="{{ route('admin.feedback') }}" class="nav-item">
                    <i class="fa-solid fa-comments"></i> Feedback
                </a></li>
            </ul>
        </aside>

        <!-- ══════════════ MAIN ══════════════ -->
        <div class="main-container">

            <header class="top-bar">
                <!-- Hamburger (mobile only) -->
                <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <h1>Rooms</h1>

                <div class="admin-profile-dropdown dropdown">
                    <div class="admin-profile dropdown-toggle"
                         id="adminDropdown"
                         data-bs-toggle="dropdown"
                         aria-expanded="false">
                        <div class="avatar">{{ substr(Auth::user()->first_name, 0, 1) }}</div>
                        <strong style="font-size:13px;">{{ Auth::user()->first_name }}</strong>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="adminDropdown">
                        <li><a class="dropdown-item" href="{{ route('custom.profile.show') }}">Profile Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"
                               data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Log Out</a></li>
                    </ul>
                </div>
            </header>

            <main class="content-area">
                <!-- Add Room button stays at top of scrollable area -->
                <div class="content-header">
                    <button class="btn-add-room" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                        <i class="fa-solid fa-plus"></i> Add Room
                    </button>
                </div>

                <div class="room-grid">
                    @forelse($rooms as $room)
                    <div class="room-card">
                        <div class="room-title">{{ $room->name }}</div>
                        <div class="action-icons">
                            <i class="fa-regular fa-pen-to-square text-primary"
                               onclick="openEditModal('{{ $room->id }}', '{{ $room->name }}', '{{ $room->description }}', '{{ $room->price }}', '{{ $room->amenities }}', '{{ $room->image }}')"></i>
                            <i class="fa-regular fa-trash-can text-danger"
                               onclick="openDeleteModal('{{ $room->id }}', '{{ $room->name }}')"></i>
                        </div>
                        <p class="text-muted mt-2 small">{{ Str::limit($room->description, 120) }}</p>
                        <div class="price-tag">Nu. {{ $room->price }}/Per night</div>
                        <div>
                            @foreach(explode(',', $room->amenities) as $amenity)
                                <span class="amenity-badge">{{ trim($amenity) }}</span>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-end align-items-center mt-3">
                            <span class="status-label" id="status-text-{{ $room->id }}">{{ $room->status }}</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                       {{ $room->status == 'available' ? 'checked' : '' }}
                                       onchange="toggleStatus('{{ $room->id }}')">
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center w-100 py-5 text-muted">No rooms added yet.</p>
                    @endforelse
                </div>
            </main>
        </div>
    </div>

    <!-- ══════════════ LOGOUT MODAL — matched to dashboard ══════════════ -->
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center shadow">
                <div class="modal-header border-0 justify-content-center">
                    <h5 class="modal-title h3" style="font-family:'Playfair Display';font-weight:700;">Are you sure?</h5>
                </div>
                <div class="modal-body py-0">
                    <p class="text-muted">Do you really want to log out of the admin panel?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">No, stay</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-confirm">Yes, Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════ ADD ROOM MODAL ══════════════ -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <i class="fa-solid fa-circle-xmark position-absolute" style="top:25px; right:25px; font-size:24px; cursor:pointer;" data-bs-dismiss="modal"></i>
                <h2 class="modal-title-custom">Add Room</h2>
                <div id="addRoomWarning" class="validation-warning">Please fill all fields and select an image.</div>
                <form id="addRoomForm" action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Room Name</label>
                            <input type="text" name="name" id="addName" class="custom-input">
                            <label class="form-label">Price (Nu)</label>
                            <input type="number" name="price" id="addPrice" class="custom-input">
                            <label class="form-label">Amenities</label>
                            <input type="text" name="amenities" id="addAmenities" class="custom-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="addDesc" class="custom-input" rows="4" style="height: 125px;"></textarea>
                            <label class="form-label">Upload Image</label>
                            <div class="upload-box" onclick="document.getElementById('roomImg').click()">
                                <i class="fa-solid fa-upload" id="upIconAdd"></i>
                                <img id="imgPrevAdd" style="display:none;">
                                <input type="file" name="image" id="roomImg" hidden
                                       onchange="preview(this, 'imgPrevAdd', 'upIconAdd')">
                            </div>
                        </div>
                    </div>
                    <button type="submit" style="background:var(--primary-green); color:white; width:100%; border:none; padding:15px; border-radius:12px; font-weight:700; margin-top:20px;">Add Room</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ══════════════ EDIT ROOM MODAL ══════════════ -->
    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <i class="fa-solid fa-circle-xmark position-absolute" style="top:25px; right:25px; font-size:24px; cursor:pointer;" data-bs-dismiss="modal"></i>
                <h2 class="modal-title-custom">Edit Room</h2>
                <div id="editRoomWarning" class="validation-warning">Please fill all required text fields.</div>
                <form id="editRoomForm" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Room Name</label>
                            <input type="text" name="name" id="editName" class="custom-input">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" id="editPrice" class="custom-input">
                            <label class="form-label">Amenities</label>
                            <input type="text" name="amenities" id="editAmenities" class="custom-input">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="editDesc" class="custom-input" rows="4" style="height: 125px;"></textarea>
                            <label class="form-label">Image</label>
                            <div class="upload-box" onclick="document.getElementById('editImg').click()">
                                <img id="imgPrevEdit" style="display:none;">
                                <input type="file" name="image" id="editImg" hidden
                                       onchange="preview(this, 'imgPrevEdit')">
                            </div>
                        </div>
                    </div>
                    <button type="submit" style="background:var(--primary-green); color:white; width:100%; border:none; padding:15px; border-radius:12px; font-weight:700; margin-top:20px;">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ══════════════ DELETE MODAL ══════════════ -->
    <div class="modal fade" id="deleteRoomModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center shadow">
                <div class="modal-header border-0 justify-content-center">
                    <h5 class="modal-title h3" style="font-family:'Playfair Display';font-weight:700;">Delete Room</h5>
                </div>
                <div class="modal-body py-0">
                    <p class="text-muted">Are you sure you want to delete <b id="delRoomName"></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">No, cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-confirm">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toast auto-hide
        window.onload = function() {
            const toast = document.getElementById('successToast');
            if (toast) {
                setTimeout(() => {
                    toast.classList.add('toast-hide');
                    setTimeout(() => toast.remove(), 500);
                }, 2000);
            }
        };

        // Add Room validation
        document.getElementById('addRoomForm').onsubmit = function(e) {
            const name      = document.getElementById('addName').value;
            const price     = document.getElementById('addPrice').value;
            const amenities = document.getElementById('addAmenities').value;
            const desc      = document.getElementById('addDesc').value;
            const img       = document.getElementById('roomImg').files.length;
            if (!name || !price || !amenities || !desc || img === 0) {
                e.preventDefault();
                document.getElementById('addRoomWarning').style.display = 'block';
                return false;
            }
        };

        // Edit Room validation
        document.getElementById('editRoomForm').onsubmit = function(e) {
            const name      = document.getElementById('editName').value;
            const price     = document.getElementById('editPrice').value;
            const amenities = document.getElementById('editAmenities').value;
            const desc      = document.getElementById('editDesc').value;
            if (!name || !price || !amenities || !desc) {
                e.preventDefault();
                document.getElementById('editRoomWarning').style.display = 'block';
                return false;
            }
        };

        function preview(input, imgId, iconId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(imgId);
                    img.src = e.target.result;
                    img.style.display = 'block';
                    if (iconId) document.getElementById(iconId).style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function toggleStatus(id) {
            fetch(`/admin/rooms/toggle/${id}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => { document.getElementById(`status-text-${id}`).innerText = data.status; });
        }

        function openEditModal(id, name, desc, price, amenities, img) {
            document.getElementById('editRoomForm').action = `/admin/rooms/update/${id}`;
            document.getElementById('editName').value      = name;
            document.getElementById('editDesc').value      = desc;
            document.getElementById('editPrice').value     = price;
            document.getElementById('editAmenities').value = amenities;
            const prev = document.getElementById('imgPrevEdit');
            if (img) { prev.src = `/images/rooms/${img}`; prev.style.display = 'block'; }
            new bootstrap.Modal(document.getElementById('editRoomModal')).show();
        }

        function openDeleteModal(id, name) {
            document.getElementById('delRoomName').innerText    = name;
            document.getElementById('deleteForm').action        = `/admin/rooms/delete/${id}`;
            new bootstrap.Modal(document.getElementById('deleteRoomModal')).show();
        }

        /* ── Mobile sidebar toggle ── */
        (function () {
            const btn     = document.getElementById('hamburgerBtn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            if (btn)     btn.addEventListener('click', openSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);

            document.querySelectorAll('.nav-item').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 768) closeSidebar();
                });
            });
        })();
    </script>
</body>
</html>