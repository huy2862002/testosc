<?php
namespace App\Repositories\AccessTokenCtl;

use App\Http\Controllers\Api\AccessTokenController;
use App\Repositories\AccessTokenCtl\AccessTokenRepositoryInterface as AccessTokenCtlAccessTokenRepositoryInterface;

class AccessTokenRepository implements AccessTokenCtlAccessTokenRepositoryInterface
{
    public function accessToken()
    {
        $ctlAccessToken = new AccessTokenController();
        $accessToken =  $ctlAccessToken->getAccessToken();
        return $accessToken;
    }
}
