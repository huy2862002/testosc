<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait EmployeeTrait
{
    use OAthToken;
    public function listEmployee()
    {
        $accessToken = $this->getAccessToken();
        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->get(urlGetRecord('P_Employee'));

        return strZohoId($response);
    }
}
