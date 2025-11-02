<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
        'is_read',
        'message_type',
        'attachment_path',
        'attachment_name',
        'attachment_type',
        'attachment_size',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Get the file size in human-readable format
     */
    public function getFormattedSizeAttribute(): string
    {
        if (!$this->attachment_size) return '';
        
        $bytes = $this->attachment_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if message has an attachment
     */
    public function hasAttachment(): bool
    {
        return $this->message_type === 'file' && !empty($this->attachment_path);
    }

    /**
     * Get the file icon based on mime type
     */
    public function getFileIcon(): string
    {
        if (!$this->attachment_type) return 'document';
        
        return match(true) {
            str_contains($this->attachment_type, 'pdf') => 'pdf',
            str_contains($this->attachment_type, 'word') || str_contains($this->attachment_type, 'doc') => 'word',
            str_contains($this->attachment_type, 'excel') || str_contains($this->attachment_type, 'sheet') => 'excel',
            str_contains($this->attachment_type, 'image') => 'image',
            str_contains($this->attachment_type, 'video') => 'video',
            str_contains($this->attachment_type, 'audio') => 'audio',
            str_contains($this->attachment_type, 'zip') || str_contains($this->attachment_type, 'rar') => 'archive',
            default => 'document'
        };
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
