<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AgencyLoginController extends Controller
{
    /**
     * Attempt to authenticate the user and generate a JWT token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Extract the email and password from the request and generate a JWT token based on the provided credentials
        $credentials = $request->only('email', 'password');

        try {
            // Attempt to generate a JWT token based on the provided credentials
            if (!$token = auth('agency')->attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            // Something went wrong while attempting to generate the token
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(['token' => $token]);
    }
}