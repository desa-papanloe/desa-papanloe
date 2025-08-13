import './bootstrap';

// =============================================================================
// THEME MANAGEMENT
// =============================================================================
const html = document.documentElement;
const currentTheme = localStorage.getItem('theme') || 'light';

function applyDarkTheme() {
    html.classList.add('dark');
    document.body.classList.add('dark-theme');
    document.body.classList.remove('light-theme');
    
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach(card => {
        card.style.backgroundColor = 'rgb(30, 41, 59)';
    });
    
    const elements = ['desktop-theme-toggle', 'mobile-theme-toggle', 'navbar-container', 'mobile-menu'];
    elements.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            if (id.includes('toggle')) element.classList.add('dark');
            else if (id === 'navbar-container') element.classList.add('navbar-dark');
            else if (id === 'mobile-menu') element.classList.add('mobile-menu-dark');
        }
    });
}

function applyLightTheme() {
    html.classList.remove('dark');
    document.body.classList.remove('dark-theme');
    document.body.classList.add('light-theme');
    
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach(card => {
        card.style.backgroundColor = '#ffffff';
    });
    
    const elements = ['desktop-theme-toggle', 'mobile-theme-toggle', 'navbar-container', 'mobile-menu'];
    elements.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            if (id.includes('toggle')) element.classList.remove('dark');
            else if (id === 'navbar-container') element.classList.remove('navbar-dark');
            else if (id === 'mobile-menu') element.classList.remove('mobile-menu-dark');
        }
    });
}

function toggleTheme() {
    if (html.classList.contains('dark')) {
        applyLightTheme();
        localStorage.setItem('theme', 'light');
    } else {
        applyDarkTheme();
        localStorage.setItem('theme', 'dark');
    }
}


document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = target / speed;

        if (count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(() => animateCounter(counter), 1);
        } else {
            counter.innerText = target;
        }
    };

    // Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('counter')) {
                    animateCounter(entry.target);
                }
                if (entry.target.classList.contains('progress-bar')) {
                    const width = entry.target.getAttribute('data-width');
                    entry.target.style.transition = 'width 2s ease-in-out';
                    entry.target.style.width = width;
                }
            }
        });
    }, { threshold: 0.5 });

    // Observe all counters and progress bars
    counters.forEach(counter => observer.observe(counter));
    progressBars.forEach(bar => observer.observe(bar));
});

// =============================================================================
// ANIMATIONS
// =============================================================================
function animateNavbar() {
    const navbar = document.querySelector('nav') || 
                   document.querySelector('[role="navigation"]') || 
                   document.getElementById('navbar-container');
    if (navbar) {
        navbar.classList.add('navbar-animate');
    }
}

function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -50px 0px'
    };

    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                requestAnimationFrame(() => {
                    entry.target.classList.add('animate-in');
                });
                scrollObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const animatedElements = document.querySelectorAll('.scroll-animate');
    animatedElements.forEach(element => {
        scrollObserver.observe(element);
    });
}

// =============================================================================
// HERO SECTION (LAYANAN PAGE)
// =============================================================================
function initHeroSection() {
    const heroContent = document.querySelector('.hero-content');
    
    if (heroContent) {
        setTimeout(() => {
            heroContent.classList.add('animate-in');
        }, 300);
    }
    
    setupHeroButtons();
    setupFloatingElements();
}

function setupHeroButtons() {
    const buttons = [
        { id: 'btn-mulai-mengajukan', action: 'mulai-mengajukan', target: '#services' },
        { id: 'btn-panduan-layanan', action: 'panduan-layanan', target: '#info' }
    ];
    
    buttons.forEach(({ id, action, target }) => {
        const button = document.getElementById(id);
        if (button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                handleButtonClick(this, action, target);
            });
        }
    });
}

