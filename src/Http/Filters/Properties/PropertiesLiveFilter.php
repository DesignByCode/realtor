<?php

namespace DesignByCode\Realtor\Http\Filters\Properties;

use function array_get;
use DesignByCode\Realtor\Http\Filters\FilterAbstact;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PropertiesLiveFilter
 *
 * @package \DesignByCode\Realtor\Http\Filters\Properties
 */
class PropertiesLiveFilter extends FilterAbstact
{

    /**
     * @return array
     */
    public function mappings()
    {
        return [
            'live' => true,
            'not-live' => null
        ];
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return Builder
     */
    public function filter(Builder $builder, $value)
    {
        $value = $this->resolveFilterValues($value);

        $method = ($value === null) ? 'whereNull' : 'whereNotNull';

        return $builder->{$method}('live');
    }



}
