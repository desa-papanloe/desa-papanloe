// Agenda JavaScript - Fixed Version
(function() {
    'use strict';
    
    let isLoading = false;
    let currentView = localStorage.getItem('agendaView') || 'grid';
    
    document.addEventListener('DOMContentLoaded', function() {
        initializeAgendaFeatures();
    });
    
    function initializeAgendaFeatures() {
        try {
            initViewToggle();
            initAjaxFilters();
            initScrollAnimations();
            
            // Apply saved view on page load
            applyViewToAgendaSection(currentView);
        } catch (error) {
            console.error('❌ Error initializing agenda:', error);
            initBasicFeatures();
        }
    }
    
    // ==================== VIEW TOGGLE ====================
    function initViewToggle() {
        const gridBtn = document.getElementById('gridBtn');
        const listBtn = document.getElementById('listBtn');
        
        if (!gridBtn || !listBtn) {
            console.warn('View toggle buttons not found');
            return;
        }
        
        // Set initial button states
        updateToggleButtons(currentView);
        
        gridBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            switchView('grid');
        });
        
        listBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            switchView('list');
        });
    }
    
    function switchView(view) {
        currentView = view;
        localStorage.setItem('agendaView', view);
        
        // Update button states
        updateToggleButtons(view);
        
        // Apply view to agenda section
        applyViewToAgendaSection(view);
    }
    
    function updateToggleButtons(view) {
        const gridBtn = document.getElementById('gridBtn');
        const listBtn = document.getElementById('listBtn');
        
        if (!gridBtn || !listBtn) return;
        
        // Reset classes
        gridBtn.className = 'px-3 py-2 rounded-md transition-all';
        listBtn.className = 'px-3 py-2 rounded-md transition-all';
        
        if (view === 'grid') {
            gridBtn.classList.add('text-purple-600', 'bg-purple-50');
            listBtn.classList.add('text-gray-400', 'hover:text-purple-600');
        } else {
            listBtn.classList.add('text-purple-600', 'bg-purple-50');
            gridBtn.classList.add('text-gray-400', 'hover:text-purple-600');
        }
    }
    
    function applyViewToAgendaSection(view) {
        const agendaGrid = document.getElementById('agendaGrid');
        if (!agendaGrid) {
            console.warn('Agenda grid not found');
            return;
        }
        
        if (view === 'grid') {
            agendaGrid.className = 'grid md:grid-cols-2 xl:grid-cols-3 gap-8';
            
            // Update cards for grid view
            document.querySelectorAll('#agendaGrid .agenda-card').forEach(card => {
                card.className = 'agenda-card bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 group';
                
                // Reset any flex modifications
                const imageContainer = card.querySelector('.relative');
                if (imageContainer && imageContainer.classList.contains('h-48')) {
                    imageContainer.className = 'relative h-48 overflow-hidden';
                }
            });
        } else {
            agendaGrid.className = 'space-y-6';
            
            // Update cards for list view
            document.querySelectorAll('#agendaGrid .agenda-card').forEach(card => {
                card.className = 'agenda-card bg-white border border-gray-200 rounded-2xl hover:shadow-xl transition-all duration-300 group flex flex-col md:flex-row overflow-hidden';
                
                // Adjust image size for list view
                const imageContainer = card.querySelector('.relative');
                if (imageContainer && imageContainer.classList.contains('h-48')) {
                    imageContainer.className = 'relative h-48 md:h-auto md:w-64 flex-shrink-0 overflow-hidden';
                }
            });
        }
    }
    
    // ==================== AJAX FILTERS ====================
    function initAjaxFilters() {
        // Search input with proper selector
        const searchInput = document.querySelector('#ajaxSearchForm input[name="search"], input[name="search"]');
        if (searchInput) {
            let searchTimeout;
            
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.trim();
                
                // Debounce search
                searchTimeout = setTimeout(() => {
                    performAjaxUpdate();
                }, query.length === 0 ? 300 : 800);
            });
        }
        
        // Category select with proper selector
        const categorySelect = document.querySelector('#ajaxSearchForm select[name="kategori"], select[name="kategori"]');
        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                performAjaxUpdate();
            });
        }
        
        // Sort select with proper selector
        const sortSelect = document.querySelector('#ajaxSortForm select[name="sort"], select[name="sort"]');
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                performAjaxUpdate();
            });
        }
        
        // Prevent form submissions
        const forms = document.querySelectorAll('#ajaxSearchForm, #ajaxSortForm, form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                performAjaxUpdate();
            });
        });
    }
    
    function performAjaxUpdate() {
        if (isLoading) {
            return;
        }
        
        isLoading = true;
        showLoadingOnSection();
        
        // Collect form data with better selectors
        const searchValue = getInputValue('input[name="search"]');
        const categoryValue = getInputValue('select[name="kategori"]');
        const sortValue = getInputValue('select[name="sort"]') || 'tanggal_mulai';
        
        // Build query string
        const params = new URLSearchParams();
        if (searchValue) params.append('search', searchValue);
        if (categoryValue) params.append('kategori', categoryValue);
        if (sortValue) params.append('sort', sortValue);
        params.append('section_only', '1'); // Flag for section update only
        
        const url = window.location.pathname + '?' + params.toString();
        
        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success && data.html) {
                updateAgendaSectionOnly(data.html);
                
                // Update URL without refresh
                const cleanUrl = url.replace('&section_only=1', '').replace('section_only=1&', '').replace('section_only=1', '');
                const finalUrl = cleanUrl.endsWith('?') ? cleanUrl.slice(0, -1) : cleanUrl;
                window.history.pushState({}, '', finalUrl || window.location.pathname);
                
                showNotification('Data berhasil dimuat', 'success');
            } else {
                throw new Error(data.message || 'Invalid response format');
            }
        })
        .catch(error => {
            console.error('❌ AJAX Update Error:', error);
            showNotification('Gagal memuat data: ' + error.message, 'error');
            
            // Fallback: reload page on persistent errors
            if (error.message.includes('HTTP 50')) {
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
        .finally(() => {
            isLoading = false;
            hideLoadingOnSection();
        });
    }
    
    function getInputValue(selector) {
        const element = document.querySelector(selector);
        return element ? element.value.trim() : '';
    }
    
    function updateAgendaSectionOnly(html) {
        const agendaSection = document.getElementById('agendaSection');
        if (!agendaSection) {
            console.error('❌ Agenda section not found');
            return;
        }
        
        try {
            // Parse the new HTML
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            
            // Find the container inside agenda section
            const container = agendaSection.querySelector('.container');
            const newContainer = tempDiv.querySelector('.container');
            
            if (container && newContainer) {
                // Update only the container content
                container.innerHTML = newContainer.innerHTML;
                
                // Reapply current view to the new content
                setTimeout(() => {
                    applyViewToAgendaSection(currentView);
                    
                    // Trigger animations for new content
                    const newCards = container.querySelectorAll('.agenda-card:not(.animate-in)');
                    newCards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('animate-in');
                        }, index * 50);
                    });
                    
                    // Reinitialize scroll animations for new content
                    initScrollAnimations();
                }, 100);
            } else {
                console.error('❌ Container elements not found in response');
                // Fallback: replace entire section
                agendaSection.innerHTML = html;
                setTimeout(() => applyViewToAgendaSection(currentView), 100);
            }
        } catch (error) {
            console.error('❌ Error updating section:', error);
            showNotification('Terjadi kesalahan saat memperbarui tampilan', 'error');
        }
    }
    
    function showLoadingOnSection() {
        const agendaSection = document.getElementById('agendaSection');
        if (!agendaSection) return;
        
        // Remove existing overlay
        const existingOverlay = agendaSection.querySelector('.section-loading-overlay');
        if (existingOverlay) {
            existingOverlay.remove();
        }
        
        // Add loading overlay to section
        const loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'section-loading-overlay fixed inset-0 bg-white/80 backdrop-blur-sm z-50 flex items-center justify-center';
        loadingOverlay.innerHTML = `
            <div class="flex items-center space-x-3 bg-white px-6 py-4 rounded-xl shadow-lg border">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600"></div>
                <span class="text-gray-700 font-medium">Memuat data...</span>
            </div>
        `;
        
        document.body.appendChild(loadingOverlay);
    }
    
    function hideLoadingOnSection() {
        const loadingOverlay = document.querySelector('.section-loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.remove();
        }
    }
    
    // ==================== SCROLL ANIMATIONS ====================
    function initScrollAnimations() {
        if (typeof IntersectionObserver === 'undefined') {
            console.warn('IntersectionObserver not supported');
            return;
        }
        
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animate-in')) {
                    entry.target.classList.add('animate-in');
                    // Don't unobserve to allow re-animation of new content
                }
            });
        }, observerOptions);

        // Observe elements that should animate
        document.querySelectorAll('.scroll-animate:not(.animate-in), .fade-up:not(.animate-in)').forEach(el => {
            observer.observe(el);
        });
    }
    
    // ==================== BASIC FEATURES FALLBACK ====================
    function initBasicFeatures() {
        
        // Basic view toggle
        const gridBtn = document.getElementById('gridBtn');
        const listBtn = document.getElementById('listBtn');
        
        if (gridBtn && listBtn) {
            gridBtn.addEventListener('click', (e) => {
                e.preventDefault();
                switchView('grid');
            });
            
            listBtn.addEventListener('click', (e) => {
                e.preventDefault();
                switchView('list');
            });
            
            // Apply current view
            applyViewToAgendaSection(currentView);
        }
        
        // Basic form submissions (fallback)
        const categorySelect = document.querySelector('select[name="kategori"]');
        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                // For fallback, just submit the form normally
                window.location.search = `?kategori=${this.value}`;
            });
        }
        
        const sortSelect = document.querySelector('select[name="sort"]');
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const params = new URLSearchParams(window.location.search);
                params.set('sort', this.value);
                window.location.search = params.toString();
            });
        }
    }
    
    // ==================== UTILITY FUNCTIONS ====================
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.agenda-notification');
        existingNotifications.forEach(notif => notif.remove());
        
        const notification = document.createElement('div');
        const bgColor = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-yellow-500',
            info: 'bg-blue-500'
        }[type] || 'bg-blue-500';
        
        notification.className = `agenda-notification fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => notification.classList.remove('translate-x-full'), 100);
        
        // Animate out
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 300);
        }, 3000);
    }
    
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // ==================== EXPORT FOR GLOBAL ACCESS ====================
    window.AgendaApp = {
        switchView,
        performAjaxUpdate,
        applyViewToAgendaSection,
        showNotification,
        currentView: () => currentView,
        isLoading: () => isLoading
    };
})();