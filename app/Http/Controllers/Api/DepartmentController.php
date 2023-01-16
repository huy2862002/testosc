<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\Http;
class DepartmentController extends Controller
{
    public function index(){
        $new_Department = new Department();

       $response = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken 1000.7c19e6745fe534d9ec2275a6a82871a5.b1480a4f5d20a66baeef7f7bde7aeb02',
        ])->get('https://people.zoho.com/people/api/forms/P_Department/getRecords?sIndex=1&limit=100');

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
        


        foreach($newParent as $key=>$item){
            $get_item = $new_Department->show_item($item[0]['Zoho_ID']);
            if($get_item == null){
$new_Department->create($item);
            }
        }


        return $newParent;
       }
}
