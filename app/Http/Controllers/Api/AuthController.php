<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{

    /**
     * @var Guard
     */
    private $authGuard;

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->authGuard = auth()->guard();
    }

    /**
     * Login user and return token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        //validate
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        //attempt to get token
        $token = auth()->attempt($data);
        if (!$token) {
            return response()->json(['error' => 'Ongeldige gegevens.'], 401);
        }

        return response()->json()->header('Authorization', $token);
    }

    /**
     * Get logged in user
     */
    public function user()
    {
        return response()->json(['data' => auth()->user()]);
    }

    /**
     * Register the user
     *
     * @param Request $request
     * @return
     */
    public function register(Request $request)
    {
        //validate
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string'
        ]);

        //hash pwd
        $data['password'] = Hash::make($data['password']);

        //create user
        return User::create($data);
    }

    /**
     * Log the user out.
     */
    public function logout()
    {
        auth()->logout();
    }

    /**
     *  Refreshes the token.
     */
    public function refresh()
    {
        return response()->json(['success' => 'Token refreshed']);
    }

}
