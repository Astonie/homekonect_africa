<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Auth::user()->clients()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('agent.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agent.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
            'type' => 'required|in:buyer,seller,tenant,landlord',
            'status' => 'required|in:active,inactive,archived',
            'notes' => 'nullable|string',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0',
            'preferred_location' => 'nullable|string|max:255',
            'property_type' => 'nullable|string|max:255',
        ]);

        $validated['agent_id'] = Auth::id();

        Client::create($validated);

        return redirect()->route('agent.clients.index')
            ->with('success', 'Client added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        // Ensure the client belongs to the authenticated agent
        if ($client->agent_id !== Auth::id()) {
            abort(403);
        }

        return view('agent.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        // Ensure the client belongs to the authenticated agent
        if ($client->agent_id !== Auth::id()) {
            abort(403);
        }

        return view('agent.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        // Ensure the client belongs to the authenticated agent
        if ($client->agent_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'type' => 'required|in:buyer,seller,tenant,landlord',
            'status' => 'required|in:active,inactive,archived',
            'notes' => 'nullable|string',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0',
            'preferred_location' => 'nullable|string|max:255',
            'property_type' => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return redirect()->route('agent.clients.index')
            ->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // Ensure the client belongs to the authenticated agent
        if ($client->agent_id !== Auth::id()) {
            abort(403);
        }

        $client->delete();

        return redirect()->route('agent.clients.index')
            ->with('success', 'Client deleted successfully!');
    }
}
