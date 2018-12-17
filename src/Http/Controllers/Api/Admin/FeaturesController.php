<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use DesignByCode\Realtor\Http\Resources\PropertyResource;
use DesignByCode\Realtor\Models\Property;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'dining_areas' => 'required|integer',
            'en_suites' => 'required|integer',
            'lounges' => 'required|integer',
            'storeys' => 'required|integer',
            'floor_area' => 'required|integer',
            'land_area' => 'required|integer',
            'garages' => 'required|integer',
            'covered_parking' => 'required|integer',
            'open_parking' => 'required|integer',
        ]);

        if (!$property->features()->exists()) {
            $property->features()->create($request->only([
                'bedrooms',
                'bathrooms',
                'dining_areas',
                'en_suites',
                'lounges',
                'storeys',
                'floor_area',
                'land_area',
                'garages',
                'covered_parking',
                'open_parking'
            ]));
        }else {
            $property->features()->update($request->only([
                'bedrooms',
                'bathrooms',
                'dining_areas',
                'en_suites',
                'lounges',
                'storeys',
                'floor_area',
                'land_area',
                'garages',
                'covered_parking',
                'open_parking'
            ]));
        }

        return new PropertyResource($property);
    }
}
