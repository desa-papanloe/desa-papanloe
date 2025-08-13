// Berita Detail JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functions
    initSocialShare();
    initGallery();
    initBackToTop();
    initScrollProgress();
    loadLatestNews();
    initReadingTime();
    initTableOfContents();
});

// Social Share Functions
function initSocialShare() {
    window.shareToFacebook = function() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&t=${title}`, 
            'facebook-share', 
            'width=600,height=400,scrollbars=yes,resizable=yes'
        );
    };

    window.shareToTwitter = function() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, 
            'twitter-share', 
            'width=600,height=400,scrollbars=yes,resizable=yes'
        );
    };

    window.shareToWhatsApp = function() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        window.open(`https://wa.me/?text=${title} ${url}`, 
            'whatsapp-share'
        );
    };

    window.copyLink = function() {
        navigator.clipboard.writeText(window.location.href).then(function() {
            showNotification('Tautan berhasil disalin!', 'success');
        }, function() {
            // Fallback for older browsers
            const textArea = document.createElement("textarea");
            textArea.value = window.location.href;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showNotification('Tautan berhasil disalin!', 'success');
        });
    };
}

// Gallery Functions
let currentImageIndex = 0;
let galleryImages = [];

function initGallery() {
    // Get all gallery images - perbaikan untuk menggunakan gallery_urls
    const galleryElements = document.querySelectorAll('[onclick^="openGallery"]');
    galleryImages = Array.from(galleryElements).map(el => {
        const img = el.querySelector('img');
        return {
            src: img.src,
            alt: img.alt
        };
    });

    // Jika tidak ada gallery dari DOM, coba ambil dari PHP data
    if (galleryImages.length === 0 && typeof beritaGallery !== 'undefined') {
        galleryImages = beritaGallery.map((url, index) => ({
            src: url,
            alt: `Galeri foto ${index + 1}`
        }));
    }

    window.openGallery = function(index) {
        currentImageIndex = index;
        const modal = document.getElementById('gallery-modal');
        const image = document.getElementById('gallery-image');
        
        if (galleryImages[index]) {
            image.src = galleryImages[index].src;
            image.alt = galleryImages[index].alt;
            
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeGallery = function() {
        const modal = document.getElementById('gallery-modal');
        modal.classList.remove('show');
        document.body.style.overflow = '';
    };

    window.nextImage = function() {
        if (galleryImages.length > 0) {
            currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
            const image = document.getElementById('gallery-image');
            image.src = galleryImages[currentImageIndex].src;
            image.alt = galleryImages[currentImageIndex].alt;
        }
    };

    window.prevImage = function() {
        if (galleryImages.length > 0) {
            currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
            const image = document.getElementById('gallery-image');
            image.src = galleryImages[currentImageIndex].src;
            image.alt = galleryImages[currentImageIndex].alt;
        }
    };

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('gallery-modal');
        if (modal && modal.classList.contains('show')) {
            switch(e.key) {
                case 'Escape':
                    closeGallery();
                    break;
                case 'ArrowLeft':
                    prevImage();
                    break;
                case 'ArrowRight':
                    nextImage();
                    break;
            }
        }
    });

    // Click outside to close
    const modal = document.getElementById('gallery-modal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeGallery();
            }
        });
    }
}

