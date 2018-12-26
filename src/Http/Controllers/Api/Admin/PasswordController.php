<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use DesignByCode\Realtor\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PasswordController extends Controller
{


    public function store(PasswordRequest $request)
    {

        $request->user()->update([
           'password' => bcrypt($request->password)
        ]);

    }


}
