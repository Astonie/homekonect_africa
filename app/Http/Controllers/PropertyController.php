<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of available properties
     */
    public function index(Request $request)
    {
        $query = Property::with('owner')
            ->where('status', 'available')
            ->where('is_verified', true);

        // Property Type Filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Listing Type Filter
        if ($request->filled('listing_type')) {
            $query->where('listing_type', $request->listing_type);
        }

        // Location Filters
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }

        // Price Range Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Bedrooms Filter
        if ($request->filled('bedrooms')) {
            if ($request->bedrooms >= 4) {
                $query->where('bedrooms', '>=', 4);
            } else {
                $query->where('bedrooms', $request->bedrooms);
            }
        }

        // Bathrooms Filter
        if ($request->filled('bathrooms')) {
            if ($request->bathrooms >= 4) {
                $query->where('bathrooms', '>=', 4);
            } else {
                $query->where('bathrooms', $request->bathrooms);
            }
        }

        // Square Footage Filter
        if ($request->filled('min_sqft')) {
            $query->where('square_feet', '>=', $request->min_sqft);
        }

        // Amenities Filters
        if ($request->filled('furnished')) {
            $query->where('furnished', true);
        }

        if ($request->filled('parking')) {
            $query->whereJsonContains('amenities', 'Parking');
        }

        if ($request->filled('pool')) {
            $query->whereJsonContains('amenities', 'Swimming Pool');
        }

        if ($request->filled('gym')) {
            $query->whereJsonContains('amenities', 'Gym');
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'sqft_large':
                $query->orderBy('square_feet', 'desc');
                break;
            case 'newest':
            default:
                $query->latest('published_at');
                break;
        }

        $properties = $query->paginate(12)->withQueryString();

        return view('properties.index', compact('properties'));
    }

    /**
     * Display the specified property
     */
    public function show($slug)
    {
        $property = Property::with(['owner', 'verifier'])
            ->where('slug', $slug)
            ->where('is_verified', true)
            ->firstOrFail();

        // Increment view count
        $property->incrementViews();

        // Get similar properties
        $similarProperties = Property::with('owner')
            ->where('id', '!=', $property->id)
            ->where('type', $property->type)
            ->where('is_verified', true)
            ->where('status', 'available')
            ->where('city', $property->city)
            ->take(3)
            ->get();

        return view('properties.show', compact('property', 'similarProperties'));
    }
}
