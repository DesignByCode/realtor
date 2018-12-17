<?php

namespace DesignByCode\Realtor\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Price
 *
 * @package DesignByCode\Realtor\Models
 */
class Price extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['property_id', 'selling_price', 'display_price', 'rates', 'levies'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'price_id');
    }
}
