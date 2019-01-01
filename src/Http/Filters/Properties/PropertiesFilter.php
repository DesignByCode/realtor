<?php

namespace DesignByCode\Realtor\Http\Filters\Properties;

use DesignByCode\Realtor\Http\Filters\FiltersAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class PropertiesFilter
 *
 * @package \DesignByCode\Realtor\Http\Filters\Properties
 */
class PropertiesFilter extends FiltersAbstract
{

    protected $filters = [
        'ref' => ReferenceFilter::class,
        'town' => TownFilter::class,
        'live' => PropertiesLiveFilter::class,
        'users' => PropertiesUsersFilter::class
    ];



}
