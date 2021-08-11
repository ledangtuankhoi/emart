<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // admin
            [
                'full_name'=>'TuanKhoi admin',
                'username'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('1111'),
                'role'=>'admin',
                'status'=>'active',
            ],
            // vendor
            [
                'full_name'=>'TuanKhoi seller',
                'username'=>'seller',
                'email'=>'seller@gmail.com',
                'password'=>Hash::make('1111'),
                'role'=>'seller',
                'status'=>'active',
            ],
            // customer
            [
                'full_name'=>'TuanKhoi customer',
                'username'=>'customer',
                'email'=>'customer@gmail.com',
                'password'=>Hash::make('1111'),
                'role'=>'customer',
                'status'=>'active',
            ],
        ]);
    }
}
