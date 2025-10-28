<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class LandlordDashboardController extends Controller
{
    public function index()
    {
        // Check if user is landlord
        if (auth()->user()->role !== 'landlord') {
            abort(403, 'Unauthorized access.');
        }

        // Get landlord's properties and stats
        $properties = Property::where('user_id', auth()->id())->get();
        
        $stats = [
            'total' => $properties->count(),
            'available' => $properties->where('status', 'available')->count(),
            'rented' => $properties->where('status', 'rented')->count(),
            'pending' => $properties->where('status', 'pending')->count(),
        ];

        return view('landlord.dashboard', compact('stats'));
    }
}
