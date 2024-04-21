<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'propertyId' => $this->property_id,
            'name' => $this->name,
            'description' => $this->description,
            'descriptionLicense' => $this->description_license,
            'rating' => $this->rating,
            'facilities' => $this->facilities,
            'agency' => [
                'agencyId' => $this->agency_id,
                'name' => optional($this->agency)->name,
            ],
        ];
    }
}
