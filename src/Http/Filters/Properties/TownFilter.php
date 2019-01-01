<?php

namespace DesignByCode\Realtor\Http\Filters\Properties;

use DesignByCode\Realtor\Http\Filters\FilterAbstact;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ReferenceFilter
 *
 * @package \DesignByCode\Realtor\Http\Filters\Properties
 */
class TownFilter extends FilterAbstact
{

    public function filter(Builder $builder, $value)
    {
        return $builder->where('town', 'LIKE', '%' . $value);
    }


}
