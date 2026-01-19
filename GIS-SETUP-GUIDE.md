# GIS Features Setup Guide

## Overview
Enhanced property visualization with 3D tours, Street View, and high-quality media galleries for HomeKonnect.

## Features Added
✅ **High-Quality Media Gallery** - Photos, videos, drone imagery with Swiper.js
✅ **3D Virtual Tours** - Matterport, Kuula, YouTube integration
✅ **Google Maps Integration** - Interactive maps with Street View
✅ **Drone Imagery Support** - Aerial photography and videos
✅ **360° Panoramas** - Immersive property viewing

## Installation Steps

### 1. Update .env File
```bash
GOOGLE_MAPS_API_KEY=your_google_maps_api_key_here
GOOGLE_STREET_VIEW_ENABLED=true
MATTERPORT_ENABLED=false
MATTERPORT_API_KEY=your_matterport_key_if_needed
```

### 2. Install Dependencies
```bash
npm install
```

### 3. Run Migrations
```bash
php artisan migrate
```

### 4. Build Assets
```bash
npm run build
```

## Google Maps API Setup

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing
3. Enable these APIs:
   - Maps JavaScript API
   - Street View Static API
   - Geocoding API
   - Places API
4. Create API Key and add to `.env`
5. Set API restrictions (optional but recommended):
   - HTTP referrers for your domain
   - API restrictions to only enabled APIs

## Usage Examples

### 1. Property Gallery Component
```blade
<x-property-gallery 
    :property="$property" 
    :media="$property->media"
    :property-id="$property->id"
    :show-thumbnails="true"
/>
```

### 2. Initialize Gallery in JavaScript
```javascript
const gallery = new PropertyGallery('property-gallery-1', {
    propertyId: 1,
    latitude: -1.286389,
    longitude: 36.817223,
    virtualTourUrl: 'https://my.matterport.com/show/?m=xxx',
    enableStreetView: true,
    enableVirtualTour: true,
    autoplay: false
});
```

### 3. Initialize Map
```javascript
const map = new PropertyMap('property-map', {
    latitude: -1.286389,
    longitude: 36.817223,
    apiKey: 'YOUR_API_KEY',
    zoom: 15,
    mapType: 'satellite', // roadmap, satellite, hybrid, terrain
    showStreetView: true,
    draggable: false
});
```

### 4. Upload Media with Media Type
```php
// In your controller
$property->media()->create([
    'file_path' => $path,
    'media_type' => 'drone', // photo, video, drone, panorama
    'order' => 0,
    'is_featured' => true,
    'metadata' => json_encode([
        'altitude' => '120m',
        'camera' => 'DJI Mavic 3'
    ])
]);
```

### 5. Add Virtual Tour URL
```php
$property->update([
    'virtual_tour_url' => 'https://my.matterport.com/show/?m=xxx',
    'virtual_tour_type' => 'matterport',
    'has_street_view' => true,
    'has_drone_imagery' => true
]);
```

## Supported Virtual Tour Platforms

- **Matterport** - `https://my.matterport.com/show/?m=xxx`
- **Kuula** - `https://kuula.co/share/xxx`
- **YouTube 360** - `https://youtube.com/watch?v=xxx`
- **Generic iframes** - Any embeddable URL

## API Routes

```php
// Upload media
POST /properties/{property}/media/upload

// Delete media
DELETE /properties/{property}/media/{media}

// Update media order
PATCH /properties/{property}/media/{media}/order

// Set featured image
PATCH /properties/{property}/media/{media}/featured
```

## Configuration

Edit `config/gis.php` for:
- Google Maps settings
- Virtual tour providers
- Media upload limits
- Thumbnail sizes
- Geocoding options

## Testing

```bash
# Test migration
php artisan migrate:status

# Check routes
php artisan route:list | grep media

# Build assets
npm run build

# Development mode
npm run dev
```

## Frontend Dependencies

- **Swiper** - Touch slider for galleries
- **GLightbox** - Lightbox for images/videos
- **Google Maps API** - Map integration
- **Video.js** - Video player (optional)

## Database Schema

### Properties Table (New Fields)
- `virtual_tour_url` - URL to 3D tour
- `virtual_tour_type` - matterport, kuula, youtube, etc.
- `has_drone_imagery` - Boolean flag
- `has_street_view` - Boolean flag
- `street_view_metadata` - JSON data

### Property Media Table (New Fields)
- `media_type` - photo, video, drone, panorama
- `order` - Display order
- `is_featured` - Featured image flag
- `metadata` - JSON metadata (camera, altitude, etc.)

## Performance Tips

1. **Lazy load images** - Only load visible images
2. **Optimize images** - Use WebP format where possible
3. **Cache Street View checks** - Results cached for 24h
4. **Use CDN** - For media files
5. **Compress videos** - Use H.264 codec

## Troubleshooting

**Maps not loading?**
- Check API key in `.env`
- Verify APIs enabled in Google Cloud Console
- Check browser console for errors

**Virtual tours not embedding?**
- Verify URL format is correct
- Check iframe restrictions
- Test URL directly in browser

**Images not uploading?**
- Check file permissions on storage folder
- Verify `max_upload_size` in php.ini
- Check disk space

## Next Steps

1. ✅ Install and test basic functionality
2. Add your Google Maps API key
3. Upload sample drone imagery
4. Test virtual tour embedding
5. Configure media upload limits
6. Customize gallery appearance
7. Add Street View to property pages

## Support

For issues or questions:
- Check Laravel logs: `storage/logs/laravel.log`
- Check browser console for JavaScript errors
- Verify all migrations ran successfully
- Test with sample data first
