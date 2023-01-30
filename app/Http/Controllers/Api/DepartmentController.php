<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AccessTokenCtl\AccessTokenRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DepartmentController extends Controller
{
    protected $accessToken;
    public function __construct(AccessTokenRepositoryInterface $accessTokenRepositoryInterface)
    {
        $this->accessToken = $accessTokenRepositoryInterface;
    }
    public function list(Request $request)
    {
        $accessToken = $this->accessToken->accessToken();
        $url = urlGetRecord('P_Department');
        if ($request->key) {
            $url = urlGetRecord('P_Department') . "?searchParams={searchField: 'Department', searchOperator: 'Contains', searchText : " . $request->key . "}";
        }
        $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->get($url);

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

    public function create(Request $request)
    {
        $accessToken = $this->accessToken->accessToken();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post(urlAddRecord('P_Department'), [
            'inputData' => '{Department:' . $request->Department . ',MailAlias:' . $request->MailAlias . ',Department_Lead:' . $request->Department_Lead . ',Parent_Department:' . $request->Parent_Department . ',isDivision:' . $request->isDivision . '}'
        ]);

        return  json_decode($response);
    }

    public function delete($id)
    {
        $accessToken = $this->accessToken->accessToken();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post(urlDeleteRecord(), [
            'recordIds' => $id,
            'formLinkName' => 'P_Department'
        ]);

        return json_decode($response);
    }


    public function show($id)
    {
        $accessToken = $this->accessToken->accessToken();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post(urlShowRecord('P_Department'), [
            'recordId' => $id,
        ]);
        return $response['response']['result'][0]['Department Details/Chi tiết phòng ban'];
    }

    public function Update($id, Request $request)
    {
        $accessToken = $this->accessToken->accessToken();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
        ])->post(urlUpdateRecord('P_Department'), [
            'inputData' => '{Department:' . $request->Department . ',MailAlias:' . $request->MailAlias . ',Department_Lead:' . $request->Department_Lead . ',Parent_Department:' . $request->Parent_Department . ',isDivision:' . $request->isDivision . '}',
            'recordId' => $id
        ]);

        return json_decode($response);
    }
}
