<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    public function index(){
       
       $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken 1000.7c19e6745fe534d9ec2275a6a82871a5.b1480a4f5d20a66baeef7f7bde7aeb02',
        ])->get('https://people.zoho.com/people/api/forms/P_Employee/getRecords?sIndex=1&limit=100');

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
