<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PropertyMedia extends Model
{
    protected $fillable = [
        'property_id',
        'type',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'width',
        'height',
        'duration',
        'thumbnail_path',
        'display_order',
        'is_featured',
        'is_cover',
        'title',
        'description',
        'caption',
        'tags',
        'room_type',
        'view_type',
        'is_360',
        'exif_data',
        'processing_status',
        'processing_error',
    ];

    protected $casts = [
        'tags' => 'array',
        'exif_data' => 'array',
        'is_featured' => 'boolean',
        'is_cover' => 'boolean',
        'is_360' => 'boolean',
        'file_size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'duration' => 'integer',
        'display_order' => 'integer',
    ];

    /**
     * Get the property that owns this media
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the full URL for the media file
     */
    public function getUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    /**
     * Get the full URL for the thumbnail
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail_path ? Storage::url($this->thumbnail_path) : null;
    }

    /**
     * Get human-readable file size
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Scope for images only
     */
    public function scopeImages($query)
    {
        return $query->whereIn('type', ['image', 'drone_image']);
    }

    /**
     * Scope for videos only
     */
    public function scopeVideos($query)
    {
        return $query->whereIn('type', ['video', 'drone_video']);
    }

    /**
     * Scope for 360 photos
     */
    public function scope360Photos($query)
    {
        return $query->where('is_360', true);
    }

    /**
     * Scope for featured media
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Check if this is an image type
     */
    public function isImage(): bool
    {
        return in_array($this->type, ['image', 'drone_image', 'floor_plan', '360_photo']);
    }

    /**
     * Check if this is a video type
     */
    public function isVideo(): bool
    {
        return in_array($this->type, ['video', 'drone_video']);
    }

    /**
     * Delete media file when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($media) {
            // Delete the main file
            if (Storage::exists($media->file_path)) {
                Storage::delete($media->file_path);
            }
            
            // Delete the thumbnail if exists
            if ($media->thumbnail_path && Storage::exists($media->thumbnail_path)) {
                Storage::delete($media->thumbnail_path);
            }
        });
    }
}
