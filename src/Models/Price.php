<?php

namespace DesignByCode\Realtor\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['selling_price', 'display_price', 'rates', 'levies'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
