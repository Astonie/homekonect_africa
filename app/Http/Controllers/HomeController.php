<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with featured properties
     */
    public function index()
    {
        $properties = Property::with('owner')
            ->where('status', 'available')
            ->where('is_verified', true)
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('welcome', compact('properties'));
    }

    /**
     * Display all available properties with pagination
     */
    public function properties()
    {
        $properties = Property::with('owner')
            ->where('status', 'available')
            ->where('is_verified', true)
            ->latest('published_at')
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
}