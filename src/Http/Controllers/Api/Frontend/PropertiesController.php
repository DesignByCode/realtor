<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use DesignByCode\Realtor\Http\Filters\Properties\TownFilter;
use DesignByCode\Realtor\Models\Property;
use Illuminate\Http\Request;

/**
 * Class PropertiesController
 * @package DesignByCode\Realtor\Http\Controllers\Api\Frontend
 */
class PropertiesController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return Property::with(['price', 'tags' , 'users', 'features'])->filter($request, $this->getFilters())->get();
    }



    /**
     * @return array
     */
    protected function getFilters()
    {
        return [];
    }


}
