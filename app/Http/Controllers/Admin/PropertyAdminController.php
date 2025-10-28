<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Notifications\PropertyApprovedNotification;
use App\Notifications\PropertyRejectedNotification;
use Illuminate\Http\Request;

class PropertyAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with(['user', 'verifier'])
            ->latest();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by document submission status
        if ($request->has('docs') && $request->docs !== '') {
            if ($request->docs === 'submitted') {
                $query->where('documents_submitted', true);
            } elseif ($request->docs === 'not_submitted') {
                $query->where('documents_submitted', false);
            }
        }

        // Filter by verification status
        if ($request->has('verified') && $request->verified !== '') {
            $query->where('is_verified', $request->verified === 'yes');
        }

        $properties = $query->paginate(20);

        // Calculate stats
        $stats = [
            'total' => Property::count(),
            'pending' => Property::where('status', 'pending')->count(),
            'verified' => Property::where('is_verified', true)->count(),
            'docs_submitted' => Property::where('documents_submitted', true)->where('is_verified', false)->count(),
            'rejected' => Property::where('status', 'inactive')->where('rejection_reason', '!=', null)->count(),
        ];

        return view('admin.properties.index', compact('properties', 'stats'));
    }

    public function show(Property $property)
    {
        $property->load(['user', 'verifier']);
        return view('admin.properties.show', compact('property'));
    }

    public function verify(Request $request, Property $property)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $property->update([
            'is_verified' => true,
            'status' => 'available',
            'verified_by' => auth()->id(),
            'verification_notes' => $request->notes,
            'rejection_reason' => null,
        ]);

        // Send email notification to property owner
        $property->user->notify(new PropertyApprovedNotification($property));

        return redirect()->route('admin.properties.show', $property)
            ->with('success', 'Property has been verified successfully and is now available for listing.');
    }

    public function reject(Request $request, Property $property)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $property->update([
            'is_verified' => false,
            'status' => 'inactive',
            'verified_by' => auth()->id(),
            'rejection_reason' => $request->reason,
        ]);

        // Send email notification to property owner
        $property->user->notify(new PropertyRejectedNotification($property, $request->reason));

        return redirect()->route('admin.properties.show', $property)
            ->with('success', 'Property has been rejected.');
    }

    public function updateNotes(Request $request, Property $property)
    {
        $request->validate([
            'notes' => 'required|string|max:1000',
        ]);

        $property->update([
            'verification_notes' => $request->notes,
            'verified_by' => auth()->id(),
        ]);

        return redirect()->route('admin.properties.show', $property)
            ->with('success', 'Verification notes have been updated.');
    }
}
