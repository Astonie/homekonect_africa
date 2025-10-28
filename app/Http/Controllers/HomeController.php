<?php

namespace App\Http\Controllers;

use App\Models\{Property, TeamMember};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with featured properties
     */
    public function index(Request $request)
    {
        $query = Property::with('owner')
            ->where('status', 'available')
            ->where('is_verified', true);

        // Apply filters if provided
        $this->applyFilters($query, $request);

        $properties = $query->latest('published_at')
            ->take(6)
            ->get();

        $teamMembers = TeamMember::active()->ordered()->get();

        return view('welcome', compact('properties', 'teamMembers'));
    }

    /**
     * Display all available properties with pagination
     */
    public function properties(Request $request)
    {
        $query = Property::with('owner')
            ->where('status', 'available')
            ->where('is_verified', true);

        // Apply filters if provided
        $this->applyFilters($query, $request);

        $properties = $query->latest('published_at')
            ->paginate(12);

        return view('properties', compact('properties'));
    }

    /**
     * Display property details with similar properties
     */
    public function showProperty(Property $property)
    {
        // Ensure property is available and verified
        if ($property->status !== 'available' || !$property->is_verified) {
            abort(404);
        }

        // Increment views
        $property->incrementViews();

        // Get similar properties based on multiple criteria with minimum 3 properties
        $similarProperties = $this->getSimilarProperties($property);

        return view('property.details', compact('property', 'similarProperties'));
    }

    /**
     * Get similar properties for a given property
     * Returns exactly 4 properties
     */
    private function getSimilarProperties(Property $property)
    {
        // First, try to get properties with weighted scoring
        $similarProperties = Property::with('owner')
            ->where('status', 'available')
            ->where('is_verified', true)
            ->where('id', '!=', $property->id)
            ->where(function ($query) use ($property) {
                $query->where('city', $property->city)
                      ->orWhere('type', $property->type)
                      ->orWhere('listing_type', $property->listing_type);
            })
            ->orderByRaw("
                (CASE WHEN city = ? THEN 3 ELSE 0 END) +
                (CASE WHEN type = ? THEN 2 ELSE 0 END) +
                (CASE WHEN listing_type = ? THEN 1 ELSE 0 END) DESC
            ", [$property->city, $property->type, $property->listing_type])
            ->limit(4)
            ->get();

        // If we don't have enough similar properties, fill with other available properties
        if ($similarProperties->count() < 4) {
            $existingIds = $similarProperties->pluck('id')->push($property->id);

            $additionalProperties = Property::with('owner')
                ->where('status', 'available')
                ->where('is_verified', true)
                ->whereNotIn('id', $existingIds)
                ->latest('published_at')
                ->take(4 - $similarProperties->count())
                ->get();

            $similarProperties = $similarProperties->merge($additionalProperties);
        }

        return $similarProperties;
    }

    /**
     * Apply filters to the property query
     */
    private function applyFilters($query, Request $request)
    {
        // Location filter (search in city, state, or address)
        if ($request->filled('location')) {
            $location = $request->location;
            $query->where(function ($q) use ($location) {
                $q->where('city', 'like', '%' . $location . '%')
                  ->orWhere('state', 'like', '%' . $location . '%')
                  ->orWhere('address', 'like', '%' . $location . '%');
            });
        }

        // Property type filter
        if ($request->filled('property_type') && $request->property_type !== 'All Types') {
            $query->where('type', $request->property_type);
        }

        // Price range filter
        if ($request->filled('price_range') && $request->price_range !== 'Any Price') {
            $this->applyPriceFilter($query, $request->price_range);
        }

        // Bedrooms filter
        if ($request->filled('bedrooms') && $request->bedrooms !== 'Any') {
            $bedroomCount = (int) $request->bedrooms;
            $query->where('bedrooms', '>=', $bedroomCount);
        }
    }

    /**
     * Apply price range filter
     */
    private function applyPriceFilter($query, $priceRange)
    {
        switch ($priceRange) {
            case '$0 - $200k':
                $query->where('price', '<=', 200000);
                break;
            case '$200k - $500k':
                $query->whereBetween('price', [200000, 500000]);
                break;
            case '$500k - $1M':
                $query->whereBetween('price', [500000, 1000000]);
                break;
            case '$1M - $2M':
                $query->whereBetween('price', [1000000, 2000000]);
                break;
            case '$2M+':
                $query->where('price', '>=', 2000000);
                break;
        }
    }
}