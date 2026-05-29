<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TN ADMIN - Bookings</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.PNG') }}?v=2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-green: #005a2b;
            --bg-light: #ffffff;
            --card-bg: #f5f6f7;
            --border-line: #e0e0e0;
            --text-black: #000000;
            --top-bar-grey: #f8f9fa;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body, html { height: 100%; overflow: hidden; }
        .wrapper { display: flex; height: 100vh; width: 100%; }

        /* SIDEBAR */
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

        /* NAV */
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
            position: relative;
        }

        .nav-item i { margin-right: 23px; font-size: 30px; width: 33px; text-align: center; }
        .nav-item:hover { background-color: #f1f3f5; }
        .nav-item.active { background-color: var(--primary-green); color: white !important; }

        /* NEW BOOKING BADGE */
        .new-booking-badge {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: #d32f2f;
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            animation: badgePulse 2s infinite;
        }
        @keyframes badgePulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(211,47,47,0.5); }
            50%       { box-shadow: 0 0 0 5px rgba(211,47,47,0); }
        }

        /* SIDEBAR OVERLAY (mobile) */
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

        /* HAMBURGER */
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

        /* MAIN */
        .main-container { flex: 1; display: flex; flex-direction: column; height: 100%; overflow: hidden; }

        /* TOP BAR */
        .top-bar {
            flex-shrink: 0;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 60px;
            background-color: var(--top-bar-grey);
            border-bottom: 1.5px solid var(--border-line);
            position: relative;
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

        .dropdown-menu {
            border-radius: 15px;
            border: 1px solid var(--border-line);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 10px 0;
            margin-top: 10px !important;
        }
        .dropdown-item { font-weight: 600; padding: 10px 20px; font-size: 14px; }

        /* CONTENT AREA */
        .content-section {
            flex: 1; overflow: hidden;
            display: flex; flex-direction: column;
            background-color: #fff;
            padding: 30px 60px 0 60px;
        }

        /* STICKY HEADER */
        .sticky-header { flex-shrink: 0; background: #fff; padding-bottom: 20px; z-index: 100; }

        .search-row {
            background: white; border: 1px solid #999;
            border-radius: 15px; display: flex; align-items: center;
            padding: 5px 20px; margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .search-input-group { display: flex; align-items: center; flex: 1; gap: 15px; border-right: 1px solid #ccc; padding: 5px 0; }
        .search-input-group input { border: none; outline: none; width: 100%; font-size: 17px; font-family: 'Playfair Display', serif; background: transparent; }
        .status-dropdown-container { position: relative; padding-left: 20px; min-width: 160px; }
        .status-trigger { cursor: pointer; font-family: 'Playfair Display', serif; font-size: 18px; display: flex; justify-content: space-between; align-items: center; gap: 10px; }
        .status-menu { display: none; position: absolute; top: 110%; right: 0; background: white; border: 1px solid #ccc; border-radius: 10px; width: 150px; z-index: 200; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .status-menu div { padding: 10px 15px; cursor: pointer; }
        .status-menu div:hover { background: #f0f0f0; }

        .booking-tabs { background: #d1d1d1; padding: 8px; border-radius: 15px; display: flex; gap: 10px; }
        .tab-btn { flex: 1; padding: 12px; text-align: center; font-family: 'Playfair Display', serif; font-weight: 700; border-radius: 12px; cursor: pointer; border: none; background: transparent; transition: 0.2s; }
        .tab-btn.active { background: white; }

        /* TABLE */
        .table-scroll-wrapper { flex: 1; overflow-y: auto; }

        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        thead { position: sticky; top: 0; z-index: 50; background: #fff; }

        th {
            font-family: 'Playfair Display', serif; font-size: 16px;
            text-align: left; padding: 18px 12px 15px 12px;
            border-bottom: 2.5px solid #222;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
            background: #fff;
        }

        td {
            padding: 18px 12px; vertical-align: middle;
            border-bottom: 1px solid #d0d0d0;
            font-size: 14px; overflow: hidden;
        }
        tr:last-child td { border-bottom: none; }

        th:nth-child(1), td:nth-child(1) { width: 7%; }
        th:nth-child(2), td:nth-child(2) { width: 20%; overflow: visible; white-space: normal; word-break: break-word; }
        th:nth-child(3), td:nth-child(3) { width: 9%; }
        th:nth-child(4), td:nth-child(4) { width: 13%; }
        th:nth-child(5), td:nth-child(5) { width: 14%; }
        th:nth-child(6), td:nth-child(6) { width: 10%; }
        th:nth-child(7), td:nth-child(7) { width: 21%; }
        th:nth-child(8), td:nth-child(8) { width: 6%; }

        .status-pill { padding: 4px 12px; border-radius: 10px; font-weight: 600; font-size: 13px; display: inline-block; white-space: nowrap; }
        .st-Cancelled { background: #ffcdd2; color: #d32f2f; }
        .st-Confirmed { background: #c8e6c9; color: #2e7d32; }
        .st-Pending   { background: #fff3e0; color: #e65100; }

        /* ACTIONS CELL — whatsapp + eye */
        .actions-cell { display: flex; align-items: center; justify-content: center; gap: 6px; }
        .action-icon-btn {
            width: 34px; height: 34px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            transition: transform 0.15s, opacity 0.15s;
            flex-shrink: 0;
        }
        .action-icon-btn:hover { transform: translateY(-1px); opacity: 0.85; }
        .action-icon-btn i { font-size: 16px; line-height: 1; }
        .action-btn-whatsapp { background: #25d366; color: white; }
        .action-btn-whatsapp.disabled { background: #ccc; cursor: not-allowed; }
        .action-btn-whatsapp.disabled:hover { transform: none; opacity: 1; }
        .action-btn-eye { background: #f1f3f5; color: #333; border: 1px solid #e0e0e0; }
        .action-btn-eye:hover { background: #e8eaed; }

        .date-label { display: block; font-size: 11px; color: #888; font-weight: 700; text-transform: uppercase; margin-bottom: 1px; }
        .date-val   { display: block; font-size: 13px; color: #111; font-weight: 600; }
        .date-row   { margin-bottom: 5px; }
        .date-row:last-child { margin-bottom: 0; }

        /* SUCCESS NOTIFICATION */
        .success-notification {
            position: fixed; top: 120px; left: 50%;
            transform: translateX(-50%) translateY(-20px);
            background: var(--primary-green); color: white;
            padding: 16px 32px; border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,90,43,0.3);
            z-index: 4000; display: none; align-items: center;
            gap: 12px; font-weight: 600; font-size: 15px;
            animation: slideDownFade 0.3s ease;
        }
        .success-notification.show { display: flex; }
        .success-notification i { font-size: 20px; }
        @keyframes slideDownFade {
            from { opacity: 0; transform: translateX(-50%) translateY(-20px); }
            to   { opacity: 1; transform: translateX(-50%) translateY(0); }
        }
        @keyframes slideUpFade {
            from { opacity: 1; transform: translateX(-50%) translateY(0); }
            to   { opacity: 0; transform: translateX(-50%) translateY(-20px); }
        }
        .success-notification.hiding { animation: slideUpFade 0.3s ease forwards; }

        /* VIEW MODAL */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; }
        .modal-card { background: white; width: 720px; border-radius: 20px; padding: 35px; position: relative; box-shadow: 0 10px 40px rgba(0,0,0,0.2); max-height: 90vh; overflow-y: auto; }
        .close-modal { position: absolute; top: 20px; right: 25px; font-size: 28px; cursor: pointer; color: #333; background: none; border: none; line-height: 1; }
        .modal-header-custom h2 { font-weight: 800; font-size: 24px; margin-bottom: 5px; font-family: 'Playfair Display', serif; }
        .modal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px 40px; margin-top: 20px; }
        .modal-item label { display: block; font-weight: 800; font-size: 12px; margin-bottom: 5px; color: #777; text-transform: uppercase; }
        .modal-item p { font-size: 16px; color: #000; font-weight: 600; margin: 0; }
        .special-req-box { grid-column: span 2; background: #f9f9f9; padding: 15px; border-radius: 10px; border-left: 4px solid var(--primary-green); }

        .order-items-box {
            grid-column: span 2; background: #f0f7f4; padding: 18px;
            border-radius: 12px; border-left: 4px solid var(--primary-green); margin-top: 10px;
        }
        .order-items-box label { display: block; font-weight: 800; font-size: 12px; margin-bottom: 12px; color: var(--primary-green); text-transform: uppercase; }
        .order-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #d4e8dd; }
        .order-item:last-child { border-bottom: none; }
        .order-item-name  { font-weight: 600; color: #111; font-size: 14px; }
        .order-item-qty   { background: var(--primary-green); color: white; padding: 2px 10px; border-radius: 12px; font-size: 12px; font-weight: 700; margin: 0 10px; }
        .order-item-price { font-weight: 700; color: var(--primary-green); font-size: 14px; }
        .order-total { display: flex; justify-content: flex-end; margin-top: 12px; padding-top: 12px; border-top: 2px solid var(--primary-green); font-size: 16px; font-weight: 800; color: var(--primary-green); }

        /* TABLE SCHEDULE BOX */
        .table-schedule-box {
            grid-column: span 2;
            background: #f4f8ff;
            border-radius: 12px;
            border-left: 4px solid #1565c0;
            padding: 16px 18px;
            margin-top: 4px;
        }
        .table-schedule-box .schedule-label {
            display: block;
            font-weight: 800;
            font-size: 12px;
            margin-bottom: 12px;
            color: #1565c0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .schedule-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px solid #dce8f9;
            font-size: 13px;
        }
        .schedule-row:last-child { border-bottom: none; }
        .schedule-row-left { display: flex; align-items: center; gap: 10px; }
        .schedule-booking-id { font-weight: 800; color: #1565c0; font-size: 13px; }
        .schedule-guest { color: #333; font-weight: 600; }
        .schedule-time { color: #555; font-size: 12px; font-weight: 600; }
        .schedule-empty { color: #aaa; font-size: 13px; font-style: italic; text-align: center; padding: 8px 0; }
        .schedule-pill { padding: 2px 10px; border-radius: 8px; font-weight: 700; font-size: 11px; display: inline-block; white-space: nowrap; }
        .sched-Confirmed { background: #c8e6c9; color: #2e7d32; }
        .sched-Pending   { background: #fff3e0; color: #e65100; }
        .sched-Cancelled { background: #ffcdd2; color: #d32f2f; }

        .modal-footer-custom { display: flex; justify-content: flex-end; gap: 15px; margin-top: 35px; }
        .btn-cancel-modal  { border: 1.5px solid #ff5252; color: #ff5252; background: white; padding: 10px 25px; border-radius: 10px; cursor: pointer; font-weight: 700; font-size: 14px; }
        .btn-confirm-modal { background: var(--primary-green); color: white; border: none; padding: 10px 25px; border-radius: 10px; cursor: pointer; font-weight: 700; font-size: 14px; }

        /* CONFIRM PROMPT (only used for Confirm action now) */
        .prompt-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000; justify-content: center; align-items: center; }
        .prompt-box { background: white; padding: 35px 30px; border-radius: 15px; text-align: center; width: 400px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .prompt-box p { font-weight: 700; font-size: 18px; margin-bottom: 8px; }
        .prompt-box small { color: #777; font-size: 13px; }
        .prompt-btns { display: flex; justify-content: center; gap: 20px; margin-top: 25px; }
        .prompt-btn { padding: 10px 35px; border-radius: 8px; cursor: pointer; font-weight: 700; border: none; font-size: 15px; }
        .btn-yes-confirm { background: var(--primary-green); color: white; }
        .btn-yes-cancel  { background: #d32f2f; color: white; }
        .btn-no  { background: #eee; color: #333; }

        /* CANCELLATION MESSAGE MODAL */
        .cancel-msg-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2100; justify-content: center; align-items: center; }
        .cancel-msg-box { background: white; padding: 30px; border-radius: 20px; width: 500px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .cancel-msg-box h3 { font-family: 'Playfair Display', serif; font-weight: 700; margin-bottom: 15px; font-size: 20px; }
        .cancel-msg-box small { color: #666; font-size: 13px; display: block; margin-bottom: 15px; }
        .cancel-msg-box textarea { width: 100%; min-height: 100px; padding: 12px; border: 1px solid #ccc; border-radius: 10px; font-size: 14px; font-family: 'Inter', sans-serif; resize: vertical; margin-bottom: 20px; }
        .cancel-msg-box textarea:focus { outline: none; border-color: var(--primary-green); box-shadow: 0 0 0 3px rgba(0,90,43,0.1); }
        .cancel-msg-btns { display: flex; justify-content: flex-end; gap: 12px; }
        .btn-send-cancel { background: #d32f2f; color: white; border: none; padding: 10px 25px; border-radius: 10px; cursor: pointer; font-weight: 700; font-size: 14px; }
        .btn-send-cancel:hover { background: #c62828; }
        .btn-back-cancel { background: #eee; color: #333; border: none; padding: 10px 25px; border-radius: 10px; cursor: pointer; font-weight: 700; font-size: 14px; }
        .btn-back-cancel:hover { background: #e0e0e0; }

        /* CUSTOM ALERT MODAL */
        .alert-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 3000; justify-content: center; align-items: center; animation: fadeIn 0.2s ease; }
        .alert-box { background: white; padding: 35px 30px; border-radius: 20px; text-align: center; width: 420px; box-shadow: 0 15px 50px rgba(0,0,0,0.25); animation: slideUp 0.3s ease; }
        .alert-icon { width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px; }
        .alert-icon-warning { background: #fff3e0; color: #e65100; }
        .alert-box h3 { font-family: 'Playfair Display', serif; font-weight: 700; margin-bottom: 12px; font-size: 22px; color: #111; }
        .alert-box p { color: #666; font-size: 15px; margin-bottom: 25px; line-height: 1.5; }
        .alert-btn { background: var(--primary-green); color: white; border: none; padding: 12px 40px; border-radius: 12px; cursor: pointer; font-weight: 700; font-size: 15px; transition: all 0.2s; }
        .alert-btn:hover { background: #004d25; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,90,43,0.3); }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* LOGOUT MODAL */
        .modal-content { border-radius: 25px; border: none; padding: 20px; }
        .modal-footer  { border: none; justify-content: center; gap: 15px; }
        .btn-confirm   { background: #dc3545; color: white; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }
        .btn-cancel    { background: #eee; color: #333; border-radius: 12px; padding: 10px 30px; font-weight: 600; border: none; }

        /* ══════════════════════════════════════
           RESPONSIVE — TABLET (≤ 1100px)
        ══════════════════════════════════════ */
        @media (max-width: 1100px) {
            .sidebar { width: 260px; }
            .content-section { padding: 20px 30px 0; }
            .top-bar { padding: 0 30px; }
            .admin-profile-dropdown { right: 30px; }
            th { font-size: 14px; padding: 14px 8px; }
            td { padding: 14px 8px; font-size: 13px; }
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

            .main-container { width: 100%; height: auto; overflow: visible; }

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
            .content-section {
                padding: 16px 12px 0;
                overflow: visible;
                flex: unset;
            }

            /* Search row — stack input and dropdown */
            .search-row {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
                padding: 12px 14px;
                border-radius: 12px;
            }
            .search-input-group {
                border-right: none;
                border-bottom: 1px solid #eee;
                padding-bottom: 10px;
            }
            .search-input-group input { font-size: 15px; }
            .status-dropdown-container {
                padding-left: 0;
                min-width: unset;
            }
            .status-trigger { font-size: 15px; }
            .status-menu { width: 100%; }

            /* Tabs — smaller text, no fixed padding */
            .booking-tabs { gap: 6px; padding: 6px; border-radius: 12px; }
            .tab-btn { padding: 9px 4px; font-size: 12px; border-radius: 8px; }

            /* Table scroll wrapper */
            .table-scroll-wrapper {
                flex: unset;
                overflow-y: visible;
                overflow-x: auto;
            }

            /* Table — card-based layout */
            table { table-layout: auto; }
            thead { display: none; }

            tbody tr {
                display: flex;
                flex-direction: column;
                padding: 16px 14px;
                border-bottom: 1.5px solid #e8e8e8;
                gap: 6px;
            }
            tbody tr:last-child { border-bottom: none; }

            tbody td {
                display: flex;
                align-items: flex-start;
                gap: 8px;
                padding: 0;
                border-bottom: none;
                font-size: 13px;
                width: 100% !important;
                overflow: visible;
                white-space: normal;
                word-break: break-word;
            }

            tbody td::before {
                content: attr(data-label);
                font-weight: 800;
                font-size: 11px;
                color: #888;
                text-transform: uppercase;
                min-width: 80px;
                flex-shrink: 0;
                padding-top: 1px;
            }

            tbody td:last-child::before { display: none; }
            tbody td:last-child { justify-content: flex-start; }

            .actions-cell { gap: 8px; }
            .action-icon-btn { width: 36px; height: 36px; border-radius: 10px; }
            .action-icon-btn i { font-size: 17px; }

            /* View modal — full width on mobile */
            .modal-card {
                width: calc(100% - 32px);
                max-width: 100%;
                padding: 24px 18px;
                border-radius: 16px;
                margin: 16px;
            }
            .modal-grid { grid-template-columns: 1fr; gap: 16px; }
            .special-req-box,
            .order-items-box,
            .table-schedule-box { grid-column: span 1; }
            .modal-footer-custom { flex-wrap: wrap; gap: 10px; }
            .btn-cancel-modal,
            .btn-confirm-modal { flex: 1; min-width: 120px; text-align: center; }

            /* Prompt + cancel-msg — full width */
            .prompt-box { width: calc(100% - 40px); max-width: 380px; padding: 28px 20px; }
            .cancel-msg-box { width: calc(100% - 32px); max-width: 460px; padding: 24px 18px; margin: 16px; }

            /* Alert box */
            .alert-box { width: calc(100% - 40px); max-width: 380px; padding: 28px 20px; }

            /* Success notification */
            .success-notification {
                top: 80px;
                left: 16px; right: 16px;
                transform: none;
                font-size: 14px;
                padding: 14px 18px;
                border-radius: 10px;
            }
            .success-notification.show { display: flex; }

            /* Schedule rows wrap on small screens */
            .schedule-row { flex-wrap: wrap; gap: 6px; }
            .schedule-row-left { flex-wrap: wrap; }
        }

        /* ══════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤ 400px)
        ══════════════════════════════════════ */
        @media (max-width: 400px) {
            .top-bar h1 { font-size: 17px; }
            .tab-btn { font-size: 11px; padding: 8px 3px; }
            .booking-tabs { gap: 4px; }
        }
    </style>
</head>
<body>

<!-- Sidebar overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="wrapper">

    <!-- SIDEBAR -->
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
            <li><a href="{{ route('admin.dashboard') }}" class="nav-item"><i class="fa-solid fa-table-cells-large"></i> Dashboard</a></li>
            <li>
                <a href="{{ route('admin.bookings') }}" class="nav-item active" id="bookingsNavLink" onclick="clearNewBookingBadge()">
                    <i class="fa-solid fa-calendar-check"></i> Bookings
                    <span class="new-booking-badge" id="newBookingBadge" style="display:none;"></span>
                </a>
            </li>
            <li><a href="{{ route('admin.menu') }}"     class="nav-item"><i class="fa-solid fa-utensils"></i> Restaurant</a></li>
            <li><a href="{{ route('admin.rooms') }}"    class="nav-item"><i class="fa-solid fa-bed"></i> Rooms</a></li>
            <li><a href="{{ route('admin.spa') }}"      class="nav-item"><i class="fa-solid fa-spa"></i> Spa Services</a></li>
            <li><a href="{{ route('admin.users') }}"    class="nav-item"><i class="fa-solid fa-circle-user"></i> Users</a></li>
            <li><a href="{{ route('admin.feedback') }}" class="nav-item"><i class="fa-solid fa-comments"></i> Feedback</a></li>
        </ul>
    </aside>

    <!-- MAIN -->
    <div class="main-container">

        <header class="top-bar">
            <!-- Hamburger (mobile only) -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <h1>Bookings</h1>

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

        <main class="content-section">

            <!-- SUCCESS NOTIFICATION -->
            <div class="success-notification" id="successNotification">
                <i class="fa-solid fa-circle-check"></i>
                <span>Email sent successfully!</span>
            </div>

            <!-- STICKY HEADER -->
            <div class="sticky-header">
                <div class="search-row">
                    <div class="search-input-group">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchInput" placeholder="Search by ID, guest name and services" oninput="filterTable()">
                    </div>
                    <div class="status-dropdown-container">
                        <div class="status-trigger" onclick="toggleStatusMenu()">
                            <span id="currentStatusText">All Status</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="status-menu" id="statusMenu">
                            <div onclick="selectStatus('All Status')">All Status</div>
                            <div onclick="selectStatus('Confirmed')">Confirmed</div>
                            <div onclick="selectStatus('Pending')">Pending</div>
                            <div onclick="selectStatus('Cancelled')">Cancelled</div>
                        </div>
                    </div>
                </div>

                <div class="booking-tabs">
                    <button class="tab-btn active" onclick="filterTab(this,'All')">All</button>
                    <button class="tab-btn" onclick="filterTab(this,'Lodging')">Rooms</button>
                    <button class="tab-btn" onclick="filterTab(this,'Restaurant')">Restaurant</button>
                    <button class="tab-btn" onclick="filterTab(this,'Spa')">Spa</button>
                </div>
            </div>

            <!-- SCROLLABLE TABLE -->
            <div class="table-scroll-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Guest</th>
                            <th>Type</th>
                            <th>Service</th>
                            <th>Date / Time</th>
                            <th>Status</th>
                            <th>Special Request</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="bookingTableBody">

                        @foreach($bookings as $booking)
                        <tr
                            data-type="{{ $booking->service_type }}"
                            data-status="{{ $booking->status }}"
                            data-search="{{ strtolower((string)$booking->id . ' ' . $booking->user->first_name . ' ' . $booking->user->last_name . ' ' . $booking->user->email . ' ' . $booking->service_name . ' ' . $booking->service_type) }}"
                        >
                            <td data-label="ID"><strong>#{{ $booking->id }}</strong></td>

                            <td data-label="Guest" style="overflow:visible; white-space:normal; word-break:break-word;">
                                <div>
                                    <strong style="display:block; font-size:14px;">{{ $booking->user->first_name }} {{ $booking->user->last_name }}</strong>
                                    <small style="color:#777; font-size:12px; display:block; margin-top:2px;">{{ $booking->user->email }}</small>
                                </div>
                            </td>

                            <td data-label="Type">{{ $booking->service_type }}</td>
                            <td data-label="Service">{{ $booking->service_name }}</td>

                            <td data-label="Date / Time">
                                @if($booking->service_type === 'Lodging')
                                    <div>
                                        <div class="date-row"><span class="date-label">Check-in</span><span class="date-val">{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}</span></div>
                                        <div class="date-row"><span class="date-label">Check-out</span><span class="date-val">{{ \Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d') }}</span></div>
                                    </div>
                                @else
                                    <div>
                                        <div class="date-row"><span class="date-label">Date</span><span class="date-val">{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}</span></div>
                                        <div class="date-row"><span class="date-label">Time</span><span class="date-val">{{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}</span></div>
                                    </div>
                                @endif
                            </td>

                            <td data-label="Status"><span class="status-pill st-{{ $booking->status }}">{{ $booking->status }}</span></td>

                            <td data-label="Request" style="color:#666;font-size:13px;white-space:normal;word-break:break-word">
                                {{ $booking->special_request ?? 'None' }}
                            </td>

                            <td>
                                <div class="actions-cell">
                                    {{-- WhatsApp icon box --}}
                                    @if($booking->user->phone)
                                    <div class="action-icon-btn action-btn-whatsapp"
                                         title="Chat on WhatsApp"
                                         onclick="openWhatsApp('{{ $booking->user->phone }}')">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                    @else
                                    <div class="action-icon-btn action-btn-whatsapp disabled"
                                         title="No phone number">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                    @endif

                                    {{-- Eye icon box --}}
                                    <div class="action-icon-btn action-btn-eye"
                                         title="View Details"
                                         data-order-items="{{ json_encode($booking->order_items) }}"
                                         onclick="openViewModal(
                                             '#{{ $booking->id }}',
                                             '{{ addslashes($booking->user->first_name . ' ' . $booking->user->last_name) }}',
                                             '{{ addslashes($booking->user->email) }}',
                                             '{{ addslashes($booking->user->phone ?? '') }}',
                                             '{{ $booking->service_type }}',
                                             '{{ addslashes($booking->service_name) }}',
                                             '{{ $booking->status }}',
                                             '{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}',
                                             '{{ $booking->service_type === 'Lodging' ? \Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d') : '' }}',
                                             '{{ $booking->service_type !== 'Lodging' ? \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') : '' }}',
                                             '{{ addslashes($booking->special_request ?? 'None') }}',
                                             {{ $booking->id }},
                                             {{ $booking->number_of_guests ?? 'null' }},
                                             this
                                         )">
                                        <i class="fa-solid fa-eye"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>


{{-- VIEW DETAILS MODAL --}}
<div class="modal-overlay" id="viewModal">
    <div class="modal-card">
        <button class="close-modal" onclick="closeViewModal()">&times;</button>
        <div class="modal-header-custom"><h2 id="vm-id">Booking Details</h2></div>
        <div class="modal-grid">
            <div class="modal-item"><label>Guest Name</label><p id="vm-name"></p></div>
            <div class="modal-item"><label>Status</label><p id="vm-status"></p></div>
            <div class="modal-item"><label>Type</label><p id="vm-type"></p></div>
            <div class="modal-item"><label>Service</label><p id="vm-service"></p></div>
            <div class="modal-item"><label>Email</label><p id="vm-email"></p></div>
            <div class="modal-item"><label>Phone</label><p id="vm-phone"></p></div>
            <div class="modal-item" id="vm-row1"><label id="vm-lbl1"></label><p id="vm-val1"></p></div>
            <div class="modal-item" id="vm-row2"><label id="vm-lbl2"></label><p id="vm-val2"></p></div>
            <div class="modal-item" id="vm-guests-row" style="display:none;"><label>Number of Guests</label><p id="vm-guests"></p></div>

            {{-- Order items --}}
            <div class="order-items-box" id="vm-order-items-box" style="display:none; grid-column: span 2;">
                <label><i class="fa-solid fa-bag-shopping me-2"></i>Ordered Items</label>
                <div id="vm-order-items-content"></div>
            </div>

            {{-- TABLE SCHEDULE --}}
            <div class="table-schedule-box" id="vm-table-schedule-box" style="display:none;">
                <span class="schedule-label">
                    <i class="fa-solid fa-clock" style="margin-right:6px;"></i>
                    Table Schedule for: <span id="vm-schedule-date" style="font-weight:600; color:#1565c0; margin-left:4px;"></span>
                </span>
                <div id="vm-schedule-rows"></div>
            </div>

            <div class="special-req-box">
                <label>Special Request</label>
                <p id="vm-request" style="font-style:italic;color:#555;"></p>
            </div>
        </div>
        <div class="modal-footer-custom" id="vm-buttons"></div>
    </div>
</div>


{{-- CONFIRM PROMPT (used only for Confirm action) --}}
<div class="prompt-overlay" id="promptOverlay">
    <div class="prompt-box">
        <p id="promptTitle">Are you sure?</p>
        <small id="promptSub">A notification email will be sent to the guest.</small>
        <div class="prompt-btns">
            <button class="prompt-btn btn-no" onclick="closePrompt()">No</button>
            <button class="prompt-btn" id="promptYesBtn" onclick="handlePromptYes()">Yes</button>
        </div>
    </div>
    <form id="actionForm" method="POST" style="display:none;">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" id="actionStatus">
        <input type="hidden" name="cancellation_message" id="actionCancelMessage" value="">
    </form>
</div>


{{-- CANCELLATION MESSAGE MODAL --}}
<div class="cancel-msg-overlay" id="cancelMsgOverlay">
    <div class="cancel-msg-box">
        <h3>✍️ Add Cancellation Reason</h3>
        <small>Write a short message to explain the cancellation. This will be sent to the guest via email.</small>
        <textarea id="cancelMessageInput" placeholder="e.g., Sorry, the table is already booked. You can try rescheduling for tomorrow evening."></textarea>
        <div class="cancel-msg-btns">
            <button class="btn-back-cancel" onclick="closeCancelMsgModal()">Back</button>
            <button class="btn-send-cancel" onclick="submitCancellation()">Send & Cancel</button>
        </div>
    </div>
</div>


{{-- CUSTOM ALERT MODAL --}}
<div class="alert-overlay" id="alertOverlay">
    <div class="alert-box">
        <div class="alert-icon alert-icon-warning" id="alertIcon">
            <i class="fa-solid fa-circle-exclamation" id="alertIconInner"></i>
        </div>
        <h3 id="alertTitle">Notice</h3>
        <p id="alertMessage">Message goes here</p>
        <button class="alert-btn" onclick="closeAlert()">OK, Got it</button>
    </div>
</div>


{{-- LOGOUT MODAL --}}
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


{{-- ALL BOOKINGS DATA FOR JS TABLE SCHEDULE --}}
<script>
    const baseUrl = window.location.origin;
    const allRestaurantBookings = @json($restaurantBookings);
    const todayDate = '{{ \Carbon\Carbon::today()->format('Y-m-d') }}';

    /* ══════════════════════════════════════════
       NEW BOOKING BADGE
    ══════════════════════════════════════════ */
    const allBookingTimestamps = @json(
        $bookings->map(fn($b) => \Carbon\Carbon::parse($b->created_at)->valueOf())->values()
    );

    const BADGE_KEY = 'tn_last_booking_seen_at';

    function initNewBookingBadge() {
        const lastSeen = parseInt(localStorage.getItem(BADGE_KEY) || '0', 10);
        const newCount = allBookingTimestamps.filter(ts => ts > lastSeen).length;
        const badge    = document.getElementById('newBookingBadge');
        if (newCount > 0) {
            badge.textContent   = newCount > 99 ? '99+' : newCount;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }

    function clearNewBookingBadge() {
        localStorage.setItem(BADGE_KEY, Date.now().toString());
        document.getElementById('newBookingBadge').style.display = 'none';
    }

    /* ══════════════════════════════════════════
       WHATSAPP
    ══════════════════════════════════════════ */
    function openWhatsApp(phone) {
        // Strip all non-digit characters, then build wa.me link
        const cleaned = phone.replace(/\D/g, '');
        if (!cleaned) { showAlert('No Phone Number', 'This user does not have a phone number on file.'); return; }
        window.open('https://wa.me/' + cleaned, '_blank');
    }

    /* ══════════════════════════════════════════
       MOBILE SIDEBAR TOGGLE
    ══════════════════════════════════════════ */
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

    /* ══════════════════════════════════════════
       TABLE FILTER
    ══════════════════════════════════════════ */
    let currentTab    = 'All';
    let currentStatus = 'All Status';

    function filterTable() {
        const q    = document.getElementById('searchInput').value.toLowerCase().trim();
        const rows = document.querySelectorAll('#bookingTableBody tr');
        let counts = { All: 0, Lodging: 0, Restaurant: 0, Spa: 0 };

        rows.forEach(row => {
            const type   = (row.dataset.type   || '').trim();
            const status = (row.dataset.status || '').trim();
            const search = (row.dataset.search || '').trim();

            const matchTab    = currentTab === 'All' || type === currentTab;
            const matchStatus = currentStatus === 'All Status' || status === currentStatus;
            const matchSearch = q === '' || search.includes(q);

            row.style.display = (matchTab && matchStatus && matchSearch) ? '' : 'none';

            if (matchSearch && matchStatus) {
                counts['All']++;
                if (counts[type] !== undefined) counts[type]++;
            }
        });

        const tabs    = document.querySelectorAll('.tab-btn');
        const labels  = ['All', 'Lodging', 'Restaurant', 'Spa'];
        const display = ['All', 'Rooms', 'Restaurant', 'Spa'];
        tabs.forEach((btn, i) => {
            btn.innerText = display[i] + (i === 0 ? ` (${counts.All})` : ` (${counts[labels[i]] ?? 0})`);
        });
    }

    function filterTab(btn, type) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentTab = type;
        filterTable();
    }

    function toggleStatusMenu() {
        const m = document.getElementById('statusMenu');
        m.style.display = m.style.display === 'block' ? 'none' : 'block';
    }

    function selectStatus(s) {
        currentStatus = s;
        document.getElementById('currentStatusText').innerText = s;
        toggleStatusMenu();
        filterTable();
    }

    document.addEventListener('click', e => {
        if (!e.target.closest('.status-dropdown-container')) {
            document.getElementById('statusMenu').style.display = 'none';
        }
    });

    /* ══════════════════════════════════════════
       VIEW MODAL
    ══════════════════════════════════════════ */
    let modalBookingId = null;

    function openViewModal(id, name, email, phone, type, service, status, checkin, checkout, time, request, bookingId, numberOfGuests, element) {
        let orderItems = null;
        try {
            const rawItems = element.getAttribute('data-order-items');
            orderItems = rawItems ? JSON.parse(rawItems) : null;
        } catch (e) {
            console.error('Error parsing order items:', e);
        }

        modalBookingId = bookingId;

        document.getElementById('vm-id').innerText      = 'Booking ' + id;
        document.getElementById('vm-name').innerText    = name;
        document.getElementById('vm-email').innerText   = email;
        document.getElementById('vm-phone').innerText   = phone || '—';
        document.getElementById('vm-type').innerText    = type;
        document.getElementById('vm-service').innerText = service;
        document.getElementById('vm-request').innerText = request;

        const pill = { Confirmed: 'st-Confirmed', Pending: 'st-Pending', Cancelled: 'st-Cancelled' }[status] || '';
        document.getElementById('vm-status').innerHTML = `<span class="status-pill ${pill}">${status}</span>`;

        if (type === 'Lodging') {
            document.getElementById('vm-lbl1').innerText = 'Check-in Date';
            document.getElementById('vm-val1').innerText = checkin;
            document.getElementById('vm-lbl2').innerText = 'Check-out Date';
            document.getElementById('vm-val2').innerText = checkout;
            document.getElementById('vm-row2').style.display = '';
            if (numberOfGuests !== null && numberOfGuests !== undefined) {
                document.getElementById('vm-guests').innerText = numberOfGuests;
                document.getElementById('vm-guests-row').style.display = '';
            } else {
                document.getElementById('vm-guests-row').style.display = 'none';
            }
        } else {
            document.getElementById('vm-lbl1').innerText = 'Booking Date';
            document.getElementById('vm-val1').innerText = checkin;
            document.getElementById('vm-lbl2').innerText = 'Booking Time';
            document.getElementById('vm-val2').innerText = time || '—';
            document.getElementById('vm-row2').style.display = '';
            document.getElementById('vm-guests-row').style.display = 'none';
        }

        const orderItemsBox     = document.getElementById('vm-order-items-box');
        const orderItemsContent = document.getElementById('vm-order-items-content');

        if (orderItems && typeof orderItems === 'object' && Object.keys(orderItems).length > 0) {
            orderItemsBox.style.display = 'block';
            let html = '', total = 0;
            for (const [itemName, itemData] of Object.entries(orderItems)) {
                const qty       = itemData && itemData.qty   ? itemData.qty            : 1;
                const price     = itemData && itemData.price ? parseFloat(itemData.price) : 0;
                const itemTotal = qty * price;
                total += itemTotal;
                html += `
                    <div class="order-item">
                        <span class="order-item-name">${itemName}</span>
                        <div style="display:flex;align-items:center;">
                            <span class="order-item-qty">x${qty}</span>
                            <span class="order-item-price">Nu. ${itemTotal.toFixed(2)}</span>
                        </div>
                    </div>`;
            }
            html += `<div class="order-total">Total: Nu. ${total.toFixed(2)}</div>`;
            orderItemsContent.innerHTML = html;
        } else {
            orderItemsBox.style.display = 'none';
        }

        const scheduleBox  = document.getElementById('vm-table-schedule-box');
        const scheduleRows = document.getElementById('vm-schedule-rows');
        const scheduleDate = document.getElementById('vm-schedule-date');

        if (type === 'Restaurant' && status === 'Pending') {
            const selectedBookingDate = checkin;
            const relatedBookings = allRestaurantBookings.filter(b =>
                b.service_name === service &&
                b.booking_date === selectedBookingDate
            );
            relatedBookings.sort((a, b) => {
                const toMins = t => {
                    if (!t || t === '—') return 0;
                    const [timePart, period] = t.split(' ');
                    let [h, m] = timePart.split(':').map(Number);
                    if (period === 'PM' && h !== 12) h += 12;
                    if (period === 'AM' && h === 12) h = 0;
                    return h * 60 + m;
                };
                return toMins(a.booking_time) - toMins(b.booking_time);
            });

            scheduleDate.innerText = selectedBookingDate;

            if (relatedBookings.length === 0) {
                scheduleRows.innerHTML = `<div class="schedule-empty">No other bookings for this table on this date.</div>`;
            } else {
                scheduleRows.innerHTML = relatedBookings.map(b => {
                    const pillClass = `sched-${b.status}`;
                    const isCurrent = b.id == bookingId;
                    const highlight = isCurrent
                        ? 'background:#fff9c4; border-radius:8px; padding:4px 8px; margin:-4px -8px; border:1px solid #fbc02d;'
                        : '';
                    return `
                        <div class="schedule-row" style="${highlight}">
                            <div class="schedule-row-left">
                                <span class="schedule-booking-id">#${b.id}${isCurrent ? ' <span style="font-size:10px;color:#888;">(Viewing)</span>' : ''}</span>
                                <span class="schedule-guest">${b.guest}</span>
                                <span class="schedule-time"><i class="fa-regular fa-clock" style="margin-right:3px;"></i>${b.booking_time}</span>
                            </div>
                            <span class="schedule-pill ${pillClass}">${b.status}</span>
                        </div>`;
                }).join('');
            }
            scheduleBox.style.display = 'block';
        } else {
            scheduleBox.style.display = 'none';
        }

        const btns = document.getElementById('vm-buttons');
        btns.innerHTML = '';
        if (status === 'Pending') {
            btns.innerHTML = `
                <button class="btn-cancel-modal" onclick="closeViewModal()">Close</button>
                <button class="btn-cancel-modal" onclick="handleModalAction('cancel')">Cancel Booking</button>
                <button class="btn-confirm-modal" onclick="handleModalAction('confirm')">Confirm Booking</button>`;
        } else if (status === 'Confirmed') {
            btns.innerHTML = `
                <button class="btn-cancel-modal" onclick="closeViewModal()">Close</button>
                <button class="btn-cancel-modal" onclick="handleModalAction('cancel')">Cancel Booking</button>`;
        } else {
            btns.innerHTML = `<button class="btn-confirm-modal" onclick="closeViewModal()">Close</button>`;
        }

        document.getElementById('viewModal').style.display = 'flex';
    }

    function closeViewModal() {
        document.getElementById('viewModal').style.display = 'none';
        modalBookingId = null;
    }

    function handleModalAction(action) {
        if (!modalBookingId) { showAlert('Error', 'Booking ID not available'); return; }
        const route = `${baseUrl}/admin/bookings/${modalBookingId}`;
        closeViewModal();
        if (action === 'confirm') {
            openPrompt('confirm', modalBookingId, route);
        } else {
            // Cancel: skip prompt, go directly to cancellation reason modal
            pendingAction    = 'cancel';
            pendingRoute     = route;
            pendingBookingId = modalBookingId;
            openCancelMsgModal();
        }
    }

    /* ══════════════════════════════════════════
       PROMPT (only used for Confirm now)
    ══════════════════════════════════════════ */
    let pendingAction    = null;
    let pendingRoute     = null;
    let pendingBookingId = null;

    function openPrompt(action, bookingId, route) {
        pendingAction    = action;
        pendingRoute     = route;
        pendingBookingId = bookingId;

        const isConfirm = action === 'confirm';
        document.getElementById('promptTitle').innerText = isConfirm ? 'Confirm this booking?' : 'Cancel this booking?';
        document.getElementById('promptSub').innerText   = isConfirm
            ? 'A confirmation email will be sent to the guest.'
            : 'You will add a reason before sending cancellation email.';

        const yesBtn = document.getElementById('promptYesBtn');
        yesBtn.className = 'prompt-btn ' + (isConfirm ? 'btn-yes-confirm' : 'btn-yes-cancel');
        yesBtn.innerText = isConfirm ? 'Yes, Confirm' : 'Yes, Cancel';

        document.getElementById('promptOverlay').style.display = 'flex';
    }

    function closePrompt() { document.getElementById('promptOverlay').style.display = 'none'; }

    function handlePromptYes() {
        // This is only called for confirm action now
        if (pendingAction === 'confirm') submitConfirmation();
    }

    function submitConfirmation() {
        if (!pendingRoute) { showAlert('Error', 'No valid route found'); closePrompt(); return; }
        const form = document.getElementById('actionForm');
        form.action = pendingRoute;
        document.getElementById('actionStatus').value = 'Confirmed';
        document.getElementById('actionCancelMessage').value = '';
        form.submit();
    }

    /* ══════════════════════════════════════════
       CANCEL MESSAGE MODAL
    ══════════════════════════════════════════ */
    function openCancelMsgModal() {
        document.getElementById('cancelMessageInput').value = '';
        document.getElementById('cancelMsgOverlay').style.display = 'flex';
        document.getElementById('cancelMessageInput').focus();
    }

    function closeCancelMsgModal() {
        document.getElementById('cancelMsgOverlay').style.display = 'none';
    }

    async function submitCancellation() {
        const message = document.getElementById('cancelMessageInput').value.trim();
        if (!message) { showAlert('Missing Information', 'Please write a short reason for cancellation.'); return; }
        if (!pendingRoute) { showAlert('Error', 'No valid route found'); closeCancelMsgModal(); return; }

        const sendBtn      = document.querySelector('.btn-send-cancel');
        const originalText = sendBtn.innerText;
        sendBtn.innerText  = 'Sending...';
        sendBtn.disabled   = true;

        try {
            const formData  = new FormData();
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
                           || document.querySelector('#actionForm input[name="_token"]')?.value;
            formData.append('_token', csrfToken);
            formData.append('_method', 'PUT');
            formData.append('status', 'Cancelled');
            formData.append('cancellation_message', message);

            const response = await fetch(pendingRoute, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': formData.get('_token'), 'X-HTTP-Method-Override': 'PUT' },
                body: formData
            });

            if (response.ok) {
                showSuccessNotification();
                closeCancelMsgModal();
                setTimeout(() => { window.location.href = '{{ route('admin.bookings') }}'; }, 2000);
            } else {
                throw new Error('Failed to update booking');
            }
        } catch (error) {
            console.error('Error:', error);
            showAlert('Error', 'Failed to cancel booking. Please try again.');
            sendBtn.innerText = originalText;
            sendBtn.disabled  = false;
        }
    }

    /* ══════════════════════════════════════════
       SUCCESS NOTIFICATION
    ══════════════════════════════════════════ */
    function showSuccessNotification() {
        const n = document.getElementById('successNotification');
        n.classList.remove('hiding');
        n.classList.add('show');
        setTimeout(() => { n.classList.remove('show'); n.classList.add('hiding'); }, 2000);
    }

    /* ══════════════════════════════════════════
       CUSTOM ALERT
    ══════════════════════════════════════════ */
    function showAlert(title, message) {
        document.getElementById('alertIcon').className      = 'alert-icon alert-icon-warning';
        document.getElementById('alertIconInner').className = 'fa-solid fa-circle-exclamation';
        document.getElementById('alertTitle').innerText     = title;
        document.getElementById('alertMessage').innerText   = message;
        document.getElementById('alertOverlay').style.display = 'flex';
    }

    function closeAlert() { document.getElementById('alertOverlay').style.display = 'none'; }

    /* ══════════════════════════════════════════
       KEYBOARD + BACKDROP CLOSE
    ══════════════════════════════════════════ */
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            if (document.getElementById('alertOverlay').style.display === 'flex')          closeAlert();
            else if (document.getElementById('cancelMsgOverlay').style.display === 'flex') closeCancelMsgModal();
            else if (document.getElementById('promptOverlay').style.display === 'flex')    closePrompt();
            else if (document.getElementById('viewModal').style.display === 'flex')        closeViewModal();
        }
    });

    ['alertOverlay', 'cancelMsgOverlay', 'promptOverlay', 'viewModal'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', e => {
            if (e.target.id === id) {
                if      (id === 'alertOverlay')      closeAlert();
                else if (id === 'cancelMsgOverlay')  closeCancelMsgModal();
                else if (id === 'promptOverlay')     closePrompt();
                else if (id === 'viewModal')         closeViewModal();
            }
        });
    });

    /* ══════════════════════════════════════════
       INIT
    ══════════════════════════════════════════ */
    window.addEventListener('load', () => {
        filterTable();
        initNewBookingBadge();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>