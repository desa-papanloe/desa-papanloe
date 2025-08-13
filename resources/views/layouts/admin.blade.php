{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin') - Desa Papanloe</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900" rel="stylesheet" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('/img/5 bantaeng png.png') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        inter: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    {{-- Page-specific Styles Stack --}}
    @stack('styles')
    
    <!-- Custom Admin Base Styles -->
    <style>
        /* Font Family */
        * {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }

        /* Admin Body Background */
        .admin-body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%);
            min-height: 100vh;
        }

        .admin-body.dark {
            background: linear-gradient(135deg, rgb(15, 23, 42) 0%, rgb(30, 41, 59) 50%, rgb(51, 65, 85) 100%);
        }

        /* Admin Card */
        .admin-card {
            @apply bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-200/50 dark:border-slate-700/50 p-6 transition-all duration-300 hover:shadow-2xl;
        }

        /* Button Styles */
        .btn-primary {
            @apply bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-medium py-2.5 px-4 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105;
        }

        .btn-secondary {
            @apply bg-white hover:bg-gray-50 text-gray-700 font-medium py-2.5 px-4 rounded-xl border border-gray-300 transition-all duration-200 shadow-sm hover:shadow;
        }

        .btn-danger {
            @apply bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium py-2.5 px-4 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105;
        }

        /* Alert Styles */
        .alert {
            @apply flex items-center p-4 rounded-xl transition-all duration-300 border;
        }

        .alert svg {
            @apply flex-shrink-0 mr-3 w-5 h-5;
        }

        .alert-success {
            @apply bg-emerald-50 dark:bg-emerald-900/20 text-emerald-800 dark:text-emerald-200 border-emerald-200 dark:border-emerald-700;
        }

        .alert-error {
            @apply bg-red-50 dark:bg-red-900/20 text-red-800 dark:text-red-200 border-red-200 dark:border-red-700;
        }

        .alert-warning {
            @apply bg-amber-50 dark:bg-amber-900/20 text-amber-800 dark:text-amber-200 border-amber-200 dark:border-amber-700;
        }

        .alert-info {
            @apply bg-blue-50 dark:bg-blue-900/20 text-blue-800 dark:text-blue-200 border-blue-200 dark:border-blue-700;
        }

        /* Form Styles */
        .form-input, .form-textarea, .form-select {
            @apply block w-full px-4 py-3 border border-gray-300 dark:border-slate-600 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-slate-700 dark:text-white transition-all duration-200;
        }

        .form-label {
            @apply block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2;
        }

        /* Notification Styles */
        .notification {
            @apply fixed top-4 right-4 px-6 py-4 rounded-xl text-white font-medium z-50 transform transition-all duration-300 shadow-2xl;
            transform: translateX(100%);
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success { @apply bg-gradient-to-r from-emerald-500 to-emerald-600; }
        .notification.error { @apply bg-gradient-to-r from-red-500 to-red-600; }
        .notification.warning { @apply bg-gradient-to-r from-amber-500 to-amber-600; }
        .notification.info { @apply bg-gradient-to-r from-blue-500 to-blue-600; }
    </style>
</head>

<body class="admin-body font-inter">
    <!-- Include Navbar Admin -->
    @include('layouts.navbaradmin')

    {{-- Main Content --}}
    <div class="lg:ml-64 min-h-screen">
        <!-- Page Content -->
        <main class="p-6">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success mb-6">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-emerald-600 hover:text-emerald-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error mb-6">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-red-600 hover:text-red-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning mb-6">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ session('warning') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-amber-600 hover:text-amber-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error mb-6">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-sm">• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-red-600 hover:text-red-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Page Content Yield -->
            @yield('content')
        </main>
    </div>

    {{-- Page-specific Scripts Stack --}}
    @stack('scripts')

    <!-- Global Admin Scripts -->
    <script>
        // Global notification function
        window.showNotification = function(message, type = 'info', duration = 5000) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            const iconMap = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-circle',
                warning: 'fas fa-exclamation-triangle',
                info: 'fas fa-info-circle'
            };
            
            notification.innerHTML = `
                <i class="${iconMap[type]} mr-3"></i>
                <span class="flex-1">${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-3 opacity-70 hover:opacity-100">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            document.body.appendChild(notification);
            
            // Show notification
            setTimeout(() => notification.classList.add('show'), 100);
            
            // Auto hide
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, duration);
        };

        // Global loading function
        window.showLoading = function(message = 'Loading...') {
            const loading = document.createElement('div');
            loading.id = 'global-loading';
            loading.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center';
            loading.innerHTML = `
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 flex items-center space-x-4 shadow-2xl">
                    <div class="animate-spin w-6 h-6 border-2 border-primary-600 border-t-transparent rounded-full"></div>
                    <span class="text-gray-900 dark:text-white font-medium">${message}</span>
                </div>
            `;
            
            document.body.appendChild(loading);
        };

        window.hideLoading = function() {
            const loading = document.getElementById('global-loading');
            if (loading) {
                loading.remove();
            }
        };

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 300);
            });
        }, 5000);

        // Global error handler
        window.addEventListener('error', function(e) {
            console.error('🚨 JavaScript Error:', e.error);
        });

        // Quick theme initialization to prevent flash
        (function() {
            const savedTheme = localStorage.getItem('admin-theme') || 'light';
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();

        console.log('✅ Admin layout initialized');
    </script>
</body>
</html>