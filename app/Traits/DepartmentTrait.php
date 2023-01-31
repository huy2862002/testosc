<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait DepartmentTrait
{
    use OAthToken;
    public function listDepartment(Request $request)
    {
        $accessToken = $this->getAccessToken();

        $url = urlGetRecord('P_Department');
        if ($request->key) {
            $url = urlGetRecord('P_Department') . "?searchParams={searchField: 'Department', searchOperator: 'Contains', searchText : " . $request->key . "}";
        }
        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->get($url);

        return strZohoId($response);
    }

    public function createDepartment(Request $request)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post(urlAddRecord('P_Department'), [
            'inputData' => '{Department:' . $request->Department . ',MailAlias:' . $request->MailAlias . ',Department_Lead:' . $request->Department_Lead . ',Parent_Department:' . $request->Parent_Department . ',isDivision:' . $request->isDivision . '}'
        ]);

        return  json_decode($response);
    }

    public function deleteDepartment($id)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post(urlDeleteRecord(), [
            'recordIds' => $id,
            'formLinkName' => 'P_Department'
        ]);

        return json_decode($response);
    }


    public function showDepartment($id)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post(urlShowRecord('P_Department'), [
            'recordId' => $id,
        ]);
        return $response['response']['result'][0]['Department Details/Chi tiết phòng ban'];
    }

    public function updateDepartment($id, Request $request)
    {
        $accessToken = $this->getAccessToken();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post(urlUpdateRecord('P_Department'), [
            'inputData' => '{Department:' . $request->Department . ',MailAlias:' . $request->MailAlias . ',Department_Lead:' . $request->Department_Lead . ',Parent_Department:' . $request->Parent_Department . ',isDivision:' . $request->isDivision . '}',
            'recordId' => $id
        ]);

        return json_decode($response);
    }
}
