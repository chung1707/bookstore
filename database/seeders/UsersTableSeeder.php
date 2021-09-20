<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<4; $i++){
            User::create([
                'name' => 'admin'.$i,
                'email' => 'admin'.$i.'@firstblog.com',
                'phone' => '98765432100'.$i,
                'address' => '2362 Aoma Rapid Jakubowskiton, PA 29565-0803',
                'role_id' => 1,
                'password' => Hash::make('admin123'),
                'province_id' => 1,
                'district_id' => 15,
                'ward_id' => 230,
            ]);
        }
        User::create([
            'name' => 'user',
            'email' => 'user@firstblog.com',
            'phone' => '9876543211',
            'address' => '2362 Lazada Rapid Jakubowskiton, PA 29565-0803',
            'role_id' => 2,
            'password' => Hash::make('user1234'),
            'province_id' => 1,
            'district_id' => 15,
            'ward_id' => 230,
        ]);
        for($i=1; $i<4; $i++){
            User::create([
                'name' => 'author'.$i,
                'email' => 'author'.$i.'@firstblog.com',
                'phone' => '9876543212'.$i,
                'address' => '2362 Valencia Rapid Jakubowskiton, PA 29565-0803',
                'role_id' => 3,
                'password' => Hash::make('author123'),
                'province_id' => 1,
                'district_id' => 15,
                'ward_id' => 230,
            ]);
        }
        for($i=1; $i<4; $i++){
            User::create([
                'name' => 'Employee'.$i,
                'email' => 'employee'.$i.'@firstblog.com',
                'phone' => '9876543213'.$i,
                'address' => '2362 Valencia Rapid Jakubowskiton, PA 29565-0803',
                'role_id' => 4,
                'password' => Hash::make('employee123'),
                'province_id' => 1,
                'district_id' => 15,
                'ward_id' => 230,
            ]);
        }
        User::factory()->count(30)->create();
    }
}
