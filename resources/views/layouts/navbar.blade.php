<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Navbar</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in-down': 'fadeInDown 0.5s ease-out',
                        'slide-in-left': 'slideInLeft 0.3s ease-out',
                        'slide-out-left': 'slideOutLeft 0.3s ease-in',
                    },
                    keyframes: {
                        fadeInDown: {
                            '0%': { opacity: '0', transform: 'translateY(-20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideInLeft: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' }
                        },
                        slideOutLeft: {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(-100%)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Mobile menu styles */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
        
        /* Smooth transitions */
        .nav-link {
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #2563eb, #0ea5e9);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Active nav link */
        .nav-link.active {
            color: #2563eb;
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        /* Mobile menu animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        .fade-out {
            animation: fadeOut 0.3s ease-in;
        }
        
        /* Mobile menu item hover effect */
        .mobile-menu-item {
            position: relative;
            transition: all 0.2s ease;
        }
        
        .mobile-menu-item:hover {
            background: linear-gradient(to right, #eff6ff, #dbeafe);
            transform: translateX(4px);
        }
        
        /* Button hover effects */
        .lapor-btn {
            position: relative;
            overflow: hidden;
        }
        
        .lapor-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: all 0.4s ease;
            transform: translate(-50%, -50%);
        }
        
        .lapor-btn:hover::before {
            width: 300px;
            height: 300px;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 px-4 py-4 animate-fade-in-down">
        <div class="max-w-7xl mx-auto">
            <div id="navbar-container" class="bg-white/90 backdrop-blur-md shadow-lg rounded-2xl border border-gray-100">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        
                        <!-- Logo/Brand -->
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10">
                                <img src="{{ asset('/img/5 bantaeng png.png') }}" alt="Logo Pemkab Bantaeng" class="w-full h-full object-contain">
                            </div>
                            <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-sky-600 bg-clip-text text-transparent">
                                Desa Papanloe
                            </span>
                        </div>

                        <!-- Desktop Menu -->
                        <div class="hidden lg:flex items-center space-x-8">
                            <a href="/" class="nav-link text-gray-700 hover:text-blue-600 font-medium px-3 py-2 transition-colors duration-200">
                                Beranda
                            </a>
                            <a href="/galeri" class="nav-link text-gray-700 hover:text-blue-600 font-medium px-3 py-2 transition-colors duration-200">
                                Galeri Potensi Desa
                            </a>
                            <a href="/peta" class="nav-link text-gray-700 hover:text-blue-600 font-medium px-3 py-2 transition-colors duration-200">
                                Peta Digital
                            </a>
                            
                            <!-- Lapor PakDe Button -->
                            <button class="lapor-btn relative group bg-gradient-to-r from-blue-700 to-sky-500 text-white font-semibold px-6 py-2.5 rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200 overflow-hidden">
                                <span class="relative z-10 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    <span>Lapor PakDe</span>
                                </span>
                            </button>
                        </div>

                        <!-- Mobile Menu Button -->
                        <div class="lg:hidden">
                            <button id="mobile-menu-btn" class="p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition-colors duration-200">
                                <svg id="menu-icon" class="w-6 h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden opacity-0 pointer-events-none transition-opacity duration-300"></div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 h-full w-80 bg-white z-50 lg:hidden shadow-2xl">
        <div class="p-6 h-full flex flex-col">
            <!-- Mobile Header -->
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10">
                        <img src="{{ asset('/img/5 bantaeng png.png') }}" alt="Logo Pemkab Bantaeng" class="w-full h-full object-contain">
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-blue-900 to-sky-500 bg-clip-text text-transparent">
                        Desa Papanloe
                    </span>
                </div>
                <button id="close-menu" class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu Items -->
            <div class="flex-1 space-y-2">
                <a href="/" class="mobile-menu-item flex items-center text-gray-700 hover:text-blue-600 font-medium py-4 px-4 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3M5 10V9a1 1 0 011-1h3m0 1v11m0-11h3m0 0a1 1 0 011-1h3v14a1 1 0 01-1 1h-3m-6-1v1"></path>
                    </svg>
                    Beranda
                </a>
                
                <a href="/galeri" class="mobile-menu-item flex items-center text-gray-700 hover:text-blue-600 font-medium py-4 px-4 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Galeri Potensi Desa
                </a>
                
                <a href="/peta" class="mobile-menu-item flex items-center text-gray-700 hover:text-blue-600 font-medium py-4 px-4 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                    Peta Digital
                </a>
            </div>
            
            <!-- Mobile Lapor PakDe Button -->
            <div class="pt-6 border-t border-gray-200">
                <button class="lapor-btn w-full bg-gradient-to-r from-blue-900 to-sky-500 text-white font-semibold px-6 py-4 rounded-xl hover:shadow-lg transition-all duration-200 relative overflow-hidden">
                    <span class="relative z-10 flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <span>Lapor PakDe</span>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const closeMenuBtn = document.getElementById('close-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        
        // State management
        let isMenuOpen = false;
        
        // Toggle mobile menu
        function toggleMobileMenu() {
            isMenuOpen = !isMenuOpen;
            
            if (isMenuOpen) {
                openMobileMenu();
            } else {
                closeMobileMenu();
            }
        }
        
        // Open mobile menu
        function openMobileMenu() {
            isMenuOpen = true;
            
            // Show overlay
            mobileOverlay.style.pointerEvents = 'auto';
            mobileOverlay.classList.remove('opacity-0');
            mobileOverlay.classList.add('opacity-100');
            
            // Show menu
            mobileMenu.classList.add('active');
            
            // Toggle icons
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            
            // Add animation class
            mobileMenu.classList.add('fade-in');
            setTimeout(() => {
                mobileMenu.classList.remove('fade-in');
            }, 300);
        }
        
        // Close mobile menu
        function closeMobileMenu() {
            isMenuOpen = false;
            
            // Hide overlay
            mobileOverlay.style.pointerEvents = 'none';
            mobileOverlay.classList.remove('opacity-100');
            mobileOverlay.classList.add('opacity-0');
            
            // Hide menu
            mobileMenu.classList.remove('active');
            
            // Toggle icons
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            
            // Restore body scroll
            document.body.style.overflow = 'auto';
            
            // Add animation class
            mobileMenu.classList.add('fade-out');
            setTimeout(() => {
                mobileMenu.classList.remove('fade-out');
            }, 300);
        }
        
        // Event listeners
        mobileMenuBtn.addEventListener('click', toggleMobileMenu);
        closeMenuBtn.addEventListener('click', closeMobileMenu);
        mobileOverlay.addEventListener('click', closeMobileMenu);
        
        // Close menu when clicking on menu links
        const mobileMenuLinks = document.querySelectorAll('.mobile-menu-item');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                setTimeout(closeMobileMenu, 100); // Small delay for better UX
            });
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isMenuOpen) {
                closeMobileMenu();
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024 && isMenuOpen) {
                closeMobileMenu();
            }
        });
        
        // Active nav link highlighting
        function setActiveNavLink() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            const mobileLinks = document.querySelectorAll('.mobile-menu-item');
            
            // Desktop nav links
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href === currentPath || (currentPath === '/' && href === '/')) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
            
            // Mobile nav links
            mobileLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href === currentPath || (currentPath === '/' && href === '/')) {
                    link.classList.add('text-blue-600');
                    link.classList.remove('text-gray-700');
                } else {
                    link.classList.add('text-gray-700');
                    link.classList.remove('text-blue-600');
                }
            });
        }
        
        // Initialize active nav link on page load
        document.addEventListener('DOMContentLoaded', setActiveNavLink);
        
        // Smooth navbar background on scroll
        let lastScrollY = window.scrollY;
        window.addEventListener('scroll', () => {
            const navbarContainer = document.getElementById('navbar-container');
            
            if (window.scrollY > 50) {
                navbarContainer.classList.remove('bg-white/90');
                navbarContainer.classList.add('bg-white/95');
            } else {
                navbarContainer.classList.remove('bg-white/95');
                navbarContainer.classList.add('bg-white/90');
            }
            
            lastScrollY = window.scrollY;
        });
        
        console.log('Navbar initialized successfully!');
    </script>
</body>
</html>