<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Viễn tưởng', 'Lãng mạn', 'Hành động', 'Văn học', 'Kĩ năng sống', 'Nghệ thuật', 'Khoa học', 'Sử thi'];
        for($i =0; $i<count($names); $i++){
            Category::factory()->count(1)
            ->state([
                'name' => $names[$i],
            ])
            ->create();
        }
    }
}
