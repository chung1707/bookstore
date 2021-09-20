<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\Transporters;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'transaction_id'=> Str::random(10),
            'dispatch' => $this->faker->address(),
            'note' => $this->faker->paragraphs(6, true),
            'totalPrice' =>$this->faker->numberBetween($min = 90000, $max = 500000),
            'user_id' => 2,
            'discount_code_id' => 1,
            'transporter_id'=> Transporters::inRandomOrder()->first()->id,
            'province_id' => 1,
            'district_id' => 15,
            'ward_id' => 230,
        ];
    }
}
