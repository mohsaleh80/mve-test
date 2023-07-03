<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([

            //Admin
            [
                "name"=>"Admin",
                "username"=>"admin",
                "email"=>"admin@gmail.com",
                "password"=>Hash::make("111"),
                "role"=>"admin",
                "status"=>"active",
                'created_at' => now(),
            ],
           
            //Vendor
            [
                "name"=>"Moh Vendor",
                "username"=>"MohVendor",
                "email"=>"MohVendor@gmail.com",
                "password"=>Hash::make("111"),
                "role"=>"vendor",
                "status"=>"active",
                'created_at' => now(),
            ],
            
            //user or customer
            [
                "name"=>"User",
                "username"=>"User",
                "email"=>"user@gmail.com",
                "password"=>Hash::make("111"),
                "role"=>"user",
                "status"=>"active",
                'created_at' => now(),
            ],
        ]);
    }
}
