{{-- resources/views/admin/settings/index.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pengaturan Sistem - Admin Desa Papanloe</title>
    
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
            position: relative;
        }
        
        .container-fluid {
            max-width: 100vw;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
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
        
        /* Main Content */
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
        
        /* Page Content */
        .page-content {
            flex: 1;
            padding: 24px;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            background: #f8fafc;
        }
        
        /* Form Container */
        .form-container {
            max-width: 800px;
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
            border: 1px solid #d1d5db;
        }
        
        .btn-secondary:hover {
            background: #f9fafb;
        }
        
        /* Form Sections */
        .form-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
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
            max-width: 450px;
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

                    <a href="{{ route('admin.berita.index') }}" class="nav-item">
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

                    <a href="{{ route('admin.settings.index') }}" class="nav-item active">
                        <span class="nav-icon">⚙️</span>
                        <span>Pengaturan</span>
                    </a>

                    <a href="{{ route('admin.profile.show') }}" class="nav-item">
                        <span class="nav-icon">👤</span>
                        <span>Profil</span>
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
                        <a href="{{ route('admin.settings.index') }}">Pengaturan</a> / 
                        <span>Umum</span>
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
                            <h1 class="form-title">🌐 Pengaturan Umum</h1>
                            <p class="form-subtitle">Kelola informasi dasar website dan konfigurasi sistem</p>
                            <div class="form-actions">
                                <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
                                    ← Kembali
                                </a>
                            </div>
                        </div>

                        <!-- Form -->
                        <form action="{{ route('admin.settings.general') }}" method="POST" id="general-settings-form">
                            @csrf
                            @method('PUT')

                            <!-- Website Information -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    🌐 Informasi Website
                                </h3>
                                
                                <div class="form-group">
                                    <label for="site_name" class="form-label required">Nama Website</label>
                                    <input type="text" 
                                           id="site_name" 
                                           name="site_name" 
                                           class="form-input {{ $errors->has('site_name') ? 'error' : '' }}"
                                           value="{{ old('site_name', $settings['site_name'] ?? 'Desa Papanloe') }}"
                                           required>
                                    @error('site_name')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-help">Nama website yang akan ditampilkan di header dan title</div>
                                </div>

                                <div class="form-group">
                                    <label for="site_description" class="form-label required">Deskripsi Website</label>
                                    <textarea id="site_description" 
                                              name="site_description" 
                                              class="form-textarea {{ $errors->has('site_description') ? 'error' : '' }}"
                                              rows="3"
                                              required>{{ old('site_description', $settings['site_description'] ?? 'Website Resmi Desa Papanloe') }}</textarea>
                                    @error('site_description')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-help">Deskripsi singkat website untuk SEO dan meta tags</div>
                                </div>

                                <div class="form-group">
                                    <label for="site_keywords" class="form-label">Kata Kunci</label>
                                    <input type="text" 
                                           id="site_keywords" 
                                           name="site_keywords" 
                                           class="form-input {{ $errors->has('site_keywords') ? 'error' : '' }}"
                                           value="{{ old('site_keywords', $settings['site_keywords'] ?? 'desa papanloe, bantaeng, sulawesi selatan') }}"
                                           placeholder="kata kunci, dipisahkan, dengan, koma">
                                    @error('site_keywords')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-help">Kata kunci untuk SEO, pisahkan dengan koma</div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    📞 Informasi Kontak
                                </h3>
                                
                                <div class="form-group">
                                    <label for="contact_email" class="form-label required">Email Kontak</label>
                                    <input type="email" 
                                           id="contact_email" 
                                           name="contact_email" 
                                           class="form-input {{ $errors->has('contact_email') ? 'error' : '' }}"
                                           value="{{ old('contact_email', $settings['contact_email'] ?? 'info@papanloe.com') }}"
                                           required>
                                    @error('contact_email')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-help">Email resmi untuk kontak dan komunikasi</div>
                                </div>

                                <div class="form-group">
                                    <label for="contact_phone" class="form-label required">Nomor Telepon</label>
                                    <input type="text" 
                                           id="contact_phone" 
                                           name="contact_phone" 
                                           class="form-input {{ $errors->has('contact_phone') ? 'error' : '' }}"
                                           value="{{ old('contact_phone', $settings['contact_phone'] ?? '+62 xxx xxxx xxxx') }}"
                                           required>
                                    @error('contact_phone')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-help">Nomor telepon resmi desa</div>
                                </div>

                                <div class="form-group">
                                    <label for="contact_address" class="form-label required">Alamat</label>
                                    <textarea id="contact_address" 
                                              name="contact_address" 
                                              class="form-textarea {{ $errors->has('contact_address') ? 'error' : '' }}"
                                              rows="3"
                                              required>{{ old('contact_address', $settings['contact_address'] ?? 'Desa Papanloe, Kec. Xxx, Kab. Bantaeng') }}</textarea>
                                    @error('contact_address')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                    <div class="form-help">Alamat lengkap kantor desa</div>
                                </div>
                            </div>

                            <!-- System Settings -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    ⚙️ Pengaturan Sistem
                                </h3>
                                
                                <div class="form-group">
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <label class="form-label">Mode Maintenance</label>
                                        <label class="toggle-switch">
                                            <input type="checkbox" 
                                                   name="maintenance_mode" 
                                                   value="1" 
                                                   class="toggle-input"
                                                   {{ old('maintenance_mode', $settings['maintenance_mode'] ?? false) ? 'checked' : '' }}>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-help">Aktifkan untuk menonaktifkan sementara website untuk maintenance</div>
                                </div>
                            </div>

                            <!-- Submit Actions -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    💾 Simpan Perubahan
                                </h3>
                                
                                <div style="display: flex; gap: 12px;">
                                    <button type="submit" class="btn btn-primary">
                                        💾 Simpan Pengaturan
                                    </button>
                                    
                                    <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
                                        ❌ Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('general-settings-form');
            
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.disabled = true;
                submitBtn.innerHTML = '⏳ Menyimpan...';
                
                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }, 5000);
            });
        });

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
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }, 3000);
        }

        // Show success/error messages from Laravel
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif
        
        // Show validation errors
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


