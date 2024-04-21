<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id',
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
        'facilities' => 'json',
    ];

    /**
     * Mutator to format the rating attribute.
     *
     * @param  mixed  $value
     * @return string
     */
    public function getRatingAttribute($value)
    {
        return $value . ' stars';
    }

    /**
     * Define the relationship with the provider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * Define the relationship with hotels.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
