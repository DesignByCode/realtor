<?php

namespace DesignByCode\Realtor\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Feature
 *
 * @package DesignByCode\Realtor\Models
 */
class Feature extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'bedrooms',
        'bathrooms',
        'dining_areas',
        'en_suites',
        'lounges',
        'storeys',
        'floor_area',
        'land_area',
        'garages',
        'covered_parking',
        'open_parking'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function properties()
    {
        return $this->belongsTo(Property::class);
    }

}
