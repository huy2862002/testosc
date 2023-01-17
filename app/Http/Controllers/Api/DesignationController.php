<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DesignationController extends Controller
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
        ])->get('https://people.zoho.com/people/api/forms/designation/getRecords');

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


       public function create(Request $request){
        $access_token = $this->access_token();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken '.$access_token,
        ])->post('https://people.zoho.com/people/api/forms/json/P_Department/insertRecord',[
            'inputData'=> '{Department:'.$request->Department.',MailAlias:'.$request->MailAlias.',Department_Lead:'.$request->Department_Lead.',Parent_Department:'.$request->Parent_Department.',isDivision:'.$request->isDivision.'}'
        ]);

       return  json_decode($response);

       }

       public function delete($id){
        $access_token = $this->access_token();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken '.$access_token,
        ])->post('https://people.zoho.com/people/api/deleteRecords',[
            'recordIds'=> $id,
            'formLinkName'=>'P_Department'
        ]);

        return json_decode($response);
       }


       public function show($id){
        $access_token = $this->access_token();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken '.$access_token,
        ])->post('https://people.zoho.com/people/api/forms/P_Department/getRecordByID',[
            'recordId'=> $id,
        ]);
        return $response['response']['result'][0]['Department Details/Chi tiết phòng ban'];
       }

       public function Update($id, Request $request){
        $access_token = $this->access_token();
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Zoho-oauthtoken '.$access_token,
        ])->post('https://people.zoho.com/people/api/forms/json/P_Department/updateRecord',[
            'inputData'=> '{Department:'.$request->Department.',MailAlias:'.$request->MailAlias.',Department_Lead:'.$request->Department_Lead.',Parent_Department:'.$request->Parent_Department.',isDivision:'.$request->isDivision.'}',
            'recordId'=>$id
        ]);

        return json_decode($response);
       }
}
