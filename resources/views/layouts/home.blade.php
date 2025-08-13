<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Desa Papanloe')</title>
    
    {{-- Meta Tags --}}
    <meta name="description" content="@yield('meta_description', 'Website resmi Desa Papanloe, Kecamatan Somba Opu, Kabupaten Gowa')">
    <meta name="keywords" content="@yield('meta_keywords', 'desa papanloe, somba opu, gowa, pemerintah desa')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- CSS Framework (Tailwind CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                        }
                    },
                    animation: {
                        'fade-in-down': 'fadeInDown 0.5s ease-out',
                        'pulse-glow': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Main App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    
    <!-- Vite Assets (Fallback) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    {{-- Page-specific Styles Stack --}}
    @stack('styles')
    
    {{-- Default Styles --}}
    <style>
        /* Default scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        
        /* Basic animations */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }
        
        .fade-up.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Loading spinner */
        .loading-spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -100%, 0);
            }
            to {
                opacity: 1;
                transform: none;
            }
        }
        
        /* Scroll animate classes */
        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }
        
        .scroll-animate.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Custom button styles */
        .btn-primary {
            background: linear-gradient(to right, #9333ea, #ec4899);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            transform: scale(1);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, #7c3aed, #db2777);
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Notification styles */
        .notification {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            color: white;
            font-weight: 500;
            z-index: 9999;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification.success { background-color: #10b981; }
        .notification.error { background-color: #ef4444; }
        .notification.warning { background-color: #f59e0b; }
        .notification.info { background-color: #3b82f6; }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    {{-- Navigation --}}
    @include('layouts.navbar')

    {{-- Main Content --}}
    <div class="min-h-screen">
        @yield('content')
    </div>
    
    {{-- Footer --}}
    @include('layouts.footer')
    
    <!-- Main App JavaScript -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js'])
    @else
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
    <!-- WhatsApp Integration -->
    <script src="{{ asset('js/whatsapp.js') }}?v={{ time() }}"></script>
    @include('partials.whatsapp-integration')
    
    {{-- Page-specific Scripts Stack --}}
    @stack('scripts')
    
    {{-- Default JavaScript --}}
    <script>
        // Basic scroll animation
        document.addEventListener('DOMContentLoaded', function() {
            
            // Initialize scroll animations
            initScrollAnimations();
            
            // Initialize global features
            initGlobalFeatures();
            
        });
        
        function initScrollAnimations() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe all elements with scroll-animate class
            document.querySelectorAll('.scroll-animate, .fade-up').forEach(el => {
                observer.observe(el);
            });
        }
        
        function initGlobalFeatures() {
            // Global notification function
            window.showNotification = function(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `notification ${type}`;
                notification.textContent = message;
                
                document.body.appendChild(notification);
                
                // Show notification
                setTimeout(() => notification.classList.add('show'), 100);
                
                // Hide notification after 3 seconds
                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            };
            
            // Form handling improvements
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn && !submitBtn.disabled) {
                        // Store original text
                        if (!submitBtn.hasAttribute('data-original-text')) {
                            submitBtn.setAttribute('data-original-text', submitBtn.innerHTML);
                        }
                        
                        // Disable and show loading
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<div class="loading-spinner w-4 h-4 border-2 border-white border-t-transparent rounded-full inline-block mr-2"></div>Loading...';
                        
                        // Re-enable after 5 seconds as fallback
                        setTimeout(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = submitBtn.getAttribute('data-original-text');
                        }, 5000);
                    }
                });
            });
            
            // Handle CSRF token for AJAX requests
            const token = document.querySelector('meta[name="csrf-token"]');
            if (token) {
                window.Laravel = {
                    csrfToken: token.getAttribute('content')
                };
                
                // Set default AJAX headers if jQuery is available
                if (typeof $ !== 'undefined') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token.getAttribute('content')
                        }
                    });
                }
            }
        }
        
        // Global error handler
        window.addEventListener('error', function(e) {
            console.error('🚨 JavaScript Error:', e.error);
        });
        
        // Quick theme initialization to prevent flash
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</body>
</html>