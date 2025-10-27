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

        return view('agent.dashboard');
    }
}
