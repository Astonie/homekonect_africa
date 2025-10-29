<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'bio',
        'is_verified',
        'verification_status',
        'verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
        ];
    }

    /**
     * Get the KYC verification for this user
     */
    public function kycVerification()
    {
        return $this->hasOne(KycVerification::class);
    }

    /**
     * Check if user needs KYC verification
     */
    public function needsKycVerification(): bool
    {
        return in_array($this->role, ['landlord', 'agent']) && !$this->is_verified;
    }

    /**
     * Check if user has submitted KYC
     */
    public function hasSubmittedKyc(): bool
    {
        return $this->kycVerification()->exists();
    }

    /**
     * Check if user's KYC is pending
     */
    public function kycIsPending(): bool
    {
        return $this->verification_status === 'pending';
    }

    /**
     * Check if user's KYC is verified
     */
    public function kycIsVerified(): bool
    {
        return $this->is_verified && $this->verification_status === 'verified';
    }

    /**
     * Check if user can list properties
     */
    public function canListProperties(): bool
    {
        if ($this->isTenant()) {
            return false;
        }

        if ($this->isAdmin()) {
            return true;
        }

        // Landlords and agents must be verified
        return $this->is_verified && $this->verification_status === 'verified';
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a tenant
     */
    public function isTenant(): bool
    {
        return $this->role === 'tenant';
    }

    /**
     * Check if user is a landlord
     */
    public function isLandlord(): bool
    {
        return $this->role === 'landlord';
    }

    /**
     * Check if user is an agent
     */
    public function isAgent(): bool
    {
        return $this->role === 'agent';
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
