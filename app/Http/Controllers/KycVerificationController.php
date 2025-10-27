<?php

namespace App\Http\Controllers;

use App\Models\KycVerification;
use App\Http\Requests\KycVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KycVerificationController extends Controller
{
    /**
     * Show the KYC verification form
     */
    public function create()
    {
        $user = auth()->user();

        // Check if user can submit KYC
        if (!in_array($user->role, ['agent', 'landlord'])) {
            abort(403, 'Only agents and landlords can submit KYC verification.');
        }

        // Check if already verified
        if ($user->is_verified) {
            return redirect()->route($user->role . '.dashboard')
                ->with('info', 'Your account is already verified.');
        }

        // Check if KYC already exists
        $existingKyc = $user->kycVerification;

        return view('kyc.create', compact('existingKyc'));
    }

    /**
     * Store KYC verification submission
     */
    public function store(KycVerificationRequest $request)
    {
        $user = auth()->user();

        // Check if user already has a pending/approved KYC
        $existingKyc = $user->kycVerification;
        if ($existingKyc && in_array($existingKyc->status, ['pending', 'under_review', 'approved'])) {
            return redirect()->route('kyc.status')
                ->with('error', 'You already have a KYC verification in progress.');
        }

        $data = $request->validated();

        // Handle file uploads
        $data['id_front_image'] = $this->uploadFile($request->file('id_front_image'), 'kyc/id_documents');
        $data['selfie_image'] = $this->uploadFile($request->file('selfie_image'), 'kyc/selfies');
        $data['proof_of_address_image'] = $this->uploadFile($request->file('proof_of_address_image'), 'kyc/proof_of_address');

        if ($request->hasFile('id_back_image')) {
            $data['id_back_image'] = $this->uploadFile($request->file('id_back_image'), 'kyc/id_documents');
        }

        // Agent-specific documents
        if ($user->isAgent() && $request->hasFile('professional_license_image')) {
            $data['professional_license_image'] = $this->uploadFile($request->file('professional_license_image'), 'kyc/licenses');
        }

        if ($request->hasFile('certification_documents')) {
            $certPaths = [];
            foreach ($request->file('certification_documents') as $file) {
                $certPaths[] = $this->uploadFile($file, 'kyc/certifications');
            }
            $data['certification_documents'] = $certPaths;
        }

        // Landlord-specific documents
        if ($user->isLandlord() && $request->hasFile('property_ownership_documents')) {
            $ownershipPaths = [];
            foreach ($request->file('property_ownership_documents') as $file) {
                $ownershipPaths[] = $this->uploadFile($file, 'kyc/property_ownership');
            }
            $data['property_ownership_documents'] = $ownershipPaths;
        }

        // Create or update KYC verification
        $data['user_id'] = $user->id;
        $data['status'] = 'pending';
        $data['submitted_at'] = now();

        if ($existingKyc) {
            // Delete old files before updating
            $this->deleteOldFiles($existingKyc);
            $existingKyc->update($data);
            $kyc = $existingKyc;
        } else {
            $kyc = KycVerification::create($data);
        }

        // Update user status
        $user->update([
            'verification_status' => 'pending',
        ]);

        return redirect()->route('kyc.status')
            ->with('success', 'Your KYC verification has been submitted successfully. We will review it within 24-48 hours.');
    }

    /**
     * Show KYC verification status
     */
    public function status()
    {
        $user = auth()->user();
        $kyc = $user->kycVerification;

        if (!$kyc) {
            return redirect()->route('kyc.create')
                ->with('info', 'Please submit your KYC verification first.');
        }

        return view('kyc.status', compact('kyc'));
    }

    /**
     * Upload file helper
     */
    private function uploadFile($file, $path)
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($path, $filename, 'public');
    }

    /**
     * Delete old files helper
     */
    private function deleteOldFiles($kyc)
    {
        $fields = [
            'id_front_image',
            'id_back_image',
            'selfie_image',
            'proof_of_address_image',
            'professional_license_image',
        ];

        foreach ($fields as $field) {
            if ($kyc->$field && Storage::disk('public')->exists($kyc->$field)) {
                Storage::disk('public')->delete($kyc->$field);
            }
        }

        // Delete array fields
        if ($kyc->certification_documents) {
            foreach ($kyc->certification_documents as $doc) {
                if (Storage::disk('public')->exists($doc)) {
                    Storage::disk('public')->delete($doc);
                }
            }
        }

        if ($kyc->property_ownership_documents) {
            foreach ($kyc->property_ownership_documents as $doc) {
                if (Storage::disk('public')->exists($doc)) {
                    Storage::disk('public')->delete($doc);
                }
            }
        }
    }
}
