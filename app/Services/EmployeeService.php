<?php

namespace App\Services;
use App\Traits\OAthTokenTrait;
use Illuminate\Support\Facades\Http;

class EmployeeService
{
    use OAthTokenTrait;
    public function listEmployee()
    {
        $accessToken = $this->getAccessToken();
        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->get(urlGetRecord('P_Employee'));

        return $this->customZohoId($response);
    }
}
