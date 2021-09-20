<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            SupplierTableSeeder::class,
            CategoriesTableSeeder::class,
            BooksTableSeeder::class,
            OrdersTableSeeder::class
        ]);
    }
}
