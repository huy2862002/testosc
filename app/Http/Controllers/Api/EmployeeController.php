<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    public function list(){
       
       $access_token = '1000.c0492c3262d1fcd31c634e2238bd818e.0dfb9877b2565befe28ffb775346a8ae';
        
       $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken '.$access_token,
        ])->get('https://people.zoho.com/people/api/forms/P_Employee/getRecords?sIndex=1&limit=200');

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
