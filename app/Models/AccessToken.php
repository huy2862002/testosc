<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use HasFactory;
    protected $table = 'access_token';

    public function getLast(){
        $token = AccessToken::orderBy('created_at', 'desc')->first();
        return $token;
    }

    public function createAccessToken($access_token){
        $new_accessToken = new AccessToken();
        $new_accessToken->access_token = $access_token;
        $new_accessToken->expires_at = date('Y-m-d H:i:s', strtotime('+ 1 hours'));
        $new_accessToken->save();
    }
}
