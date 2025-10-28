<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'document_type',
        'file_path',
        'file_name',
        'file_size',
        'file_extension',
        'description',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    /**
     * Get the user (landlord) that owns the document.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if document is expired
     */
    public function isExpired()
    {
        if (!$this->expiry_date) {
            return false;
        }
        
        return $this->expiry_date < now();
    }

    /**
     * Get human-readable file size
     */
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get document type label
     */
    public function getDocumentTypeLabel()
    {
        $types = [
            'ownership_deed' => 'Ownership Deed',
            'tax_receipt' => 'Tax Receipt',
            'noc' => 'NOC (No Objection Certificate)',
            'insurance' => 'Insurance Document',
            'survey_plan' => 'Survey Plan',
            'building_approval' => 'Building Approval',
            'utility_bill' => 'Utility Bill',
            'lease_agreement' => 'Lease Agreement',
            'other' => 'Other Document',
        ];
        
        return $types[$this->document_type] ?? 'Unknown';
    }
}
