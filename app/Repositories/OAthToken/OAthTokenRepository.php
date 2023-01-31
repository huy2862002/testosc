<?php
namespace App\Repositories\OAthToken;

use App\Models\AccessToken;

class OAthTokenRepository implements OAthTokenRepositoryInterface
{
    //lấy model tương ứng
    public function getLast(){
        $token = AccessToken::orderBy('created_at', 'desc')->first();
        return $token;
    }

    public function createAccessToken($accessToken){
        $newAccessToken = new AccessToken();
        $newAccessToken->access_token = $accessToken;
        $newAccessToken->expires_at = date('Y-m-d H:i:s', strtotime('+ 1 hours'));
        $newAccessToken->save();
    }
}
