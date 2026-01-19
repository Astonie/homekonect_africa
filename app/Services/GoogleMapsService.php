<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleMapsService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google_maps.api_key');
    }

    /**
     * Geocode an address to get latitude and longitude
     *
     * @param string $address
     * @return array|null
     */
    public function geocodeAddress(string $address): ?array
    {
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $address,
                'key' => $this->apiKey,
            ]);

            $data = $response->json();

            if ($data['status'] === 'OK' && !empty($data['results'])) {
                $result = $data['results'][0];
                
                return [
                    'latitude' => $result['geometry']['location']['lat'],
                    'longitude' => $result['geometry']['location']['lng'],
                    'formatted_address' => $result['formatted_address'],
                    'place_id' => $result['place_id'],
                    'address_components' => $result['address_components'],
                ];
            }

            return null;
        } catch (Exception $e) {
            Log::error('Geocoding error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Check Street View availability for a location
     */
    public function checkStreetViewAvailability(float $lat, float $lng): array
    {
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/streetview/metadata', [
                'location' => "{$lat},{$lng}",
                'key' => $this->apiKey,
            ]);

            $data = $response->json();

            return [
                'available' => $data['status'] === 'OK',
                'pano_id' => $data['pano_id'] ?? null,
                'location' => $data['location'] ?? null,
                'date' => $data['date'] ?? null,
            ];
        } catch (Exception $e) {
            Log::error('Street View check error: ' . $e->getMessage());
            return ['available' => false];
        }
    }

    /**
     * Get Street View image URL
     */
    public function getStreetViewImageUrl(float $lat, float $lng, array $options = []): string
    {
        $params = [
            'location' => "{$lat},{$lng}",
            'size' => $options['size'] ?? '600x400',
            'heading' => $options['heading'] ?? 0,
            'pitch' => $options['pitch'] ?? 0,
            'fov' => $options['fov'] ?? 90,
            'key' => $this->apiKey,
        ];

        return 'https://maps.googleapis.com/maps/api/streetview?' . http_build_query($params);
    }

    /**
     * Reverse geocode coordinates to get address
     *
     * @param float $latitude
     * @param float $longitude
     * @return array|null
     */
    public function reverseGeocode(float $latitude, float $longitude): ?array
    {
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'latlng' => "{$latitude},{$longitude}",
                'key' => $this->apiKey,
            ]);

            $data = $response->json();

            if ($data['status'] === 'OK' && !empty($data['results'])) {
                $result = $data['results'][0];
                
                return [
                    'formatted_address' => $result['formatted_address'],
                    'place_id' => $result['place_id'],
                    'address_components' => $result['address_components'],
                ];
            }

            return null;
        } catch (Exception $e) {
            Log::error('Reverse geocoding error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Check if Street View is available at location
     *
     * @param float $latitude
     * @param float $longitude
     * @return array|null
     */
    public function checkStreetViewAvailability(float $latitude, float $longitude): ?array
    {
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/streetview/metadata', [
                'location' => "{$latitude},{$longitude}",
                'key' => $this->apiKey,
            ]);

            $data = $response->json();

            if ($data['status'] === 'OK') {
                return [
                    'available' => true,
                    'pano_id' => $data['pano_id'] ?? null,
                    'location' => $data['location'] ?? null,
                    'date' => $data['date'] ?? null,
                ];
            }

            return ['available' => false];
        } catch (Exception $e) {
            Log::error('Street View check error: ' . $e->getMessage());
            return ['available' => false];
        }
    }

    /**
     * Get nearby places (POI)
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $radius Radius in meters
     * @param array $types Types of places to search for
     * @return array
     */
    public function getNearbyPlaces(float $latitude, float $longitude, int $radius = 2000, array $types = []): array
    {
        try {
            $params = [
                'location' => "{$latitude},{$longitude}",
                'radius' => $radius,
                'key' => $this->apiKey,
            ];

            if (!empty($types)) {
                $params['type'] = implode('|', $types);
            }

            $response = Http::get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', $params);

            $data = $response->json();

            if ($data['status'] === 'OK') {
                return array_map(function ($place) {
                    return [
                        'name' => $place['name'],
                        'place_id' => $place['place_id'],
                        'types' => $place['types'],
                        'vicinity' => $place['vicinity'] ?? '',
                        'rating' => $place['rating'] ?? null,
                        'latitude' => $place['geometry']['location']['lat'],
                        'longitude' => $place['geometry']['location']['lng'],
                    ];
                }, $data['results']);
            }

            return [];
        } catch (Exception $e) {
            Log::error('Nearby places error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get distance between two points
     *
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @param string $unit
     * @return array
     */
    public function getDistance(float $lat1, float $lon1, float $lat2, float $lon2, string $unit = 'metric'): array
    {
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins' => "{$lat1},{$lon1}",
                'destinations' => "{$lat2},{$lon2}",
                'units' => $unit,
                'key' => $this->apiKey,
            ]);

            $data = $response->json();

            if ($data['status'] === 'OK' && !empty($data['rows'])) {
                $element = $data['rows'][0]['elements'][0];
                
                if ($element['status'] === 'OK') {
                    return [
                        'distance' => $element['distance']['value'], // in meters
                        'distance_text' => $element['distance']['text'],
                        'duration' => $element['duration']['value'], // in seconds
                        'duration_text' => $element['duration']['text'],
                    ];
                }
            }

            return [];
        } catch (Exception $e) {
            Log::error('Distance calculation error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get static map image URL
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $zoom
     * @param string $size
     * @param string $mapType
     * @return string
     */
    public function getStaticMapUrl(
        float $latitude,
        float $longitude,
        int $zoom = 15,
        string $size = '600x400',
        string $mapType = 'roadmap'
    ): string {
        return sprintf(
            'https://maps.googleapis.com/maps/api/staticmap?center=%s,%s&zoom=%d&size=%s&maptype=%s&markers=color:red%%7C%s,%s&key=%s',
            $latitude,
            $longitude,
            $zoom,
            $size,
            $mapType,
            $latitude,
            $longitude,
            $this->apiKey
        );
    }

    /**
     * Get Street View static image URL
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $heading
     * @param int $pitch
     * @param int $fov
     * @param string $size
     * @return string
     */
    public function getStreetViewUrl(
        float $latitude,
        float $longitude,
        int $heading = 0,
        int $pitch = 0,
        int $fov = 90,
        string $size = '600x400'
    ): string {
        return sprintf(
            'https://maps.googleapis.com/maps/api/streetview?size=%s&location=%s,%s&heading=%d&pitch=%d&fov=%d&key=%s',
            $size,
            $latitude,
            $longitude,
            $heading,
            $pitch,
            $fov,
            $this->apiKey
        );
    }

    /**
     * Search for essential POIs near a property
     *
     * @param float $latitude
     * @param float $longitude
     * @return array
     */
    public function getEssentialPOIs(float $latitude, float $longitude): array
    {
        $poiTypes = [
            'school' => ['school', 'primary_school', 'secondary_school'],
            'hospital' => ['hospital', 'doctor', 'pharmacy'],
            'transport' => ['bus_station', 'train_station', 'subway_station'],
            'shopping' => ['supermarket', 'shopping_mall'],
            'restaurant' => ['restaurant', 'cafe'],
            'bank' => ['bank', 'atm'],
        ];

        $results = [];

        foreach ($poiTypes as $category => $types) {
            $places = $this->getNearbyPlaces($latitude, $longitude, 2000, $types);
            
            if (!empty($places)) {
                $results[$category] = array_slice($places, 0, 5); // Top 5 for each category
            }
        }

        return $results;
    }
}
