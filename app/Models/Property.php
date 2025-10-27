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
        return '$' . number_format($this->price, 2);
    }

    /**
     * Get first image
     */
    public function getFirstImageAttribute()
    {
        return $this->images[0] ?? 'https://via.placeholder.com/800x600?text=No+Image';
    }

    /**
     * Increment views
     */
    public function incrementViews()
    {
        $this->increment('views');
    }
}
