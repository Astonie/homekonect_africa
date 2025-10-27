<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
        
        return view('landlord.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('landlord.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:apartment,house,condo,townhouse,studio,villa,commercial',
            'listing_type' => 'required|in:rent,sale',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|numeric|min:0',
            'square_feet' => 'required|integer|min:1',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'floors' => 'nullable|integer|min:1',
            'furnished' => 'required|boolean',
            'price' => 'required|numeric|min:0',
            'security_deposit' => 'nullable|numeric|min:0',
            'maintenance_fee' => 'nullable|numeric|min:0',
            'amenities' => 'nullable|array',
            'available_from' => 'nullable|date',
            'lease_duration' => 'nullable|integer',
            // Property documents
            'ownership_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'tax_receipt' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'insurance_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'building_permit' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'additional_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            // Images
            'images.*' => 'nullable|image|max:5120',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending'; // Pending until documents verified
        $validated['country'] = $validated['country'] ?? 'USA';

        // Handle property document uploads
        if ($request->hasFile('ownership_document')) {
            $validated['ownership_document'] = $request->file('ownership_document')->store('properties/documents', 'public');
        }
        if ($request->hasFile('tax_receipt')) {
            $validated['tax_receipt'] = $request->file('tax_receipt')->store('properties/documents', 'public');
        }
        if ($request->hasFile('insurance_document')) {
            $validated['insurance_document'] = $request->file('insurance_document')->store('properties/documents', 'public');
        }
        if ($request->hasFile('building_permit')) {
            $validated['building_permit'] = $request->file('building_permit')->store('properties/documents', 'public');
        }

        // Handle additional documents
        if ($request->hasFile('additional_documents')) {
            $additionalDocs = [];
            foreach ($request->file('additional_documents') as $file) {
                $additionalDocs[] = $file->store('properties/documents', 'public');
            }
            $validated['additional_documents'] = $additionalDocs;
        }

        // Handle images
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties/images', 'public');
                $images[] = Storage::url($path);
            }
            $validated['images'] = $images;
        }

        // Mark documents as submitted if any document was uploaded
        if ($request->hasFile('ownership_document') || $request->hasFile('tax_receipt')) {
            $validated['documents_submitted'] = true;
            $validated['documents_submitted_at'] = now();
        }

        $property = Property::create($validated);

        return redirect()->route('landlord.properties.index')
            ->with('success', 'Property created successfully! It will be available after admin verification.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        // Ensure user owns this property
        if ($property->user_id !== auth()->id()) {
            abort(403);
        }

        return view('landlord.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        // Ensure user owns this property
        if ($property->user_id !== auth()->id()) {
            abort(403);
        }

        return view('landlord.properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        // Ensure user owns this property
        if ($property->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:apartment,house,condo,townhouse,studio,villa,commercial',
            'listing_type' => 'required|in:rent,sale',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|numeric|min:0',
            'square_feet' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'furnished' => 'required|boolean',
            'amenities' => 'nullable|array',
        ]);

        $property->update($validated);

        return redirect()->route('landlord.properties.show', $property)
            ->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        // Ensure user owns this property
        if ($property->user_id !== auth()->id()) {
            abort(403);
        }

        $property->delete();

        return redirect()->route('landlord.properties.index')
            ->with('success', 'Property deleted successfully!');
    }
}
