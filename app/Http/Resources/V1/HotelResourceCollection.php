<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HotelResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($hotel) {
            return [
                'id' => $hotel->id,
                'propertyId' => $hotel->property_id,
                'name' => $hotel->name ?? optional($hotel->property)->name,
                'description' => $hotel->description ?? optional($hotel->property)->description,
                'descriptionLicense' => $hotel->description_license ?? optional($hotel->property)->description_license,
                'rating' => $hotel->rating ?? optional($hotel->property)->rating,
                'facilities' => $hotel->facilities,
                'agency' => [
                    'agencyId' => $hotel->agency_id,
                    'name' => optional($hotel->agency)->name,
                ],
            ];
        })->toArray();
    }
}
