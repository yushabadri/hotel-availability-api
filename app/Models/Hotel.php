<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id',
        'agency_id',
        'name',
        'description',
        'description_license',
        'address',
        'rating',
        'facilities',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'rating' => 'string',
        'facilities' => 'json',
    ];

    /**
     * Mutator to format the rating attribute.
     *
     * @param  mixed  $value
     * @return string|null
     */
    public function getRatingAttribute($value)
    {
        return $value ? $value . ' stars' : null;
    }

    /**
     * Define the relationship with the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Define the relationship with the agency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
