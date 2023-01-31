<?php
namespace App\Traits;

use App\Models\AccessToken;
use App\Repositories\OAthToken\OAthTokenRepositoryInterface;
use Illuminate\Support\Facades\Http;

trait OAthToken
{
    protected $OAthToken;

    public function __construct(OAthTokenRepositoryInterface $OAthToken)
    {
        $this->OAthToken = $OAthToken;
    }
    public function callAccessToken()
    {
        $response = Http::post('https://accounts.zoho.com/oauth/v2/token?refresh_token=' . contants('refreshToken') . '&client_id=' . contants('clientId') . '&client_secret=' . contants('clientSecret') . '&grant_type=' . contants('grantType'));
        return $response['access_token'];
    }
    public function getAccessToken()
    {
        $lastAccessToken = $this->OAthToken->getLast();
        $accessToken = $this->callAccessToken();
        if ($lastAccessToken == null) {
            $this->OAthToken->createAccessToken($accessToken);
            return $accessToken;
        } else {
            if (strtotime($lastAccessToken->expires_at) < strtotime(date('Y-m-d H:i:s'))) {
                $this->OAthToken->createAccessToken($accessToken);
                return $accessToken;
            }
        }
       return $lastAccessToken->access_token;
    }
}