function handleButtonClick(button, action, target) {
    const originalContent = button.innerHTML;
    
    button.classList.add('btn-loading');
    button.innerHTML = `
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Memuat...
    `;
    
    setTimeout(() => {
        const messages = {
            'mulai-mengajukan': '📝 Mengarahkan ke layanan pengajuan...',
            'panduan-layanan': '📖 Membuka panduan layanan...'
        };
        
        // Removed toast notification
        
        const targetElement = document.querySelector(target);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
        
        button.classList.remove('btn-loading');
        button.innerHTML = originalContent;
    }, 1500);
}

function setupFloatingElements() {
    const floatingElements = document.querySelectorAll('.floating-element');
    
    floatingElements.forEach(element => {
        const randomDelay = Math.random() * 2;
        const randomDuration = 4 + Math.random() * 4;
        
        element.style.animationDelay = `${randomDelay}s`;
        element.style.animationDuration = `${randomDuration}s`;
        
        element.addEventListener('mouseenter', function() {
            this.style.animationPlayState = 'paused';
            this.style.transform += ' scale(1.2)';
            this.style.opacity = '0.4';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.animationPlayState = 'running';
            this.style.opacity = '0.2';
        });
    });
}

// =============================================================================
// MOBILE MENU
// =============================================================================
function initMobileMenu() {
    const elements = {
        btn: document.getElementById('mobile-menu-btn'),
        menu: document.getElementById('mobile-menu'),
        overlay: document.getElementById('mobile-overlay'),
        close: document.getElementById('close-menu')
    };
    
    if (!elements.btn || !elements.menu || !elements.overlay || !elements.close) return;
    
    function openMenu() {
        elements.menu.classList.add('active');
        elements.overlay.classList.remove('opacity-0', 'pointer-events-none');
        elements.overlay.classList.add('opacity-100');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMenu() {
        elements.menu.classList.remove('active');
        elements.overlay.classList.add('opacity-0', 'pointer-events-none');
        elements.overlay.classList.remove('opacity-100');
        document.body.style.overflow = '';
    }
    
    elements.btn.addEventListener('click', openMenu);
    elements.close.addEventListener('click', closeMenu);
    elements.overlay.addEventListener('click', closeMenu);
    
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });
}

// =============================================================================
// AGENDA FEATURES (BERANDA PAGE)
// =============================================================================
function initAgendaFeatures() {
    // Only initialize if agenda elements exist
    if (!document.querySelector('.agenda-filter-btn')) return;
    
    initAgendaFilter();
}

function initAgendaFilter() {
    const filterButtons = document.querySelectorAll('.agenda-filter-btn');
    const agendaItems = document.querySelectorAll('.agenda-item');
    
    if (!filterButtons.length || !agendaItems.length) return;
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-gradient-to-r', 'from-indigo-600', 'to-purple-500', 'text-white', 'shadow-lg');
                btn.classList.add('text-gray-600', 'dark:text-gray-300', 'hover:bg-gray-100', 'dark:hover:bg-slate-700');
            });
            
            this.classList.add('active', 'bg-gradient-to-r', 'from-indigo-600', 'to-purple-500', 'text-white', 'shadow-lg');
            this.classList.remove('text-gray-600', 'dark:text-gray-300', 'hover:bg-gray-100', 'dark:hover:bg-slate-700');
            
            // Filter items with animation
            let visibleCount = 0;
            agendaItems.forEach((item, index) => {
                setTimeout(() => {
                    const itemCategory = item.getAttribute('data-category');
                    const shouldShow = filter === 'all' || itemCategory === filter;
                    
                    if (shouldShow) {
                        item.style.display = 'block';
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px) scale(0.95)';
                        
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0) scale(1)';
                            item.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                        }, 100);
                        visibleCount++;
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(-20px) scale(0.95)';
                        item.style.transition = 'all 0.3s ease-out';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                }, index * 50);
            });
            
            setTimeout(() => {
                const filterText = {
                    'all': 'Semua Agenda',
                    'rapat': 'Rapat',
                    'kegiatan': 'Kegiatan',
                    'pelatihan': 'Pelatihan',
                    'gotong-royong': 'Gotong Royong'
                }[filter] || filter;
                
            // Removed toast notification
            }, 500);
        });
    });
}

