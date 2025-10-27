<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandlordDashboardController extends Controller
{
    public function index()
    {
        // Check if user is landlord
        if (auth()->user()->role !== 'landlord') {
            abort(403, 'Unauthorized access.');
        }

        return view('landlord.dashboard');
    }
}
