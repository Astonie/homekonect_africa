/**
 * Google Maps Integration Component
 * Handles interactive maps, Street View, and location visualization
 */

import { Loader } from '@googlemaps/js-api-loader';

export class GoogleMapsIntegration {
    constructor(containerId, options = {}) {
        this.containerId = containerId;
        this.container = document.getElementById(containerId);
        this.options = {
            apiKey: options.apiKey || window.GOOGLE_MAPS_API_KEY,
            latitude: options.latitude || 0,
            longitude: options.longitude || 0,
            zoom: options.zoom || 15,
            mapType: options.mapType || 'roadmap',
            enableStreetView: options.enableStreetView !== false,
            enableSatellite: options.enableSatellite !== false,
            markerTitle: options.markerTitle || 'Property Location',
            streetViewHeading: options.streetViewHeading || 0,
            streetViewPitch: options.streetViewPitch || 0,
            ...options
        };

        this.map = null;
        this.marker = null;
        this.streetView = null;
        this.loader = null;

        this.init();
    }

    /**
     * Initialize Google Maps
     */
    async init() {
        if (!this.container) {
            console.error('Map container not found');
            return;
        }

        if (!this.options.apiKey) {
            console.error('Google Maps API key not provided');
            return;
        }

        try {
            this.loader = new Loader({
                apiKey: this.options.apiKey,
                version: 'weekly',
                libraries: ['places', 'geometry']
            });

            await this.loader.load();
            this.initMap();
        } catch (error) {
            console.error('Error loading Google Maps:', error);
        }
    }

    /**
     * Initialize the map
     */
    initMap() {
        const position = {
            lat: parseFloat(this.options.latitude),
            lng: parseFloat(this.options.longitude)
        };

        // Create map
        this.map = new google.maps.Map(this.container, {
            center: position,
            zoom: this.options.zoom,
            mapTypeId: this.options.mapType,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.TOP_RIGHT,
                mapTypeIds: this.options.enableSatellite 
                    ? ['roadmap', 'satellite', 'hybrid', 'terrain']
                    : ['roadmap', 'terrain']
            },
            streetViewControl: this.options.enableStreetView,
            fullscreenControl: true,
            zoomControl: true,
        });

        // Add marker
        this.addMarker(position);

        // Add Street View control if enabled
        if (this.options.enableStreetView) {
            this.setupStreetView(position);
        }

