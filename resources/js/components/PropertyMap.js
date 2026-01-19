export class PropertyMap {
    constructor(elementId, options = {}) {
        this.container = document.getElementById(elementId);
        if (!this.container) return;

        this.options = {
            latitude: options.latitude,
            longitude: options.longitude,
            zoom: options.zoom || 15,
            mapType: options.mapType || 'roadmap', // roadmap, satellite, hybrid, terrain
            markers: options.markers || [],
            showStreetView: options.showStreetView !== false,
            draggable: options.draggable || false,
            ...options
        };

        this.map = null;
        this.marker = null;
        this.streetView = null;
        
        this.init();
    }

    async init() {
        await this.loadGoogleMaps();
        this.initMap();
        
        if (this.options.showStreetView) {
            this.initStreetView();
        }
    }

    async loadGoogleMaps() {
        if (window.google && window.google.maps) {
            return Promise.resolve();
        }

        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key=${this.options.apiKey}&libraries=places,geometry`;
            script.async = true;
            script.defer = true;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }

    initMap() {
        const center = {
            lat: parseFloat(this.options.latitude),
            lng: parseFloat(this.options.longitude)
        };

        this.map = new google.maps.Map(this.container, {
            center: center,
            zoom: this.options.zoom,
            mapTypeId: this.options.mapType,
            mapTypeControl: true,
            streetViewControl: this.options.showStreetView,
            fullscreenControl: true,
            zoomControl: true,
        });

        // Add marker
        this.marker = new google.maps.Marker({
            position: center,
            map: this.map,
            draggable: this.options.draggable,
            title: this.options.title || 'Property Location',
            animation: google.maps.Animation.DROP,
        });

        if (this.options.draggable) {
            this.marker.addListener('dragend', (event) => {
                this.onMarkerDragEnd(event.latLng);
            });
        }

        // Add info window
        if (this.options.infoContent) {
            const infoWindow = new google.maps.InfoWindow({
                content: this.options.infoContent
            });

            this.marker.addListener('click', () => {
                infoWindow.open(this.map, this.marker);
            });
        }

        // Add additional markers if provided
        this.addMarkers(this.options.markers);
    }

    initStreetView() {
        const position = {
            lat: parseFloat(this.options.latitude),
            lng: parseFloat(this.options.longitude)
        };

        const streetViewService = new google.maps.StreetViewService();
        
        streetViewService.getPanorama({
            location: position,
            radius: 50
        }, (data, status) => {
            if (status === google.maps.StreetViewStatus.OK) {
                this.streetView = this.map.getStreetView();
                this.streetView.setPosition(position);
                this.streetView.setPov({
                    heading: 34,
                    pitch: 10
                });
            }
        });
    }

    addMarkers(markers) {
        markers.forEach(markerData => {
            new google.maps.Marker({
                position: { lat: markerData.lat, lng: markerData.lng },
                map: this.map,
                title: markerData.title,
                icon: markerData.icon || null
            });
        });
    }

    onMarkerDragEnd(latLng) {
        if (this.options.onLocationChange) {
            this.options.onLocationChange({
                latitude: latLng.lat(),
                longitude: latLng.lng()
            });
        }
    }

    setMapType(type) {
        if (this.map) {
            this.map.setMapTypeId(type);
        }
    }

    toggleStreetView() {
        if (this.streetView) {
            const visible = this.streetView.getVisible();
            this.streetView.setVisible(!visible);
        }
    }

    destroy() {
        if (this.map) {
            google.maps.event.clearInstanceListeners(this.map);
            this.map = null;
        }
    }
}
