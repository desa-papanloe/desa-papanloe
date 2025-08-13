{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - Desa Papanloe</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('/img/5 bantaeng png.png') }}">
    
    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        /* Admin Layout with Max Width/Height */
        .admin-layout {
            background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
            min-height: 100vh;
            max-height: 100vh;
            overflow: hidden;
        }
        
        /* Container with max width */
        .container-fluid {
            max-width: 100vw;
            width: 100%;
            margin: 0 auto;
        }
        
        /* Sidebar - Same as agenda index */
        .admin-sidebar {
            width: 280px;
            background: white;
            border-right: 1px solid #e2e8f0;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            max-height: 100vh;
            z-index: 50;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .admin-sidebar.open {
            transform: translateX(0);
        }
        
        @media (min-width: 1024px) {
            .admin-sidebar {
                transform: translateX(0);
                position: relative;
            }
        }
        
        /* Sidebar Styles - Same as agenda */
        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid #e2e8f0;
            background: #fafbfc;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-badge {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .logo-badge img {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }
        
        .logo-text h2 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        
        .logo-text p {
            font-size: 12px;
            color: #64748b;
            margin: 2px 0 0 0;
            font-weight: 500;
        }
        
        .sidebar-nav {
            padding: 16px;
            height: calc(100vh - 200px);
            overflow-y: auto;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }
        
        .nav-item:hover {
            background: #f1f5f9;
            color: #374151;
        }
        
        .nav-item.active {
            background: #eff6ff;
            color: #2563eb;
            box-shadow: 0 1px 3px rgba(59, 130, 246, 0.1);
        }
        
        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }
        
        .nav-badge {
            background: #f3f4f6;
            color: #6b7280;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 12px;
            margin-left: auto;
        }
        
        /* Main Content with responsive design */
        .main-wrapper {
            display: flex;
            max-width: 100vw;
            max-height: 100vh;
        }
        
        .main-content {
            flex: 1;
            min-height: 100vh;
            max-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        /* Top Navigation - Fixed height */
        .top-nav {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
            height: 80px;
            flex-shrink: 0;
        }
        
        .nav-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .breadcrumb {
            font-size: 14px;
            color: #64748b;
        }
        
        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            border-radius: 10px;
            background: #f8fafc;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }
        
        .user-info h4 {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin: 0;
        }
        
        .user-info p {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }
        
        /* Page Content with scrollable area */
        .page-content {
            flex: 1;
            padding: 20px;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            background: #f8fafc;
        }
        
        /* Welcome Section - More compact */
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 6px;
        }
        
        .welcome-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 8px;
        }
        
        .welcome-info {
            display: flex;
            gap: 16px;
            font-size: 12px;
            opacity: 0.8;
        }
        
        .welcome-avatar {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
        }
        
        /* Stats Grid - More compact */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .stat-header {
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .stat-label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 6px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }
        
        .stat-desc {
            font-size: 12px;
            color: #6b7280;
            margin: 0;
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .stat-blue .stat-icon { background: #dbeafe; }
        .stat-green .stat-icon { background: #d1fae5; }
        .stat-orange .stat-icon { background: #fed7aa; }
        .stat-red .stat-icon { background: #fecaca; }
        
        .stat-footer {
            background: #f9fafb;
            padding: 10px 16px;
            border-top: 1px solid #f3f4f6;
        }
        
        .stat-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        
        .stat-link:hover {
            color: #374151;
        }
        
        /* Main Grid - Natural height, let content flow */
        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        
        .left-column, .right-column {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        /* Content Cards - Natural size, no forced height */
        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .card-header {
            padding: 16px 16px 12px 16px;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }
        
        .card-subtitle {
            color: #6b7280;
            font-size: 12px;
            margin: 0;
        }
        
        .header-with-icon {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .header-icon {
            font-size: 20px;
        }
        
        /* Quick Actions - More compact grid */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
            padding: 16px;
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 2px solid transparent;
            font-size: 13px;
        }
        
        .action-icon {
            font-size: 18px;
            flex-shrink: 0;
        }
        
        .action-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        
        .action-title {
            font-weight: 600;
            font-size: 12px;
        }
        
        .action-desc {
            font-size: 10px;
            opacity: 0.7;
        }
        
        .action-blue {
            background: #eff6ff;
            color: #1d4ed8;
        }
        
        .action-blue:hover {
            background: #dbeafe;
            border-color: #3b82f6;
        }
        
        .action-green {
            background: #f0fdf4;
            color: #166534;
        }
        
        .action-green:hover {
            background: #dcfce7;
            border-color: #10b981;
        }
        
        .action-orange {
            background: #fffbeb;
            color: #92400e;
        }
        
        .action-orange:hover {
            background: #fef3c7;
            border-color: #f59e0b;
        }
        
        .action-gray {
            background: #f9fafb;
            color: #374151;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }
        
        .action-gray:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
        }
        
        /* Mini Stats - More compact */
        .mini-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            padding: 12px 16px;
            background: #f9fafb;
        }
        
        .mini-stat {
            text-align: center;
            padding: 8px;
            background: white;
            border-radius: 6px;
            border: 1px solid #f3f4f6;
        }
        
        .mini-number {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2px;
        }
        
        .mini-label {
            font-size: 10px;
            color: #6b7280;
            font-weight: 500;
            text-transform: uppercase;
        }
        
        /* Card Actions - Natural positioning */
        .card-actions {
            display: flex;
            gap: 10px;
            padding: 0 16px 16px 16px;
        }
        
        .btn-primary, .btn-secondary {
            flex: 1;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background: #3b82f6;
            color: white;
            border: 2px solid #3b82f6;
        }
        
        .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
        }
        
        .btn-secondary {
            background: white;
            color: #374151;
            border: 2px solid #e5e7eb;
        }
        
        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }
        
        /* Activities Container - No fixed height, natural flow */
        .activities-container {
            padding: 0 16px 16px 16px;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 600;
            color: #111827;
            font-size: 12px;
            margin-bottom: 2px;
        }
        
        .activity-desc {
            color: #6b7280;
            font-size: 11px;
            margin-bottom: 2px;
        }
        
        .activity-meta {
            font-size: 10px;
            color: #9ca3af;
        }
        
        .activity-action {
            color: #6b7280;
            text-decoration: none;
            font-size: 12px;
            padding: 4px;
        }
        
        .activity-action:hover {
            color: #374151;
        }
        
        /* Pending Container - Natural flow */
        .pending-container {
            padding: 0 16px 16px 16px;
        }
        
        .pending-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: #f9fafb;
            border-radius: 6px;
            margin-bottom: 6px;
        }
        
        .pending-item:last-child {
            margin-bottom: 0;
        }
        
        .pending-icon {
            font-size: 18px;
            flex-shrink: 0;
        }
        
        .pending-content {
            flex: 1;
        }
        
        .pending-title {
            font-weight: 600;
            color: #111827;
            font-size: 12px;
            margin-bottom: 2px;
        }
        
        .pending-desc {
            color: #6b7280;
            font-size: 11px;
            margin: 0;
        }
        
        .pending-action {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            padding: 4px;
        }
        
        .pending-action:hover {
            color: #374151;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 30px 16px;
        }
        
        .empty-icon {
            font-size: 36px;
            margin-bottom: 8px;
        }
        
        .empty-title {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
            font-size: 14px;
        }
        
        .empty-desc {
            color: #6b7280;
            font-size: 12px;
            margin: 0;
        }
        
        /* Admin Info Container - Natural flow */
        .admin-container {
            padding: 0 16px 16px 16px;
        }
        
        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 10px;
            margin-bottom: 12px;
        }
        
        .admin-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
        }
        
        .admin-details {
            flex: 1;
        }
        
        .admin-name {
            font-weight: 700;
            color: #111827;
            margin-bottom: 2px;
            font-size: 14px;
        }
        
        .admin-email {
            color: #6b7280;
            font-size: 11px;
            margin-bottom: 4px;
        }
        
        .admin-role {
            background: #3b82f6;
            color: white;
            font-size: 9px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            text-transform: uppercase;
        }
        
        .admin-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 12px;
        }
        
        .admin-stat {
            text-align: center;
            padding: 8px;
            background: #f9fafb;
            border-radius: 6px;
            border: 1px solid #f3f4f6;
        }
        
        .admin-stat-number {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 2px;
        }
        
        .admin-stat-label {
            font-size: 9px;
            color: #6b7280;
            font-weight: 500;
        }
        
        .admin-meta {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        
        .meta-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
        }
        
        .meta-label {
            color: #6b7280;
            font-weight: 500;
        }
        
        .meta-value {
            color: #111827;
            font-weight: 600;
        }
        
        /* Loading State */
        .loading-state {
            text-align: center;
            padding: 30px 16px;
        }
        
        .loading-spinner {
            font-size: 20px;
            margin-bottom: 8px;
        }
        
        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
            
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.open {
                transform: translateX(0);
            }
        }
        
        @media (max-width: 768px) {
            .page-content {
                padding: 12px;
            }
            
            .welcome-card {
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
            
            .card-actions {
                flex-direction: column;
            }
        }
        
        /* Scrollbar Styling - Only for main page content */
        .page-content::-webkit-scrollbar {
            width: 4px;
        }
        
        .page-content::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        .page-content::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }
        
        .page-content::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Notification styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }
        
        .notification.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .notification.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        .notification.warning {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }
        
        .notification.info {
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }
        
        .notification.show {
            transform: translateX(0);
        }
    </style>
