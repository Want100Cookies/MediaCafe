<?php

namespace App\Http\Controllers;

use App\MetaSources\IMetaSource;
use App\MetaSources\TheTVDBSource;
use App\Models\MediaItem;
use App\Models\Profile;
use Dawson\TVDB\TVDBClient;
use Illuminate\Http\Request;
use Imdb\Title;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if ( ! $token = \JWTAuth::attempt($credentials)) {
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
        $source = new TheTVDBSource();

        return $source->getMetaData("78901");
    }
}