// =============================================================================
// UTILITY FUNCTIONS
// =============================================================================
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

function initBackToTop() {
    const backToTopButton = document.getElementById('back-to-top');
    
    if (backToTopButton) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}

function initFooterAnimations() {
    const footer = document.querySelector('footer');
    if (!footer) return;
    
    const footerObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                footer.style.animationDelay = '0.2s';
                footer.classList.add('animate-fade-in-up');
            }
        });
    }, { threshold: 0.1 });

    footerObserver.observe(footer);
}

function initClipboardFeatures() {
    const contactElements = document.querySelectorAll('footer p');
    
    contactElements.forEach(element => {
        if (element.textContent.includes('desapapanloe@bantaengkab.go.id')) {
            element.style.cursor = 'pointer';
            element.title = 'Klik untuk menyalin email';
            element.addEventListener('click', function() {
                if (navigator.clipboard) {
                    navigator.clipboard.writeText('desapapanloe@bantaengkab.go.id').then(() => {
                        // Email copied successfully
                    }).catch(() => {
                        // Failed to copy email
                    });
                }
            });
        }
        
        if (element.textContent.includes('+62')) {
            element.style.cursor = 'pointer';
            element.title = 'Klik untuk menyalin nomor telepon';
            element.addEventListener('click', function() {
                if (navigator.clipboard) {
                    navigator.clipboard.writeText('+62 813-4567-8901').then(() => {
                        // Phone number copied successfully
                    }).catch(() => {
                        // Failed to copy phone number
                    });
                }
            });
        }
    });
}

function initResponsiveMenu() {
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileOverlay = document.getElementById('mobile-overlay');
            
            if (mobileMenu) mobileMenu.classList.remove('active');
            if (mobileOverlay) {
                mobileOverlay.classList.add('opacity-0', 'pointer-events-none');
                mobileOverlay.classList.remove('opacity-100');
            }
            document.body.style.overflow = '';
        }
    });
}

// =============================================================================
// INITIALIZATION
// =============================================================================
function initializeApp() {
    // Apply saved theme
    if (currentTheme === 'dark') {
        applyDarkTheme();
    } else {
        applyLightTheme();
    }
    
    // Setup theme toggles
    const desktopToggle = document.getElementById('desktop-theme-toggle');
    const mobileToggle = document.getElementById('mobile-theme-toggle');
    
    if (desktopToggle) desktopToggle.addEventListener('click', toggleTheme);
    if (mobileToggle) mobileToggle.addEventListener('click', toggleTheme);
    
    // Initialize core features
    setTimeout(animateNavbar, 100);
    setTimeout(initScrollAnimations, 200);
    setTimeout(initHeroSection, 300);
    setTimeout(initAgendaFeatures, 400);
    
    // Initialize other features
    initMobileMenu();
    initSmoothScroll();
    initBackToTop();
    initFooterAnimations();
    initClipboardFeatures();
    initResponsiveMenu();
}

// Start the application
document.addEventListener('DOMContentLoaded', initializeApp);
window.addEventListener('load', initializeApp);

// =============================================================================
// PROFIL DESA - JAVASCRIPT FUNCTIONALITY
// =============================================================================

// =============================================================================
// TIMELINE ANIMATIONS (SEJARAH PAGE)
// =============================================================================
function initTimelineAnimations() {
    // Only run on sejarah page
    if (!document.querySelector('.timeline-container')) return;
    
    const timelineItems = document.querySelectorAll('.timeline-item');
    const timelineIcons = document.querySelectorAll('.timeline-icon');
    
    // Intersection Observer untuk timeline items
    const timelineObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    
                    // Animate icon
                    const icon = entry.target.querySelector('.timeline-icon');
                    if (icon) {
                        icon.style.transform = 'scale(1)';
                        icon.classList.add('animate-pulse');
                    }
                }, index * 200);
                
                timelineObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // Set initial state dan observe
    timelineItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(50px)';
        item.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        timelineObserver.observe(item);
    });
    
    // Timeline icons hover effects
    timelineIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.2)';
            this.style.boxShadow = '0 0 30px rgba(59, 130, 246, 0.6)';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = '0 0 20px rgba(59, 130, 246, 0.3)';
        });
    });
}

