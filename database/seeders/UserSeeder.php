<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'email'=>'admin@gmail.com',
            'password'=>Hash::make("admin"),
            'avatar'=>'public/avatar.png',
            'full_name'=>'Mr. Admin',
            'phone_number'=>'0394844753'
        ]);
        DB::table('users')->insert([
            'email'=>'hothichau@gmail.com',
            'password'=>Hash::make("chau"),
            'avatar'=>'public/avatar.png',
            'full_name'=>'Ho Thi Chau',
            'phone_number'=>'0987654321'
        ]);
        DB::table('users')->insert([
            'email'=>'sim@gmail.com',
            'password'=>Hash::make("sim"),
            'avatar'=>'public/avatar.png',
            'full_name'=>'Ho Thi Sim',
            'phone_number'=>'0987654321'
        ]);
        DB::table('users')->insert([
            'email'=>'thao@gmail.com',
            'password'=>Hash::make("thao"),
            'avatar'=>'public/avatar.png',
            'full_name'=>'Nguyen Ngoc Thao',
            'phone_number'=>'0987654321'
        ]);
        DB::table('users')->insert([
            'email'=>'manhgmail.com',
            'password'=>Hash::make("manh"),
            'avatar'=>'public/avatar.png',
            'full_name'=>'Pham Van Manh',
            'phone_number'=>'0987654321'
        ]);
    }
}
