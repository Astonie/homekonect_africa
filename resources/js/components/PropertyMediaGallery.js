/**
 * Property Media Gallery Component
 * Handles photos, videos, 360 tours, and drone footage display
 */

import PhotoSwipeLightbox from 'photoswipe/lightbox';
import PhotoSwipe from 'photoswipe';
import 'photoswipe/style.css';
import videojs from 'video.js';
import 'video.js/dist/video-js.css';
import { viewer as PannellumViewer } from 'pannellum';

export class PropertyMediaGallery {
    constructor(containerId, options = {}) {
        this.container = document.getElementById(containerId);
        this.options = {
            showThumbnails: true,
            autoPlay: false,
            enableZoom: true,
            enable360: true,
            enableVideos: true,
            ...options
        };
        
        this.currentMedia = [];
        this.lightbox = null;
        this.videoPlayers = [];
        this.pannellumViewer = null;
        
        this.init();
    }

    init() {
        if (!this.container) {
            console.error('Gallery container not found');
            return;
        }

        this.setupPhotoSwipe();
        this.setupVideoPlayers();
        this.setupEventListeners();
    }

    /**
     * Set media items for the gallery
     */
    setMedia(mediaItems) {
        this.currentMedia = mediaItems;
        this.render();
    }

    /**
     * Setup PhotoSwipe lightbox for images
     */
    setupPhotoSwipe() {
        this.lightbox = new PhotoSwipeLightbox({
            gallery: `#${this.container.id}`,
            children: 'a.gallery-item',
            pswpModule: PhotoSwipe,
            zoom: this.options.enableZoom,
            loop: true,
            pinchToClose: true,
            closeOnVerticalDrag: true,
            padding: { top: 50, bottom: 50, left: 100, right: 100 },
        });

        this.lightbox.init();
    }

    /**
     * Setup video players
     */
    setupVideoPlayers() {
        const videoElements = this.container.querySelectorAll('video.vjs-tech');
        
        videoElements.forEach((videoEl, index) => {
            const player = videojs(videoEl, {
                controls: true,
                autoplay: false,
                preload: 'auto',
                fluid: true,
                responsive: true,
            });

            this.videoPlayers.push(player);
        });
    }

    /**
     * Setup 360 photo viewer
     */
    setup360Viewer(imageUrl, containerId) {
        if (!this.options.enable360) return;

        const viewerContainer = document.getElementById(containerId);
        
        if (!viewerContainer) return;

        this.pannellumViewer = PannellumViewer(viewerContainer, {
            type: 'equirectangular',
            panorama: imageUrl,
            autoLoad: true,
            showControls: true,
            showFullscreenCtrl: true,
            showZoomCtrl: true,
            mouseZoom: true,
            draggable: true,
            disableKeyboardCtrl: false,
            compass: true,
            northOffset: 0,
            hfov: 100,
            pitch: 0,
            yaw: 0,
        });
    }

    /**
     * Render gallery HTML
     */
    render() {
        if (!this.currentMedia || this.currentMedia.length === 0) {
            this.container.innerHTML = '<p class="text-gray-500 text-center py-8">No media available</p>';
            return;
        }

        const html = this.generateGalleryHTML();
        this.container.innerHTML = html;

        // Reinitialize components after rendering
        this.setupPhotoSwipe();
        this.setupVideoPlayers();
    }

