<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (! $token = \JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }

        return response()->json([
            'response' => 'success',
            'result' => [
                'token' => $token,
            ],
        ]);
    }

    public function getAuthUser(Request $request)
    {
        $user = \JWTAuth::toUser();

        return response()->json(['result' => $user]);
    }

    public function foo()
    {
        \App\Jobs\CreateMediaItem::dispatch([
            'meta_id' => '78901',
            'implementation' => 'App\MetaSources\TheTVDBSource',
            'profile_id' => '1',
        ]);
    }
}
