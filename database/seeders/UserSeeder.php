<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'Avatar' => '',
                'Zoho_ID' => '425479000019947201',
                'FirstName' => 'Nguyễn',
                'LastName' => 'Quang Huy',
                'EmailID' => 'huynq8@smartosc.com',
                'password' => Hash::make('12345678'),
                'Gender' => 'Male',
                'Date_of_birth' => '28-Jun-2002',
                'Role' => 'Fresher',
            ],
            [
                'Avatar' => '',
                'Zoho_ID' => '425479000019947202',
                'FirstName' => 'Nguyễn',
                'LastName' => 'Admin',
                'EmailID' => 'admin@smartosc.com',
                'password' => Hash::make('12345678'),
                'Gender' => 'Male',
                'Date_of_birth' => '28-Jun-2002',
                'Role' => 'Admin',
            ]
        ];
        foreach($users as $item){
            User::create($item);
        }
    }
}
