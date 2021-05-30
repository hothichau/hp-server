<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'age' => 20,
            'height' => 155,
            'weight' => 50,
            'gender'=>'Nữ',
            'user_id'=>2,
            'service_id'=>1
        ]);
        DB::table('customers')->insert([
            'age' => 20,
            'height' => 155,
            'weight' => 50,
            'gender'=>'Nam',
            'user_id'=>3,
            'service_id'=>1
        ]);
        DB::table('customers')->insert([
            'age' => 20,
            'height' => 155,
            'weight' => 50,
            'gender'=>'Nữ',
            'user_id'=>4,
            'service_id'=>2
        ]);
        DB::table('customers')->insert([
            'age' => 20,
            'height' => 155,
            'weight' => 50,
            'gender'=>'Nam',
            'user_id'=>5,
            'service_id'=>3
        ]);
    }
}
