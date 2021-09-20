<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Thumbnail;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i =1; $i<=27; $i++){
            $thumbnail = new Thumbnail;
            $thumbnail->img = 'product'.$i.'.jpg';
            Book::factory()->count(1)->create();
            $book = Book::find($i);
            $thumbnail->book_id = $book->id;
            $thumbnail->save();
            $category = Category::inRandomOrder()->first();
            $book->categories()->attach($category);
        }
        for($i =1; $i<=27; $i++){
            $thumbnail = new Thumbnail;
            $thumbnail->img = 'product'.($i+30).'.jpg';
            $book = Book::find($i);
            $thumbnail->book_id = $book->id;
            $thumbnail->save();
            $category = Category::inRandomOrder()->first();
            $book->categories()->attach($category);
        }
    }
}