// =============================================================================
// VISI MISI ANIMATIONS
// =============================================================================
function initVisiMisiAnimations() {
    // Only run on visi-misi page
    if (!document.querySelector('.visi-card')) return;
    
    // Animated counters untuk target
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current) + '%';
        }, 16);
    }
    
    // Observer untuk target indicators
    const targetObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const numberElement = entry.target.querySelector('.achievement-number');
                if (numberElement) {
                    const targetValue = parseInt(numberElement.textContent);
                    if (!isNaN(targetValue)) {
                        animateCounter(numberElement, targetValue);
                    }
                }
                targetObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    // Observe target indicators
    document.querySelectorAll('.target-indicator').forEach(indicator => {
        targetObserver.observe(indicator);
    });
    
    // Misi cards stagger animation
    const misiCards = document.querySelectorAll('.misi-card');
    const misiObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                misiObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    
    misiCards.forEach(card => {
        misiObserver.observe(card);
    });
    
    // Nilai-nilai desa interaction
    const nilaiCards = document.querySelectorAll('.nilai-card');
    nilaiCards.forEach(card => {
        card.addEventListener('click', function() {
            // Add click effect
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            // Optional: Show more info atau navigate
            const title = this.querySelector('h3').textContent;
        });
    });
}

// =============================================================================
// STRUKTUR ORGANISASI INTERACTIONS
// =============================================================================
function initStrukturOrganisasi() {
    // Only run on struktur-organisasi page
    if (!document.querySelector('.perangkat-card')) return;
    
    // Perangkat cards click handlers
    const perangkatCards = document.querySelectorAll('.perangkat-card');
    perangkatCards.forEach(card => {
        card.addEventListener('click', function() {
            const name = this.querySelector('h3').textContent;
            const position = this.querySelector('p').textContent;
            const email = this.querySelector('.contact-info-item span').textContent;
            
            // Create modal atau detail view
            showPerangkatDetail(name, position, email);
        });
        
        // Add keyboard navigation
        card.setAttribute('tabindex', '0');
        card.setAttribute('role', 'button');
        card.setAttribute('aria-label', `Lihat detail ${card.querySelector('h3').textContent}`);
        
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
    
    // RT/RW cards interactions
    const rtCards = document.querySelectorAll('.rt-card');
    rtCards.forEach(card => {
        card.addEventListener('click', function() {
            const rtNumber = this.querySelector('h4').textContent;
            const rtLeader = this.querySelector('p').textContent;
            
            showRTDetail(rtNumber, rtLeader);
        });
        
        // Hover effects untuk RT cards
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
    
    // Contact info click to copy
    const contactItems = document.querySelectorAll('.contact-info-item');
    contactItems.forEach(item => {
        item.addEventListener('click', function() {
            const text = this.querySelector('span').textContent;
            
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    showCopyNotification(text);
                }).catch(() => {
                    fallbackCopyText(text);
                });
            } else {
                fallbackCopyText(text);
            }
        });
    });
}

// =============================================================================
// HELPER FUNCTIONS
// =============================================================================
function showPerangkatDetail(name, position, email) {
    // Create simple modal
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
    modal.innerHTML = `
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 max-w-md w-full shadow-2xl">
            <div class="text-center">
                <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">${name}</h3>
                <p class="text-purple-600 dark:text-purple-400 mb-4">${position}</p>
                <p class="text-gray-600 dark:text-gray-300 mb-6">${email}</p>
                <button onclick="this.closest('.fixed').remove()" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                    Tutup
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Close on outside click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.remove();
        }
    });
    
    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            modal.remove();
        }
    });
}

function showRTDetail(rtNumber, rtLeader) {
    // Simple alert untuk sekarang, bisa diganti dengan modal
    alert(`Detail ${rtNumber}\nKetua: ${rtLeader}\n\nFitur detail RT akan segera hadir!`);
}

function showCopyNotification(text) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg z-50 transform translate-y-full transition-all duration-300';
    toast.textContent = `Disalin: ${text}`;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateY(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.transform = 'translateY(full)';
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
}

function fallbackCopyText(text) {
    // Fallback untuk browser yang tidak support clipboard API
    const textArea = document.createElement('textarea');
    textArea.value = text;
    document.body.appendChild(textArea);
    textArea.select();
    
    try {
        document.execCommand('copy');
        showCopyNotification(text);
    } catch (err) {
    }
    
    document.body.removeChild(textArea);
}

// =============================================================================
// SCROLL PROGRESS INDICATOR
// =============================================================================
function initScrollProgress() {
    // Create progress bar
    const progressBar = document.createElement('div');
    progressBar.className = 'fixed top-0 left-0 h-1 bg-gradient-to-r from-purple-600 to-indigo-600 z-50 transition-all duration-300';
    progressBar.style.width = '0%';
    document.body.appendChild(progressBar);
    
    // Update progress on scroll
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        
        progressBar.style.width = scrollPercent + '%';
    });
}

// =============================================================================
// RESPONSIVE TABLE HANDLING
// =============================================================================
function initResponsiveTables() {
    const tables = document.querySelectorAll('table');
    tables.forEach(table => {
        const wrapper = document.createElement('div');
        wrapper.className = 'overflow-x-auto';
        table.parentNode.insertBefore(wrapper, table);
        wrapper.appendChild(table);
    });
}

// =============================================================================
// SEARCH FUNCTIONALITY (untuk halaman yang panjang)
// =============================================================================
function initQuickSearch() {
    // Add search box untuk halaman struktur organisasi
    if (document.querySelector('.perangkat-card')) {
        const searchContainer = document.createElement('div');
        searchContainer.className = 'mb-8 max-w-md mx-auto';
        searchContainer.innerHTML = `
            <div class="relative">
                <input type="text" id="perangkat-search" placeholder="Cari perangkat desa..." 
                       class="w-full px-4 py-3 pl-12 border border-gray-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        `;
        
        const perangkatSection = document.querySelector('.perangkat-card').closest('section');
        const sectionHeader = perangkatSection.querySelector('.text-center');
        sectionHeader.appendChild(searchContainer);
        
        // Search functionality
        const searchInput = document.getElementById('perangkat-search');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.perangkat-card');
            
            cards.forEach(card => {
                const name = card.querySelector('h3').textContent.toLowerCase();
                const position = card.querySelector('p').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || position.includes(searchTerm)) {
                    card.style.display = 'block';
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                } else {
                    card.style.opacity = '0.3';
                    card.style.transform = 'scale(0.95)';
                }
            });
        });
    }
}

// =============================================================================
// PERFORMANCE OPTIMIZATIONS
// =============================================================================
function initLazyLoading() {
    // Lazy load untuk gambar yang akan ditambahkan nanti
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
}

// =============================================================================
// INITIALIZATION UNTUK PROFIL DESA
// =============================================================================
function initProfilDesaFeatures() {
    // Timeline animations (sejarah page)
    setTimeout(initTimelineAnimations, 100);
    
    // Visi Misi animations
    setTimeout(initVisiMisiAnimations, 200);
    
    // Struktur Organisasi interactions
    setTimeout(initStrukturOrganisasi, 300);
    
    // Additional features
    setTimeout(initScrollProgress, 400);
    setTimeout(initResponsiveTables, 500);
    setTimeout(initQuickSearch, 600);
    setTimeout(initLazyLoading, 700);
}

// Add ke main initialization
document.addEventListener('DOMContentLoaded', function() {
    // ... existing initialization code ...
    
    // Add profil desa features
    initProfilDesaFeatures();
});

// Export functions if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initTimelineAnimations,
        initVisiMisiAnimations,
        initStrukturOrganisasi,
        initProfilDesaFeatures
    };
}