<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class OAthTokenService
{
    public function callAccessToken()
    {
        $response = Http::post('https://accounts.zoho.com/oauth/v2/token?refresh_token=' . config('constants.refreshToken') . '&client_id=' . config('constants.clientId') . '&client_secret=' . config('constants.clientSecret') . '&grant_type=' . config('constants.grantType'));
        
        return $response['access_token'];

    }
}
