<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureKycVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Only check for agents and landlords
        if (!in_array($user->role, ['agent', 'landlord'])) {
            return $next($request);
        }

        // Require email verification first
        if (! $user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice')
                ->with('error', 'Please verify your email address first.');
        }

        // If user is not KYC verified
        if (!($user->is_verified && $user->verification_status === 'verified')) {
            // Check if KYC has been submitted
            $kyc = $user->kycVerification;

            if (!$kyc) {
                // No KYC submitted - redirect to KYC form
                return redirect()->route('kyc.create')
                    ->with('warning', 'Please complete your KYC verification to access this feature.');
            }

            if (method_exists($kyc, 'isPending') && $kyc->isPending()) {
                // KYC is pending - show status page
                return redirect()->route('kyc.status')
                    ->with('info', 'Your KYC verification is under review. You will be notified once approved.');
            }

            if ((method_exists($kyc, 'isRejected') && $kyc->isRejected()) || (method_exists($kyc, 'needsResubmission') && $kyc->needsResubmission())) {
                // KYC was rejected - redirect to resubmit
                return redirect()->route('kyc.create')
                    ->with('error', 'Your KYC verification was rejected. Please review the feedback and resubmit.');
            }

            // Fallback to status if state is unknown
            return redirect()->route('kyc.status')
                ->with('info', 'Your KYC status is being reviewed.');
        }

        return $next($request);
    }
}
