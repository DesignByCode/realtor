<?php

namespace DesignByCode\Realtor\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Phone
 * @package DesignByCode\Realtor\Models
 */
class Phone extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['type', 'phone'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