// Back to Top Function
function initBackToTop() {
    const backToTopButton = document.getElementById('back-to-top');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Scroll Progress Indicator
function initScrollProgress() {
    // Create progress bar
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        z-index: 1000;
        transition: width 0.1s ease;
    `;
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        progressBar.style.width = scrolled + '%';
    });
}

// Load Latest News
function loadLatestNews() {
    const container = document.getElementById('latest-news');
    
    // Simulate API call (replace with actual endpoint)
    fetch('/api/berita/latest?limit=3')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                container.innerHTML = '';
                data.data.forEach(berita => {
                    const article = createLatestNewsItem(berita);
                    container.appendChild(article);
                });
            }
        })
}

function createLatestNewsItem(berita) {
    const article = document.createElement('article');
    article.className = 'group';
    
    article.innerHTML = `
        <a href="/berita/${berita.slug}" class="block">
            <div class="flex gap-3">
                <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                    <img src="${berita.featured_image_url}" 
                         alt="${berita.judul}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors text-sm leading-tight mb-2">
                        ${truncateText(berita.judul, 60)}
                    </h4>
                    <div class="flex items-center text-xs text-gray-500">
                        <time>${formatDate(berita.created_at)}</time>
                        <span class="mx-2">•</span>
                        <span>${berita.views} views</span>
                    </div>
                </div>
            </div>
        </a>
    `;
    
    return article;
}

// Reading Time Calculator
function initReadingTime() {
    const content = document.querySelector('.prose');
    if (!content) return;

    const text = content.textContent || content.innerText || '';
    const wordsPerMinute = 200;
    const wordCount = text.trim().split(/\s+/).length;
    const readingTime = Math.ceil(wordCount / wordsPerMinute);

    // Create reading time element
    const readingTimeEl = document.createElement('div');
    readingTimeEl.className = 'flex items-center text-sm text-gray-600 mb-2';
    readingTimeEl.innerHTML = `
        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
        <span>${readingTime} menit dibaca</span>
    `;

    // Insert after the meta information
    const metaInfo = document.querySelector('header .flex.flex-wrap.items-center.gap-6');
    if (metaInfo) {
        metaInfo.appendChild(readingTimeEl);
    }
}

// Table of Contents Generator
function initTableOfContents() {
    const headings = document.querySelectorAll('.prose h2, .prose h3');
    if (headings.length < 3) return; // Only show TOC if there are enough headings

    const tocContainer = document.createElement('div');
    tocContainer.className = 'bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8';
    tocContainer.innerHTML = `
        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
            </svg>
            Daftar Isi
        </h4>
        <ul class="space-y-2"></ul>
    `;

    const tocList = tocContainer.querySelector('ul');
    
    headings.forEach((heading, index) => {
        // Create anchor ID
        const anchorId = `heading-${index}`;
        heading.id = anchorId;

        // Create TOC item
        const li = document.createElement('li');
        li.className = heading.tagName === 'H2' ? 'font-medium' : 'ml-4 text-sm';
        
        const link = document.createElement('a');
        link.href = `#${anchorId}`;
        link.textContent = heading.textContent;
        link.className = 'text-blue-600 hover:text-blue-800 transition-colors';
        
        li.appendChild(link);
        tocList.appendChild(li);
    });

    // Insert TOC after the featured image or at the beginning of content
    const featuredImage = document.querySelector('figure');
    const prose = document.querySelector('.prose');
    
    if (featuredImage) {
        featuredImage.insertAdjacentElement('afterend', tocContainer);
    } else if (prose) {
        prose.insertAdjacentElement('beforebegin', tocContainer);
    }
}

// Utility Functions
function truncateText(text, maxLength) {
    if (text.length <= maxLength) return text;
    return text.substr(0, maxLength) + '...';
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const months = [
        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];
    
    return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 transition-all duration-300 transform translate-x-full`;
    
    // Set background color based on type
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        warning: 'bg-yellow-500',
        info: 'bg-blue-500'
    };
    
    notification.classList.add(colors[type] || colors.info);
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Image lazy loading for better performance
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
});

// Print functionality
function printArticle() {
    window.print();
}

// Jangan tambahkan print button ke navbar - ini untuk artikel saja
document.addEventListener('DOMContentLoaded', function() {
    // Hanya tambahkan print button di area artikel, bukan navbar
    const articleArea = document.querySelector('article .flex.items-center.space-x-3');
    if (articleArea) {
        const printButton = document.createElement('button');
        printButton.onclick = printArticle;
        printButton.className = 'share-btn bg-gray-600 text-white hover:bg-gray-700';
        printButton.title = 'Cetak artikel';
        printButton.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
        `;
        articleArea.appendChild(printButton);
    }
});