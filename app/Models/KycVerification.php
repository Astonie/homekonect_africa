<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KycVerification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'business_name',
        'license_number',
        'tax_id',
        'business_address',
        'id_type',
        'id_number',
        'id_front_image',
        'id_back_image',
        'selfie_image',
        'proof_of_address_type',
        'proof_of_address_image',
        'professional_license_image',
        'certification_documents',
        'property_ownership_documents',
        'status',
        'rejection_reason',
        'admin_notes',
        'verified_by',
        'submitted_at',
        'reviewed_at',
        'verified_at',
    ];

    protected $casts = [
        'certification_documents' => 'array',
        'property_ownership_documents' => 'array',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the user that owns the KYC verification
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who verified this KYC
     */
    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Check if KYC is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending' || $this->status === 'under_review';
    }

    /**
     * Check if KYC is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if KYC is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if resubmission is required
     */
    public function needsResubmission(): bool
    {
        return $this->status === 'resubmission_required';
    }

    /**
     * Scope to get pending verifications
     */
    public function scopePending($query)
    {
        return $query->whereIn('status', ['pending', 'under_review']);
    }

    /**
     * Scope to get approved verifications
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get rejected verifications
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
