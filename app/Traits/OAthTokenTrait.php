<?php
namespace App\Traits;

use App\Repositories\OAthRepository;
use App\Services\OAthTokenService;

trait OAthTokenTrait
{
    protected $OAthTokenRepo, $OAthTokenService;

    public function __construct(OAthRepository $OAthTokenRepo, OAthTokenService $OAthTokenService)
    {
        $this->OAthTokenRepo = $OAthTokenRepo;
        $this->OAthTokenService = $OAthTokenService;
    }

    public function getAccessToken()
    {
        $lastAccessToken = $this->OAthTokenRepo->getLast();

        if ($lastAccessToken == null) {
            $accessToken = $this->OAthTokenService->callAccessToken();

            $this->OAthTokenRepo->createAccessToken($accessToken);
            return $accessToken;
        } else {
            if (strtotime($lastAccessToken->expires_at) < strtotime(date('Y-m-d H:i:s'))) {
                $accessToken = $this->OAthTokenService->callAccessToken();
                $this->OAthTokenRepo->createAccessToken($accessToken);
                return $accessToken;
            }
        }
         return $lastAccessToken->access_token;
    }

    public function customZohoId($response){
        $newParent = [];
    if ($response['response']['status'] == 0) {
        $json = $response['response']['result'];

        $newParent = [];
        foreach ($json as $zoho_id => $object[0]) {
            $newObject = [];
            foreach ($object[0] as $child) {
                $child[0]['Zoho_ID'] = (string) $child[0]['Zoho_ID'];
                $newObject = $child;
            }
            $newParent[$zoho_id] = $newObject;
        }
    }

    return $newParent;
    }

}
