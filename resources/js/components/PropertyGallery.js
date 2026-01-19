import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.css';

export class PropertyGallery {
    constructor(elementId, options = {}) {
        this.container = document.getElementById(elementId);
        if (!this.container) return;

        this.options = {
            autoplay: options.autoplay || false,
            showThumbnails: options.showThumbnails !== false,
            enableStreetView: options.enableStreetView || false,
            enableVirtualTour: options.enableVirtualTour || false,
            propertyId: options.propertyId,
            latitude: options.latitude,
            longitude: options.longitude,
            ...options
        };

        this.init();
    }

    init() {
        this.initMainGallery();
        if (this.options.showThumbnails) {
            this.initThumbnails();
        }
        this.initLightbox();
        
        if (this.options.enableStreetView && this.options.latitude && this.options.longitude) {
            this.addStreetViewButton();
        }
        
        if (this.options.enableVirtualTour && this.options.virtualTourUrl) {
            this.addVirtualTourButton();
        }
    }

    initMainGallery() {
        const thumbsSelector = this.options.showThumbnails ? '.gallery-thumbs' : null;
        
        this.swiper = new Swiper(this.container.querySelector('.gallery-main'), {
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            thumbs: thumbsSelector ? {
                swiper: this.thumbsSwiper
            } : undefined,
            loop: true,
            autoplay: this.options.autoplay ? {
                delay: 5000,
                disableOnInteraction: false,
            } : false,
            keyboard: {
                enabled: true,
            },
        });
    }

    initThumbnails() {
        this.thumbsSwiper = new Swiper(this.container.querySelector('.gallery-thumbs'), {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
            breakpoints: {
                640: { slidesPerView: 5 },
                768: { slidesPerView: 6 },
                1024: { slidesPerView: 8 },
            },
        });
    }

    initLightbox() {
        this.lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            autoplayVideos: true,
            plyr: {
                config: {
                    ratio: '16:9',
                    youtube: { noCookie: true, rel: 0, showinfo: 0 },
                }
            }
        });
    }

    addStreetViewButton() {
        const btn = document.createElement('button');
        btn.className = 'btn-street-view absolute top-4 right-4 bg-white px-4 py-2 rounded-lg shadow-lg hover:bg-gray-100 z-10';
        btn.innerHTML = '<i class="fas fa-street-view mr-2"></i>Street View';
        btn.onclick = () => this.openStreetView();
        this.container.appendChild(btn);
    }

    addVirtualTourButton() {
        const btn = document.createElement('button');
        btn.className = 'btn-virtual-tour absolute top-4 right-32 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 z-10';
        btn.innerHTML = '<i class="fas fa-vr-cardboard mr-2"></i>Virtual Tour';
        btn.onclick = () => this.openVirtualTour();
        this.container.appendChild(btn);
    }

    openStreetView() {
        const url = `https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=${this.options.latitude},${this.options.longitude}`;
        window.open(url, '_blank', 'width=1200,height=800');
    }

    openVirtualTour() {
        if (this.options.virtualTourUrl) {
            window.open(this.options.virtualTourUrl, '_blank', 'width=1200,height=800');
        }
    }

    destroy() {
        if (this.swiper) this.swiper.destroy();
        if (this.thumbsSwiper) this.thumbsSwiper.destroy();
        if (this.lightbox) this.lightbox.destroy();
    }
}
