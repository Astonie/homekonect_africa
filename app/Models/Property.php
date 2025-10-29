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