</head>

<body class="admin-layout">
    <div class="container-fluid">
        <div class="main-wrapper">
            <!-- Sidebar -->
            <aside id="admin-sidebar" class="admin-sidebar">
                <!-- Sidebar Header -->
                <div class="sidebar-header">
                    <div class="logo-container">
                        <div class="logo-badge">
                            <img src="{{ asset('/img/5 bantaeng png.png') }}" alt="Logo Desa Papanloe">
                        </div>
                        <div class="logo-text">
                            <h2>Admin Panel</h2>
                            <p>Desa Papanloe</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="sidebar-nav">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                        <span class="nav-icon">🏠</span>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.berita.index') }}" class="nav-item">
                        <span class="nav-icon">📰</span>
                        <span>Kelola Berita</span>
                        <span class="nav-badge">{{ $stats['berita_draft'] ?? 0 }}</span>
                    </a>

                    <a href="{{ route('admin.agenda.index') }}" class="nav-item">
                        <span class="nav-icon">📅</span>
                        <span>Kelola Agenda</span>
                        <span class="nav-badge">{{ $stats['agenda_aktif'] ?? 0 }}</span>
                    </a>

                    <div style="margin: 16px 0; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">
                        <small style="color: #9ca3af; font-weight: 600; text-transform: uppercase; font-size: 11px; margin-left: 16px;">SISTEM</small>
                    </div>

                    <a href="{{ route('admin.settings.index') }}" class="nav-item">
                        <span class="nav-icon">⚙️</span>
                        <span>Pengaturan</span>
                    </a>
                </nav>

                <!-- Bottom Actions -->
                <div style="padding: 16px; border-top: 1px solid #e2e8f0; background: #fafbfc; margin-top: auto;">
                    <a href="{{ route('home') }}" target="_blank" class="nav-item" style="color: #059669; margin-bottom: 8px;">
                        <span class="nav-icon">🌐</span>
                        <span>Lihat Website</span>
                    </a>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="nav-item" style="width: 100%; color: #dc2626; background: none; border: none; text-align: left;">
                            <span class="nav-icon">🚪</span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Top Navigation -->
                <header class="top-nav">
                    <div class="nav-left">
                        <div class="breadcrumb">Dashboard</div>
                    </div>

                    <div class="nav-right">
                        <div class="user-menu">
                            <div class="user-avatar">
                                {{ substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1) }}
                            </div>
                            <div class="user-info">
                                <h4>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</h4>
                                <p>{{ Auth::guard('admin')->user()->role_label ?? 'Administrator' }}</p>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="page-content">
                    <!-- Welcome Section -->
                    <div class="welcome-card">
                        <div>
                            <h1 class="welcome-title">
                                Selamat datang kembali, {{ Auth::guard('admin')->user()->name }}! 👋
                            </h1>
                            <p class="welcome-subtitle">
                                Kelola website Desa Papanloe dengan mudah melalui dashboard admin ini
                            </p>
                            <div class="welcome-info">
                                <span>📅 {{ now()->format('l, d F Y') }}</span>
                                <span>🕐 {{ now()->format('H:i') }} WITA</span>
                                <span>👤 {{ Auth::guard('admin')->user()->role_label }}</span>
                            </div>
                        </div>
                        <div class="welcome-avatar">{{ substr(Auth::guard('admin')->user()->name, 0, 1) }}</div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="stats-grid">
                        <!-- Total Berita -->
                        <div class="stat-card stat-blue">
                            <div class="stat-header">
                                <div>
                                    <h3 class="stat-label">Total Berita</h3>
                                    <div class="stat-number" id="total-berita">{{ $stats['total_berita'] ?? 0 }}</div>
                                    <p class="stat-desc">+{{ $stats['berita_bulan_ini'] ?? 0 }} bulan ini</p>
                                </div>
                                <div class="stat-icon">📰</div>
                            </div>
                            <div class="stat-footer">
                                <a href="{{ route('admin.berita.index') }}" class="stat-link">Kelola Berita →</a>
                            </div>
                        </div>

                        <!-- Total Agenda -->
                        <div class="stat-card stat-green">
                            <div class="stat-header">
                                <div>
                                    <h3 class="stat-label">Total Agenda</h3>
                                    <div class="stat-number" id="total-agenda">{{ $stats['total_agenda'] ?? 0 }}</div>
                                    <p class="stat-desc">{{ $stats['agenda_aktif'] ?? 0 }} aktif</p>
                                </div>
                                <div class="stat-icon">📅</div>
                            </div>
                            <div class="stat-footer">
                                <a href="{{ route('admin.agenda.index') }}" class="stat-link">Kelola Agenda →</a>
                            </div>
                        </div>

                        <!-- Published -->
                        <div class="stat-card stat-orange">
                            <div class="stat-header">
                                <div>
                                    <h3 class="stat-label">Published</h3>
                                    <div class="stat-number" id="berita-published">{{ $stats['berita_published'] ?? 0 }}</div>
                                    <p class="stat-desc">{{ number_format($stats['total_views'] ?? 0) }} views</p>
                                </div>
                                <div class="stat-icon">✅</div>
                            </div>
                            <div class="stat-footer">
                                <a href="{{ route('admin.berita.index', ['status' => 'published']) }}" class="stat-link">Lihat Published →</a>
                            </div>
                        </div>

                        <!-- Draft -->
                        <div class="stat-card stat-red">
                            <div class="stat-header">
                                <div>
                                    <h3 class="stat-label">Draft</h3>
                                    <div class="stat-number" id="berita-draft">{{ $stats['berita_draft'] ?? 0 }}</div>
                                    <p class="stat-desc">
                                        @if(($stats['berita_draft'] ?? 0) > 0)
                                            Perlu review
                                        @else
                                            Semua selesai
                                        @endif
                                    </p>
                                </div>
                                <div class="stat-icon">📝</div>
                            </div>
                            <div class="stat-footer">
                                <a href="{{ route('admin.berita.index', ['status' => 'draft']) }}" class="stat-link">Review Draft →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Grid -->
                    <div class="main-grid">
                        <!-- Left Column -->
                        <div class="left-column">
                            <!-- Quick Actions -->
                            <div class="content-card">
                                <div class="card-header">
                                    <h3 class="card-title">⚡ Aksi Cepat</h3>
                                    <p class="card-subtitle">Akses fitur yang sering digunakan</p>
                                </div>
                                <div class="quick-actions">
                                    <a href="{{ route('admin.berita.create') }}" class="action-btn action-blue">
                                        <span class="action-icon">➕</span>
                                        <div class="action-content">
                                            <span class="action-title">Tulis Berita</span>
                                            <span class="action-desc">Buat artikel baru</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.agenda.create') }}" class="action-btn action-green">
                                        <span class="action-icon">📅</span>
                                        <div class="action-content">
                                            <span class="action-title">Buat Agenda</span>
                                            <span class="action-desc">Jadwalkan acara</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('home') }}" target="_blank" class="action-btn action-orange">
                                        <span class="action-icon">🌐</span>
                                        <div class="action-content">
                                            <span class="action-title">Lihat Website</span>
                                            <span class="action-desc">Buka tab baru</span>
                                        </div>
                                    </a>
                                    <button onclick="refreshDashboard()" class="action-btn action-gray">
                                        <span class="action-icon">🔄</span>
                                        <div class="action-content">
                                            <span class="action-title">Refresh Data</span>
                                            <span class="action-desc">Perbarui statistik</span>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <!-- Berita Management -->
                            <div class="content-card">
                                <div class="card-header">
                                    <div class="header-with-icon">
                                        <span class="header-icon">📰</span>
                                        <div>
                                            <h3 class="card-title">Kelola Berita</h3>
                                            <p class="card-subtitle">Publikasi & edit berita desa</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mini-stats">
                                    <div class="mini-stat">
                                        <div class="mini-number" id="stat-berita-published">{{ $stats['berita_published'] ?? 0 }}</div>
                                        <div class="mini-label">Published</div>
                                    </div>
                                    <div class="mini-stat">
                                        <div class="mini-number" id="stat-berita-draft">{{ $stats['berita_draft'] ?? 0 }}</div>
                                        <div class="mini-label">Draft</div>
                                    </div>
                                    <div class="mini-stat">
                                        <div class="mini-number" id="stat-berita-featured">{{ $stats['berita_featured'] ?? 0 }}</div>
                                        <div class="mini-label">Featured</div>
                                    </div>
                                </div>
                                <div class="card-actions">
                                    <a href="{{ route('admin.berita.create') }}" class="btn-primary">➕ Tulis Berita</a>
                                    <a href="{{ route('admin.berita.index') }}" class="btn-secondary">📋 Lihat Semua</a>
                                </div>
                            </div>

                            <!-- Agenda Management -->
                            <div class="content-card">
                                <div class="card-header">
                                    <div class="header-with-icon">
                                        <span class="header-icon">📅</span>
                                        <div>
                                            <h3 class="card-title">Kelola Agenda</h3>
                                            <p class="card-subtitle">Jadwal & acara desa</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mini-stats">
                                    <div class="mini-stat">
                                        <div class="mini-number" id="stat-agenda-aktif">{{ $stats['agenda_aktif'] ?? 0 }}</div>
                                        <div class="mini-label">Aktif</div>
                                    </div>
                                    <div class="mini-stat">
                                        <div class="mini-number" id="stat-agenda-mendatang">{{ $stats['agenda_mendatang'] ?? 0 }}</div>
                                        <div class="mini-label">Mendatang</div>
                                    </div>
                                    <div class="mini-stat">
                                        <div class="mini-number" id="stat-agenda-urgent">{{ $stats['agenda_urgent'] ?? 0 }}</div>
                                        <div class="mini-label">Urgent</div>
                                    </div>
                                </div>
                                <div class="card-actions">
                                    <a href="{{ route('admin.agenda.create') }}" class="btn-primary">➕ Buat Agenda</a>
                                    <a href="{{ route('admin.agenda.index') }}" class="btn-secondary">📅 Lihat Kalender</a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="right-column">
                            <!-- Recent Activities -->
                            <div class="content-card">
                                <div class="card-header">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <h3 class="card-title">📝 Aktivitas Terbaru</h3>
                                        </div>
                                        <button onclick="loadRecentActivities()" style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 6px; padding: 6px 8px; cursor: pointer; font-size: 12px;">🔄</button>
                                    </div>
                                </div>
                                <div class="activities-container" id="recent-activities">
                                    <div class="loading-state">
                                        <div class="loading-spinner">⏳</div>
                                        <p style="font-size: 12px; margin: 0;">Memuat aktivitas terbaru...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Items -->
                            <div class="content-card">
                                <div class="card-header">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <h3 class="card-title">⚠️ Perlu Perhatian</h3>
                                        @php
                                            $totalPending = ($pendingItems['berita_draft']->count() ?? 0) + ($pendingItems['agenda_urgent']->count() ?? 0);
                                        @endphp
                                        @if($totalPending > 0)
                                            <span style="background: #fef2f2; color: #dc2626; font-size: 10px; font-weight: 600; padding: 4px 6px; border-radius: 10px;">{{ $totalPending }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="pending-container">
                                    @if(isset($pendingItems['berita_draft']) && $pendingItems['berita_draft']->count() > 0)
                                        <div class="pending-item">
                                            <span class="pending-icon">📝</span>
                                            <div class="pending-content">
                                                <h4 class="pending-title">Berita Draft</h4>
                                                <p class="pending-desc">{{ $pendingItems['berita_draft']->count() }} berita perlu direview</p>
                                            </div>
                                            <a href="{{ route('admin.berita.index', ['status' => 'draft']) }}" class="pending-action">→</a>
                                        </div>
                                    @endif

                                    @if(isset($pendingItems['agenda_urgent']) && $pendingItems['agenda_urgent']->count() > 0)
                                        <div class="pending-item">
                                            <span class="pending-icon">🚨</span>
                                            <div class="pending-content">
                                                <h4 class="pending-title">Agenda Urgent</h4>
                                                <p class="pending-desc">{{ $pendingItems['agenda_urgent']->count() }} agenda prioritas tinggi</p>
                                            </div>
                                            <a href="{{ route('admin.agenda.index', ['prioritas' => 'urgent']) }}" class="pending-action">→</a>
                                        </div>
                                    @endif

                                    @if($totalPending == 0)
                                        <div class="empty-state">
                                            <div class="empty-icon">✅</div>
                                            <h4 class="empty-title">Semua Beres!</h4>
                                            <p class="empty-desc">Tidak ada item yang memerlukan perhatian khusus</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Admin Info -->
                            <div class="content-card">
                                <div class="card-header">
                                    <h3 class="card-title">👤 Info Admin</h3>
                                </div>
                                <div class="admin-container">
                                    <div class="admin-profile">
                                        <div class="admin-avatar">{{ substr(Auth::guard('admin')->user()->name, 0, 1) }}</div>
                                        <div class="admin-details">
                                            <h4 class="admin-name">{{ Auth::guard('admin')->user()->name }}</h4>
                                            <p class="admin-email">{{ Auth::guard('admin')->user()->email }}</p>
                                            <span class="admin-role">{{ Auth::guard('admin')->user()->role_label }}</span>
                                        </div>
                                    </div>

                                    <div class="admin-stats">
                                        <div class="admin-stat">
                                            <div class="admin-stat-number">{{ Auth::guard('admin')->user()->berita()->count() ?? 0 }}</div>
                                            <div class="admin-stat-label">Berita Dibuat</div>
                                        </div>
                                        <div class="admin-stat">
                                            <div class="admin-stat-number">{{ Auth::guard('admin')->user()->agenda()->count() ?? 0 }}</div>
                                            <div class="admin-stat-label">Agenda Dibuat</div>
                                        </div>
                                    </div>

                                    <div class="admin-meta">
                                        <div class="meta-item">
                                            <span class="meta-label">Login Terakhir:</span>
                                            <span class="meta-value">{{ Auth::guard('admin')->user()->last_login_at ? Auth::guard('admin')->user()->last_login_at->diffForHumans() : 'Pertama kali' }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <span class="meta-label">Bergabung:</span>
                                            <span class="meta-value">{{ Auth::guard('admin')->user()->created_at->format('M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {;
            initializeDashboard();
            
            // Setup auto-refresh every 30 seconds
            setInterval(() => {
                refreshStats();
            }, 30000);
            
        });

        function initializeDashboard() {
            loadRecentActivities();
        }

        async function refreshStats() {
            try {
                const response = await fetch('{{ route("admin.dashboard.statistics") }}', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    if (data.status === 'success') {
                        updateStatistics(data.data);
                    }
                }
            } catch (error) {
                console.warn('Could not refresh stats:', error);
            }
        }

        function updateStatistics(stats) {
            const updates = {
                'total-berita': stats.total_berita || 0,
                'total-agenda': stats.total_agenda || 0,
                'berita-published': stats.berita_published || 0,
                'berita-draft': stats.berita_draft || 0,
                'stat-berita-published': stats.berita_published || 0,
                'stat-berita-draft': stats.berita_draft || 0,
                'stat-berita-featured': stats.berita_featured || 0,
                'stat-agenda-aktif': stats.agenda_aktif || 0,
                'stat-agenda-mendatang': stats.agenda_mendatang || 0,
                'stat-agenda-urgent': stats.agenda_urgent || 0
            };

            Object.entries(updates).forEach(([id, value]) => {
                const element = document.getElementById(id);
                if (element) {
                    element.textContent = value;
                }
            });
        }

        async function loadRecentActivities() {
            const container = document.getElementById('recent-activities');
            
            try {
                const response = await fetch('{{ route("admin.dashboard.activities") }}', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    if (data.status === 'success') {
                        displayRecentActivities(data.data);
                    } else {
                        showEmptyActivities();
                    }
                } else {
                    showEmptyActivities();
                }
            } catch (error) {
                console.warn('Could not load activities:', error);
                showEmptyActivities();
            }
        }

        function displayRecentActivities(activities) {
            const container = document.getElementById('recent-activities');
            
            if (!activities || activities.length === 0) {
                showEmptyActivities();
                return;
            }
            
            container.innerHTML = activities.slice(0, 5).map(activity => {
                const icon = activity.type === 'berita' ? '📰' : '📅';
                const bgColor = activity.type === 'berita' ? '#dbeafe' : '#d1fae5';
                
                return `
                    <div class="activity-item">
                        <div class="activity-icon" style="background: ${bgColor}">
                            ${icon}
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">${activity.title || 'Aktivitas Baru'}</div>
                            <div class="activity-desc">${activity.description || 'Deskripsi tidak tersedia'}</div>
                            <div class="activity-meta">
                                ${activity.user || 'Admin'} • ${formatTime(activity.time)}
                            </div>
                        </div>
                        ${activity.url ? `<a href="${activity.url}" class="activity-action">→</a>` : ''}
                    </div>
                `;
            }).join('');
        }

        function showEmptyActivities() {
            const container = document.getElementById('recent-activities');
            container.innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">📝</div>
                    <h4 class="empty-title">Belum Ada Aktivitas</h4>
                    <p class="empty-desc">Aktivitas terbaru akan muncul di sini</p>
                </div>
            `;
        }

        // Global functions
        window.refreshDashboard = function() {
            showNotification('🔄 Memperbarui dashboard...', 'info');
            refreshStats();
            loadRecentActivities();
            setTimeout(() => {
                showNotification('✅ Dashboard berhasil diperbarui!', 'success');
            }, 1000);
        };

        // Notification system
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            document.querySelectorAll('.notification').forEach(n => n.remove());
            
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; font-size: 16px; cursor: pointer; opacity: 0.7; padding: 0;">×</button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            // Auto hide after 3 seconds
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Utility functions
        function formatTime(timeString) {
            if (!timeString) return 'Waktu tidak tersedia';
            
            try {
                const date = new Date(timeString);
                const now = new Date();
                const diffInMinutes = Math.floor((now - date) / (1000 * 60));
                
                if (diffInMinutes < 1) return 'Baru saja';
                if (diffInMinutes < 60) return `${diffInMinutes} menit yang lalu`;
                
                const diffInHours = Math.floor(diffInMinutes / 60);
                if (diffInHours < 24) return `${diffInHours} jam yang lalu`;
                
                const diffInDays = Math.floor(diffInHours / 24);
                if (diffInDays < 7) return `${diffInDays} hari yang lalu`;
                
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
            } catch (error) {
                return 'Waktu tidak valid';
            }
        }
    </script>
</body>
</html>