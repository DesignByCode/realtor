<?php

namespace DesignByCode\Realtor\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DesignByCode\Realtor\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class AuthController
 *
 * @package DesignByCode\Realtor\Http\Controllers\Api\Admin
 */
class AuthController extends Controller
{

    /**
     * @var
     */
    protected $auth;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
//        $this->middleware('auth:api', ['except' => ['register', 'login']]);
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
            'password' => bcrypt($request->password)
        ]);

        $token = $this->auth->attempt($request->only('email', 'password'));

        return $this->respondWithToken($token, $user);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' =>  'required|email',
            'password' =>  'required'
        ]);

        try {
            if (! $token = auth()->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'errors' => [
                        'root' => 'Could not sign you in with those details.'
                    ]
                ], 401);
            }
        } catch (JWTException $e) {
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
        $this->auth->invalidate($this->auth->getToken());

        return response()->json([
            'data' => 'Loged out successfully'
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {

        if (!$request->user()) {
            return;
        }

        $me = User::with('roles', 'phones')->find($request->user()->id);
        $me->gravatar = get_gravatar($me->email);
        $me->authenticated = true;
        $user = $me;

        return new UserResource($user);
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
                'token' => $token,
                'token_type'   => 'Bearer',
                'expires_in'   => auth()->factory()->getTTL() * 360
            ]
        ]);

    }



}
