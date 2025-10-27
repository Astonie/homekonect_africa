<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantDashboardController extends Controller
{
    public function index()
    {
        // Check if user is tenant
        if (auth()->user()->role !== 'tenant') {
            abort(403, 'Unauthorized access.');
        }

        return view('tenant.dashboard');
    }
}
