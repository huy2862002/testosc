<?php

namespace App\Services;

use App\Traits\OAthTokenTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DepartmentService
{
    use OAthTokenTrait;

    public function listDepartment(Request $request)
    {
        $accessToken = $this->getAccessToken();
        $url = config('constants.linkApiZoho').'/forms/P_Department/getRecords';
        if ($request->key) {
            $url = $url . "?searchParams={searchField: 'Department', searchOperator: 'Contains', searchText : " . $request->key . "}";
        }
        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->get($url);

        return $this->customZohoId($response);
    }
    public function createDepartment(Request $request)
    {
        $accessToken = $this->getAccessToken();
        $url = config('constants.linkApiZoho').'/forms/json/P_Department/insertRecord';
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post($url, [
            'inputData' => '{Department:' . $request->Department . ',MailAlias:' . $request->MailAlias . ',Department_Lead:' . $request->Department_Lead . ',Parent_Department:' . $request->Parent_Department . ',isDivision:' . $request->isDivision . '}'
        ]);

        return  json_decode($response);
    }

    public function deleteDepartment($id)
    {
        $accessToken = $this->getAccessToken();
        $url = config('constants.linkApiZoho').'/deleteRecords';
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post($url, [
            'recordIds' => $id,
            'formLinkName' => 'P_Department'
        ]);

        return json_decode($response);
    }

    public function showDepartment($id)
    {
        $accessToken = $this->getAccessToken();
        $url = config('constants.linkApiZoho').'/forms/P_Department/getRecordByID';

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post($url, [
            'recordId' => $id,
        ]);
        return $response['response']['result'][0]['Department Details/Chi tiết phòng ban'];
    }

    public function updateDepartment($id, Request $request)
    {
        $accessToken = $this->getAccessToken();
        $url = config('constants.linkApiZoho').'/forms/json/P_Department/updateRecord';
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post(urlUpdateRecord('P_Department'), [
            'inputData' => '{Department:' . $request->Department . ',MailAlias:' . $request->MailAlias . ',Department_Lead:' . $request->Department_Lead . ',Parent_Department:' . $request->Parent_Department . ',isDivision:' . $request->isDivision . '}',
            'recordId' => $id
        ]);

        return json_decode($response);
    }
}
