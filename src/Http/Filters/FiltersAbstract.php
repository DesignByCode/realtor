<?php

namespace DesignByCode\Realtor\Http\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


/**
 * Class FiltersAbstract
 * @package DesignByCode\Realtor\Http\Filters
 */
abstract class FiltersAbstract
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * PropertiesFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function filter(Builder $builder)
    {
        foreach ($this->getFilters() as $filter => $value) {
            $this->resolveFilter($filter)->filter($builder, $value);
        }

        return $builder;
    }

    /**
     * @return $this
     */
    public function add(array $filters)
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }

    /**
     * @param $filter
     * @return mixed
     */
    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter];
    }

    /**
     * @param $filters
     * @return array
     */
    protected function filterFilters($filters)
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    /**
     * @return array
     */
    protected function getFilters()
    {
        return $this->filterFilters($this->filters);
    }


}
