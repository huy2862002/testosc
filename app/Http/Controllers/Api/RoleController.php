<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoleController extends Controller
{
    public function index(){
        $access_token = '1000.27f5e5aa8a2b6e98b052e4730ee8220f.f36c1e6eb64200213efa1989a37ce2bb';
         
        $response = Http::withHeaders([
             'Authorization' => 'Zoho-oauthtoken '.$access_token,
         ])->get('https://people.zoho.com/people/api/forms/P_Designation/getRecords?sIndex=1&limit=200');
 
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
