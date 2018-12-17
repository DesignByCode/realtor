<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use DesignByCode\Realtor\Http\Resources\PropertyResource;
use DesignByCode\Realtor\Models\Property;
use Illuminate\Http\Request;

class PricesController extends Controller
{
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'selling_price' => 'required|integer',
            'display_price' => 'required|integer',
            'rates' => 'nullable|integer',
            'levies' => 'nullable|integer',
        ]);

        if (!$property->price()->exists()) {
            $property->price()->create([
                'selling_price' => $request->selling_price,
                'display_price' => $request->display_price,
                'rates' => $request->rates,
                'levies' => $request->levies
            ]);
        }else {
            $property->price()->update([
                'selling_price' => $request->selling_price,
                'display_price' => $request->display_price,
                'rates' => $request->rates,
                'levies' => $request->levies
            ]);
        }

        return new PropertyResource($property);
    }

}
