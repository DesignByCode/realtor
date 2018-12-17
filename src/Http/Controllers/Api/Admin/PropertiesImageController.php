<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use DesignByCode\Realtor\Models\Property;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

class PropertiesImageController extends Controller
{
    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_image($id){
        $media = Media::find($id)->delete();

        return response()->json([
            'id' => $id,
            'media' => $media
        ]);
    }


    /**
     * @param \Illuminate\Http\Request              $request
     * @param \DesignByCode\Realtor\Models\Property $property
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, Property $property)
    {
        $id = uniqid(true);
        return response()->json([
            'data' => [
                'id' => $id
            ]
        ]);
    }


    /**
     * @param \Illuminate\Http\Request              $request
     * @param \DesignByCode\Realtor\Models\Property $property
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadStore(Request $request, Property $property)
    {
        $property->addMedia($request->file)->toMediaCollection('property');

        return response()->json([
            'data' => [
                'success' => true
            ]
        ]);
    }


    /**
     * @param \Illuminate\Http\Request          $request
     * @param \Spatie\MediaLibrary\Models\Media $media
     */
    public function mediaUpdate(Request $request, Media $media) {
        $media = $media->update($request->all());
    }

}
