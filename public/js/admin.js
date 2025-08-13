// public/js/admin.js
console.log('🛠️ Admin.js loaded');

// ========================================
// ADMIN THEME TOGGLE
// ========================================

class AdminThemeManager {
    constructor() {
        this.theme = this.getStoredTheme() || 'light';
        this.init();
    }

    init() {
        this.applyTheme(this.theme);
        this.setupEventListeners();
        console.log(`🎨 Admin theme initialized: ${this.theme}`);
    }

    getStoredTheme() {
        try {
            return localStorage.getItem('admin-theme');
        } catch (e) {
            return null;
        }
    }

    setStoredTheme(theme) {
        try {
            localStorage.setItem('admin-theme', theme);
        } catch (e) {
            console.warn('Cannot save admin theme to localStorage');
        }
    }

    applyTheme(theme) {
        const html = document.documentElement;
        
        if (theme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        
        this.updateToggleButton(theme);
        this.theme = theme;
    }

    updateToggleButton(theme) {
        const toggle = document.getElementById('theme-toggle');
        if (!toggle) return;

        const isDark = theme === 'dark';
        
        // Update button content
        toggle.innerHTML = isDark ? `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        ` : `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        `;
    }

    toggleTheme() {
        const newTheme = this.theme === 'light' ? 'dark' : 'light';
        this.applyTheme(newTheme);
        this.setStoredTheme(newTheme);
        
        console.log(`🌓 Admin theme switched to: ${newTheme}`);
    }

    setupEventListeners() {
        const toggle = document.getElementById('theme-toggle');
        if (toggle) {
            toggle.addEventListener('click', (e) => {
                e.preventDefault();
                this.toggleTheme();
            });
        }
    }
}

// ========================================
// ADMIN SIDEBAR
// ========================================

class AdminSidebar {
    constructor() {
        this.isOpen = false;
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setupDropdowns();
    }

    setupEventListeners() {
        // Sidebar toggle buttons
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const sidebar = document.getElementById('admin-sidebar');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => this.toggleSidebar());
        }

        if (sidebarClose) {
            sidebarClose.addEventListener('click', () => this.closeSidebar());
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', () => this.closeSidebar());
        }

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeSidebar();
            }
        });
    }

    setupDropdowns() {
        const dropdownButtons = document.querySelectorAll('.nav-dropdown > button');
        
        dropdownButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const dropdown = button.parentElement;
                const content = dropdown.querySelector('.dropdown-content');
                const arrow = button.querySelector('.dropdown-arrow');
                
                // Close other dropdowns
                dropdownButtons.forEach(otherButton => {
                    if (otherButton !== button) {
                        const otherDropdown = otherButton.parentElement;
                        const otherContent = otherDropdown.querySelector('.dropdown-content');
                        const otherArrow = otherButton.querySelector('.dropdown-arrow');
                        
                        otherDropdown.classList.remove('active');
                        if (otherContent) otherContent.classList.add('hidden');
                        if (otherArrow) otherArrow.style.transform = 'rotate(0deg)';
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('active');
                if (content) {
                    content.classList.toggle('hidden');
                }
                if (arrow) {
                    const isActive = dropdown.classList.contains('active');
                    arrow.style.transform = isActive ? 'rotate(180deg)' : 'rotate(0deg)';
                }
            });
        });
    }

    toggleSidebar() {
        if (this.isOpen) {
            this.closeSidebar();
        } else {
            this.openSidebar();
        }
    }

    openSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar && overlay) {
            sidebar.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            this.isOpen = true;
        }
    }

    closeSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar && overlay) {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            this.isOpen = false;
        }
    }
}

// ========================================
// ADMIN UTILITIES
// ========================================

class AdminUtils {
    static showAlert(message, type = 'info', duration = 5000) {
        const alertContainer = document.createElement('div');
        alertContainer.className = `alert alert-${type} show`;
        alertContainer.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${this.getAlertIcon(type)}
                </svg>
                <span>${message}</span>
                <button class="ml-auto" onclick="this.parentElement.parentElement.remove()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;
        
        document.body.appendChild(alertContainer);
        
        // Auto remove
        setTimeout(() => {
            alertContainer.classList.remove('show');
            setTimeout(() => alertContainer.remove(), 300);
        }, duration);
    }

    static getAlertIcon(type) {
        const icons = {
            success: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
            error: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
            warning: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>',
            info: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
        };
        return icons[type] || icons.info;
    }

    static confirmDelete(message = 'Apakah Anda yakin ingin menghapus data ini?') {
        return confirm(message);
    }

    static formatDate(date) {
        return new Date(date).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    static formatDateTime(date) {
        return new Date(date).toLocaleString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }
}

// ========================================
// DATA TABLES
// ========================================

class AdminDataTable {
    constructor(tableSelector) {
        this.table = document.querySelector(tableSelector);
        if (this.table) {
            this.init();
        }
    }

    init() {
        this.setupSearch();
        this.setupSorting();
        this.setupBulkActions();
    }

    setupSearch() {
        const searchInput = document.querySelector('[data-table-search]');
        if (!searchInput) return;

        searchInput.addEventListener('input', this.debounce((e) => {
            this.filterTable(e.target.value);
        }, 300));
    }

    setupSorting() {
        const sortableHeaders = this.table.querySelectorAll('[data-sortable]');
        
        sortableHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const column = header.dataset.sortable;
                this.sortTable(column);
            });
        });
    }

    setupBulkActions() {
        const selectAll = this.table.querySelector('[data-select-all]');
        const checkboxes = this.table.querySelectorAll('[data-select-item]');
        
        if (selectAll) {
            selectAll.addEventListener('change', (e) => {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = e.target.checked;
                });
                this.updateBulkActions();
            });
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                this.updateBulkActions();
            });
        });
    }

    filterTable(searchTerm) {
        const rows = this.table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const matches = text.includes(searchTerm.toLowerCase());
            row.style.display = matches ? '' : 'none';
        });
    }

    sortTable(column) {
        // Implementation for table sorting
        console.log(`Sorting by column: ${column}`);
    }

    updateBulkActions() {
        const selected = this.table.querySelectorAll('[data-select-item]:checked');
        const bulkActions = document.querySelector('[data-bulk-actions]');
        
        if (bulkActions) {
            bulkActions.style.display = selected.length > 0 ? 'block' : 'none';
        }
    }

    debounce(func, wait) {
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
}

// ========================================
// INITIALIZATION
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    // Initialize admin modules
    window.adminThemeManager = new AdminThemeManager();
    window.adminSidebar = new AdminSidebar();
    
    // Initialize data tables
    const dataTables = document.querySelectorAll('[data-admin-table]');
    dataTables.forEach(table => {
        new AdminDataTable(`#${table.id}`);
    });
    
    // Make utilities globally available
    window.AdminUtils = AdminUtils;
    window.showAlert = AdminUtils.showAlert;
    
});