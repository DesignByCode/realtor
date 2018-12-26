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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $properties = Property::paginate();

        return PropertyResource::collection($properties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \DesignByCode\Realtor\Http\Requests\PropertyReferenceRequest $request
     *
     * @return \DesignByCode\Realtor\Http\Resources\PropertyResource
     */
    public function store(PropertyReferenceRequest $request)
    {

        $property = Property::create(['reference' => $request->reference]);

        $property->price()->create();

        $property->features()->create();

        return new PropertyResource($property);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \DesignByCode\Realtor\Http\Resources\PropertyResource
     */
    public function show($id)
    {
        $property = Property::with(['price', 'tags' , 'features', 'media' => function($query) {
            $query->orderBy('order_column');
        }])->findOrFail($id);

        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request             $request
     * @param \DesignByCode\Realtor\Models\Property $property
     *
     * @return \DesignByCode\Realtor\Http\Resources\PropertyResource
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
     * @param  int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $request
     * @param $property
     *
     * @return
     */
    private function updateFullAddress($request, $property)
    {
        if ($request->full_address) {
            $request->validate([
                'full_address' => 'required|string'
            ]);

            $property->update([
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
            return $property;
        }
    }

    /**
     * @param $request
     * @param $property
     *
     * @return mixed
     */
    private function updateReference($request, $property)
    {
        if ($request->reference) {
            $request->validate([
                'reference' => [
                    'required',
                    'integer',
                    'min:5',
                    Rule::unique('properties')->ignore($property->id)
                ]
            ]);

            $property->update([
                'reference' => $request->reference
            ]);

            return $property;
        }
    }



}
