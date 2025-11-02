<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentDashboardController extends Controller
{
    public function index()
    {
        // Check if user is agent
        if (auth()->user()->role !== 'agent') {
            abort(403, 'Unauthorized access.');
        }

        $stats = [
            'total_clients' => auth()->user()->clients()->count(),
            'active_clients' => auth()->user()->clients()->where('status', 'active')->count(),
            'properties_listed' => auth()->user()->properties()->count(),
            'deals_closed' => 0, // To be implemented
        ];

        return view('agent.dashboard', compact('stats'));
    }
}
