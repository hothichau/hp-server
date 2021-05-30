<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'Gói Miễn Phí',
            'price'=>0,
            'description'=>'Người dùng có thể kiểm tra tình trạng cơ thể của mình mỗi ngày như
                            đếm bước chân, đo nhịp tim và tính số giấc ngủ',

        ]);
        DB::table('services')->insert([
            'name' => 'Gói Premium',
            'price'=>200000,
            'description'=>'Người dùng có thể tư vấn các vấn đề về sức khỏe với hệ thống và kiểm
                            tra được lượng Calories có trong bữa ăn hàng ngày',

        ]);
        DB::table('services')->insert([
            'name' => 'Gói Pro',
            'price'=>500000,
            'description'=>'Người dùng có thể được chẩn đoán một số bệnh ngoài da'
        ]);
    }
}
