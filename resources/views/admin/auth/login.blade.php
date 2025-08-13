<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - Desa Papanloe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'fade-in': 'fadeIn 0.6s ease-out'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(99, 102, 241, 0.4)' },
                            '100%': { boxShadow: '0 0 30px rgba(99, 102, 241, 0.8)' }
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(30px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .glass-morphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, 
                #667eea 0%, 
                #764ba2 25%, 
                #f093fb 50%, 
                #f5576c 75%, 
                #4facfe 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.2));
            backdrop-filter: blur(10px);
            animation: float 8s ease-in-out infinite;
        }
        
        .floating-orb:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .floating-orb:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 10%;
            animation-delay: -3s;
        }
        
        .floating-orb:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: -6s;
        }
        
        .floating-orb:nth-child(4) {
            width: 120px;
            height: 120px;
            top: 30%;
            right: 30%;
            animation-delay: -1.5s;
        }
        
        .input-wrapper {
            position: relative;
            overflow: hidden;
        }
        
        .input-field {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .input-field:focus {
            background: rgba(255, 255, 255, 1);
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1), 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .input-field:focus + .input-label {
            color: #6366f1;
            transform: translateY(-32px) scale(0.85);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .input-label {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: transparent;
            padding: 0 6px;
            font-size: 16px;
            z-index: 10;
        }
        
        .input-field:focus + .input-label,
        .input-field:not(:placeholder-shown) + .input-label {
            transform: translateY(-32px) scale(0.85);
            color: #6366f1;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 4px;
        }
        
        .input-field:not(:placeholder-shown) + .input-label {
            color: #6b7280;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
            background-size: 200% 200%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-gradient:hover {
            background-position: right center;
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
        }
        
        .btn-gradient:active {
            transform: translateY(0);
        }
        
        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-gradient:hover::before {
            left: 100%;
        }
        
        .checkbox-custom {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            background: white;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .checkbox-custom:checked {
            background: #6366f1;
            border-color: #6366f1;
        }
        
        .checkbox-custom:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }
        
        .alert {
            animation: slide-up 0.5s ease-out;
        }
        
        .card-shadow {
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.1), 
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Floating Background Orbs -->
    <div class="floating-orb"></div>
    <div class="floating-orb"></div>
    <div class="floating-orb"></div>
    <div class="floating-orb"></div>

    <!-- Main Login Container -->
    <div class="w-full max-w-md relative z-10">
        <!-- Login Card -->
        <div class="glass-morphism rounded-3xl p-8 card-shadow animate-fade-in">
            <!-- Header -->
            <div class="text-center mb-8">
                <!-- Logo -->
                <div class="w-20 h-20 mx-auto mb-6 rounded-2xl flex items-center justify-center relative">
                    <img src="{{ asset('/img/5 bantaeng png.png') }}" alt="Logo Pemkab Bantaeng" class="w-full h-full object-contain">
                </div>
                
                <!-- Title -->
                <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">
                    Admin Portal
                </h1>
                <p class="text-white/80 text-lg font-medium">
                    Desa Papanloe
                </p>
                <div class="w-16 h-1 bg-gradient-to-r from-white/40 to-white/80 rounded-full mx-auto mt-4"></div>
            </div>

            <!-- Alert Messages -->
            <div id="alert-container" class="mb-6">
                <!-- Success Alert -->
                @if(session('success'))
                <div class="alert bg-green-500/10 border border-green-500/20 rounded-xl p-4 mb-4">
                    <div class="flex items-center text-green-100">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                <!-- Error Alert -->
                @if($errors->any())
                <div class="alert bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-4">
                    <div class="flex items-start text-red-100">
                        <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                <!-- Email Field -->
                <div class="input-wrapper">
                    <input 
                        type="email" 
                        id="email"
                        name="email"
                        class="input-field w-full px-4 py-4 pr-12 rounded-xl text-gray-700 placeholder-transparent focus:outline-none {{ $errors->has('email') ? 'border-red-500' : '' }}"
                        placeholder=" "
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                    >
                    <label for="email" class="input-label">Email Admin</label>
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 z-20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="input-wrapper">
                    <input 
                        type="password" 
                        id="password"
                        name="password"
                        class="input-field w-full px-4 py-4 pr-12 rounded-xl text-gray-700 placeholder-transparent focus:outline-none {{ $errors->has('password') ? 'border-red-500' : '' }}"
                        placeholder=" "
                        required
                        autocomplete="current-password"
                    >
                    <label for="password" class="input-label">Password</label>
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20">
                        <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eyeIcon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="checkbox-custom">
                        <span class="ml-3 text-white/90 text-sm font-medium">Ingat saya</span>
                    </label>
                    <a href="{{ route('admin.forgot-password') }}" class="text-white/90 hover:text-white text-sm font-medium transition-colors duration-200 hover:underline">
                        Lupa password?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-gradient w-full py-4 px-6 rounded-xl text-white font-semibold text-lg relative overflow-hidden group">
                    <span class="relative z-10 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span id="buttonText">Masuk ke Dashboard</span>
                    </span>
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-white/60 text-sm mb-3">
                    © 2025 Desa Papanloe. Sistem Admin Dashboard.
                </p>
                <a href="{{ route('home') }}" class="text-white/80 hover:text-white text-sm font-medium transition-colors duration-200 hover:underline inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Website Utama
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464m1.414 1.414L8.464 8.464m5.656 5.656l1.414 1.414m-1.414-1.414l1.414 1.414M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                `;
            } else {
                passwordField.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        });

        // Form submission with loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = document.querySelector('.btn-gradient');
            const buttonText = document.getElementById('buttonText');
            
            // Show loading state
            button.disabled = true;
            buttonText.innerHTML = `
                <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;
        });

        // Input animations and label handling
        document.querySelectorAll('.input-field').forEach(input => {
            // Check if input has value on page load
            if (input.value && input.value.trim() !== '') {
                input.parentElement.classList.add('focused');
            }
            
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value || this.value.trim() === '') {
                    this.parentElement.classList.remove('focused');
                }
            });
            
            // Handle input changes
            input.addEventListener('input', function() {
                if (this.value && this.value.trim() !== '') {
                    this.parentElement.classList.add('focused');
                } else {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        // Auto-hide alerts after 10 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 500);
            });
        }, 10000);
    </script>
</body>
</html>