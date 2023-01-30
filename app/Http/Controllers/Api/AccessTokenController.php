<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use Illuminate\Support\Facades\Http;

class AccessTokenController extends Controller
{
    public function callAccessToken()
    {
        $response = Http::post('https://accounts.zoho.com/oauth/v2/token?refresh_token=' . contants('refreshToken') . '&client_id=' . contants('clientId') . '&client_secret=' . contants('clientSecret') . '&grant_type=' . contants('grantType'));
        return $response['access_token'];
    }
    public function getAccessToken()
    {
        $modAccessToken = new AccessToken();
        $lastAccessToken = $modAccessToken->getLast();
        if ($lastAccessToken == null) {

            $modAccessToken->createAccessToken($this->callAccessToken());
            return $this->callAccessToken();
        } else {
            if (strtotime($lastAccessToken->expires_at) < strtotime(date('Y-m-d H:i:s'))) {
                $modAccessToken->createAccessToken($this->callAccessToken());
                return $this->callAccessToken();
            }
        }
        return $lastAccessToken->access_token;
    }
}
