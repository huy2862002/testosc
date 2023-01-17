<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    public function access_token()
    {
        $ctl_accessToken = new AccessTokenController();
        $access_token =  $ctl_accessToken->getAccessToken();
        return $access_token;
    }
    public function list(){
       
        $access_token = $this->access_token();
        
       $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken '.$access_token,
        ])->get('https://people.zoho.com/people/api/forms/P_Employee/getRecords');

        $json = $response['response']['result'];

        $newParent = [];
        foreach($json as $zoho_id => $object[0]) {
            $newObject = [];
            foreach($object[0] as $child) {
                $child[0]['Zoho_ID'] = (string) $child[0]['Zoho_ID'];
                $newObject = $child;
            }
            $newParent[$zoho_id] = $newObject;
        }

        return $newParent;
       }
}
