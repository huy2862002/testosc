<?php

namespace App\Services;
use App\Traits\OAthTokenTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeService
{
    use OAthTokenTrait;
    public function listEmployee(Request $request)
    {
        $accessToken = $this->getAccessToken();
        $url = config('constants.linkApiZoho').'/forms/P_Employee/getRecords';
        if ($request->key) {
            $url = $url . "?searchParams={searchField: 'Role', searchOperator: 'Contains', searchText : " . $request->key . "}";
        }
       
        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->get($url);
        return $this->customZohoId($response);
    }
}
