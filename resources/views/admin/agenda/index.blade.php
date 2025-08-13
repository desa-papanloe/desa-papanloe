{{-- resources/views/admin/agenda/index.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Agenda - Admin Desa Papanloe</title>
    
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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    
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
        
        /* Sidebar - Copy from dashboard */
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
        
        /* Sidebar Styles - Same as dashboard */
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
        
        .breadcrumb a {
            color: #3b82f6;
            text-decoration: none;
        }
        
        .breadcrumb a:hover {
            text-decoration: underline;
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
        
        /* Page Header - Compact */
        .page-header {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        
        .header-left h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
        }
        
        .header-left p {
            color: #64748b;
            margin: 0;
            font-size: 14px;
        }
        
        .header-actions {
            display: flex;
            gap: 12px;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        
        .btn-primary:hover {
            background: #2563eb;
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
        
        /* Statistics Cards - Compact grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .stat-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .stat-label {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 6px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-number {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }
        
        .stat-desc {
            font-size: 11px;
            color: #6b7280;
            margin: 0;
        }
        
        .stat-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }
        
        .stat-blue .stat-icon { background: #dbeafe; }
        .stat-green .stat-icon { background: #d1fae5; }
        .stat-orange .stat-icon { background: #fed7aa; }
        .stat-red .stat-icon { background: #fecaca; }
        .stat-purple .stat-icon { background: #e9d5ff; }
        
        /* Filters Section - Compact */
        .filters-section {
            background: white;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .filters-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .filters-title {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin: 0;
        }
        
        .filters-toggle {
            background: #f3f4f6;
            border: none;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            color: #6b7280;
            cursor: pointer;
        }
        
        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        
        .filter-label {
            font-size: 12px;
            font-weight: 500;
            color: #374151;
        }
        
        .filter-input {
            padding: 6px 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 12px;
            transition: border-color 0.2s ease;
        }
        
        .filter-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        /* Main Table Card */
        .table-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: calc(100vh - 450px);
            display: flex;
            flex-direction: column;
        }
        
        .table-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }
        
        .table-title {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }
        
        .table-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-input {
            padding: 6px 10px 6px 32px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 12px;
            width: 200px;
            transition: all 0.2s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 14px;
        }
        
        /* Table Container with fixed height and scroll */
        .table-container {
            flex: 1;
            overflow: auto;
            padding: 0 20px 20px 20px;
        }
        
        /* DataTables Customization */
        .dataTables_wrapper {
            font-family: 'Inter', sans-serif;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin: 6px 0;
        }
        
        .dataTables_wrapper .dataTables_filter {
            display: none;
        }
        
        .dataTables_wrapper .dataTables_length select {
            padding: 3px 6px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 12px;
        }
        
        table.dataTable {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
        }
        
        table.dataTable thead th {
            background: #f9fafb;
            border-bottom: 2px solid #e5e7eb;
            padding: 10px 12px;
            font-weight: 600;
            color: #374151;
            font-size: 12px;
            text-align: left;
            border-right: 1px solid #f3f4f6;
        }
        
        table.dataTable thead th:last-child {
            border-right: none;
        }
        
        table.dataTable tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #f3f4f6;
            border-right: 1px solid #f9fafb;
            vertical-align: middle;
            font-size: 12px;
        }
        
        table.dataTable tbody td:last-child {
            border-right: none;
        }
        
        table.dataTable tbody tr:hover {
            background: #f8fafc;
        }
        
        /* Status Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize;
        }
        
        .badge-aktif {
            background: #d1fae5;
            color: #065f46;
        }
        
        .badge-nonaktif {
            background: #f3f4f6;
            color: #6b7280;
        }
        
        .badge-selesai {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .badge-dibatalkan {
            background: #fecaca;
            color: #991b1b;
        }
        
        /* Priority Badges */
        .priority-rendah {
            background: #f0f9ff;
            color: #0369a1;
        }
        
        .priority-normal {
            background: #f3f4f6;
            color: #6b7280;
        }
        
        .priority-tinggi {
            background: #fef3c7;
            color: #92400e;
        }
        
        .priority-urgent {
            background: #fecaca;
            color: #991b1b;
        }
        
        /* Category Badges */
        .category-badge {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 500;
            text-transform: capitalize;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 4px;
            align-items: center;
        }
        
        .action-btn {
            padding: 4px 6px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 11px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 24px;
            height: 24px;
        }
        
        .action-btn:hover {
            transform: translateY(-1px);
        }
        
        .btn-view {
            background: #dbeafe;
            color: #1d4ed8;
        }
        
        .btn-edit {
            background: #fef3c7;
            color: #92400e;
        }
        
        .btn-delete {
            background: #fecaca;
            color: #991b1b;
        }
        
        .btn-featured {
            background: #fef3c7;
            color: #92400e;
        }
        
        .btn-featured.active {
            background: #fcd34d;
            color: #78350f;
        }
        
        /* Featured Toggle Switch */
        .featured-toggle {
            position: relative;
            width: 40px;
            height: 20px;
            background: #e5e7eb;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .featured-toggle.active {
            background: #10b981;
        }
        
        .featured-toggle::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: white;
            top: 2px;
            left: 2px;
            transition: transform 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .featured-toggle.active::before {
            transform: translateX(20px);
        }
        
        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.open {
                transform: translateX(0);
            }
            
            .search-input {
                width: 150px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .page-content {
                padding: 12px;
            }
            
            .header-content {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
            
            .filters-grid {
                grid-template-columns: 1fr;
            }
            
            .search-input {
                width: 120px;
            }
            
            .table-container {
                padding: 0 12px 12px 12px;
            }
        }
        
        /* Scrollbar */
        .page-content::-webkit-scrollbar,
        .table-container::-webkit-scrollbar {
            width: 4px;
        }
        
        .page-content::-webkit-scrollbar-track,
        .table-container::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        .page-content::-webkit-scrollbar-thumb,
        .table-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }
        
        .page-content::-webkit-scrollbar-thumb:hover,
        .table-container::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Loading State */
        .loading {
            text-align: center;
            padding: 30px;
            color: #6b7280;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 15px;
            color: #6b7280;
        }
        
        .empty-icon {
            font-size: 36px;
            margin-bottom: 12px;
        }
        
        .empty-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #374151;
        }
        
        .empty-desc {
            font-size: 12px;
            margin-bottom: 16px;
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
                    <a href="{{ route('admin.dashboard') }}" class="nav-item">
                        <span class="nav-icon">🏠</span>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.berita.index') }}" class="nav-item">
                        <span class="nav-icon">📰</span>
                        <span>Kelola Berita</span>
                        <span class="nav-badge">0</span>
                    </a>

                    <a href="{{ route('admin.agenda.index') }}" class="nav-item active">
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
                        <div class="breadcrumb">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a> / 
                            <span>Kelola Agenda</span>
                        </div>
                    </div>

                    <div class="nav-right">
                        <div class="user-menu">
                            <div class="user-info">
                                <h4>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</h4>
                                <p>{{ Auth::guard('admin')->user()->role_label ?? 'Administrator' }}</p>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="page-content">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="header-content">
                            <div class="header-left">
                                <h1>📅 Kelola Agenda</h1>
                                <p>Kelola jadwal kegiatan dan acara desa</p>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('admin.agenda.calendar') }}" class="btn btn-secondary">
                                    🗓️ Calendar
                                </a>
                                <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary">
                                    ➕ Buat Agenda
                                </a>
                            </div>
                        </div>

                        <!-- Statistics Cards -->
                        <div class="stats-grid">
                            <div class="stat-card stat-blue">
                                <div class="stat-content">
                                    <div>
                                        <div class="stat-label">Total Agenda</div>
                                        <div class="stat-number">{{ $stats['total_agenda'] ?? 0 }}</div>
                                        <div class="stat-desc">Semua agenda</div>
                                    </div>
                                    <div class="stat-icon">📅</div>
                                </div>
                            </div>

                            <div class="stat-card stat-green">
                                <div class="stat-content">
                                    <div>
                                        <div class="stat-label">Agenda Aktif</div>
                                        <div class="stat-number">{{ $stats['agenda_aktif'] ?? 0 }}</div>
                                        <div class="stat-desc">Sedang berlangsung</div>
                                    </div>
                                    <div class="stat-icon">✅</div>
                                </div>
                            </div>

                            <div class="stat-card stat-orange">
                                <div class="stat-content">
                                    <div>
                                        <div class="stat-label">Agenda Mendatang</div>
                                        <div class="stat-number">{{ $stats['agenda_mendatang'] ?? 0 }}</div>
                                        <div class="stat-desc">7 hari ke depan</div>
                                    </div>
                                    <div class="stat-icon">⏰</div>
                                </div>
                            </div>

                            <div class="stat-card stat-red">
                                <div class="stat-content">
                                    <div>
                                        <div class="stat-label">Urgent</div>
                                        <div class="stat-number">{{ $stats['agenda_urgent'] ?? 0 }}</div>
                                        <div class="stat-desc">Prioritas tinggi</div>
                                    </div>
                                    <div class="stat-icon">🚨</div>
                                </div>
                            </div>

                            <div class="stat-card stat-purple">
                                <div class="stat-content">
                                    <div>
                                        <div class="stat-label">Agenda Selesai</div>
                                        <div class="stat-number">{{ $stats['agenda_selesai'] ?? 0 }}</div>
                                        <div class="stat-desc">Bulan ini</div>
                                    </div>
                                    <div class="stat-icon">✔️</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters Section -->
                    <div class="filters-section">
                        <div class="filters-header">
                            <h3 class="filters-title">🔍 Filter & Pencarian</h3>
                            <button class="filters-toggle" onclick="toggleFilters()">Toggle</button>
                        </div>
                        <div class="filters-grid" id="filters-grid">
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-input" id="filter-status">
                                    <option value="">Semua Status</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non Aktif</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label class="filter-label">Kategori</label>
                                <select class="filter-input" id="filter-kategori">
                                    <option value="">Semua Kategori</option>
                                    <option value="rapat">Rapat</option>
                                    <option value="kegiatan">Kegiatan</option>
                                    <option value="sosialisasi">Sosialisasi</option>
                                    <option value="gotong_royong">Gotong Royong</option>
                                    <option value="pelatihan">Pelatihan</option>
                                    <option value="upacara">Upacara</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label class="filter-label">Prioritas</label>
                                <select class="filter-input" id="filter-prioritas">
                                    <option value="">Semua Prioritas</option>
                                    <option value="rendah">Rendah</option>
                                    <option value="normal">Normal</option>
                                    <option value="tinggi">Tinggi</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label class="filter-label">Periode</label>
                                <select class="filter-input" id="filter-periode">
                                    <option value="">Semua Periode</option>
                                    <option value="hari_ini">Hari Ini</option>
                                    <option value="minggu_ini">Minggu Ini</option>
                                    <option value="bulan_ini">Bulan Ini</option>
                                    <option value="mendatang">Mendatang</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label class="filter-label">Tanggal Mulai</label>
                                <input type="date" class="filter-input" id="filter-tanggal-mulai">
                            </div>

                            <div class="filter-group">
                                <label class="filter-label">Tanggal Selesai</label>
                                <input type="date" class="filter-input" id="filter-tanggal-selesai">
                            </div>
                        </div>
                    </div>

                    <!-- Main Table Card -->
                    <div class="table-card">
                        <div class="table-header">
                            <h3 class="table-title">📋 Daftar Agenda</h3>
                            <div class="table-actions">
                                <div class="search-box">
                                    <span class="search-icon">🔍</span>
                                    <input type="text" class="search-input" placeholder="Cari agenda..." id="global-search">
                                </div>
                                <button class="btn btn-secondary" onclick="refreshTable()">
                                    🔄
                                </button>
                                <button class="btn btn-secondary" onclick="exportData()">
                                    📥
                                </button>
                            </div>
                        </div>

                        <div class="table-container">
                            <table id="agenda-table" class="display responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="40">
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th width="250">Agenda</th>
                                        <th width="120">Kategori</th>
                                        <th width="150">Tanggal & Waktu</th>
                                        <th width="150">Tempat</th>
                                        <th width="80">Status</th>
                                        <th width="80">Prioritas</th>
                                        <th width="60">Featured</th>
                                        <th width="80">Peserta</th>
                                        <th width="120">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data will be loaded via DataTables AJAX --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Bulk Actions (Initially Hidden) -->
                    <div id="bulk-actions" class="filters-section" style="display: none;">
                        <div class="filters-header">
                            <h3 class="filters-title">📦 Aksi Massal</h3>
                            <span id="selected-count">0 agenda dipilih</span>
                        </div>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <button class="btn btn-secondary" onclick="bulkAction('aktif')">
                                ✅ Aktifkan
                            </button>
                            <button class="btn btn-secondary" onclick="bulkAction('nonaktif')">
                                ⏸️ Non-Aktifkan
                            </button>
                            <button class="btn btn-secondary" onclick="bulkAction('selesai')">
                                ✔️ Selesai
                            </button>
                            <button class="btn btn-secondary" onclick="bulkAction('export')">
                                📤 Export
                            </button>
                            <button class="btn btn-secondary" onclick="bulkAction('delete')" style="background: #fecaca; color: #991b1b;">
                                🗑️ Hapus
                            </button>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- jQuery & DataTables Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script>
        // Global variables
        let agendaTable;
        let selectedItems = [];

        $(document).ready(function() {
            initializeDataTable();
            initializeFilters();
            initializeEvents();
        });

        function initializeDataTable() {
            agendaTable = $('#agenda-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                scrollY: 'calc(100vh - 500px)',
                scrollCollapse: true,
                ajax: {
                    url: '{{ route("admin.agenda.data") }}',
                    data: function(d) {
                        d.status = $('#filter-status').val();
                        d.kategori = $('#filter-kategori').val();
                        d.prioritas = $('#filter-prioritas').val();
                        d.periode = $('#filter-periode').val();
                        d.tanggal_mulai = $('#filter-tanggal-mulai').val();
                        d.tanggal_selesai = $('#filter-tanggal-selesai').val();
                        d.search_global = $('#global-search').val();
                    },
                    error: function(xhr, error, thrown) {
                        showNotification('❌ Gagal memuat data agenda', 'error');
                    }
                },
                columns: [
                    {
                        data: 'id',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `<input type="checkbox" class="agenda-checkbox" value="${data}">`;
                        }
                    },
                    {
                        data: 'judul',
                        name: 'judul',
                        render: function(data, type, row) {
                            let featuredBadge = row.is_featured ? '<span class="badge" style="background: #fef3c7; color: #92400e; margin-left: 6px; font-size: 9px;">⭐</span>' : '';
                            let image = row.featured_image ? 
                                `<img src="${row.featured_image}" style="width: 32px; height: 32px; object-fit: cover; border-radius: 4px; margin-right: 8px;">` : 
                                '<div style="width: 32px; height: 32px; background: #f3f4f6; border-radius: 4px; margin-right: 8px; display: flex; align-items: center; justify-content: center; font-size: 12px;">📅</div>';
                            
                            return `
                                <div style="display: flex; align-items: center;">
                                    ${image}
                                    <div>
                                        <div style="font-weight: 600; color: #111827; margin-bottom: 2px; font-size: 12px;">${data.length > 40 ? data.substring(0, 40) + '...' : data}</div>
                                        <div style="font-size: 10px; color: #6b7280;">${(row.deskripsi || 'Tidak ada deskripsi').length > 50 ? (row.deskripsi || 'Tidak ada deskripsi').substring(0, 50) + '...' : (row.deskripsi || 'Tidak ada deskripsi')}</div>
                                        ${featuredBadge}
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'kategori',
                        name: 'kategori',
                        render: function(data) {
                            const categories = {
                                'rapat': '👥',
                                'kegiatan': '🎉',
                                'sosialisasi': '📢',
                                'gotong_royong': '🤝',
                                'pelatihan': '📚',
                                'upacara': '🏛️',
                                'lainnya': '📋'
                            };
                            return `<span class="category-badge">${categories[data] || '📋'} ${data}</span>`;
                        }
                    },
                    {
                        data: 'tanggal_mulai',
                        name: 'tanggal_mulai',
                        render: function(data, type, row) {
                            const startDate = new Date(data);
                            let dateStr = startDate.toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric'
                            });
                            
                            let timeStr = '';
                            if (row.waktu_mulai) {
                                timeStr = row.waktu_mulai;
                                if (row.waktu_selesai) {
                                    timeStr += ` - ${row.waktu_selesai}`;
                                }
                            }
                            
                            return `
                                <div>
                                    <div style="font-weight: 600; color: #111827; font-size: 11px;">${dateStr}</div>
                                    ${timeStr ? `<div style="font-size: 10px; color: #6b7280;">🕐 ${timeStr}</div>` : ''}
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'tempat',
                        name: 'tempat',
                        render: function(data, type, row) {
                            return `
                                <div>
                                    <div style="font-weight: 600; color: #111827; font-size: 11px;">📍 ${data.length > 20 ? data.substring(0, 20) + '...' : data}</div>
                                    ${row.alamat_lengkap ? `<div style="font-size: 10px; color: #6b7280;">${row.alamat_lengkap.length > 25 ? row.alamat_lengkap.substring(0, 25) + '...' : row.alamat_lengkap}</div>` : ''}
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            return `<span class="badge badge-${data}">${data}</span>`;
                        }
                    },
                    {
                        data: 'prioritas',
                        name: 'prioritas',
                        render: function(data) {
                            const priorities = {
                                'rendah': '🟢',
                                'normal': '🔵',
                                'tinggi': '🟡',
                                'urgent': '🔴'
                            };
                            return `<span class="badge priority-${data}">${priorities[data]} ${data}</span>`;
                        }
                    },
                    {
                        data: 'is_featured',
                        name: 'featured',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            const isActive = data ? 'active' : '';
                            return `
                                <div class="featured-toggle ${isActive}" onclick="toggleFeatured('${row.id}', ${!data})" title="Toggle Featured">
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'kapasitas_peserta',
                        name: 'peserta',
                        render: function(data, type, row) {
                            if (!row.perlu_pendaftaran) {
                                return '<span style="color: #6b7280; font-size: 10px;">Tidak ada</span>';
                            }
                            
                            const registered = row.jumlah_pendaftar || 0;
                            const capacity = data || 0;
                            const percentage = capacity > 0 ? Math.round((registered / capacity) * 100) : 0;
                            
                            return `
                                <div>
                                    <div style="font-weight: 600; color: #111827; font-size: 11px;">${registered}/${capacity}</div>
                                    <div style="font-size: 9px; color: #6b7280;">${percentage}% terisi</div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'id',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="action-buttons">
                                    <a href="/admin/agenda/${data}" class="action-btn btn-view" title="Lihat">👁️</a>
                                    <a href="/admin/agenda/${data}/edit" class="action-btn btn-edit" title="Edit">✏️</a>
                                    <button onclick="deleteAgenda('${data}')" class="action-btn btn-delete" title="Hapus">🗑️</button>
                                </div>
                            `;
                        }
                    }
                ],
                order: [[3, 'desc']],
                pageLength: 25,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                language: {
                    processing: "⏳ Memuat...",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ per halaman",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ agenda",
                    infoEmpty: "Tidak ada agenda",
                    infoFiltered: "(difilter dari _MAX_ total)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Belum ada agenda"
                },
                drawCallback: function() {
                    updateSelectedCount();
                    initializeCheckboxEvents();
                }
            });
        }

        function initializeFilters() {
            $('#filter-status, #filter-kategori, #filter-prioritas, #filter-periode, #filter-tanggal-mulai, #filter-tanggal-selesai').on('change', function() {
                agendaTable.ajax.reload();
            });

            let searchTimeout;
            $('#global-search').on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    agendaTable.ajax.reload();
                }, 500);
            });
        }

        function initializeEvents() {
            $('#select-all').on('change', function() {
                const isChecked = $(this).is(':checked');
                $('.agenda-checkbox').prop('checked', isChecked);
                updateSelectedItems();
            });
        }

        function initializeCheckboxEvents() {
            $('.agenda-checkbox').off('change').on('change', function() {
                updateSelectedItems();
                
                const totalCheckboxes = $('.agenda-checkbox').length;
                const checkedCheckboxes = $('.agenda-checkbox:checked').length;
                $('#select-all').prop('indeterminate', checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes);
                $('#select-all').prop('checked', checkedCheckboxes === totalCheckboxes);
            });
        }

        function updateSelectedItems() {
            selectedItems = [];
            $('.agenda-checkbox:checked').each(function() {
                selectedItems.push($(this).val());
            });
            updateSelectedCount();
            toggleBulkActions();
        }

        function updateSelectedCount() {
            $('#selected-count').text(`${selectedItems.length} agenda dipilih`);
        }

        function toggleBulkActions() {
            if (selectedItems.length > 0) {
                $('#bulk-actions').slideDown();
            } else {
                $('#bulk-actions').slideUp();
            }
        }

        function toggleFilters() {
            $('#filters-grid').slideToggle();
        }

        function refreshTable() {
            showNotification('🔄 Memperbarui data...', 'info');
            agendaTable.ajax.reload(null, false);
            setTimeout(() => {
                showNotification('✅ Data berhasil diperbarui!', 'success');
            }, 1000);
        }

        function exportData() {
            showNotification('📥 Memproses export...', 'info');
            window.open('{{ route("admin.agenda.export") }}', '_blank');
        }

        function toggleFeatured(id, featured) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: `/admin/agenda/${id}/toggle-featured`,
                type: 'POST',
                data: {
                    featured: featured,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('✅ Status featured berhasil diperbarui!', 'success');
                        agendaTable.ajax.reload(null, false);
                    } else {
                        showNotification('❌ ' + (response.message || 'Gagal memperbarui status featured'), 'error');
                    }
                },
                error: function(xhr, status, error) {
                    showNotification('❌ Gagal memperbarui status featured: ' + error, 'error');
                }
            });
        }

        function deleteAgenda(id) {
            if (confirm('❌ Yakin ingin menghapus agenda ini?\n\nData yang dihapus tidak dapat dikembalikan.')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: `/admin/agenda/${id}`,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            showNotification('✅ ' + response.message, 'success');
                            agendaTable.ajax.reload(null, false);
                        } else {
                            showNotification('❌ ' + (response.message || 'Gagal menghapus agenda'), 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        showNotification('❌ Gagal menghapus agenda: ' + error, 'error');
                    }
                });
            }
        }

        function bulkAction(action) {
            if (selectedItems.length === 0) {
                showNotification('⚠️ Pilih minimal satu agenda!', 'warning');
                return;
            }

            let confirmMessage = '';
            let url = '';
            
            switch(action) {
                case 'aktif':
                    confirmMessage = `Aktifkan ${selectedItems.length} agenda terpilih?`;
                    url = '/admin/agenda/bulk/status';
                    break;
                case 'nonaktif':
                    confirmMessage = `Non-aktifkan ${selectedItems.length} agenda terpilih?`;
                    url = '/admin/agenda/bulk/status';
                    break;
                case 'selesai':
                    confirmMessage = `Tandai selesai ${selectedItems.length} agenda terpilih?`;
                    url = '/admin/agenda/bulk/status';
                    break;
                case 'delete':
                    confirmMessage = `❌ HAPUS ${selectedItems.length} agenda terpilih?\n\nData yang dihapus tidak dapat dikembalikan!`;
                    url = '/admin/agenda/bulk/delete';
                    break;
                case 'export':
                    url = '/admin/agenda/bulk/export';
                    break;
            }

            if (action === 'export') {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.style.display = 'none';
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);
                
                const idsInput = document.createElement('input');
                idsInput.type = 'hidden';
                idsInput.name = 'ids';
                idsInput.value = JSON.stringify(selectedItems);
                form.appendChild(idsInput);
                
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
                
                showNotification('📤 Export dimulai...', 'info');
                return;
            }

            if (confirm(confirmMessage)) {
                $.post(url, {
                    _token: '{{ csrf_token() }}',
                    ids: selectedItems,
                    status: action
                })
                .done(function(response) {
                    if (response.status === 'success') {
                        showNotification('✅ ' + response.message, 'success');
                        agendaTable.ajax.reload();
                        selectedItems = [];
                        $('.agenda-checkbox, #select-all').prop('checked', false);
                        toggleBulkActions();
                    } else {
                        showNotification('❌ ' + response.message, 'error');
                    }
                })
                .fail(function() {
                    showNotification('❌ Gagal melakukan aksi massal', 'error');
                });
            }
        }

        function showNotification(message, type = 'info') {
            $('.notification').remove();
            
            const notification = $(`<div class="notification ${type}"></div>`);
            
            notification.html(`
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span>${message}</span>
                    <button onclick="$(this).closest('.notification').remove()" style="background: none; border: none; font-size: 16px; cursor: pointer; opacity: 0.7; padding: 0;">×</button>
                </div>
            `);
            
            $('body').append(notification);
            
            setTimeout(() => {
                notification.addClass('show');
            }, 100);
            
            setTimeout(() => {
                notification.removeClass('show');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
    </script>
</body>
</html>