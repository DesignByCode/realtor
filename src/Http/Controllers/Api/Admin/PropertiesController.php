<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use DesignByCode\Realtor\Http\Requests\PropertyReferenceRequest;
use DesignByCode\Realtor\Http\Resources\PropertyResource;
use DesignByCode\Realtor\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;



class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::paginate();

        return PropertyResource::collection($properties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \DesignByCode\Realtor\Http\Controllers\Api\Admin\Propertyresource
     */
    public function store(PropertyReferenceRequest $request)
    {

        $property = Property::create(['reference' => $request->reference]);

        return new PropertyResource($property);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::with('media')->findOrFail($id);

        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $this->updateReference($request, $property);

        $this->updateFullAddress($request, $property);

        return new PropertyResource($property);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $request
     * @param $property
     */
    private function updateFullAddress($request, $property)
    {
        if ($request->full_address) {
            $request->validate([
                'full_address' => 'required'
            ]);

            return $property = $property->update([
                'full_address' => $request->full_address,
                'number' => $request->number,
                'street_name' =>$request->street_name,
                'town' => $request->town,
                'city' => $request->city,
                'province' => $request->province,
                'post_code' => $request->post_code,
                'country' => $request->country,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
        }
    }

    /**
     * @param $request
     * @param $property
     */
    private function updateReference($request, $property)
    {
        if ($request->reference) {
            $request->validate([
                'reference' => [
                    'required',
                    'integer',
                    Rule::unique('properties')->ignore($property->id)
                ]
            ]);

            return $property = $property->update([
                'reference' => $request->reference
            ]);
        }
    }




}