    /**
     * Generate gallery HTML
     */
    generateGalleryHTML() {
        const images = this.currentMedia.filter(m => m.type === 'image' || m.type === 'drone_image');
        const videos = this.currentMedia.filter(m => m.type === 'video' || m.type === 'drone_video');
        const photos360 = this.currentMedia.filter(m => m.is_360);

        let html = '<div class="property-gallery">';

        // Main featured image
        if (images.length > 0) {
            const featured = images.find(img => img.is_featured) || images[0];
            html += `
                <div class="gallery-featured mb-4">
                    <a href="${featured.url}" 
                       class="gallery-item block relative overflow-hidden rounded-lg"
                       data-pswp-width="${featured.width || 1920}"
                       data-pswp-height="${featured.height || 1080}">
                        <img src="${featured.url}" 
                             alt="${featured.title || 'Property image'}"
                             class="w-full h-96 object-cover hover:scale-105 transition-transform duration-300">
                        <div class="absolute bottom-4 right-4 bg-black bg-opacity-60 text-white px-3 py-1 rounded">
                            <i class="fas fa-search-plus mr-2"></i>Click to view fullscreen
                        </div>
                    </a>
                </div>
            `;
        }

        // Thumbnail grid
        if (images.length > 1 || videos.length > 0 || photos360.length > 0) {
            html += '<div class="gallery-thumbnails grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2">';

            // Regular images
            images.slice(1).forEach(img => {
                html += `
                    <a href="${img.url}" 
                       class="gallery-item block relative overflow-hidden rounded aspect-square"
                       data-pswp-width="${img.width || 1920}"
                       data-pswp-height="${img.height || 1080}">
                        <img src="${img.thumbnail_url || img.url}" 
                             alt="${img.title || 'Property image'}"
                             class="w-full h-full object-cover hover:opacity-80 transition-opacity">
                        ${img.room_type ? `<div class="absolute top-2 left-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">${img.room_type}</div>` : ''}
                    </a>
                `;
            });

            // Videos
            videos.forEach(video => {
                html += `
                    <div class="video-thumbnail relative overflow-hidden rounded aspect-square cursor-pointer" 
                         data-video-url="${video.url}">
                        <img src="${video.thumbnail_url || '/images/video-placeholder.jpg'}" 
                             alt="${video.title || 'Property video'}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40">
                            <i class="fas fa-play-circle text-white text-4xl"></i>
                        </div>
                        ${video.type === 'drone_video' ? '<div class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded">Drone</div>' : ''}
                    </div>
                `;
            });

            // 360 photos
            photos360.forEach(photo => {
                html += `
                    <div class="360-photo relative overflow-hidden rounded aspect-square cursor-pointer"
                         data-360-url="${photo.url}">
                        <img src="${photo.thumbnail_url || photo.url}" 
                             alt="${photo.title || '360° view'}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40">
                            <i class="fas fa-street-view text-white text-3xl"></i>
                        </div>
                        <div class="absolute top-2 left-2 bg-purple-600 text-white text-xs px-2 py-1 rounded">360°</div>
                    </div>
                `;
            });

            html += '</div>';
        }

        html += '</div>';

        return html;
    }

    /**
     * Setup event listeners
     */
    setupEventListeners() {
        // Video thumbnail clicks
        this.container.addEventListener('click', (e) => {
            const videoThumb = e.target.closest('.video-thumbnail');
            if (videoThumb) {
                const videoUrl = videoThumb.dataset.videoUrl;
                this.openVideoModal(videoUrl);
            }

            // 360 photo clicks
            const photo360 = e.target.closest('.360-photo');
            if (photo360) {
                const photoUrl = photo360.dataset['360Url'];
                this.open360Modal(photoUrl);
            }
        });
    }

    /**
     * Open video in modal
     */
    openVideoModal(videoUrl) {
        const modalHtml = `
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90" id="videoModal">
                <div class="relative w-full max-w-4xl mx-4">
                    <button class="absolute -top-12 right-0 text-white text-3xl hover:text-gray-300" onclick="this.closest('#videoModal').remove()">
                        <i class="fas fa-times"></i>
                    </button>
                    <video id="modalVideo" class="video-js vjs-big-play-centered w-full" controls preload="auto">
                        <source src="${videoUrl}" type="video/mp4">
                    </video>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        
        const videoEl = document.getElementById('modalVideo');
        videojs(videoEl, {
            controls: true,
            autoplay: true,
            fluid: true,
        });
    }

    /**
     * Open 360 photo in modal
     */
    open360Modal(photoUrl) {
        const modalHtml = `
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90" id="viewer360Modal">
                <div class="relative w-full h-full">
                    <button class="absolute top-4 right-4 z-10 text-white text-3xl hover:text-gray-300" onclick="this.closest('#viewer360Modal').remove()">
                        <i class="fas fa-times"></i>
                    </button>
                    <div id="panoramaViewer" class="w-full h-full"></div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        
        PannellumViewer('panoramaViewer', {
            type: 'equirectangular',
            panorama: photoUrl,
            autoLoad: true,
            showControls: true,
        });
    }

    /**
     * Cleanup
     */
    destroy() {
        if (this.lightbox) {
            this.lightbox.destroy();
        }

        this.videoPlayers.forEach(player => {
            if (player) {
                player.dispose();
            }
        });

        if (this.pannellumViewer) {
            this.pannellumViewer.destroy();
        }
    }
}

// Export for use in other modules
export default PropertyMediaGallery;
