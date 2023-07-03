<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class vendorSeeder extends Seeder
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

           
           
            //Vendor
            [
                "name"=>"Nest Food Ltd",
                "username"=>"Nest Food",
                "email"=>"nest@gmail.com",
                "password"=>Hash::make("111"),
                "role"=>"vendor",
                "status"=>"active",
                'created_at' => now(),
            ],
            
       
        ]);
    }
}
