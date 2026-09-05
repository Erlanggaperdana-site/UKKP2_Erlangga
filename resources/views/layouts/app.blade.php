<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Pengaduan Masyarakat — Portal layanan pengaduan terpercaya">
    <title>{{ config('app.name', 'Sistem Pengaduan') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap 5.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ============================================
           DESIGN SYSTEM — Sistem Pengaduan Masyarakat
           Bootstrap 5 + Custom Premium CSS
           ============================================ */

        /* ---------- CSS Variables ---------- */
        :root {
            --primary: #4361ee;
            --primary-hover: #3a56d4;
            --primary-light: #eef2ff;
            --primary-rgb: 67, 97, 238;
            --primary-gradient: linear-gradient(135deg, #4361ee 0%, #7c3aed 100%);

            --sidebar-dark: #0f172a;
            --sidebar-accent: #1e293b;
            --sidebar-text: #94a3b8;
            --sidebar-hover: #f1f5f9;
            --sidebar-active-bg: rgba(67, 97, 238, 0.12);
            --sidebar-active-border: #4361ee;
            --sidebar-width: 260px;

            --body-bg: #f1f5f9;
            --body-color: #1e293b;
            --muted: #64748b;
            --border-color: #e2e8f0;

            --card-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.06);
            --card-shadow-hover: 0 10px 25px rgba(0,0,0,0.07), 0 4px 10px rgba(0,0,0,0.04);

            --radius: 12px;
            --radius-sm: 8px;
            --radius-lg: 16px;

            --font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        /* ---------- Base ---------- */
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: var(--font-family);
            font-size: 14px;
            line-height: 1.6;
            color: var(--body-color);
            background: var(--body-bg);
            -webkit-font-smoothing: antialiased;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ---------- Animations ---------- */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-14px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%      { transform: translateY(-20px) rotate(5deg); }
        }
        @keyframes floatReverse {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%      { transform: translateY(20px) rotate(-5deg); }
        }
        @keyframes pulse-ring {
            0%   { transform: scale(0.9); opacity: 0.5; }
            80%, 100% { transform: scale(1.3); opacity: 0; }
        }
        @keyframes shimmer {
            0%   { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .animate-fade-in     { animation: fadeInUp 0.5s ease-out both; }
        .animate-fade         { animation: fadeIn 0.4s ease-out both; }
        .animate-slide-left   { animation: slideInLeft 0.4s ease-out both; }
        .animate-slide-down   { animation: slideDown 0.4s ease-out both; }
        .animate-delay-1 { animation-delay: 0.05s; }
        .animate-delay-2 { animation-delay: 0.10s; }
        .animate-delay-3 { animation-delay: 0.15s; }
        .animate-delay-4 { animation-delay: 0.20s; }
        .animate-delay-5 { animation-delay: 0.25s; }
        .animate-delay-6 { animation-delay: 0.30s; }

        /* ---------- App Shell ---------- */
        .app-shell {
            min-height: 100vh;
        }

        /* ---------- Sidebar ---------- */
        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1040;
            background: linear-gradient(180deg, var(--sidebar-dark) 0%, #111827 100%);
            padding: 20px 14px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px 28px;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            white-space: nowrap;
        }
        .sidebar-brand:hover { color: #fff; }

        .brand-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--primary-gradient);
            display: grid;
            place-items: center;
            font-size: 16px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.35);
        }

        .nav-caption {
            font-size: 10px;
            font-weight: 700;
            color: #475569;
            letter-spacing: 0.1em;
            padding: 8px 12px 6px;
            text-transform: uppercase;
        }

        .sidebar .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            margin: 2px 0;
            border-radius: var(--radius-sm);
            color: var(--sidebar-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 13.5px;
            white-space: nowrap;
            transition: all 0.18s ease;
            border: 1px solid transparent;
            position: relative;
        }
        .sidebar .nav-item i {
            font-size: 17px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        .sidebar .nav-item:hover {
            color: var(--sidebar-hover);
            background: rgba(255,255,255,0.06);
        }
        .sidebar .nav-item.active {
            color: #fff;
            background: var(--sidebar-active-bg);
            border-color: rgba(67, 97, 238, 0.15);
            box-shadow: inset 3px 0 0 var(--sidebar-active-border);
        }
        .sidebar .nav-item.active i {
            color: var(--primary);
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .nav-logout {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        /* ---------- Main Wrapper ---------- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ---------- Topbar ---------- */
        .topbar {
            height: 70px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .topbar-subtitle {
            font-size: 13px;
            color: var(--muted);
            font-weight: 500;
        }

        .sidebar-toggle {
            display: none;
            border: none;
            background: none;
            font-size: 22px;
            color: var(--body-color);
            padding: 4px;
            border-radius: 6px;
            transition: background 0.15s;
            cursor: pointer;
        }
        .sidebar-toggle:hover {
            background: rgba(0,0,0,0.05);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--body-color);
            padding: 6px 8px;
            border-radius: var(--radius-sm);
            transition: background 0.15s;
        }
        .topbar-user:hover {
            background: rgba(0,0,0,0.03);
            color: var(--body-color);
        }

        .user-info { line-height: 1.3; }
        .user-name { font-size: 13px; font-weight: 600; }
        .user-role { font-size: 11px; color: var(--muted); text-transform: capitalize; }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: #fff;
            display: grid;
            place-items: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(var(--primary-rgb), 0.3);
        }

        /* ---------- Main Content ---------- */
        .main-content {
            max-width: 1360px;
            margin: 0 auto;
            padding: 28px 28px 48px;
            animation: fadeInUp 0.45s ease-out;
        }

        /* ---------- Mobile Overlay ---------- */
        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(2px);
            z-index: 1030;
            opacity: 0;
            transition: opacity 0.25s;
        }
        .mobile-overlay.open {
            display: block;
            opacity: 1;
        }

        /* ---------- Page Header ---------- */
        .page-header {
            margin-bottom: 24px;
        }
        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--body-color);
            letter-spacing: -0.02em;
            margin-bottom: 4px;
        }
        .page-subtitle {
            color: var(--muted);
            font-size: 14px;
            margin: 0;
        }

        /* ---------- Cards ---------- */
        .card {
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            background: var(--card-bg);
            transition: box-shadow 0.22s ease, transform 0.22s ease;
        }
        .card-header {
            background: #f8fafc;
            border-bottom: 1px solid var(--border-color);
            padding: 16px 24px;
            font-weight: 600;
            font-size: 15px;
            border-radius: var(--radius) var(--radius) 0 0 !important;
        }
        .card-body { padding: 24px; }

        .content-card {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        /* ---------- Stat Cards ---------- */
        .stat-card {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: var(--card-shadow);
            transition: all 0.22s ease;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            border-radius: 0 0 0 80px;
            opacity: 0.06;
            transition: opacity 0.22s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }
        .stat-card:hover::after { opacity: 0.1; }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 20px;
            margin-bottom: 16px;
        }
        .stat-icon-blue    { background: #eef2ff; color: #4361ee; }
        .stat-icon-green   { background: #ecfdf5; color: #10b981; }
        .stat-icon-amber   { background: #fffbeb; color: #f59e0b; }
        .stat-icon-red     { background: #fef2f2; color: #ef4444; }
        .stat-icon-purple  { background: #f5f3ff; color: #8b5cf6; }
        .stat-icon-cyan    { background: #ecfeff; color: #06b6d4; }

        .stat-card-blue::after    { background: #4361ee; }
        .stat-card-green::after   { background: #10b981; }
        .stat-card-amber::after   { background: #f59e0b; }
        .stat-card-red::after     { background: #ef4444; }
        .stat-card-purple::after  { background: #8b5cf6; }

        .stat-label {
            color: var(--muted);
            font-size: 12.5px;
            font-weight: 500;
            margin-bottom: 6px;
        }
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--body-color);
            letter-spacing: -0.03em;
            line-height: 1;
        }

        /* ---------- Hero Card ---------- */
        .hero-card {
            background: var(--primary-gradient);
            border-radius: var(--radius-lg);
            padding: 32px;
            color: #fff;
            position: relative;
            overflow: hidden;
            border: none;
            box-shadow: 0 8px 24px rgba(var(--primary-rgb), 0.25);
        }
        .hero-card::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }
        .hero-card::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: 10%;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .hero-label {
            font-size: 13px;
            opacity: 0.85;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .hero-value {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1;
            margin-bottom: 6px;
        }
        .hero-hint {
            font-size: 13px;
            opacity: 0.7;
        }
        .hero-icon {
            font-size: 56px;
            opacity: 0.2;
            position: relative;
            z-index: 1;
        }

        /* ---------- Filter Card ---------- */
        .filter-card {
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 18px 24px;
        }

        /* ---------- Tables ---------- */
        .table {
            margin: 0;
            font-size: 13px;
        }
        .table thead th {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #64748b;
            background: #f8fafc;
            border-bottom: 1px solid var(--border-color);
            padding: 13px 18px;
            white-space: nowrap;
        }
        .table tbody td {
            padding: 14px 18px;
            color: #334155;
            border-color: #f1f5f9;
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background: #f8fafc;
        }
        .table-responsive {
            border-radius: 0;
        }

        /* ---------- Buttons ---------- */
        .btn {
            font-family: var(--font-family);
            font-weight: 600;
            font-size: 13px;
            border-radius: var(--radius-sm);
            padding: 9px 18px;
            transition: all 0.18s ease;
            letter-spacing: 0.01em;
        }
        .btn:active { transform: scale(0.97); }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 2px 6px rgba(var(--primary-rgb), 0.25);
        }
        .btn-primary:hover,
        .btn-primary:focus {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
            box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.3);
            transform: translateY(-1px);
        }

        .btn-gradient {
            background: var(--primary-gradient);
            border: none;
            color: #fff;
            box-shadow: 0 3px 10px rgba(var(--primary-rgb), 0.3);
        }
        .btn-gradient:hover {
            box-shadow: 0 6px 16px rgba(var(--primary-rgb), 0.35);
            transform: translateY(-1px);
            color: #fff;
        }

        .btn-light {
            background: #f1f5f9;
            border-color: #e2e8f0;
            color: #475569;
        }
        .btn-light:hover {
            background: #e2e8f0;
            border-color: #cbd5e1;
            color: #334155;
        }

        .btn-danger {
            box-shadow: 0 2px 6px rgba(239,68,68,0.2);
        }
        .btn-danger:hover {
            box-shadow: 0 4px 12px rgba(239,68,68,0.3);
            transform: translateY(-1px);
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 12px;
        }

        /* ---------- Forms ---------- */
        .form-label {
            font-size: 12.5px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }
        .form-control,
        .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            font-size: 13.5px;
            font-family: var(--font-family);
            color: var(--body-color);
            transition: all 0.18s ease;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
        }
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #ef4444;
        }
        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
        }
        .form-text-error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
        }
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        /* ---------- Badges ---------- */
        .badge {
            font-size: 11px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 50px;
            letter-spacing: 0.01em;
        }
        .badge-role-admin   { background: #fef2f2; color: #dc2626; }
        .badge-role-petugas { background: #fffbeb; color: #d97706; }
        .badge-role-customer { background: #eef2ff; color: #4361ee; }

        /* ---------- Alerts ---------- */
        .alert {
            border: none;
            border-radius: var(--radius);
            padding: 14px 18px;
            font-size: 13px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            animation: slideDown 0.35s ease-out;
            transition: opacity 0.3s, transform 0.3s;
        }
        .alert-success {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: #065f46;
        }
        .alert-danger {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            color: #991b1b;
        }

        /* ---------- Detail Card ---------- */
        .detail-card {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        .detail-header {
            background: var(--primary-gradient);
            padding: 28px 28px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .detail-header::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -5%;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }
        .detail-header .avatar-lg {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: grid;
            place-items: center;
            font-size: 22px;
            font-weight: 700;
            flex-shrink: 0;
            backdrop-filter: blur(4px);
        }
        .detail-body {
            padding: 28px;
        }
        .detail-item {
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .detail-item:last-child { border-bottom: none; }
        .detail-item-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 4px;
        }
        .detail-item-value {
            font-size: 14px;
            color: var(--body-color);
            font-weight: 500;
        }

        /* ---------- Code Badge ---------- */
        .code-badge {
            display: inline-block;
            padding: 4px 10px;
            background: #f1f5f9;
            color: #475569;
            border-radius: 6px;
            font-family: 'SF Mono', 'Fira Code', monospace;
            font-size: 12px;
            font-weight: 500;
        }

        /* ---------- Empty State ---------- */
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--muted);
        }
        .empty-state i {
            font-size: 40px;
            color: #cbd5e1;
            margin-bottom: 12px;
            display: block;
        }
        .empty-state strong {
            display: block;
            color: var(--body-color);
            font-size: 14px;
            margin-bottom: 4px;
        }
        .empty-state p {
            font-size: 13px;
        }

        /* ---------- Avatar ---------- */
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-weight: 700;
            font-size: 14px;
            color: #fff;
            flex-shrink: 0;
        }
        .avatar-blue   { background: linear-gradient(135deg, #4361ee, #6366f1); }
        .avatar-green  { background: linear-gradient(135deg, #10b981, #059669); }
        .avatar-amber  { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .avatar-red    { background: linear-gradient(135deg, #ef4444, #dc2626); }
        .avatar-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

        /* ---------- File Upload ---------- */
        .file-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: var(--radius);
            padding: 20px;
            text-align: center;
            transition: all 0.2s;
            cursor: pointer;
            background: #fafbfc;
        }
        .file-upload-area:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }
        .file-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        /* ---------- Auth Page ---------- */
        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #312e81 100%);
            position: relative;
            overflow: hidden;
        }

        .auth-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.08;
        }
        .auth-shape-1 {
            width: 400px;
            height: 400px;
            background: var(--primary);
            top: -100px;
            right: -80px;
            animation: float 8s ease-in-out infinite;
        }
        .auth-shape-2 {
            width: 250px;
            height: 250px;
            background: #7c3aed;
            bottom: -50px;
            left: -50px;
            animation: floatReverse 10s ease-in-out infinite;
        }
        .auth-shape-3 {
            width: 150px;
            height: 150px;
            background: #06b6d4;
            top: 40%;
            left: 15%;
            animation: float 12s ease-in-out infinite;
        }

        .auth-card {
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: var(--radius-lg);
            padding: 40px 36px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.6s ease-out;
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }
        .auth-brand .brand-icon {
            width: 40px;
            height: 40px;
            font-size: 17px;
        }
        .auth-brand span {
            font-weight: 700;
            font-size: 15px;
            color: var(--body-color);
        }

        .auth-card h1 {
            font-size: 22px;
            font-weight: 700;
            color: var(--body-color);
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }
        .auth-card .auth-subtitle {
            color: var(--muted);
            font-size: 13.5px;
            margin-bottom: 28px;
        }

        .auth-footer {
            text-align: center;
            color: rgba(255,255,255,0.4);
            font-size: 12px;
            margin-top: 24px;
            position: relative;
            z-index: 1;
        }

        /* ---------- Pagination Override ---------- */
        .pagination {
            gap: 4px;
        }
        .page-link {
            border-radius: var(--radius-sm) !important;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 12px;
            color: #475569;
            border: 1px solid var(--border-color);
        }
        .page-link:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-color: var(--primary-light);
        }
        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 2px 6px rgba(var(--primary-rgb), 0.25);
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 8px 0 30px rgba(0,0,0,0.15);
            }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
            .sidebar-toggle { display: block; }
            .topbar { padding: 0 16px; height: 60px; }
            .main-content { padding: 20px 16px 36px; }
        }

        @media (max-width: 575.98px) {
            .page-title { font-size: 20px; }
            .main-content { padding: 16px 14px 32px; }
            .auth-card { padding: 28px 22px; }
            .stat-card { padding: 16px; }
            .stat-value { font-size: 24px; }
            .hero-value { font-size: 32px; }
            .card-body { padding: 16px; }
            .card-header { padding: 12px 16px; }
        }

        /* ---------- Utilities ---------- */
        .fw-medium { font-weight: 500; }
        .text-muted { color: var(--muted) !important; }
        .rounded-xl { border-radius: var(--radius) !important; }
        .shadow-card { box-shadow: var(--card-shadow) !important; }
        .truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body>
    @auth
    <div class="app-shell">
        {{-- Mobile Overlay --}}
        <div class="mobile-overlay" id="mobileOverlay"></div>

        {{-- Sidebar --}}
        <aside class="sidebar" id="sidebar">
            <a class="sidebar-brand" href="{{ route('dashboard') }}">
                <div class="brand-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <span>Sistem Pengaduan</span>
            </a>

            <nav class="d-flex flex-column flex-grow-1">
                <div class="nav-caption">MENU UTAMA</div>

                <a class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Dashboard</span>
                </a>

                @if(!auth()->user()->isCustomer())
                <a class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}"
                   href="{{ route('users.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Manajemen User</span>
                </a>
                @endif

                <a class="nav-item {{ request()->routeIs('pengaduans.*') ? 'active' : '' }}"
                   href="{{ route('pengaduans.index') }}">
                    <i class="bi bi-inboxes"></i>
                    <span>{{ auth()->user()->isCustomer() ? 'Pengaduan Saya' : 'Pengaduan' }}</span>
                </a>

                @can('create', App\Models\Pengaduan::class)
                <a class="nav-item" href="{{ route('pengaduans.create') }}">
                    <i class="bi bi-plus-square"></i>
                    <span>Buat Pengaduan</span>
                </a>
                @endcan

                <div class="nav-caption mt-3">AKUN</div>

                <a class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                   href="{{ route('profile.show') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil Saya</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-item nav-logout" type="submit">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="main-wrapper">
            {{-- Topbar --}}
            <header class="topbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Buka navigasi">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="topbar-subtitle d-none d-md-inline">Portal layanan pengaduan masyarakat</span>
                </div>
                <a class="topbar-user text-decoration-none" href="{{ route('profile.show') }}">
                    <div class="user-info d-none d-md-block text-end">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">{{ auth()->user()->role }}</div>
                    </div>
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </a>
            </header>

            {{-- Page Content --}}
            <main class="main-content">
                @include('partials.alert')
                @yield('content')
            </main>
        </div>
    </div>

    @else
    {{-- Guest / Auth Page --}}
    <main class="auth-page">
        <div class="auth-shape auth-shape-1"></div>
        <div class="auth-shape auth-shape-2"></div>
        <div class="auth-shape auth-shape-3"></div>
        @include('partials.alert')
        @yield('content')
    </main>
    @endauth

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle (mobile)
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobileOverlay');
        const toggle  = document.getElementById('sidebarToggle');

        toggle?.addEventListener('click', () => {
            sidebar?.classList.toggle('open');
            overlay?.classList.toggle('open');
        });
        overlay?.addEventListener('click', () => {
            sidebar?.classList.remove('open');
            overlay?.classList.remove('open');
        });

        // Auto-dismiss alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(el => {
            setTimeout(() => {
                el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 400);
            }, 5000);
        });
    </script>
</body>
</html>
