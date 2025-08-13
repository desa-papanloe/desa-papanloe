{{-- resources/views/admin/berita/create.blade.php - CLEANED VERSION (NO IMAGE FEATURES) --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($berita) ? 'Edit' : 'Buat' }} Berita - Admin Desa Papanloe</title>
    
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
        
        /* Admin Layout with Max Width/Height - FIXED */
        .admin-layout {
            background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
            min-height: 100vh;
            max-height: 100vh;
            overflow: hidden;
            position: relative;
        }
        
        .container-fluid {
            max-width: 100vw;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        /* Hide any stray elements outside main container */
        body > *:not(.container-fluid):not(.notification):not(script) {
            display: none !important;
        }
        
        /* Sidebar - Fixed Height */
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
        
        /* Main Content - Fixed Height with Scroll */
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
        
        /* Form Container with Max Width */
        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        .form-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .form-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
        }
        
        .form-subtitle {
            color: #64748b;
            margin: 0 0 16px 0;
            font-size: 16px;
        }
        
        .form-actions {
            display: flex;
            gap: 12px;
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
        
        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 24px;
        }
        
        @media (max-width: 1024px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }
        
        /* Form Sections with Proper Height */
        .form-section {
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
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }
        
        .form-label.required::after {
            content: '*';
            color: #ef4444;
            margin-left: 4px;
        }
        
        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
            background: white;
        }
        
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-input.error, .form-textarea.error, .form-select.error {
            border-color: #ef4444;
        }
        
        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-help {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
        
        .form-error {
            font-size: 12px;
            color: #ef4444;
            margin-top: 4px;
        }
        
        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }
        
        .toggle-input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e5e7eb;
            transition: 0.3s;
            border-radius: 24px;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .toggle-input:checked + .toggle-slider {
            background-color: #10b981;
        }
        
        .toggle-input:checked + .toggle-slider:before {
            transform: translateX(20px);
        }
        
        /* Character Counter */
        .char-counter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 4px;
            font-size: 12px;
            color: #6b7280;
        }
        
        /* CKEditor Customization - Fixed Height */
        .ck-editor__editable {
            min-height: 350px;
            max-height: 500px;
            overflow-y: auto;
        }
        
        .ck.ck-editor__main > .ck-editor__editable {
            border-radius: 0 0 8px 8px;
        }
        
        .ck.ck-editor__top .ck-sticky-panel__content {
            border-radius: 8px 8px 0 0;
        }
        
        /* Responsive - Maintain Height Constraints */
        @media (max-width: 768px) {
            .page-content {
                padding: 16px;
                max-height: calc(100vh - 80px);
            }
            
            .form-header {
                padding: 16px;
            }
            
            .form-section {
                padding: 16px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .ck-editor__editable {
                min-height: 250px;
                max-height: 350px;
            }
        }
        
        /* Loading State */
        .loading {
            position: relative;
            pointer-events: none;
        }
        
        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        
        /* Notification - Improved */
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
            max-width: 450px;
            word-wrap: break-word;
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
                        <span>{{ isset($berita) ? 'Edit' : 'Buat Baru' }}</span>
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
                    <div class="form-container">
                        <!-- Form Header -->
                        <div class="form-header">
                            <h1 class="form-title">
                                {{ isset($berita) ? '✏️ Edit Berita' : '➕ Buat Berita Baru' }}
                            </h1>
                            <p class="form-subtitle">
                                {{ isset($berita) ? 'Perbarui informasi berita yang sudah ada' : 'Tulis dan publikasikan berita terbaru untuk website desa' }}
                            </p>
                            <div class="form-actions">
                                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                                    ← Kembali
                                </a>
                                @if(isset($berita))
                                <a href="{{ route('admin.berita.preview', $berita->id) }}" target="_blank" class="btn btn-warning">
                                    👁️ Preview
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Main Form -->
                        <form action="{{ isset($berita) ? route('admin.berita.update', $berita->id) : route('admin.berita.store') }}" 
                              method="POST" 
                              enctype="multipart/form-data" 
                              id="berita-form"
                              novalidate>
                            @csrf
                            @if(isset($berita))
                                @method('PUT')
                            @endif

                            <div class="form-grid">
                                <!-- Left Column - Main Content -->
                                <div>
                                    <!-- Basic Information -->
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            📝 Informasi Dasar
                                        </h3>
                                        
                                        <div class="form-group">
                                            <label for="judul" class="form-label required">Judul Berita</label>
                                            <input type="text" 
                                                   id="judul" 
                                                   name="judul" 
                                                   class="form-input {{ $errors->has('judul') ? 'error' : '' }}"
                                                   value="{{ old('judul', $berita->judul ?? '') }}"
                                                   placeholder="Masukkan judul berita yang menarik..."
                                                   required>
                                            @error('judul')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                            <div class="form-help">Slug URL akan dibuat otomatis dari judul</div>
                                        </div>

                                        <div class="form-group">
                                            <label for="excerpt" class="form-label">Ringkasan</label>
                                            <textarea id="excerpt" 
                                                      name="excerpt" 
                                                      class="form-textarea {{ $errors->has('excerpt') ? 'error' : '' }}"
                                                      rows="3"
                                                      maxlength="500"
                                                      placeholder="Tulis ringkasan singkat berita (opsional)...">{{ old('excerpt', $berita->excerpt ?? '') }}</textarea>
                                            @error('excerpt')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                            <div class="char-counter">
                                                <span class="form-help">Ringkasan akan tampil di daftar berita</span>
                                                <span id="excerpt-count">0/500</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Content Section -->
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            📄 Konten Berita
                                        </h3>
                                        
                                        <div class="form-group">
                                            <label for="konten" class="form-label required">Isi Berita</label>
                                            <textarea id="konten" 
                                                      name="konten" 
                                                      class="form-textarea {{ $errors->has('konten') ? 'error' : '' }}"
                                                      required>{{ old('konten', $berita->konten ?? '') }}</textarea>
                                            @error('konten')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- SEO Section -->
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            🔍 SEO & Meta Data
                                        </h3>
                                        
                                        <div class="form-group">
                                            <label for="meta_description" class="form-label">Meta Description</label>
                                            <textarea id="meta_description" 
                                                      name="meta_description" 
                                                      class="form-textarea {{ $errors->has('meta_description') ? 'error' : '' }}"
                                                      rows="2"
                                                      maxlength="160"
                                                      placeholder="Deskripsi yang akan muncul di hasil pencarian Google...">{{ old('meta_description', $berita->meta_description ?? '') }}</textarea>
                                            @error('meta_description')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                            <div class="char-counter">
                                                <span class="form-help">Optimal: 120-160 karakter</span>
                                                <span id="meta-count">0/160</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="meta_keywords" class="form-label">Kata Kunci</label>
                                            <input type="text" 
                                                   id="meta_keywords" 
                                                   name="meta_keywords" 
                                                   class="form-input {{ $errors->has('meta_keywords') ? 'error' : '' }}"
                                                   value="{{ old('meta_keywords', $berita->meta_keywords ?? '') }}"
                                                   placeholder="kata kunci, dipisahkan, dengan, koma">
                                            @error('meta_keywords')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                            <div class="form-help">Pisahkan dengan koma. Contoh: berita desa, papanloe, bantaeng</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column - Settings Only (NO MEDIA SECTION) -->
                                <div>
                                    <!-- Publish Settings -->
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            📊 Pengaturan Publikasi
                                        </h3>
                                        
                                        <div class="form-group">
                                            <label for="status" class="form-label required">Status</label>
                                            <select id="status" 
                                                    name="status" 
                                                    class="form-select {{ $errors->has('status') ? 'error' : '' }}"
                                                    required>
                                                @foreach($statuses as $value => $label)
                                                    <option value="{{ $value }}" {{ old('status', $berita->status ?? 'draft') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kategori" class="form-label required">Kategori</label>
                                            <select id="kategori" 
                                                    name="kategori" 
                                                    class="form-select {{ $errors->has('kategori') ? 'error' : '' }}"
                                                    required>
                                                @foreach($kategoris as $value => $label)
                                                    <option value="{{ $value }}" {{ old('kategori', $berita->kategori ?? 'umum') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="published_at" class="form-label">Tanggal Publikasi</label>
                                            <input type="datetime-local" 
                                                   id="published_at" 
                                                   name="published_at" 
                                                   class="form-input {{ $errors->has('published_at') ? 'error' : '' }}"
                                                   value="{{ old('published_at', isset($berita) && $berita->published_at ? $berita->published_at->format('Y-m-d\TH:i') : '') }}">
                                            @error('published_at')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                            <div class="form-help">Kosongkan untuk publikasi otomatis saat status "Published"</div>
                                        </div>

                                        <div class="form-group">
                                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                                <label class="form-label">Berita Utama (Featured)</label>
                                                <label class="toggle-switch">
                                                    <input type="checkbox" 
                                                           name="is_featured" 
                                                           value="1" 
                                                           class="toggle-input"
                                                           {{ old('is_featured', $berita->is_featured ?? false) ? 'checked' : '' }}>
                                                    <span class="toggle-slider"></span>
                                                </label>
                                            </div>
                                            <div class="form-help">Berita yang ditandai akan tampil di beranda</div>
                                        </div>

                                        <div class="form-group">
                                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                                <label class="form-label">Izinkan Komentar</label>
                                                <label class="toggle-switch">
                                                    <input type="checkbox" 
                                                           name="allow_comments" 
                                                           value="1" 
                                                           class="toggle-input"
                                                           {{ old('allow_comments', $berita->allow_comments ?? true) ? 'checked' : '' }}>
                                                    <span class="toggle-slider"></span>
                                                </label>
                                            </div>
                                            <div class="form-help">Pengunjung dapat memberikan komentar</div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            💾 Aksi
                                        </h3>
                                        
                                        <div style="display: flex; flex-direction: column; gap: 12px;">
                                            <button type="submit" 
                                                    name="action" 
                                                    value="save" 
                                                    class="btn btn-primary" 
                                                    style="width: 100%;"
                                                    id="save-btn">
                                                💾 {{ isset($berita) ? 'Perbarui' : 'Simpan' }} Berita
                                            </button>
                                            
                                            <button type="submit" 
                                                    name="action" 
                                                    value="save_and_continue" 
                                                    class="btn btn-secondary" 
                                                    style="width: 100%;"
                                                    id="save-continue-btn">
                                                💾➕ {{ isset($berita) ? 'Perbarui' : 'Simpan' }} & Lanjut Edit
                                            </button>

                                            @if(isset($berita))
                                                <button type="submit" 
                                                        name="action" 
                                                        value="save_and_publish" 
                                                        class="btn btn-success" 
                                                        style="width: 100%;"
                                                        id="save-publish-btn">
                                                    📢 {{ isset($berita) ? 'Perbarui' : 'Simpan' }} & Publish
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    @if(isset($berita))
                                    <!-- Info Section -->
                                    <div class="form-section">
                                        <h3 class="section-title">
                                            📊 Informasi Berita
                                        </h3>
                                        
                                        <div style="font-size: 13px; color: #6b7280; line-height: 1.6;">
                                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                <span>ID Berita:</span>
                                                <strong style="color: #374151;">#{{ $berita->id }}</strong>
                                            </div>
                                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                <span>Dibuat:</span>
                                                <strong style="color: #374151;">{{ $berita->created_at->format('d/m/Y H:i') }}</strong>
                                            </div>
                                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                <span>Diupdate:</span>
                                                <strong style="color: #374151;">{{ $berita->updated_at->format('d/m/Y H:i') }}</strong>
                                            </div>
                                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                <span>Pembaca:</span>
                                                <strong style="color: #374151;">{{ number_format($berita->views) }} kali</strong>
                                            </div>
                                            @if($berita->published_at)
                                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                <span>Dipublikasi:</span>
                                                <strong style="color: #374151;">{{ $berita->published_at->format('d/m/Y H:i') }}</strong>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        let editor;
        
        document.addEventListener('DOMContentLoaded', function() {
            // Hide any potential debug output or errors that appear above navbar
            const bodyChildren = document.body.children;
            for (let i = 0; i < bodyChildren.length; i++) {
                const child = bodyChildren[i];
                // Hide any text nodes or unwanted elements before our main container
                if (child !== document.querySelector('.container-fluid') && 
                    !child.classList.contains('notification') && 
                    child.tagName !== 'SCRIPT') {
                    
                    // If it's a text node or unwanted element, hide it
                    if (child.nodeType === Node.TEXT_NODE || 
                        (child.tagName && !child.querySelector('.container-fluid'))) {
                        child.style.display = 'none';
                    }
                }
            }

            // Initialize CKEditor (WITHOUT image upload functionality)
            ClassicEditor
                .create(document.querySelector('#konten'), {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'blockQuote', 'insertTable', '|',
                        'undo', 'redo'
                    ],
                    table: {
                        contentToolbar: [
                            'tableColumn',
                            'tableRow',
                            'mergeTableCells'
                        ]
                    }
                })
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error('CKEditor initialization error:', error);
                });

            // Character counters
            setupCharCounter('excerpt', 'excerpt-count', 500);
            setupCharCounter('meta_description', 'meta-count', 160);

            // Auto-slug generation (only for new berita)
            @if(!isset($berita))
            const judulInput = document.getElementById('judul');
            if (judulInput) {
                judulInput.addEventListener('input', function() {
                    // Visual feedback for slug generation
                    const helpText = this.nextElementSibling?.nextElementSibling;
                    if (helpText && helpText.classList.contains('form-help')) {
                        if (this.value.trim()) {
                            helpText.textContent = 'Slug URL: ' + this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                        } else {
                            helpText.textContent = 'Slug URL akan dibuat otomatis dari judul';
                        }
                    }
                });
            }
            @endif

            // Form submission handling
            const form = document.getElementById('berita-form');
            form.addEventListener('submit', function(e) {
                // Update CKEditor content before submission
                if (editor) {
                    const content = editor.getData();
                    document.querySelector('#konten').value = content;
                }

                // Basic validation
                const judul = document.getElementById('judul').value.trim();
                const konten = document.querySelector('#konten').value.trim();
                
                if (!judul) {
                    e.preventDefault();
                    showNotification('❌ Judul berita wajib diisi!', 'error');
                    return false;
                }
                
                if (!konten || konten.length < 10) {
                    e.preventDefault();
                    showNotification('❌ Konten berita terlalu pendek!', 'error');
                    return false;
                }

                // Show loading state
                const clickedButton = document.activeElement;
                if (clickedButton && clickedButton.type === 'submit') {
                    clickedButton.disabled = true;
                    const originalText = clickedButton.getAttribute('data-original-text');
                    clickedButton.innerHTML = '⏳ Menyimpan...';
                    
                    // Re-enable after 10 seconds as fallback
                    setTimeout(() => {
                        clickedButton.disabled = false;
                        clickedButton.innerHTML = originalText || 'Simpan';
                    }, 10000);
                }
            });

            // Enhanced auto-save draft functionality
            let autoSaveInterval;
            let lastSavedContent = '';
            
            function startAutoSave() {
                if (autoSaveInterval) clearInterval(autoSaveInterval);
                
                autoSaveInterval = setInterval(function() {
                    if (editor) {
                        const currentContent = editor.getData();
                        const judul = document.getElementById('judul').value.trim();
                        
                        // Only auto-save if content changed and has substantial content
                        if (currentContent !== lastSavedContent && 
                            currentContent.length > 50 && 
                            judul.length > 3) {
                            
                            lastSavedContent = currentContent;
                            // Show subtle indication
                            showNotification('💾 Konten otomatis tersimpan sementara...', 'success');
                        }
                    }
                }, 60000); // Every 60 seconds
            }
            
            // Start auto-save when editor is ready and content exists
            if (editor && document.getElementById('judul').value) {
                startAutoSave();
            }
        });

        function setupCharCounter(inputId, counterId, maxChars) {
            const input = document.getElementById(inputId);
            const counter = document.getElementById(counterId);
            
            if (input && counter) {
                function updateCounter() {
                    const currentLength = input.value.length;
                    counter.textContent = `${currentLength}/${maxChars}`;
                    
                    if (currentLength > maxChars * 0.9) {
                        counter.style.color = '#ef4444';
                    } else if (currentLength > maxChars * 0.7) {
                        counter.style.color = '#f59e0b';
                    } else {
                        counter.style.color = '#6b7280';
                    }
                }
                
                input.addEventListener('input', updateCounter);
                updateCounter(); // Initial count
            }
        }

        function showNotification(message, type = 'success') {
            // Remove existing notifications first
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notif => notif.remove());
            
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 8px; max-width: 400px;">
                    <span style="flex: 1; word-wrap: break-word;">${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; font-size: 16px; cursor: pointer; opacity: 0.7; flex-shrink: 0;">×</button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }, 5000);
        }

        // Show success/error messages from Laravel
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif
        
        // Show validation errors if any
        @if($errors->any())
            let errorMessages = [];
            @foreach($errors->all() as $error)
                errorMessages.push('{{ $error }}');
            @endforeach
            
            if (errorMessages.length > 0) {
                showNotification('❌ Terdapat kesalahan: ' + errorMessages.join(', '), 'error');
            }
        @endif
    </script>
</body>
</html>