<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Order;
use App\Models\DiscountCode;
use App\Models\Transporters;
use Illuminate\Database\Seeder;


class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1 ; $i<=3; $i++){
            Transporters::create([
                'name' => 'nha van chuyen'. $i,
                'email' => 'nhavanchuyen'.$i.'@gmail.com',
                'phone' => '987654321'.$i,
                'postage'=> 10+$i,
            ]);
        }
        DiscountCode::create([
            'code' => 'giamgia10',
            'discount' => 10,
            'valid_date' =>'2022-12-30'
        ]);
        Order::factory()->count(3)->create();
    }
}
