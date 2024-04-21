<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Models\Hotel;
use App\Models\Property;

class HotelService
{
    /**
     * Create hotels associated with the given agency ID.
     *
     * @param int $agencyId
     * @param array $hotelData
     * @return array
     */
    public function createHotelsByAgencyId($agencyId, $hotelData)
    {
        // Create hotels using the provided data and show flag
        $hotelData['agency_id'] = $agencyId;
        $hotel = Hotel::create($hotelData);
        
        return $hotel;
    }

    /**
     * return list of hotels associated with the user's agency.
     *
     * 
     * @param int|null $agencyId
     *
     * @return JsonResponse
     */
    public static function getHotelsByAgencyId($agencyId)
    {
        if ($agencyId === null) {
            // If agency ID is NULL, return an empty collection
            return collect();
        }
    
        // Find the hotels within the current agency of the user
        $hotels = Hotel::where('agency_id', $agencyId)->get();
        
        return $hotels;
    }
}
