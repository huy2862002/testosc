<?php

namespace App\Services;
use App\Traits\OAthTokenTrait;
use Illuminate\Support\Facades\Http;

class EmployeeService
{
    use OAthTokenTrait;
    public function listEmployee()
    {
        $url = config('constants.linkApiZoho').'/forms/P_Employee/getRecords';
        $accessToken = $this->getAccessToken();
        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->get($url);

        return $this->customZohoId($response);
    }
}