{{-- resources/views/admin/settings/users.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Pengguna - Admin Desa Papanloe</title>
    
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
        
        /* Admin Layout - Same as other pages */
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
        
        /* Standard sidebar and navigation styles */
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
        
        /* Main Content */
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
        
        /* Page Content */
        .page-content {
            flex: 1;
            padding: 24px;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            background: #f8fafc;
        }
        
        /* Users Management Specific Styles */
        .users-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        .users-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .users-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
        }
        
        .users-subtitle {
            color: #64748b;
            margin: 0;
            font-size: 16px;
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
            border: 1px solid #d1d5db;
        }
        
        .btn-secondary:hover {
            background: #f9fafb;
        }
        
        .btn-success {
            background: #10b981;
            color: white;
        }
        
        .btn-success:hover {
            background: #059669;
        }
        
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background: #dc2626;
        }
        
        /* User Cards */
        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }
        
        .user-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #f1f5f9;
        }
        
        .user-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .user-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }
        
        .user-info h4 {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .user-info p {
            font-size: 12px;
            color: #64748b;
            margin: 2px 0 0 0;
        }
        
        .user-details {
            margin-bottom: 16px;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .detail-label {
            font-size: 14px;
            color: #64748b;
        }
        
        .detail-value {
            font-size: 14px;
            color: #1e293b;
            font-weight: 500;
        }
        
        .role-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .role-super-admin {
            background: #fef3c7;
            color: #92400e;
        }
        
        .role-admin {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .role-editor {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-active {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .user-actions {
            display: flex;
            gap: 8px;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }
        
        /* Add New User Section */
        .add-user-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 16px;
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
        
        .form-input, .form-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
            background: white;
        }
        
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-input.error, .form-select.error {
            border-color: #ef4444;
        }
        
        .form-error {
            font-size: 12px;
            color: #ef4444;
            margin-top: 4px;
        }
        
        .form-help {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
        
        /* Modal styles for edit user */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        
        .modal.show {
            opacity: 1;
            pointer-events: auto;
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 24px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        
        .modal.show .modal-content {
            transform: scale(1);
        }
        
        .modal-header {
            margin-bottom: 20px;
        }
        
        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .users-grid {
                grid-template-columns: 1fr;
            }
            
            .users-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .user-actions {
                flex-direction: column;
            }
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
            max-width: 450px;
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

                    <a href="{{ route('admin.berita.index') }}" class="nav-item">
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

                    <a href="{{ route('admin.settings.index') }}" class="nav-item active">
                        <span class="nav-icon">⚙️</span>
                        <span>Pengaturan</span>
                    </a>

                    <a href="{{ route('admin.profile.show') }}" class="nav-item">
                        <span class="nav-icon">👤</span>
                        <span>Profil</span>
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
                        <a href="{{ route('admin.settings.index') }}">Pengaturan</a> / 
                        <span>Pengguna</span>
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
                    <div class="users-container">
                        <!-- Users Header -->
                        <div class="users-header">
                            <div>
                                <h1 class="users-title">👥 Manajemen Pengguna</h1>
                                <p class="users-subtitle">Kelola akun admin, editor, dan operator sistem</p>
                            </div>
                            <button onclick="toggleAddUserForm()" class="btn btn-primary">
                                ➕ Tambah Pengguna
                            </button>
                        </div>

                        <!-- Add New User Form -->
                        <div class="add-user-section" id="add-user-form" style="display: none;">
                            <h3 class="section-title">
                                ➕ Tambah Pengguna Baru
                            </h3>
                            
                            <form action="{{ route('admin.settings.users') }}" method="POST" id="create-user-form">
                                @csrf
                                
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="name" class="form-label required">Nama Lengkap</label>
                                        <input type="text" 
                                               id="name" 
                                               name="name" 
                                               class="form-input {{ $errors->has('name') ? 'error' : '' }}"
                                               value="{{ old('name') }}"
                                               placeholder="Masukkan nama lengkap"
                                               required>
                                        @error('name')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label required">Email</label>
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                                               value="{{ old('email') }}"
                                               placeholder="nama@email.com"
                                               required>
                                        @error('email')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label required">Password</label>
                                        <input type="password" 
                                               id="password" 
                                               name="password" 
                                               class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                                               placeholder="Minimal 8 karakter"
                                               required>
                                        @error('password')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label required">Konfirmasi Password</label>
                                        <input type="password" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               class="form-input"
                                               placeholder="Ulangi password"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label for="role" class="form-label required">Role</label>
                                        <select id="role" name="role" class="form-select {{ $errors->has('role') ? 'error' : '' }}" required>
                                            <option value="">Pilih Role</option>
                                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                                        </select>
                                        @error('role')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                        <div class="form-help">Super Admin: Akses penuh, Admin: Kelola konten, Editor: Edit konten</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="is_active" class="form-label">Status</label>
                                        <select id="is_active" name="is_active" class="form-select">
                                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>
                                </div>

                                <div style="display: flex; gap: 12px; margin-top: 20px;">
                                    <button type="submit" class="btn btn-success">
                                        💾 Simpan Pengguna
                                    </button>
                                    <button type="button" onclick="toggleAddUserForm()" class="btn btn-secondary">
                                        ❌ Batal
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Users Grid -->
                        <div class="users-grid">
                            @forelse($admins ?? collect([
                                (object)[
                                    'id' => 1,
                                    'name' => 'Super Admin',
                                    'email' => 'admin@papanloe.com',
                                    'role' => 'super_admin',
                                    'is_active' => true,
                                    'last_login_at' => now(),
                                    'created_at' => now()->subDays(30)
                                ],
                                (object)[
                                    'id' => 2,
                                    'name' => 'Admin Desa',
                                    'email' => 'desa@papanloe.com',
                                    'role' => 'admin',
                                    'is_active' => true,
                                    'last_login_at' => now()->subHours(2),
                                    'created_at' => now()->subDays(15)
                                ],
                                (object)[
                                    'id' => 3,
                                    'name' => 'Editor Konten',
                                    'email' => 'editor@papanloe.com',
                                    'role' => 'editor',
                                    'is_active' => false,
                                    'last_login_at' => now()->subDays(7),
                                    'created_at' => now()->subDays(5)
                                ]
                            ]) as $admin)
                                <div class="user-card">
                                    <div class="user-header">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($admin->name, 0, 2)) }}
                                        </div>
                                        <div class="user-info">
                                            <h4>{{ $admin->name }}</h4>
                                            <p>{{ $admin->email }}</p>
                                        </div>
                                    </div>

                                    <div class="user-details">
                                        <div class="detail-item">
                                            <span class="detail-label">Role:</span>
                                            <span class="detail-value">
                                                <span class="role-badge role-{{ str_replace('_', '-', $admin->role) }}">
                                                    {{ ucwords(str_replace('_', ' ', $admin->role)) }}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Status:</span>
                                            <span class="detail-value">
                                                <span class="status-badge status-{{ $admin->is_active ? 'active' : 'inactive' }}">
                                                    {{ $admin->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Login Terakhir:</span>
                                            <span class="detail-value">{{ $admin->last_login_at ? $admin->last_login_at->format('d M Y H:i') : 'Belum pernah' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Bergabung:</span>
                                            <span class="detail-value">{{ $admin->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="user-actions">
                                        <button onclick="editUser({{ $admin->id }})" class="btn btn-secondary btn-sm">
                                            ✏️ Edit
                                        </button>
                                        @if($admin->id != (Auth::guard('admin')->user()->id ?? 1))
                                            <form method="POST" action="{{ route('admin.settings.users.delete', $admin->id) }}" 
                                                  style="display: inline;" 
                                                  onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                                    <p style="color: #64748b; font-size: 16px;">Belum ada pengguna terdaftar</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal" id="edit-user-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">✏️ Edit Pengguna</h3>
            </div>
            
            <form id="edit-user-form" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="edit_name" class="form-label required">Nama Lengkap</label>
                    <input type="text" id="edit_name" name="name" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="edit_email" class="form-label required">Email</label>
                    <input type="email" id="edit_email" name="email" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="edit_password" class="form-label">Password Baru</label>
                    <input type="password" id="edit_password" name="password" class="form-input" placeholder="Kosongkan jika tidak ingin mengubah">
                    <div class="form-help">Kosongkan jika tidak ingin mengubah password</div>
                </div>

                <div class="form-group">
                    <label for="edit_password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="edit_password_confirmation" name="password_confirmation" class="form-input">
                </div>

                <div class="form-group">
                    <label for="edit_role" class="form-label required">Role</label>
                    <select id="edit_role" name="role" class="form-select" required>
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_is_active" class="form-label">Status</label>
                    <select id="edit_is_active" name="is_active" class="form-select">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="submit" class="btn btn-success">
                        💾 Update Pengguna
                    </button>
                    <button type="button" onclick="closeEditModal()" class="btn btn-secondary">
                        ❌ Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleAddUserForm() {
            const form = document.getElementById('add-user-form');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
                form.scrollIntoView({ behavior: 'smooth' });
            } else {
                form.style.display = 'none';
            }
        }

        function editUser(id) {
            // In a real application, you would fetch user data via AJAX
            // For demo, we'll use sample data
            const userData = {
                1: { name: 'Super Admin', email: 'admin@papanloe.com', role: 'super_admin', is_active: 1 },
                2: { name: 'Admin Desa', email: 'desa@papanloe.com', role: 'admin', is_active: 1 },
                3: { name: 'Editor Konten', email: 'editor@papanloe.com', role: 'editor', is_active: 0 }
            };

            const user = userData[id];
            if (user) {
                document.getElementById('edit_name').value = user.name;
                document.getElementById('edit_email').value = user.email;
                document.getElementById('edit_role').value = user.role;
                document.getElementById('edit_is_active').value = user.is_active;
                document.getElementById('edit-user-form').action = `/admin/settings/users/${id}`;
                
                document.getElementById('edit-user-modal').classList.add('show');
            }
        }

        function closeEditModal() {
            document.getElementById('edit-user-modal').classList.remove('show');
        }

        // Close modal when clicking outside
        document.getElementById('edit-user-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

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
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }, 3000);
        }

        // Show success/error messages from Laravel
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif
        
        // Show validation errors
        @if($errors->any())
            // If there are errors, show the add form
            document.getElementById('add-user-form').style.display = 'block';
            
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
</html>item {
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
        
        /* Main Content */
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
        
        /* Page Content */
        .page-content {
            flex: 1;
            padding: 24px;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            background: #f8fafc;
        }
        
        /* Settings Layout */
        .settings-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        .settings-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .settings-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
        }
        
        .settings-subtitle {
            color: #64748b;
            margin: 0;
            font-size: 16px;
        }
        
        /* Settings Grid */
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 24px;
            margin-bottom: 24px;
        }
        
        .settings-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }
        
        .settings-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }
        
        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .card-description {
            color: #64748b;
            font-size: 14px;
            margin: 8px 0 16px 0;
            line-height: 1.5;
        }
        
        .card-actions {
            display: flex;
            gap: 8px;
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
            border: 1px solid #d1d5db;
        }
        
        .btn-secondary:hover {
            background: #f9fafb;
        }
        
        /* System Info */
        .system-info {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 24px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .info-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }
        
        .info-value {
            font-size: 14px;
            color: #1e293b;
            font-weight: 600;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .settings-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .page-content {
                padding: 16px;
            }
            
            .settings-header {
                padding: 16px;
            }
            
            .settings-card {
                padding: 16px;
            }
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
            max-width: 450px;
        }
        
        .notification.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
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
                    </a>

                    <a href="{{ route('admin.agenda.index') }}" class="nav-item">
                        <span class="nav-icon">📅</span>
                        <span>Kelola Agenda</span>
                    </a>

                    <div style="margin: 16px 0; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">
                        <small style="color: #9ca3af; font-weight: 600; text-transform: uppercase; font-size: 11px; margin-left: 16px;">SISTEM</small>
                    </div>

                    <a href="{{ route('admin.settings.index') }}" class="nav-item active">
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
                        <span>Pengaturan</span>
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
                    <div class="settings-container">
                        <!-- Settings Header -->
                        <div class="settings-header">
                            <h1 class="settings-title">⚙️ Pengaturan Sistem</h1>
                            <p class="settings-subtitle">Kelola pengaturan website dan sistem admin</p>
                        </div>

                        <!-- Settings Grid -->
                        <div class="settings-grid">
                            <!-- General Settings -->
                            <div class="settings-card">
                                <div class="card-header">
                                    <div class="card-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                                        🌐
                                    </div>
                                    <div>
                                        <h3 class="card-title">Pengaturan Umum</h3>
                                    </div>
                                </div>
                                <p class="card-description">
                                    Kelola informasi dasar website seperti nama situs, deskripsi, kontak, dan pengaturan umum lainnya.
                                </p>
                                <div class="card-actions">
                                    <a href="{{ route('admin.settings.general') }}" class="btn btn-primary">
                                        Kelola Pengaturan
                                    </a>
                                </div>
                            </div>

                            <!-- User Management -->
                            <div class="settings-card">
                                <div class="card-header">
                                    <div class="card-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                                        👥
                                    </div>
                                    <div>
                                        <h3 class="card-title">Manajemen Pengguna</h3>
                                    </div>
                                </div>
                                <p class="card-description">
                                    Kelola akun admin, editor, dan operator. Atur hak akses dan role pengguna sistem.
                                </p>
                                <div class="card-actions">
                                    <a href="{{ route('admin.settings.users') }}" class="btn btn-primary">
                                        Kelola Pengguna
                                    </a>
                                </div>
                            </div>

                            <!-- System Backup -->
                            <div class="settings-card">
                                <div class="card-header">
                                    <div class="card-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                                        💾
                                    </div>
                                    <div>
                                        <h3 class="card-title">Backup & Restore</h3>
                                    </div>
                                </div>
                                <p class="card-description">
                                    Buat backup data website dan restore dari backup yang tersedia untuk menjaga keamanan data.
                                </p>
                                <div class="card-actions">
                                    <button class="btn btn-secondary" onclick="alert('Fitur akan segera hadir!')">
                                        Segera Hadir
                                    </button>
                                </div>
                            </div>

                            <!-- Security Settings -->
                            <div class="settings-card">
                                <div class="card-header">
                                    <div class="card-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                        🔐
                                    </div>
                                    <div>
                                        <h3 class="card-title">Keamanan</h3>
                                    </div>
                                </div>
                                <p class="card-description">
                                    Pengaturan keamanan sistem, two-factor authentication, dan log aktivitas pengguna.
                                </p>
                                <div class="card-actions">
                                    <button class="btn btn-secondary" onclick="alert('Fitur akan segera hadir!')">
                                        Segera Hadir
                                    </button>
                                </div>
                            </div>

                            <!-- Mail Settings -->
                            <div class="settings-card">
                                <div class="card-header">
                                    <div class="card-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                                        📧
                                    </div>
                                    <div>
                                        <h3 class="card-title">Pengaturan Email</h3>
                                    </div>
                                </div>
                                <p class="card-description">
                                    Konfigurasi SMTP server, template email, dan pengaturan notifikasi via email.
                                </p>
                                <div class="card-actions">
                                    <button class="btn btn-secondary" onclick="alert('Fitur akan segera hadir!')">
                                        Segera Hadir
                                    </button>
                                </div>
                            </div>

                            <!-- Performance -->
                            <div class="settings-card">
                                <div class="card-header">
                                    <div class="card-icon" style="background: linear-gradient(135deg, #06b6d4, #0891b2);">
                                        🚀
                                    </div>
                                    <div>
                                        <h3 class="card-title">Performa & Cache</h3>
                                    </div>
                                </div>
                                <p class="card-description">
                                    Optimasi performa website, pengaturan cache, dan monitoring sistem.
                                </p>
                                <div class="card-actions">
                                    <button class="btn btn-secondary" onclick="alert('Fitur akan segera hadir!')">
                                        Segera Hadir
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- System Information -->
                        <div class="system-info">
                            <h3 style="font-size: 18px; font-weight: 600; color: #1e293b; margin: 0 0 20px 0; display: flex; align-items: center; gap: 8px;">
                                📊 Informasi Sistem
                            </h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Versi Laravel:</span>
                                    <span class="info-value">{{ app()->version() }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Versi PHP:</span>
                                    <span class="info-value">{{ phpversion() }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Server:</span>
                                    <span class="info-value">{{ $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Environment:</span>
                                    <span class="info-value">{{ config('app.env') }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Debug Mode:</span>
                                    <span class="info-value">{{ config('app.debug') ? 'Aktif' : 'Nonaktif' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Database:</span>
                                    <span class="info-value">{{ config('database.default') }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Timezone:</span>
                                    <span class="info-value">{{ config('app.timezone') }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Cache Driver:</span>
                                    <span class="info-value">{{ config('cache.default') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
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
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }, 3000);
        }

        // Show success messages from Laravel
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif
    </script>
</body>
</html>