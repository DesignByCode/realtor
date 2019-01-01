<?php

namespace DesignByCode\Realtor\Http\Filters;

use function array_get;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FilterAbstact
 *
 * @package \DesignByCode\Realtor\Http\Filters
 */
abstract class FilterAbstact
{

    /**
     * @param Builder $builder
     * @param $value
     * @return mixed
     */
    abstract public function filter(Builder $builder, $value);

    /**
     * @return array
     */
    public function mappings()
    {
        return [];
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function resolveFilterValues($key)
    {
        return array_get($this->mappings(), $key);
    }

    /**
     * @param $direction
     * @return mixed
     */
    protected function resolveOrederDirection($direction)
    {
        return array_get([
            'desc' => 'desc',
            'asc' => 'asc'
        ], $direction, 'desc');
    }

}
