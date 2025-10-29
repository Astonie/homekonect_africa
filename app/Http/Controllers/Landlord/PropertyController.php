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
        $user = auth()->user();
        if (!$user->canListProperties()) {
            $route = $user->kycVerification ? 'kyc.status' : 'kyc.create';
            return redirect()->route($route)
                ->with('error', 'You must complete and verify KYC before listing properties.');
        }

        return view('landlord.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user->canListProperties()) {
            $route = $user->kycVerification ? 'kyc.status' : 'kyc.create';
            return redirect()->route($route)
                ->with('error', 'You must complete and verify KYC before listing properties.');
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
            'currency_id' => 'required|exists:currencies,id',
            // Property documents
            'ownership_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'tax_receipt' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'insurance_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'building_permit' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'additional_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            // Multi-image upload handled below
            'property_images' => 'required|array|min:1',
            'property_images.*.file' => 'required|string',
            'property_images.*.is_featured' => 'required|in:0,1',
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

        // Handle images from base64 (from Alpine.js)
        $images = [];
        foreach ($request->input('property_images', []) as $img) {
            if (isset($img['file']) && strpos($img['file'], 'data:image') === 0) {
                $imageData = $img['file'];
                $image = str_replace(' ', '+', $imageData);
                $image_parts = explode(';base64,', $image);
                $image_type_aux = explode('image/', $image_parts[0]);
                $image_type = $image_type_aux[1] ?? 'png';
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = 'properties/images/' . uniqid() . '.' . $image_type;
                Storage::disk('public')->put($fileName, $image_base64);
                $images[] = [
                    'path' => Storage::url($fileName),
                    'is_featured' => $img['is_featured'] == '1',
                ];
            }
        }
        $validated['images'] = $images;

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
            'currency_id' => 'nullable|exists:currencies,id',
            'delete_images' => 'nullable|array',
            'new_property_images' => 'nullable|array',
            'new_property_images.*.file' => 'nullable|string',
            'new_property_images.*.is_featured' => 'nullable|in:0,1',
        ]);

        // Handle image deletions
        if ($request->has('delete_images')) {
            $currentImages = $property->images ?? [];
            $deleteIndices = $request->input('delete_images');
            
            // Remove deleted images from array
            foreach ($deleteIndices as $index) {
                if (isset($currentImages[$index])) {
                    // Delete physical file if it exists
                    $imagePath = is_array($currentImages[$index]) ? 
                        ($currentImages[$index]['path'] ?? $currentImages[$index]) : 
                        $currentImages[$index];
                    
                    if (str_starts_with($imagePath, '/storage/')) {
                        $filePath = str_replace('/storage/', '', $imagePath);
                        Storage::disk('public')->delete($filePath);
                    }
                    
                    unset($currentImages[$index]);
                }
            }
            
            // Reindex array
            $validated['images'] = array_values($currentImages);
        }

        // Handle new images
        if ($request->has('new_property_images')) {
            $currentImages = $property->images ?? [];
            
            foreach ($request->input('new_property_images', []) as $img) {
                if (isset($img['file']) && strpos($img['file'], 'data:image') === 0) {
                    $imageData = $img['file'];
                    $image = str_replace(' ', '+', $imageData);
                    $image_parts = explode(';base64,', $image);
                    $image_type_aux = explode('image/', $image_parts[0]);
                    $image_type = $image_type_aux[1] ?? 'png';
                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = 'properties/images/' . uniqid() . '.' . $image_type;
                    Storage::disk('public')->put($fileName, $image_base64);
                    
                    $currentImages[] = [
                        'path' => Storage::url($fileName),
                        'is_featured' => $img['is_featured'] == '1',
                    ];
                }
            }
            
            $validated['images'] = $currentImages;
        }

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
