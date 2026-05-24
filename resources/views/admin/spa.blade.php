<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TN ADMIN - Spa Services</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-green: #005a2b;
            --dark-green: #065f32;
            --bg-light: #ffffff;
            --card-bg: #f5f6f7;
            --container-bg: #e9ecef;
            --border-line: #e0e0e0;
            --text-black: #000000;
            --top-bar-grey: #f8f9fa;
            --status-red: #d32f2f;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; background: #fff; }

        /* ── LAYOUT ── */
        .wrapper { display: flex; height: 100vh; width: 100%; overflow: hidden; }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: 320px;
            min-width: 320px;
            background: white;
            display: flex;
            flex-direction: column;
            padding: 40px 0;
            border-right: 1.5px solid var(--border-line);
            height: 100%;
            overflow: hidden;
            transition: transform 0.3s ease;
            z-index: 1000;
            flex-shrink: 0;
        }

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
            width: 48px; height: 48px;
            border-radius: 12px;
            background: var(--primary-green);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; flex-shrink: 0;
        }

        .logo-img-wrap img { width: 30px; height: 30px; object-fit: contain; filter: brightness(0) invert(1); }

        .logo-text-block { display: flex; flex-direction: column; line-height: 1; }
        .logo-panel-title { font-size: 15px; font-weight: 800; color: var(--text-black); letter-spacing: 0.06em; text-transform: uppercase; }
        .logo-admin-name  { font-size: 12px; font-weight: 500; color: #888; margin-top: 5px; }

        .nav-links { list-style: none; padding: 0 25px; flex-grow: 1; }

        .nav-item {
            display: flex; align-items: center;
            padding: 14px 25px; margin-bottom: 15px;
            cursor: pointer; border-radius: 50px;
            font-weight: 700; color: var(--text-black);
            text-decoration: none; transition: 0.3s;
            border: none; background: none; width: 100%;
        }

        .nav-item i { margin-right: 23px; font-size: 30px; width: 33px; text-align: center; }
        .nav-item:hover { background-color: #f1f3f5; }
        .nav-item.active { background-color: var(--primary-green); color: white !important; }

        /* ── SIDEBAR OVERLAY (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 999; opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        .sidebar-overlay.active { opacity: 1; pointer-events: auto; }

        /* ── HAMBURGER (mobile only) ── */
        .hamburger-btn {
            display: none;
            position: absolute; left: 20px;
            background: none; border: none;
            cursor: pointer; padding: 6px;
            border-radius: 8px; color: var(--text-black);
            font-size: 22px; line-height: 1;
            transition: background 0.2s;
        }
        .hamburger-btn:hover { background: #f1f3f5; }

        /* ─── MAIN CONTAINER ─── */
        .main-container { flex: 1; display: flex; flex-direction: column; height: 100vh; overflow: hidden; min-width: 0; }

        /* ─── TOP BAR ─── */
        .top-bar {
            height: 100px; flex-shrink: 0;
            display: flex; justify-content: center; align-items: center;
            padding: 0 60px;
            background-color: var(--top-bar-grey);
            border-bottom: 1.5px solid var(--border-line);
            position: relative; z-index: 200;
        }

        .top-bar h1 { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; margin: 0; }

        .admin-profile-dropdown { position: absolute; right: 60px; }

        .admin-profile {
            display: flex; align-items: center; gap: 12px;
            background: white; padding: 8px 18px 8px 8px;
            border-radius: 50px; border: 1px solid var(--border-line);
            cursor: pointer; text-decoration: none; color: inherit;
        }

        .avatar {
            width: 32px; height: 32px;
            background-color: var(--primary-green);
            color: white; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold;
        }

        .dropdown-menu { border-radius: 15px; border: 1px solid var(--border-line); box-shadow: 0 10px 25px rgba(0,0,0,0.1); padding: 10px 0; margin-top: 10px !important; }
        .dropdown-item { font-weight: 600; padding: 10px 20px; font-size: 14px; }

        /* ── CONTENT WRAPPER ── */
        .content-outer { flex: 1; display: flex; flex-direction: column; overflow: hidden; background-color: var(--container-bg); }

        /* ── STICKY CONTROLS ── */
        .sticky-controls { flex-shrink: 0; background-color: var(--container-bg); padding: 25px 60px 0; z-index: 100; }

        .header-buttons { display: flex; justify-content: flex-end; gap: 15px; margin-bottom: 20px; }

        /* ── ACTION BUTTONS with active state ── */
        .btn-green-main {
            background-color: var(--primary-green);
            color: white; border: 2px solid var(--primary-green);
            padding: 12px 28px; border-radius: 12px;
            font-weight: 600; cursor: pointer; font-size: 15px;
            transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
        }
        .btn-green-main:hover { background-color: var(--dark-green); border-color: var(--dark-green); }

        /* Active/selected state — bright outline + inset shadow so it looks "pressed" */
        .btn-green-main.btn-active {
            background-color: var(--dark-green);
            border-color: #003d1c;
            box-shadow: inset 0 3px 8px rgba(0,0,0,0.35), 0 0 0 3px rgba(0,90,43,0.22);
            transform: translateY(1px);
        }

        .btn-outline-green { background-color: white; color: var(--primary-green); border: 2px solid var(--primary-green); padding: 10px 28px; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 15px; }
        .btn-outline-green:hover { background-color: var(--primary-green); color: white; }

        /* Filter pill bar */
        .spa-filter-wrapper { background-color: #f0f0f0; padding: 12px 20px; border-radius: 20px; margin-bottom: 20px; display: flex; align-items: center; gap: 15px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05); }
        .filter-group { display: flex; gap: 10px; overflow-x: auto; flex: 1; scrollbar-width: none; }
        .filter-group::-webkit-scrollbar { display: none; }
        .filter-pill { background: white; border: none; padding: 10px 24px; border-radius: 50px; font-weight: 600; font-size: 14px; color: #333; transition: 0.3s; white-space: nowrap; cursor: pointer; }
        .filter-pill.active { background-color: var(--primary-green); color: white; }
        .filter-pill:hover:not(.active) { background-color: #e0e0e0; }

        /* ── SCROLLABLE CARDS ZONE ── */
        .cards-scroll { flex: 1; overflow-y: auto; overflow-x: hidden; padding: 0 60px 30px; background-color: var(--container-bg); scrollbar-width: thin; scrollbar-color: #ccc transparent; }
        .cards-scroll::-webkit-scrollbar { width: 6px; }
        .cards-scroll::-webkit-scrollbar-track { background: transparent; }
        .cards-scroll::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }

        /* Service cards */
        .service-card { background: white; border: 1px solid #ddd; border-radius: 20px; padding: 30px; transition: 0.3s; height: 100%; position: relative; }
        .service-card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        .category-tag { color: var(--primary-green); border: 1px solid var(--primary-green); padding: 4px 15px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }

        /* ── VIEW SECTIONS ── */
        .view-section { display: none; background: white; border-radius: 30px; padding: 50px; max-width: 950px; margin: 0 auto 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); position: relative; }

        /* FORMS */
        .form-label { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 18px; margin-bottom: 8px; display: block; text-align: left; }
        .input-gray { background-color: #f2f2f2; border: 1px solid #ccc; border-radius: 12px; padding: 12px; width: 100%; margin-bottom: 15px; outline: none; }
        .upload-box { border: 2px dashed #999; height: 100px; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; overflow: hidden; position: relative; background: #f9f9f9; }
        .upload-box img { position: absolute; width: 100%; height: 100%; object-fit: cover; }
        .validation-warning { background-color: #fff3f3; color: #d32f2f; padding: 12px; border-radius: 10px; border: 1px solid #f8d7da; margin-bottom: 20px; display: none; font-weight: 600; text-align: left; }
        .cursor-pointer, .fa-pencil, .fa-trash-can, .close-x { cursor: pointer !important; }
        .close-x { position: absolute; top: 25px; right: 30px; font-size: 28px; color: #ccc; }
        .close-x:hover { color: #999; }

        /* TOAST */
        #toast-container { position: fixed; top: 30px; right: 30px; z-index: 3000; }
        .custom-toast { min-width: 300px; background: white; padding: 18px 25px; border-radius: 15px; box-shadow: 0 15px 40px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 15px; border-left: 6px solid var(--primary-green); animation: slideInToast 0.45s cubic-bezier(0.22,1,0.36,1) both; }
        @keyframes slideInToast { from { opacity:0; transform:translateX(60px); } to { opacity:1; transform:translateX(0); } }

        /* ─── MODALS ─── */
        .modal-content { border-radius: 25px; border: none; padding: 20px; }
        .modal-footer  { border: none; justify-content: center; gap: 15px; }
        .btn-confirm   { background: #dc3545; color: white; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }
        .btn-cancel    { background: #eee; color: #333; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }
        .btn-confirm-green { background: var(--primary-green); color: white; border-radius: 50px; padding: 12px 40px; border: none; font-weight: 600; cursor: pointer; }
        .btn-confirm-red   { background: var(--status-red); color: white; border-radius: 50px; padding: 12px 40px; border: none; font-weight: 600; cursor: pointer; }
        .btn-cancel-grey   { background: #f8f9fa; color: #333; border-radius: 50px; padding: 12px 40px; border: none; font-weight: 600; cursor: pointer; }

        /* ══════════════════════════════════════
           RESPONSIVE — TABLET (≤ 1100px)
        ══════════════════════════════════════ */
        @media (max-width: 1100px) {
            .sidebar { width: 260px; min-width: 260px; }
            .sticky-controls { padding: 20px 30px 0; }
            .cards-scroll { padding: 0 30px 30px; }
            .top-bar { padding: 0 30px; }
            .admin-profile-dropdown { right: 30px; }
            .btn-green-main { padding: 10px 18px; font-size: 14px; }
            .header-buttons { gap: 10px; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — MOBILE (≤ 768px)
        ══════════════════════════════════════ */
        @media (max-width: 768px) {
            body, html { overflow: auto; }
            .wrapper { flex-direction: column; height: auto; min-height: 100vh; }

            /* Sidebar drawer */
            .sidebar {
                position: fixed;
                top: 0; left: 0;
                height: 100%; width: 280px; min-width: unset;
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

            .main-container { width: 100%; height: auto; overflow: visible; }

            /* Top bar */
            .top-bar {
                height: 70px; padding: 0 16px;
                justify-content: center;
                position: sticky; top: 0; z-index: 100; flex-shrink: 0;
            }
            .top-bar h1 { font-size: 20px; }
            .hamburger-btn { display: flex; align-items: center; }
            .admin-profile-dropdown { right: 16px; }
            .admin-profile { padding: 6px 12px 6px 6px; gap: 8px; }
            .admin-profile strong { display: none; }

            /* Content outer */
            .content-outer { overflow: visible; flex: unset; }

            /* Sticky controls */
            .sticky-controls { padding: 14px 12px 0; }

            /* Header buttons — wrap on mobile */
            .header-buttons {
                flex-wrap: wrap;
                justify-content: flex-start;
                gap: 8px;
                margin-bottom: 14px;
            }
            .btn-green-main { padding: 9px 14px; font-size: 13px; border-radius: 10px; }

            /* Filter pills */
            .spa-filter-wrapper { padding: 10px 14px; border-radius: 14px; gap: 10px; }
            .filter-pill { padding: 8px 16px; font-size: 13px; }

            /* Cards scroll */
            .cards-scroll { padding: 0 12px 20px; overflow-y: visible; flex: unset; }

            /* Service cards */
            .service-card { padding: 20px 16px; border-radius: 16px; }

            /* View sections (Add/Edit forms) */
            .view-section { padding: 28px 16px; border-radius: 20px; max-width: 100%; margin: 0 0 20px; }
            .close-x { top: 16px; right: 16px; font-size: 22px; }
            .form-label { font-size: 15px; }
            .input-gray { padding: 10px; font-size: 14px; }

            /* Toast */
            #toast-container { top: 80px; right: 12px; left: 12px; }
            .custom-toast { min-width: unset; width: 100%; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤ 400px)
        ══════════════════════════════════════ */
        @media (max-width: 400px) {
            .top-bar h1 { font-size: 17px; }
            .btn-green-main { font-size: 12px; padding: 8px 11px; }
            .filter-pill { font-size: 12px; padding: 7px 12px; }
        }
    </style>
</head>
<body>

<!-- TOAST -->
<div id="toast-container">
    @if(session('success'))
        <div class="custom-toast" id="successToast">
            <i class="fa-solid fa-circle-check" style="color:var(--primary-green); font-size:20px;"></i>
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
            <li><a href="{{ route('admin.rooms') }}" class="nav-item">
                <i class="fa-solid fa-bed"></i> Rooms
            </a></li>
            <li><a href="{{ route('admin.spa') }}" class="nav-item active">
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

            <h1>Spa Services</h1>

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

        <!-- CONTENT OUTER -->
        <div class="content-outer">

            <!-- STICKY CONTROLS -->
            <div class="sticky-controls" id="stickyControls">
                <div class="header-buttons">
                    <button class="btn-green-main" id="btnManageCat"    onclick="handleHeaderBtn('manageCatView',   'btnManageCat')">Manage Category</button>
                    <button class="btn-green-main" id="btnAddPackages"  onclick="handleHeaderBtn('addPackageView', 'btnAddPackages')"><i class="fa-solid fa-box-archive"></i> Add Packages</button>
                    <button class="btn-green-main" id="btnAddService"   onclick="handleHeaderBtn('addView',        'btnAddService')"><i class="fa-solid fa-plus"></i> Add Service</button>
                </div>
                <div class="spa-filter-wrapper" id="filterBar">
                    <div class="filter-group">
                        <button class="filter-pill active" onclick="filterSpa('all', this)">All Service</button>
                        @foreach($categories as $cat)
                            <button class="filter-pill" onclick="filterSpa('{{ $cat->name }}', this)">{{ $cat->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- SCROLLABLE ZONE -->
            <div class="cards-scroll" id="cardsScroll">

                <!-- CARD GRID -->
                <div id="listView">
                    <div class="row g-4" id="spaGrid">
                        @foreach($services as $service)
                        <div class="col-md-6 spa-card" data-category="{{ $service->category->name }}">
                            <div class="service-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="category-tag">{{ $service->category->name }}</span>
                                    <div class="d-flex gap-3">
                                        <i class="fa-solid fa-pencil text-primary" style="cursor:pointer;"
                                           onclick="openEditView('{{ $service->id }}', '{{ addslashes($service->name) }}', '{{ addslashes($service->description) }}', '{{ str_replace('Nu. ', '', $service->price) }}', '{{ $service->duration }}', '{{ $service->category_id }}', '{{ $service->image }}')"></i>
                                        <i class="fa-solid fa-trash-can text-danger" style="cursor:pointer;"
                                           onclick="openDeleteModal('{{ $service->id }}', '{{ addslashes($service->name) }}')"></i>
                                    </div>
                                </div>
                                <h3 class="mt-3 mb-1 fw-bold" style="font-family:'Playfair Display';">{{ $service->name }}</h3>
                                @if($service->duration == 'Package')
                                    <ul class="mt-2 small text-muted">
                                        @foreach(explode(',', $service->description) as $item)
                                            <li>{{ trim($item) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted small">{{ $service->description }}</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
                                    <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i>{{ $service->duration }}</span>
                                    <span class="fw-bold" style="color:var(--primary-green);">{{ $service->price }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- ADD SERVICE VIEW -->
                <div id="addView" class="view-section">
                    <i class="fa-solid fa-circle-xmark close-x" onclick="askCancel()"></i>
                    <h2 class="mb-4" style="font-family:'Playfair Display'; font-weight:800;">Add Spa Service</h2>
                    <div id="addWarning" class="validation-warning">Kindly fill in all fields and select an image to proceed.</div>
                    <form id="addForm" action="{{ route('admin.spa.service.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Service Name</label>
                                <input type="text" name="name" id="addName" class="input-gray">
                                <label class="form-label">Price (Nu)</label>
                                <input type="number" name="price" id="addPrice" class="input-gray">
                                <label class="form-label">Duration</label>
                                <input type="text" name="duration" id="addDuration" class="input-gray" placeholder="e.g. 60 min">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select name="category_id" id="addCat" class="form-select input-gray" style="height:52px;">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $cat)
                                        @if(!str_contains(strtolower($cat->name), 'package'))
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label class="form-label">Upload Image</label>
                                <div class="upload-box" onclick="document.getElementById('fileAdd').click()">
                                    <i class="fa-solid fa-upload" id="upIconAdd"></i>
                                    <img id="imgPrevAdd" style="display:none;">
                                    <input type="file" name="image" id="fileAdd" hidden onchange="preview(this, 'imgPrevAdd', 'upIconAdd')">
                                </div>
                            </div>
                        </div>
                        <label class="form-label mt-3">Description</label>
                        <textarea name="description" id="addDesc" class="input-gray" rows="3"></textarea>
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="button" class="btn-cancel-grey px-5" onclick="askCancel()">Cancel</button>
                            <button type="button" class="btn-green-main px-5" onclick="askConfirm('add')">Add Service</button>
                        </div>
                    </form>
                </div>

                <!-- ADD PACKAGE VIEW -->
                <div id="addPackageView" class="view-section">
                    <i class="fa-solid fa-circle-xmark close-x" onclick="askCancel()"></i>
                    <h2 class="mb-4" style="font-family:'Playfair Display'; font-weight:800;">Add Spa Package</h2>
                    <div id="packageWarning" class="validation-warning">Kindly fill in all fields to proceed.</div>
                    <form id="packageForm" action="{{ route('admin.spa.package.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Package Name</label>
                                <input type="text" name="name" id="packageName" class="input-gray">
                                <label class="form-label">Price (Nu)</label>
                                <input type="number" name="price" id="packagePrice" class="input-gray">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category (Packages only)</label>
                                <select name="category_id" id="packageCat" class="form-select input-gray" style="height:52px;">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $cat)
                                        @if(str_contains(strtolower($cat->name), 'package'))
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label class="form-label">Services Included (comma separated)</label>
                                <textarea name="services_included" id="packageServices" class="input-gray" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="button" class="btn-cancel-grey px-5" onclick="askCancel()">Cancel</button>
                            <button type="button" class="btn-green-main px-5" onclick="askConfirm('package')">Add Package</button>
                        </div>
                    </form>
                </div>

                <!-- EDIT VIEW -->
                <div id="editView" class="view-section">
                    <i class="fa-solid fa-circle-xmark close-x" onclick="askCancel()"></i>
                    <h2 class="mb-4" style="font-family:'Playfair Display'; font-weight:800;">Edit Spa Item</h2>
                    <div id="editWarning" class="validation-warning">Please ensure all required fields are filled.</div>
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="editName" class="input-gray">
                                <label class="form-label">Price (Nu)</label>
                                <input type="number" name="price" id="editPrice" class="input-gray">
                                <div id="editDurContainer">
                                    <label class="form-label">Duration</label>
                                    <input type="text" name="duration" id="editDuration" class="input-gray">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select name="category_id" id="editCatSelect" class="form-select input-gray" style="height:52px;">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <div id="editImgContainer">
                                    <label class="form-label">Image</label>
                                    <div class="upload-box" onclick="document.getElementById('fileEdit').click()">
                                        <img id="imgPrevEdit" style="display:none;">
                                        <input type="file" name="image" id="fileEdit" hidden onchange="preview(this, 'imgPrevEdit')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="form-label mt-3" id="descLabel">Description</label>
                        <textarea name="description" id="editDesc" class="input-gray" rows="3"></textarea>
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="button" class="btn-cancel-grey px-5" onclick="askCancel()">Cancel</button>
                            <button type="button" class="btn-green-main px-5" onclick="askConfirm('edit')">Save Changes</button>
                        </div>
                    </form>
                </div>

                <!-- MANAGE CATEGORY VIEW -->
                <div id="manageCatView" class="view-section" style="max-width:600px;">
                    <i class="fa-solid fa-circle-xmark close-x" onclick="goBackToList()"></i>
                    <h2 class="mb-4" style="font-family:'Playfair Display'; font-weight:800;">Manage Categories</h2>
                    <div id="catWarning" class="validation-warning">Please enter a category name.</div>
                    <form id="catForm" action="{{ route('admin.spa.category.store') }}" method="POST" class="mb-4">
                        @csrf
                        <label class="form-label">New Category Name</label>
                        <div class="d-flex gap-2">
                            <input type="text" name="name" id="newCatInput" class="input-gray mb-0">
                            <button type="button" class="btn-green-main" onclick="askConfirm('cat')">Add</button>
                        </div>
                    </form>
                    @foreach($categories as $cat)
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3 mb-2 border">
                        <span class="fw-bold">{{ $cat->name }}</span>
                        <button type="button" class="btn btn-sm btn-danger rounded-pill px-3"
                                onclick="openDeleteCatModal('{{ $cat->id }}', '{{ addslashes($cat->name) }}')">Delete</button>
                    </div>
                    @endforeach
                </div>

            </div><!-- end .cards-scroll -->
        </div><!-- end .content-outer -->
    </div><!-- end .main-container -->
</div><!-- end .wrapper -->


<!-- LOGOUT MODAL -->
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

<!-- ACTION CONFIRM MODAL -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center shadow-lg">
            <h3 id="modalTitle" style="font-family:'Playfair Display'; font-weight:700;">Are you sure?</h3>
            <p id="modalBody" class="py-3 text-muted"></p>
            <div class="d-flex justify-content-center gap-3">
                <button class="btn-cancel-grey" data-bs-dismiss="modal">No</button>
                <button id="confirmBtn" class="btn-confirm-green">Yes, Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- DELETE CONFIRM MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center shadow-lg">
            <h3 style="font-family:'Playfair Display'; font-weight:700;">Are you sure?</h3>
            <p class="py-3 text-muted" id="delPromptText"></p>
            <form id="delForm" method="POST">
                @csrf @method('DELETE')
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn-cancel-grey" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-confirm-red">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

    /* ── TOAST ── */
    window.onload = function() {
        const toast = document.getElementById('successToast');
        if (toast) {
            setTimeout(() => {
                toast.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(60px)';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }
    };

    /* ── MOBILE SIDEBAR TOGGLE ── */
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

    /* ── ACTIVE BUTTON STATE ── */
    // IDs of the three header action buttons
    const HEADER_BTNS = ['btnManageCat', 'btnAddPackages', 'btnAddService'];

    function setActiveHeaderBtn(activeBtnId) {
        HEADER_BTNS.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.classList.toggle('btn-active', id === activeBtnId);
        });
    }

    function clearActiveHeaderBtns() {
        HEADER_BTNS.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.classList.remove('btn-active');
        });
    }

    /* ── HANDLE HEADER BUTTON CLICK ── */
    function handleHeaderBtn(viewId, btnId) {
        if (viewId === 'addView') {
            openAddView();
        } else if (viewId === 'addPackageView') {
            openAddPackageView();
        } else {
            toggleView(viewId);
        }
        setActiveHeaderBtn(btnId);
    }

    /* ── FORM SNAPSHOT (dirty-check) ── */
    let _formSnapshot = '';
    let _activeFormId = '';

    function snapshotForm(formId) {
        _activeFormId = formId;
        const form = document.getElementById(formId);
        if (!form) { _formSnapshot = ''; return; }
        const data = {};
        form.querySelectorAll('input:not([type=hidden]):not([type=file]), select, textarea')
            .forEach(el => { data[el.name || el.id] = el.value; });
        _formSnapshot = JSON.stringify(data);
    }

    function formIsDirty() {
        if (!_activeFormId) return false;
        const form = document.getElementById(_activeFormId);
        if (!form || _formSnapshot === '') return false;
        const data = {};
        form.querySelectorAll('input:not([type=hidden]):not([type=file]), select, textarea')
            .forEach(el => { data[el.name || el.id] = el.value; });
        let fileChanged = false;
        form.querySelectorAll('input[type=file]').forEach(f => { if (f.files && f.files.length > 0) fileChanged = true; });
        return JSON.stringify(data) !== _formSnapshot || fileChanged;
    }

    /* ── VIEW SWITCHER ── */
    function toggleView(id) {
        document.getElementById('listView').style.display = 'none';
        document.querySelectorAll('.view-section').forEach(s => s.style.display = 'none');
        document.querySelectorAll('.validation-warning').forEach(w => w.style.display = 'none');
        document.getElementById(id).style.display = 'block';
        document.getElementById('cardsScroll').scrollTop = 0;
        if (id === 'listView') {
            _formSnapshot = '';
            _activeFormId = '';
            clearActiveHeaderBtns();
        }
    }

    /* Go back to list and clear active button */
    function goBackToList() {
        toggleView('listView');
        clearActiveHeaderBtns();
    }

    /* ── CONFIRM SAVE ── */
    function askConfirm(type) {
        let formId = '';
        if (type === 'add') {
            if (!document.getElementById('addName').value ||
                !document.getElementById('addPrice').value ||
                !document.getElementById('addCat').value ||
                !document.getElementById('fileAdd').files.length) {
                document.getElementById('addWarning').style.display = 'block'; return;
            }
            formId = 'addForm';
        } else if (type === 'package') {
            if (!document.getElementById('packageName').value ||
                !document.getElementById('packagePrice').value ||
                !document.getElementById('packageCat').value ||
                !document.getElementById('packageServices').value) {
                document.getElementById('packageWarning').style.display = 'block'; return;
            }
            formId = 'packageForm';
        } else if (type === 'edit') {
            if (!document.getElementById('editName').value ||
                !document.getElementById('editPrice').value) {
                document.getElementById('editWarning').style.display = 'block'; return;
            }
            formId = 'editForm';
        } else if (type === 'cat') {
            if (!document.getElementById('newCatInput').value) {
                document.getElementById('catWarning').style.display = 'block'; return;
            }
            formId = 'catForm';
        }
        document.getElementById('modalTitle').innerText = 'Confirmation';
        document.getElementById('modalBody').innerText  = 'Do you want to proceed with this action?';
        document.getElementById('confirmBtn').onclick   = () => document.getElementById(formId).submit();
        new bootstrap.Modal(document.getElementById('actionModal')).show();
    }

    /* ── SMART CANCEL ── */
    function askCancel() {
        if (formIsDirty()) {
            document.getElementById('modalTitle').innerText = 'Discard Changes?';
            document.getElementById('modalBody').innerText  = 'Any unsaved information will be lost.';
            document.getElementById('confirmBtn').onclick   = () => {
                goBackToList();
                bootstrap.Modal.getInstance(document.getElementById('actionModal')).hide();
            };
            new bootstrap.Modal(document.getElementById('actionModal')).show();
        } else {
            goBackToList();
        }
    }

    /* ── OPEN HELPERS ── */
    function openAddView() {
        document.getElementById('addForm').reset();
        document.getElementById('imgPrevAdd').style.display = 'none';
        document.getElementById('upIconAdd').style.display  = 'block';
        document.getElementById('addWarning').style.display = 'none';
        toggleView('addView');
        snapshotForm('addForm');
    }

    function openAddPackageView() {
        document.getElementById('packageForm').reset();
        document.getElementById('packageWarning').style.display = 'none';
        toggleView('addPackageView');
        snapshotForm('packageForm');
    }

    /* ── DELETE MODALS ── */
    function openDeleteModal(id, name) {
        document.getElementById('delPromptText').innerHTML = `Delete <b>${name}</b>?`;
        document.getElementById('delForm').action = `/admin/spa/service/${id}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    function openDeleteCatModal(id, name) {
        document.getElementById('delPromptText').innerHTML = `Delete category <b>${name}</b>? This will also delete all services inside.`;
        document.getElementById('delForm').action = `/admin/spa/category/${id}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    /* ── EDIT VIEW ── */
    function openEditView(id, name, desc, price, dur, catId, img) {
        document.getElementById('editForm').action       = `/admin/spa/service/${id}`;
        document.getElementById('editName').value        = name;
        document.getElementById('editPrice').value       = price;
        document.getElementById('editDuration').value    = dur;
        document.getElementById('editDesc').value        = desc;
        document.getElementById('editCatSelect').value   = catId;

        if (dur === 'Package') {
            document.getElementById('editImgContainer').style.display = 'none';
            document.getElementById('editDurContainer').style.display = 'none';
            document.getElementById('descLabel').innerText = 'Services Included';
        } else {
            document.getElementById('editImgContainer').style.display = 'block';
            document.getElementById('editDurContainer').style.display = 'block';
            document.getElementById('descLabel').innerText = 'Description';
            const prev = document.getElementById('imgPrevEdit');
            if (img) { prev.src = `/images/spa/${img}`; prev.style.display = 'block'; }
            else      { prev.style.display = 'none'; }
        }
        // Edit is triggered from a card (not a header button) — clear header active state
        clearActiveHeaderBtns();
        toggleView('editView');
        snapshotForm('editForm');
    }

    /* ── IMAGE PREVIEW ── */
    function preview(input, imgId, iconId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById(imgId);
                img.src = e.target.result;
                img.style.display = 'block';
                if (iconId) document.getElementById(iconId).style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    /* ── FILTER ── */
    function filterSpa(cat, btn) {
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.spa-card').forEach(card => {
            card.style.display = (cat === 'all' || card.getAttribute('data-category') === cat) ? 'block' : 'none';
        });
    }

</script>
</body>
</html>