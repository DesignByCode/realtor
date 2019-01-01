<?php

namespace DesignByCode\Realtor\Http\Filters\Properties;

use DesignByCode\Realtor\Http\Filters\FilterAbstact;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ReferenceFilter
 *
 * @package \DesignByCode\Realtor\Http\Filters\Properties
 */
class ReferenceFilter extends FilterAbstact
{

    /**
     * @param Builder $builder
     * @param $value
     * @return Builder
     */
    public function filter(Builder $builder, $value)
    {
        return $builder->where('reference', $value);
    }


}
