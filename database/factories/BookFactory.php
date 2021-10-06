<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

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
            'author'=> $this->faker->name(),
            'book_code' => Str::random(7),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraphs(6, true),
            'price' =>$this->faker->numberBetween($min = 90000, $max = 500000),
            'sold' => $this->faker->numberBetween($min = 5, $max = 30),
            'quantity' => $this->faker->numberBetween($min = 50, $max = 200),
            'supplier_id'=> Supplier::inRandomOrder()->first()->id,
        ];
    }
}
