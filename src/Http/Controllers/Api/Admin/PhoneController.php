<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use DesignByCode\Realtor\Http\Requests\ProfileNumbersRequest;
use DesignByCode\Realtor\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileNumbersRequest $request)
    {
        $request->user()->phones()->create([
            'type' => $request->type,
            'phone' => $request->phone
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        $phone->delete();
    }
}
