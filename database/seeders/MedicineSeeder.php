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
            'discount' => 0,
            'price' => 15000,
        ]);

        Medicine::create([
            'name' => 'Decolgen',
            'brand' => 'Decolgen',
            'category' => 'Tablet',
            'quantity' => 20,
            'discount' => 0,
            'price' => 8000,
        ]);

        Medicine::create([
            'name' => 'Betadine',
            'brand' => 'Betadine',
            'category' => 'Larutan',
            'quantity' => 10,
            'discount' => 0,
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
            'discount' => 0,
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

        Medicine::create([
            'name' => 'Paracetamol Forte',
            'brand' => 'Paramex',
            'category' => 'Tablet',
            'quantity' => 60,
            'discount' => 0,
            'price' => 12000,
        ]);
        
        Medicine::create([
            'name' => 'Ibuprofen',
            'brand' => 'Nurofen',
            'category' => 'Tablet',
            'quantity' => 40,
            'discount' => 0.1,
            'price' => 8000,
        ]);
        
        Medicine::create([
            'name' => 'Ciprofloxacin',
            'brand' => 'Ciproxin',
            'category' => 'Kapsul',
            'quantity' => 25,
            'discount' => 0,
            'price' => 15000,
        ]);
        
        Medicine::create([
            'name' => 'Loratadine',
            'brand' => 'Clarityne',
            'category' => 'Tablet',
            'quantity' => 30,
            'discount' => 0,
            'price' => 10000,
        ]);
        
        Medicine::create([
            'name' => 'Ranitidine',
            'brand' => 'Zantac',
            'category' => 'Tablet',
            'quantity' => 35,
            'discount' => 0.1,
            'price' => 8000,
        ]);
        
        Medicine::create([
            'name' => 'Vitamin D',
            'brand' => 'Caltrate',
            'category' => 'Tablet',
            'quantity' => 50,
            'discount' => 0,
            'price' => 15000,
        ]);
        
        Medicine::create([
            'name' => 'Metformin',
            'brand' => 'Glucophage',
            'category' => 'Tablet',
            'quantity' => 25,
            'discount' => 0,
            'price' => 12000,
        ]);
        
        Medicine::create([
            'name' => 'Propranolol',
            'brand' => 'Inderal',
            'category' => 'Tablet',
            'quantity' => 20,
            'discount' => 0,
            'price' => 10000,
        ]);
        
        Medicine::create([
            'name' => 'Dexamethasone',
            'brand' => 'Decadron',
            'category' => 'Tablet',
            'quantity' => 30,
            'discount' => 0,
            'price' => 15000,
        ]);
        
        Medicine::create([
            'name' => 'Atenolol',
            'brand' => 'Tenormin',
            'category' => 'Tablet',
            'quantity' => 40,
            'discount' => 0,
            'price' => 8000,
        ]);
        
        Medicine::create([
            'name' => 'Cefixime',
            'brand' => 'Suprax',
            'category' => 'Kapsul',
            'quantity' => 25,
            'discount' => 0.05,
            'price' => 10000,
        ]);
        
        Medicine::create([
            'name' => 'Simvastatin',
            'brand' => 'Zocor',
            'category' => 'Tablet',
            'quantity' => 30,
            'discount' => 0,
            'price' => 12000,
        ]);
        
        Medicine::create([
            'name' => 'Folic Acid',
            'brand' => 'Folvite',
            'category' => 'Tablet',
            'quantity' => 40,
            'discount' => 0,
            'price' => 15000,
        ]);
        
        Medicine::create([
            'name' => 'Metoprolol',
            'brand' => 'Lopressor',
            'category' => 'Tablet',
            'quantity' => 20,
            'discount' => 0.05,
            'price' => 10000,
        ]);
        
        Medicine::create([
            'name' => 'Azithromycin',
            'brand' => 'Zithromax',
            'category' => 'Kapsul',
            'quantity' => 25,
            'discount' => 0,
            'price' => 12000,
        ]);
        
        Medicine::create([
            'name' => 'Bisoprolol',
            'brand' => 'Concor',
            'category' => 'Tablet',
            'quantity' => 30,
            'discount' => 0,
            'price' => 10000,
        ]);
        
        Medicine::create([
            'name' => 'Lansoprazole',
            'brand' => 'Prevacid',
            'category' => 'Tablet',
            'quantity' => 40,
            'discount' => 0.1,
            'price' => 12000,
        ]);
        
        Medicine::create([
            'name' => 'Sertraline',
            'brand' => 'Zoloft',
            'category' => 'Tablet',
            'quantity' => 25,
            'discount' => 0,
            'price' => 10000,
        ]);
        
        Medicine::create([
            'name' => 'Methylphenidate',
            'brand' => 'Ritalin',
            'category' => 'Tablet',
            'quantity' => 30,
            'discount' => 0.1,
            'price' => 15000,
        ]);
        
        Medicine::create([
            'name' => 'Esomeprazole',
            'brand' => 'Nexium',
            'category' => 'Tablet',
            'quantity' => 35,
            'discount' => 0,
            'price' => 15000,
        ]);

        Medicine::create([
            'name' => 'Pinisilin',
            'brand' => 'Nexium',
            'category' => 'Tablet',
            'quantity' => 75,
            'discount' => 0,
            'price' => 43000,
        ]);

        Medicine::create([
            'name' => 'Caphalospolin',
            'brand' => 'Nexium',
            'category' => 'Tablet',
            'quantity' => 55,
            'discount' => 0,
            'price' => 9000,
        ]);

        Medicine::create([
            'name' => 'Aminoglikosida',
            'brand' => 'Nexium',
            'category' => 'Tablet',
            'quantity' => 7,
            'discount' => 0,
            'price' => 23000,
        ]);

        Medicine::create([
            'name' => 'Paracetamol',
            'brand' => 'Oskadon',
            'category' => 'Kapsul',
            'quantity' => 100,
            'discount' => 0.2,
            'price' => 23000,
        ]);
    }
}
