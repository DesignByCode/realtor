<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;


/**
 * Class AuthController
 *
 * @package DesignByCode\Realtor\Http\Controllers\Api\Admin
 */
class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' =>  'required',
            'email' =>  'required|email|unique:users',
            'password' =>  'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token, $user);

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
//        $credentials = request(['email', 'password']);

        try {
            if (! $token = auth()->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'errors' => [
                        'root' => 'Could not sign you in with those details.'
                    ]
                ], 401);
            }
        } catch (UnauthorizedException $e) {
            return response()->json([
                'errors' => [
                    'root' => 'Faild'
                ]
            ], $e->getStatusCode());
        }

        return $this->respondWithToken($token, $request->user());
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @param $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $credentials)
    {
        return response()->json([
            'data' => $credentials,
            'meta' => [
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => auth()->factory()->getTTL() * 60
            ]
        ]);

//        return response()->json([
//            'access_token' => $token,
//            'token_type'   => 'bearer',
//            'expires_in'   => auth()->factory()->getTTL() * 60
//        ]);
    }





}
