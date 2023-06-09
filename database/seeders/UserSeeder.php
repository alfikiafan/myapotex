<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $adminCount = 3;
        $cashierCount = 5;
        $totalUsers = $adminCount + $cashierCount;
        for ($i = 0; $i < $adminCount; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'joining_date' => $faker->date('Y-m-d'),
                'role' => 'administrator',
            ]);
        }
        for ($i = $adminCount; $i < $totalUsers; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'joining_date' => $faker->date('Y-m-d'),
                'role' => 'cashier',
            ]);
        }
    }
}
