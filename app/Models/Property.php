<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
           'currency_id',
        'title',
        'description',
        'type',
        'listing_type',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'square_feet',
        'year_built',
        'floors',
        'furnished',
        'price',
        'security_deposit',
        'maintenance_fee',
        'amenities',
        'images',
        'videos',
        'virtual_tour_url',
        'virtual_tour_type',
        'has_drone_imagery',
        'has_street_view',
        'street_view_metadata',
        'ownership_document',
        'tax_receipt',
        'insurance_document',
        'building_permit',
        'additional_documents',
        'documents_submitted',
        'documents_submitted_at',
        'verified_by',
        'verification_notes',
        'rejection_reason',
        'status',
        'available_from',
        'lease_duration',
        'slug',
        'views',
        'is_featured',
        'is_verified',
        'published_at',
        // GIS & Visualization Fields
        'google_place_id',
        'street_view_available',
        'street_view_heading',
        'street_view_pitch',
        'street_view_zoom',
        'matterport_url',
        '360_tour_provider',
        '360_tour_data',
        'drone_images',
        'drone_videos',
        'aerial_view_url',
        'map_zoom_level',
        'map_type',
        'floor_plans',
        '3d_model_url',
        'featured_image_index',
        'has_video_tour',
        'has_360_tour',
        'has_drone_footage',
        'nearby_poi',
    ];

    protected $casts = [
        'amenities' => 'array',
        'images' => 'array',
        'videos' => 'array',
        'additional_documents' => 'array',
        'available_from' => 'date',
        'published_at' => 'datetime',
        'documents_submitted_at' => 'datetime',
        'furnished' => 'boolean',
        'is_featured' => 'boolean',
        'is_verified' => 'boolean',
        'documents_submitted' => 'boolean',
        'price' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'maintenance_fee' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        // GIS & Visualization Casts
        '360_tour_data' => 'array',
        'drone_images' => 'array',
        'drone_videos' => 'array',
        'floor_plans' => 'array',
        'nearby_poi' => 'array',
        'street_view_available' => 'boolean',
        'street_view_heading' => 'decimal:2',
        'street_view_pitch' => 'decimal:2',
        'has_video_tour' => 'boolean',
        'has_360_tour' => 'boolean',
        'has_drone_footage' => 'boolean',
    ];

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title) . '-' . Str::random(6);
            }
        });
    }

    /**
     * Get the owner of the property (primary relationship)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Alias for user relationship
     */
    public function owner(): BelongsTo
    {
        return $this->user();
    }

    /**
     * Get the admin who verified the property
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Get all media for this property
     */
    public function media()
    {
        return $this->hasMany(PropertyMedia::class)->orderBy('display_order');
    }

    /**
     * Get cover image media
     */
    public function coverImage()
    {
        return $this->hasOne(PropertyMedia::class)->where('is_cover', true);
    }

    /**
     * Get all images
     */
    public function allImages()
    {
        return $this->hasMany(PropertyMedia::class)
            ->whereIn('type', ['image', 'drone_image'])
            ->orderBy('display_order');
    }

    /**
     * Get all videos
     */
    public function allVideos()
    {
        return $this->hasMany(PropertyMedia::class)
            ->whereIn('type', ['video', 'drone_video'])
            ->orderBy('display_order');
    }

    /**
     * Get floor plans
     */
    public function floorPlanMedia()
    {
        return $this->hasMany(PropertyMedia::class)
            ->where('type', 'floor_plan')
            ->orderBy('display_order');
    }

       /**
        * Get the currency for the property
        */
       public function currency(): BelongsTo
       {
           return $this->belongsTo(Currency::class);
       }

    /**
     * Scope for available properties
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope for verified properties
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope for featured properties
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for rent properties
     */
    public function scopeForRent($query)
    {
        return $query->where('listing_type', 'rent');
    }

    /**
     * Scope for sale properties
     */
    public function scopeForSale($query)
    {
        return $query->where('listing_type', 'sale');
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
           $symbol = $this->currency ? $this->currency->symbol : '$';
           return $symbol . ' ' . number_format((float) $this->price, 2);
    }

    /**
     * Get first image
     */
    public function getFirstImageAttribute()
    {
        if (!$this->images || !is_array($this->images) || count($this->images) === 0) {
            return 'https://via.placeholder.com/800x600?text=No+Image';
        }

        // Check if new format (with 'path' and 'is_featured' keys)
        $firstItem = $this->images[0];
        if (is_array($firstItem) && isset($firstItem['path'])) {
            // New format - find featured image
            $featured = collect($this->images)->firstWhere('is_featured', true);
            return $featured ? $featured['path'] : $this->images[0]['path'];
        }

        // Old format - simple URL string
        return is_string($firstItem) ? $firstItem : 'https://via.placeholder.com/800x600?text=No+Image';
    }

    /**
     * Get featured image
     */
    public function getFeaturedImageAttribute()
    {
        if (!$this->images || !is_array($this->images) || count($this->images) === 0) {
            return 'https://via.placeholder.com/800x600?text=No+Image';
        }

        // Check if new format (with 'path' and 'is_featured' keys)
        $firstItem = $this->images[0];
        if (is_array($firstItem) && isset($firstItem['path'])) {
            // New format - find featured image
            $featured = collect($this->images)->firstWhere('is_featured', true);
            return $featured ? $featured['path'] : $this->images[0]['path'];
        }

        // Old format - return first image
        return is_string($firstItem) ? $firstItem : 'https://via.placeholder.com/800x600?text=No+Image';
    }

    /**
     * Increment views
     */
    public function incrementViews()
    {
        $this->increment('views');
    }
}
