<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicine::create([
            'name' => 'Paracetamol',
            'brand' => 'Methyl',
            'category' => 'Tablet',
            'quantity' => 50,
            'discount' => 0.1,
            'price' => 10000,
        ]);

        Medicine::create([
            'name' => 'Amoxicillin',
            'brand' => 'Biocillin',
            'category' => 'Kapsul',
            'quantity' => 30,
            'discount' => 0.2,
            'price' => 15000,
        ]);

        Medicine::create([
            'name' => 'Decolgen',
            'brand' => 'Decolgen',
            'category' => 'Tablet',
            'quantity' => 20,
            'discount' => 0.05,
            'price' => 8000,
        ]);

        Medicine::create([
            'name' => 'Betadine',
            'brand' => 'Betadine',
            'category' => 'Larutan',
            'quantity' => 10,
            'discount' => 0.15,
            'price' => 20000,
        ]);

        Medicine::create([
            'name' => 'Omeprazole',
            'brand' => 'Omez',
            'category' => 'Kapsul',
            'quantity' => 40,
            'discount' => 0.1,
            'price' => 12000,
        ]);

        Medicine::create([
            'name' => 'Cetirizine',
            'brand' => 'Cetiriz',
            'category' => 'Tablet',
            'quantity' => 25,
            'discount' => 0.05,
            'price' => 9000,
        ]);

        Medicine::create([
            'name' => 'Salbutamol',
            'brand' => 'Ventolin',
            'category' => 'Sirup',
            'quantity' => 15,
            'discount' => 0.2,
            'price' => 18000,
        ]);

        Medicine::create([
            'name' => 'Bisolvon',
            'brand' => 'Bisolvon',
            'category' => 'Sirup',
            'quantity' => 12,
            'discount' => 0.1,
            'price' => 15000,
        ]);

        Medicine::create([
            'name' => 'Asam Mefenamat',
            'brand' => 'Ponstan',
            'category' => 'Tablet',
            'quantity' => 18,
            'discount' => 0.05,
            'price' => 11000,
        ]);

        Medicine::create([
            'name' => 'Vitamin C',
            'brand' => 'Vitacimin',
            'category' => 'Tablet',
            'quantity' => 35,
            'discount' => 0.1,
            'price' => 8000,
        ]);
    }
}