        // Add custom controls
        this.addCustomControls();
    }

    /**
     * Add marker to map
     */
    addMarker(position) {
        this.marker = new google.maps.Marker({
            position: position,
            map: this.map,
            title: this.options.markerTitle,
            animation: google.maps.Animation.DROP,
            icon: {
                url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="50" viewBox="0 0 24 30">
                        <path fill="#FF385C" d="M12 0C7.31 0 3.5 3.81 3.5 8.5c0 6.56 8.5 16.5 8.5 16.5s8.5-9.94 8.5-16.5C20.5 3.81 16.69 0 12 0zm0 11.5c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"/>
                    </svg>
                `),
                scaledSize: new google.maps.Size(40, 50),
                anchor: new google.maps.Point(20, 50)
            }
        });

        // Add info window
        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div class="p-2">
                    <h3 class="font-bold text-lg">${this.options.markerTitle}</h3>
                    <p class="text-sm text-gray-600">
                        ${this.options.address || 'Property Location'}
                    </p>
                    ${this.options.price ? `<p class="text-lg font-semibold text-blue-600 mt-2">${this.options.price}</p>` : ''}
                </div>
            `
        });

        this.marker.addListener('click', () => {
            infoWindow.open(this.map, this.marker);
        });
    }

    /**
     * Setup Street View
     */
    setupStreetView(position) {
        const streetViewService = new google.maps.StreetViewService();
        const STREETVIEW_MAX_DISTANCE = 100;

        streetViewService.getPanorama({
            location: position,
            radius: STREETVIEW_MAX_DISTANCE
        }, (data, status) => {
            if (status === google.maps.StreetViewStatus.OK) {
                this.streetViewAvailable = true;
                
                // Store pano data
                this.streetViewData = {
                    position: data.location.latLng,
                    panoId: data.location.pano
                };
            } else {
                console.log('Street View not available for this location');
                this.streetViewAvailable = false;
            }
        });
    }

    /**
     * Open Street View
     */
    openStreetView() {
        if (!this.streetViewAvailable) {
            alert('Street View is not available for this location');
            return;
        }

        const position = {
            lat: parseFloat(this.options.latitude),
            lng: parseFloat(this.options.longitude)
        };

        const panorama = this.map.getStreetView();
        panorama.setPosition(position);
        panorama.setPov({
            heading: this.options.streetViewHeading,
            pitch: this.options.streetViewPitch
        });
        panorama.setVisible(true);
    }

    /**
     * Add custom controls to map
     */
    addCustomControls() {
        // Street View button
        if (this.options.enableStreetView) {
            const streetViewButton = document.createElement('button');
            streetViewButton.className = 'bg-white hover:bg-gray-100 px-4 py-2 rounded shadow-md text-sm font-medium';
            streetViewButton.textContent = '📍 Street View';
            streetViewButton.addEventListener('click', () => this.openStreetView());
            
            this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(streetViewButton);
        }

        // Satellite toggle
        if (this.options.enableSatellite) {
            const satelliteButton = document.createElement('button');
            satelliteButton.className = 'bg-white hover:bg-gray-100 px-4 py-2 rounded shadow-md text-sm font-medium ml-2';
            satelliteButton.textContent = '🛰️ Satellite';
            satelliteButton.addEventListener('click', () => {
                const currentType = this.map.getMapTypeId();
                this.map.setMapTypeId(currentType === 'satellite' ? 'roadmap' : 'satellite');
            });
            
            this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(satelliteButton);
        }
    }

    /**
     * Add nearby POI markers
     */
    addPOIMarkers(poiData) {
        if (!poiData || !this.map) return;

        const bounds = new google.maps.LatLngBounds();
        bounds.extend(this.marker.getPosition());

        Object.entries(poiData).forEach(([category, places]) => {
            places.forEach(place => {
                const position = {
                    lat: parseFloat(place.latitude),
                    lng: parseFloat(place.longitude)
                };

                const marker = new google.maps.Marker({
                    position: position,
                    map: this.map,
                    title: place.name,
                    icon: this.getPOIIcon(category)
                });

                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div class="p-2">
                            <h4 class="font-semibold">${place.name}</h4>
                            <p class="text-xs text-gray-600">${category}</p>
                            ${place.rating ? `<p class="text-sm">⭐ ${place.rating}</p>` : ''}
                        </div>
                    `
                });

                marker.addListener('click', () => {
                    infoWindow.open(this.map, marker);
                });

                bounds.extend(position);
            });
        });

        // Fit map to show all markers
        // this.map.fitBounds(bounds);
    }

    /**
     * Get icon for POI category
     */
    getPOIIcon(category) {
        const colors = {
            school: '#4CAF50',
            hospital: '#F44336',
            transport: '#2196F3',
            shopping: '#FF9800',
            restaurant: '#9C27B0',
            bank: '#795548'
        };

        const color = colors[category] || '#757575';

        return {
            path: google.maps.SymbolPath.CIRCLE,
            fillColor: color,
            fillOpacity: 0.8,
            strokeColor: '#ffffff',
            strokeWeight: 2,
            scale: 8
        };
    }

    /**
     * Calculate and display route
     */
    showRoute(origin, destination, travelMode = 'DRIVING') {
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer({
            map: this.map,
            suppressMarkers: false
        });

        directionsService.route({
            origin: origin,
            destination: destination,
            travelMode: google.maps.TravelMode[travelMode]
        }, (response, status) => {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
            } else {
                console.error('Directions request failed:', status);
            }
        });
    }

    /**
     * Get static map image URL
     */
    getStaticMapUrl(width = 600, height = 400) {
        const lat = this.options.latitude;
        const lng = this.options.longitude;
        const zoom = this.options.zoom;
        
        return `https://maps.googleapis.com/maps/api/staticmap?center=${lat},${lng}&zoom=${zoom}&size=${width}x${height}&maptype=${this.options.mapType}&markers=color:red%7C${lat},${lng}&key=${this.options.apiKey}`;
    }

    /**
     * Update map center
     */
    setCenter(lat, lng) {
        if (this.map) {
            this.map.setCenter({ lat, lng });
            if (this.marker) {
                this.marker.setPosition({ lat, lng });
            }
        }
    }

    /**
     * Set map zoom level
     */
    setZoom(zoom) {
        if (this.map) {
            this.map.setZoom(zoom);
        }
    }

    /**
     * Change map type
     */
    setMapType(type) {
        if (this.map) {
            this.map.setMapTypeId(type);
        }
    }

    /**
     * Cleanup
     */
    destroy() {
        if (this.map) {
            google.maps.event.clearInstanceListeners(this.map);
        }
        if (this.marker) {
            this.marker.setMap(null);
        }
    }
}

export default GoogleMapsIntegration;
