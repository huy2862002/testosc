<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = "departments";

    public function create($obj){
        $new_item = new Department();
        $new_item->Zoho_ID = $obj[0]['Zoho_ID'];
        $new_item->Department = $obj[0]['Department'];
        $new_item->MailAlias = $obj[0]['MailAlias'];
        $new_item->Department_Lead = $obj[0]['Department_Lead'];
        $new_item->AddedBy = $obj[0]['AddedBy'];
        $new_item->AddedTime = $obj[0]['AddedTime'];
        $new_item->save();
    }

    public function show_item($Zoho_ID){
       $item = Department::where('Zoho_ID', $Zoho_ID)->first();
    return $item;
    }
}
