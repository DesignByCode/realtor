<?php
namespace DesignByCode\Realtor\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Extra
 *
 * @package DesignByCode\Realtor\Models
 */
class Extra extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'has_this',
        'slug',
        'useable'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }





}
