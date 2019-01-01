<?php

namespace DesignByCode\Realtor\Http\Filters\Properties;

use DesignByCode\Realtor\Http\Filters\FilterAbstact;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PropertiesUsersFilter
 *
 * @package \DesignByCode\Realtor\Http\Filters\Properties
 */
class PropertiesUsersFilter extends FilterAbstact
{

    public function filter(Builder $builder, $value)
    {
        return $builder->whereHas('users', function($query) use ($value) {
            $query->where('name' , $value);
        });
    }
}
