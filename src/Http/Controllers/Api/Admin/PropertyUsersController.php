<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DesignByCode\Realtor\Models\Property;
use Illuminate\Http\Request;
use function response;

class PropertyUsersController extends Controller
{

    public function destroy(Property $property, User $user)
    {
        $property->users()->detach($user);

        return response()->json([
            "message" => "success removed"
        ]);
    }


}
