<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use App\Models\User;
use App\Notifications\KYCVerifiedNotification;
use Illuminate\Http\Request;

class KycVerificationAdminController extends Controller
{
    /**
     * Display a listing of KYC verifications
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = KycVerification::with('user');

        if ($status !== 'all') {
            if ($status === 'pending') {
                $query->whereIn('status', ['pending', 'under_review']);
            } else {
                $query->where('status', $status);
            }
        }

        $verifications = $query->latest()->paginate(20);
        
        $stats = [
            'pending' => KycVerification::whereIn('status', ['pending', 'under_review'])->count(),
            'approved' => KycVerification::where('status', 'approved')->count(),
            'rejected' => KycVerification::where('status', 'rejected')->count(),
            'resubmission' => KycVerification::where('status', 'resubmission_required')->count(),
        ];

        return view('admin.kyc.index', compact('verifications', 'stats', 'status'));
    }

    /**
     * Display the specified KYC verification
     */
    public function show(KycVerification $kycVerification)
    {
        $kycVerification->load('user');
        return view('admin.kyc.show', compact('kycVerification'));
    }

    /**
     * Approve KYC verification
     */
    public function approve(KycVerification $kycVerification)
    {
        $kycVerification->update([
            'status' => 'approved',
            'verified_by' => auth()->id(),
            'reviewed_at' => now(),
            'verified_at' => now(),
            'rejection_reason' => null,
        ]);

        // Update user status
        $kycVerification->user->update([
            'is_verified' => true,
            'verification_status' => 'verified',
            'verified_at' => now(),
        ]);

        // Send email notification
        $kycVerification->user->notify(new KYCVerifiedNotification('verified'));

        return redirect()->route('admin.kyc.index')
            ->with('success', "KYC verification for {$kycVerification->user->name} has been approved.");
    }

    /**
     * Reject KYC verification
     */
    public function reject(Request $request, KycVerification $kycVerification)
    {
        $request->validate([
            'rejection_reason' => 'required|string|min:10|max:500',
            'require_resubmission' => 'boolean',
        ]);

        $status = $request->require_resubmission ? 'resubmission_required' : 'rejected';

        $kycVerification->update([
            'status' => $status,
            'verified_by' => auth()->id(),
            'reviewed_at' => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        // Update user status
        $kycVerification->user->update([
            'is_verified' => false,
            'verification_status' => 'rejected',
            'verified_at' => null,
        ]);

        // Send email notification
        $kycVerification->user->notify(new KYCVerifiedNotification('rejected'));

        return redirect()->route('admin.kyc.index')
            ->with('success', "KYC verification for {$kycVerification->user->name} has been rejected.");
    }

    /**
     * Update admin notes
     */
    public function updateNotes(Request $request, KycVerification $kycVerification)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $kycVerification->update([
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Notes updated successfully.');
    }

    /**
     * Mark as under review
     */
    public function markUnderReview(KycVerification $kycVerification)
    {
        $kycVerification->update([
            'status' => 'under_review',
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'KYC marked as under review.');
    }
}
