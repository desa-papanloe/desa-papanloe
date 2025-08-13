{{-- resources/views/admin/berita/show.blade.php - CLEANED VERSION (NO IMAGE FEATURES) --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Berita: {{ $berita->judul }} - Admin Desa Papanloe</title>
    
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
        
        .container-fluid {
            max-width: 100vw;
            width: 100%;
            margin: 0 auto;
        }
        
        /* Sidebar - Same as other pages */
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
        
        /* Main Content with Fixed Height */
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
        
        /* Top Navigation */
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
        
        /* Page Content with Internal Scroll */
        .page-content {
            flex: 1;
            padding: 24px;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            background: #f8fafc;
        }
        
        /* Detail Container */
        .detail-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        /* Page Header */
        .page-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .header-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
        }
        
        .header-subtitle {
            color: #64748b;
            margin: 0 0 16px 0;
            font-size: 16px;
        }
        
        .header-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 10px 20px;
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
        
        .btn-success {
            background: #10b981;
            color: white;
        }
        
        .btn-success:hover {
            background: #059669;
        }
        
        .btn-warning {
            background: #f59e0b;
            color: white;
        }
        
        .btn-warning:hover {
            background: #d97706;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background: #dc2626;
        }
        
        /* Detail Grid */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 24px;
        }
        
        @media (max-width: 1024px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }
        
        /* Detail Sections */
        .detail-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 20px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-badge.draft {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-badge.published {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-badge.archived {
            background: #f3f4f6;
            color: #6b7280;
        }
        
        /* Category Badge */
        .category-badge {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: capitalize;
        }
        
        /* Featured Badge */
        .featured-badge {
            background: linear-gradient(45deg, #fef3c7, #fde68a);
            color: #92400e;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        /* Content Display */
        .content-display {
            line-height: 1.8;
            color: #374151;
        }
        
        .content-display h1,
        .content-display h2,
        .content-display h3,
        .content-display h4,
        .content-display h5,
        .content-display h6 {
            color: #1e293b;
            font-weight: 600;
            margin: 24px 0 16px 0;
        }
        
        .content-display p {
            margin-bottom: 16px;
        }
        
        /* Info List */
        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            color: #6b7280;
            font-weight: 500;
        }
        
        .info-value {
            color: #374151;
            font-weight: 600;
            text-align: right;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .page-content {
                padding: 16px;
                max-height: calc(100vh - 80px);
            }
            
            .page-header {
                padding: 16px;
            }
            
            .detail-section {
                padding: 16px;
            }
            
            .header-actions {
                flex-direction: column;
            }
            
            .btn {
                justify-content: center;
            }
        }
        
        /* Scrollbar Styling */
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
        
        /* Notification */
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

                    <a href="{{ route('admin.berita.index') }}" class="nav-item active">
                        <span class="nav-icon">📰</span>
                        <span>Kelola Berita</span>
                    </a>

                    <a href="{{ route('admin.agenda.index') }}" class="nav-item">
                        <span class="nav-icon">📅</span>
                        <span>Kelola Agenda</span>
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
                    <div class="breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a> / 
                        <a href="{{ route('admin.berita.index') }}">Berita</a> / 
                        <span>{{ Str::limit($berita->judul, 30) }}</span>
                    </div>

                    <div class="user-menu">
                        <div class="user-info">
                            <h4>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</h4>
                            <p>{{ Auth::guard('admin')->user()->role_label ?? 'Administrator' }}</p>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="page-content">
                    <div class="detail-container">
                        <!-- Page Header -->
                        <div class="page-header">
                            <h1 class="header-title">📰 Detail Berita</h1>
                            <p class="header-subtitle">Lihat informasi lengkap berita yang dipilih</p>
                            
                            <div class="header-actions">
                                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                                    ← Kembali ke Daftar
                                </a>
                                <a href="{{ route('admin.berita.preview', $berita->id) }}" target="_blank" class="btn btn-primary">
                                    👁️ Preview
                                </a>
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-warning">
                                    ✏️ Edit Berita
                                </a>
                                @if($berita->status === 'draft')
                                <button onclick="changeStatus('published')" class="btn btn-success">
                                    📢 Publish
                                </button>
                                @elseif($berita->status === 'published')
                                <button onclick="changeStatus('draft')" class="btn btn-secondary">
                                    📝 Jadikan Draft
                                </button>
                                @endif
                                <button onclick="deleteBerita()" class="btn btn-danger">
                                    🗑️ Hapus
                                </button>
                            </div>
                        </div>

                        <div class="detail-grid">
                            <!-- Main Content -->
                            <div>
                                <!-- Berita Header -->
                                <div class="detail-section">
                                    <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px;">
                                        <span class="status-badge {{ $berita->status }}">
                                            {{ ucfirst($berita->status) }}
                                        </span>
                                        <span class="category-badge">
                                            {{ $berita->kategori_display }}
                                        </span>
                                        @if($berita->is_featured)
                                        <span class="featured-badge">
                                            ⭐ Featured
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 12px; line-height: 1.3;">
                                        {{ $berita->judul }}
                                    </h2>
                                    
                                    @if($berita->excerpt)
                                    <div style="background: #f8fafc; padding: 16px; border-radius: 8px; border-left: 4px solid #3b82f6; margin-bottom: 16px;">
                                        <h4 style="margin: 0 0 8px 0; font-size: 14px; font-weight: 600; color: #374151;">Ringkasan:</h4>
                                        <p style="margin: 0; color: #6b7280; font-style: italic;">{{ $berita->excerpt }}</p>
                                    </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="detail-section">
                                    <h3 class="section-title">📄 Konten Berita</h3>
                                    <div class="content-display">
                                        {!! $berita->konten !!}
                                    </div>
                                </div>

                                <!-- SEO Information -->
                                @if($berita->meta_description || $berita->meta_keywords)
                                <div class="detail-section">
                                    <h3 class="section-title">🔍 SEO & Meta Data</h3>
                                    
                                    @if($berita->meta_description)
                                    <div style="margin-bottom: 16px;">
                                        <h4 style="font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Meta Description:</h4>
                                        <p style="background: #f8fafc; padding: 12px; border-radius: 6px; margin: 0; color: #6b7280; font-size: 14px;">
                                            {{ $berita->meta_description }}
                                        </p>
                                    </div>
                                    @endif
                                    
                                    @if($berita->meta_keywords)
                                    <div>
                                        <h4 style="font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;">Meta Keywords:</h4>
                                        <p style="background: #f8fafc; padding: 12px; border-radius: 6px; margin: 0; color: #6b7280; font-size: 14px;">
                                            {{ $berita->meta_keywords }}
                                        </p>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>

                            <!-- Sidebar Info -->
                            <div>
                                <!-- Basic Info -->
                                <div class="detail-section">
                                    <h3 class="section-title">📊 Informasi Berita</h3>
                                    <ul class="info-list">
                                        <li class="info-item">
                                            <span class="info-label">ID Berita</span>
                                            <span class="info-value">#{{ $berita->id }}</span>
                                        </li>
                                        <li class="info-item">
                                            <span class="info-label">Slug URL</span>
                                            <span class="info-value">{{ $berita->slug }}</span>
                                        </li>
                                        <li class="info-item">
                                            <span class="info-label">Status</span>
                                            <span class="info-value">
                                                <span class="status-badge {{ $berita->status }}">
                                                    {{ ucfirst($berita->status) }}
                                                </span>
                                            </span>
                                        </li>
                                        <li class="info-item">
                                            <span class="info-label">Kategori</span>
                                            <span class="info-value">{{ $berita->kategori_display }}</span>
                                        </li>
                                        <li class="info-item">
                                            <span class="info-label">Dibaca</span>
                                            <span class="info-value">{{ number_format($berita->views) }} kali</span>
                                        </li>
                                        <li class="info-item">
                                            <span class="info-label">Komentar</span>
                                            <span class="info-value">{{ $berita->allow_comments ? 'Diizinkan' : 'Tidak diizinkan' }}</span>
                                        </li>
                                        <li class="info-item">
                                            <span class="info-label">Featured</span>
                                            <span class="info-value">{{ $berita->is_featured ? 'Ya' : 'Tidak' }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Timestamps -->
                                <div class="detail-section">
                                    <h3 class="section-title">⏰ Waktu & Tanggal</h3>
                                    <ul class="info-list">
                                        <li class="info-item">
                                            <span class="info-label">Dibuat</span>
                                            <span class="info-value">
                                                {{ $berita->created_at->format('d/m/Y H:i') }}<br>
                                                <small style="color: #9ca3af;">{{ $berita->created_at->diffForHumans() }}</small>
                                            </span>
                                        </li>
                                        <li class="info-item">
                                            <span class="info-label">Diupdate</span>
                                            <span class="info-value">
                                                {{ $berita->updated_at->format('d/m/Y H:i') }}<br>
                                                <small style="color: #9ca3af;">{{ $berita->updated_at->diffForHumans() }}</small>
                                            </span>
                                        </li>
                                        @if($berita->published_at)
                                        <li class="info-item">
                                            <span class="info-label">Dipublikasi</span>
                                            <span class="info-value">
                                                {{ $berita->published_at->format('d/m/Y H:i') }}<br>
                                                <small style="color: #9ca3af;">{{ $berita->published_at->diffForHumans() }}</small>
                                            </span>
                                        </li>
                                        @endif
                                    </ul>
                                </div>

                                <!-- Author Info -->
                                <div class="detail-section">
                                    <h3 class="section-title">👤 Informasi Penulis</h3>
                                    <ul class="info-list">
                                        <li class="info-item">
                                            <span class="info-label">Dibuat oleh</span>
                                            <span class="info-value">{{ $berita->creator->name ?? 'Unknown' }}</span>
                                        </li>
                                        <li class="info-item">
                                            <span class="info-label">Diupdate oleh</span>
                                            <span class="info-value">{{ $berita->updater->name ?? 'Unknown' }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Quick Actions -->
                                <div class="detail-section">
                                    <h3 class="section-title">⚡ Aksi Cepat</h3>
                                    <div style="display: flex; flex-direction: column; gap: 8px;">
                                        @if($berita->status === 'published')
                                        <button onclick="toggleFeatured()" class="btn btn-warning" style="width: 100%; justify-content: center;">
                                            {{ $berita->is_featured ? '⭐ Remove Featured' : '⭐ Set Featured' }}
                                        </button>
                                        @endif
                                        
                                        <button onclick="duplicateBerita()" class="btn btn-secondary" style="width: 100%; justify-content: center;">
                                            📋 Duplikasi Berita
                                        </button>
                                        
                                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary" style="width: 100%; justify-content: center;">
                                            ➕ Buat Berita Baru
                                        </a>
                                    </div>
                                </div>

                                <!-- Statistics -->
                                <div class="detail-section">
                                    <h3 class="section-title">📈 Statistik</h3>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; text-align: center;">
                                        <div style="background: #eff6ff; padding: 16px; border-radius: 8px;">
                                            <div style="font-size: 24px; font-weight: 700; color: #1d4ed8;">
                                                {{ number_format($berita->views) }}
                                            </div>
                                            <div style="font-size: 12px; color: #6b7280; margin-top: 4px;">
                                                Total Views
                                            </div>
                                        </div>
                                        
                                        <div style="background: #f0fdf4; padding: 16px; border-radius: 8px;">
                                            <div style="font-size: 24px; font-weight: 700; color: #15803d;">
                                                {{ $berita->reading_time }}
                                            </div>
                                            <div style="font-size: 12px; color: #6b7280; margin-top: 4px;">
                                                Menit Baca
                                            </div>
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

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 12px; padding: 24px; max-width: 400px; width: 90%; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 16px;">🗑️</div>
            <h3 style="margin: 0 0 8px 0; color: #1e293b;">Hapus Berita</h3>
            <p style="color: #6b7280; margin-bottom: 24px;">
                Apakah Anda yakin ingin menghapus berita "<strong>{{ Str::limit($berita->judul, 50) }}</strong>"?
                <br><br>Tindakan ini tidak dapat dibatalkan.
            </p>
            <div style="display: flex; gap: 12px;">
                <button onclick="closeDeleteModal()" class="btn btn-secondary" style="flex: 1;">
                    Batal
                </button>
                <button onclick="confirmDelete()" class="btn btn-danger" style="flex: 1;">
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        // Delete Modal Functions
        function deleteBerita() {
            document.getElementById('delete-modal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').style.display = 'none';
        }

        function confirmDelete() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('admin.berita.destroy', $berita->id) }}";
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }

        // Status Change Function
        function changeStatus(newStatus) {
            if (confirm(`Apakah Anda yakin ingin mengubah status berita menjadi "${newStatus}"?`)) {
                fetch(`{{ route('admin.berita.status', $berita->id) }}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showNotification('✅ ' + data.message, 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification('❌ ' + (data.message || 'Gagal mengubah status'), 'error');
                    }
                })
                .catch(error => {
                    showNotification('❌ Terjadi kesalahan', 'error');
                    console.error('Error:', error);
                });
            }
        }

        // Toggle Featured Function
        function toggleFeatured() {
            const currentFeatured = {{ $berita->is_featured ? 'true' : 'false' }};
            const newFeatured = !currentFeatured;
            
            fetch(`{{ route('admin.berita.toggle-featured', $berita->id) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ featured: newFeatured })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showNotification('✅ ' + data.message, 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showNotification('❌ ' + (data.message || 'Gagal mengubah status featured'), 'error');
                }
            })
            .catch(error => {
                showNotification('❌ Terjadi kesalahan', 'error');
                console.error('Error:', error);
            });
        }

        // Duplicate Function (Placeholder)
        function duplicateBerita() {
            showNotification('📋 Fitur duplikasi akan segera tersedia...', 'success');
        }

        // Notification Function
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; font-size: 16px; cursor: pointer; opacity: 0.7;">×</button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Close modals on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });

        // Close modals on outside click
        document.getElementById('delete-modal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeDeleteModal();
            }
        });

        // Show success/error messages from Laravel
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif
    </script>
</body>
</html>