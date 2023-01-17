<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use Illuminate\Support\Facades\Http;

class AccessTokenController extends Controller
{
    public function callAccessToken(){
        $refresh_token = '1000.4ba2e2d715694e641ae60786387b1b4c.84a1ad979d583f71069551f36ce7ce4e';
        $client_id = '1000.EDWDQS40X91L8N7BGKF7W9AVGE86AN';
        $client_secret = '7fb0dabfe7bf52c21007b1f988dfe651fcb2c3cbd1';
        $grant_type = 'refresh_token';
        $response = Http::post('https://accounts.zoho.com/oauth/v2/token?refresh_token='.$refresh_token.'&client_id='.$client_id.'&client_secret='.$client_secret.'&grant_type='.$grant_type);
        return $response['access_token'];
    }
   public function getAccessToken(){
        $mod_accessToken = new AccessToken();
        $last_accessToken = $mod_accessToken->getLast();
        if($last_accessToken == null){

            $mod_accessToken->createAccessToken($this->callAccessToken());
            return $this->callAccessToken();
        }else{
            if(strtotime($last_accessToken->expires_at) < strtotime(date('Y-m-d H:i:s'))){
                $mod_accessToken->createAccessToken($this->callAccessToken());
                return $this->callAccessToken();
            }
        }
        return $last_accessToken->access_token;
   }
}
