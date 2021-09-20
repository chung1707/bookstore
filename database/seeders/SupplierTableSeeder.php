<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=9; $i++){
            Supplier::factory()->count(1)
            ->state([
                'logo' => 'logo'.$i.'.png',
            ])
            ->create();
        }
    }
}
