<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use App\Models\KycVerification;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_properties' => Property::count(),
            'active_listings' => Property::where('status', 'available')->count(),
            'pending_kyc' => KycVerification::whereIn('status', ['pending', 'under_review'])->count(),
            'verified_landlords' => User::where('role', 'landlord')->where('is_verified', true)->count(),
            'verified_agents' => User::where('role', 'agent')->where('is_verified', true)->count(),
        ];
        
        // Get recent properties
        $recent_properties = Property::with('owner')
            ->latest()
            ->take(5)
            ->get();
        
        // Get pending KYC verifications
        $pending_kyc = KycVerification::with('user')
            ->whereIn('status', ['pending', 'under_review'])
            ->latest()
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact('stats', 'recent_properties', 'pending_kyc'));
    }
}