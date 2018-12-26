<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;


use App\Http\Controllers\Controller;
use function array_flatten;
use DesignByCode\Realtor\Http\Resources\PropertyResource;
use DesignByCode\Realtor\Http\Resources\TagsResource;
use DesignByCode\Realtor\Models\Property;
use Designbycode\Tagger\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::get();

        return new TagsResource($tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
//        dd(array_flatten ($data));

        $property = Property::find($id);

        $property->retag($data);

        return new PropertyResource($property);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
