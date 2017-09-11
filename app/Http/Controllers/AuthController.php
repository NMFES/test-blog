<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function __construct() {
        $this->middleware('auth:api')->only('logout');
    }

    /**
     * Registers a new user
     * @param Request $request
     * @return json
     */
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
                    'success' => true
        ]);
    }

    /**
     * Log in user
     * @param Request $request
     * @return json
     */
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::where([
                    'email' => $request->email
                ])->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->api_token = str_random(60);
            $user->save();

            return response()->json([
                        'authenticated' => true,
                        'api_token' => $user->api_token,
                        'user_id' => $user->id,
                        'name' => $user->name
            ]);
        }

        return response()->json([
                    'email' => ['Email и пароль не совпадают']
                        ], 422);
    }

    /**
     * Log out user
     * @param Request $request
     * @return json
     */
    public function logout(Request $request) {
        $user = $request->user();
        $user->api_token = null;
        $user->save();

        return response()->json([
                    'success' => true
        ]);
    }

}
