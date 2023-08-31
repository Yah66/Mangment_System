<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if ($validator->failed()) {
            return response()->json(['error' => true, 'message' => $validator->errors()], 200);
        }

        $credentials = request(['email', 'password']);

        $token = auth('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['error' => true, 'message' => 'Unauthorized'], 200);
        }

        $expiration = auth('api')->payload()->get('exp'); // Get token expiration time from payload

        return response()->json([
            'access_token' => $token,
            'expire_in' => $expiration - time(), // Calculate remaining time
        ]);
    }
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['error' => false, 'message' => 'Logout Successfully '], 200);
    }
}