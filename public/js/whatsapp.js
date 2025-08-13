// resources/js/whatsapp.js

/**
 * WhatsApp Integration for Lapor PakDe Feature
 * Fungsi untuk mengarahkan button Lapor PakDe ke WhatsApp dengan template pesan
 */

class WhatsAppIntegration {
    constructor() {
        this.phoneNumber = ''; // Nomor akan diisi nanti
        this.init();
    }

    init() {
        this.bindEvents();
    }

    // Set nomor WhatsApp
    setPhoneNumber(phoneNumber) {
        // Remove all non-numeric characters and format
        this.phoneNumber = phoneNumber.replace(/\D/g, '');
        
        // Add country code if not present
        if (!this.phoneNumber.startsWith('62')) {
            if (this.phoneNumber.startsWith('0')) {
                this.phoneNumber = '62' + this.phoneNumber.substring(1);
            } else {
                this.phoneNumber = '62' + this.phoneNumber;
            }
        }
        
    }

    // Generate template pesan Lapor PakDe
    generateReportMessage() {
        const currentDate = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        const currentTime = new Date().toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });

        const template = `🏛️ *LAPORAN WARGA DESA PAPANLOE*

📅 Tanggal: ${currentDate}
⏰ Waktu: ${currentTime}

👤 *Data Pelapor:*
Nama: 
NIK: 
Alamat: 

📋 *Detail Laporan:*
Jenis Laporan: [ Pilih: Infrastruktur / Pelayanan / Keamanan / Lingkungan / Lainnya ]

Lokasi Kejadian: 

Deskripsi Masalah: 


📸 *Lampiran:* 
[ Foto/Dokumen akan dikirim terpisah jika ada ]

---
*Terima kasih telah melaporkan kepada Perangkat Desa Papanloe. Laporan Anda akan segera ditindaklanjuti.*

🏢 Kantor Desa Papanloe
📍 Jl. Poros Bantaeng - Bulukumba, Kec. Pa'jukukang`;

        return template;
    }

    // Generate template pesan untuk informasi umum
    generateInfoMessage() {
        return `🏛️ *DESA PAPANLOE - INFORMASI*

Assalamu'alaikum Warahmatullahi Wabarakatuh

Saya ingin menanyakan tentang:

[ Tulis pertanyaan atau informasi yang ingin ditanyakan ]

Terima kasih 🙏

---
🏢 Kantor Desa Papanloe
📍 Kec. Pa'jukukang, Kab. Bantaeng`;
    }

    // Open WhatsApp with template message
    openWhatsApp(messageType = 'report') {
        if (!this.phoneNumber) {
            this.showNotification('Nomor WhatsApp belum diatur!', 'error');
            return;
        }

        let message;
        switch(messageType) {
            case 'report':
                message = this.generateReportMessage();
                break;
            case 'info':
                message = this.generateInfoMessage();
                break;
            default:
                message = this.generateReportMessage();
        }

        const encodedMessage = encodeURIComponent(message);
        const whatsappUrl = `https://wa.me/${this.phoneNumber}?text=${encodedMessage}`;
        
        // Open in new tab/window
        window.open(whatsappUrl, '_blank');
        
        // Show success notification
        this.showNotification('Membuka WhatsApp...', 'success');
        
        // Analytics tracking (optional)
        this.trackLaporPakDeClick(messageType);
    }

    // Bind event listeners to buttons
    bindEvents() {
        // Desktop Lapor PakDe button (navbar)
        const desktopLaporBtn = document.querySelector('.nav-link + .nav-link + .nav-link + .nav-link + button');
        if (desktopLaporBtn) {
            desktopLaporBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.openWhatsApp('report');
            });
        }

        // Mobile Lapor PakDe button (navbar)
        const mobileLaporBtn = document.querySelector('#mobile-menu button[class*="bg-gradient-to-r from-blue-900"]');
        if (mobileLaporBtn) {
            mobileLaporBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.openWhatsApp('report');
            });
        }

        // Footer Lapor PakDe button
        const footerLaporBtn = document.querySelector('footer button[class*="bg-gradient-to-r from-emerald-600"]');
        if (footerLaporBtn) {
            footerLaporBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.openWhatsApp('report');
            });
        }

        // Alternative: Bind by finding all buttons with "Lapor PakDe" text
        const allLaporButtons = document.querySelectorAll('button');
        allLaporButtons.forEach(button => {
            if (button.textContent.includes('Lapor PakDe')) {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.openWhatsApp('report');
                });
            }
        });

    }

    // Show notification to user
    showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.whatsapp-notification');
        existingNotifications.forEach(notification => notification.remove());

        // Create notification element
        const notification = document.createElement('div');
        notification.className = `whatsapp-notification fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium z-50 transform translate-x-full transition-transform duration-300`;
        
        // Set background color based on type
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-yellow-500',
            info: 'bg-blue-500'
        };
        notification.classList.add(colors[type] || colors.info);
        
        notification.innerHTML = `
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="${type === 'success' ? 'M5 13l4 4L19 7' : 
                              type === 'error' ? 'M6 18L18 6M6 6l12 12' : 
                              'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'}"/>
                </svg>
                <span>${message}</span>
            </div>
        `;

        // Add to page
        document.body.appendChild(notification);

        // Show notification
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        // Hide notification after 3 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Track analytics (optional)
    trackLaporPakDeClick(messageType) {
        // Google Analytics atau tracking lainnya
        if (typeof gtag !== 'undefined') {
            gtag('event', 'lapor_pakde_click', {
                'event_category': 'whatsapp',
                'event_label': messageType,
                'value': 1
            });
        }
    }

    // Public method to update phone number
    updatePhoneNumber(phoneNumber) {
        this.setPhoneNumber(phoneNumber);
        this.showNotification('Nomor WhatsApp berhasil diperbarui!', 'success');
    }
}

// Initialize WhatsApp Integration when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Create global instance
    window.whatsappIntegration = new WhatsAppIntegration();
    
    // Set default phone number (akan diubah sesuai kebutuhan)
    // Contoh: window.whatsappIntegration.setPhoneNumber('081234567890');
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = WhatsAppIntegration;
}