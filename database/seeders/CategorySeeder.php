<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Outlet;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlet = Outlet::query()->first();

        if (!$outlet) {
            $this->command->warn('No outlet found. Skipping category seeding.');
            return;
        }

        $categories = [
            ['name' => 'Coffee', 'description' => 'Aneka kopi panas dan dingin', 'status' => 'active'],
            ['name' => 'Tea', 'description' => 'Pilihan teh segar', 'status' => 'active'],
            ['name' => 'Non Coffee', 'description' => 'Minuman non kopi', 'status' => 'active'],
            ['name' => 'Snack', 'description' => 'Camilan ringan', 'status' => 'active'],
            ['name' => 'Pastry', 'description' => 'Roti dan pastry harian', 'status' => 'active'],
            ['name' => 'Dessert', 'description' => 'Hidangan penutup manis', 'status' => 'active'],
            ['name' => 'Main Course', 'description' => 'Menu makanan utama', 'status' => 'active'],
            ['name' => 'Breakfast', 'description' => 'Menu sarapan', 'status' => 'active'],
            ['name' => 'Seasonal', 'description' => 'Menu musiman', 'status' => 'inactive'],
            ['name' => 'Bundling', 'description' => 'Paket hemat bundling', 'status' => 'inactive'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                [
                    'outlet_id' => $outlet->id,
                    'description' => $category['description'],
                    'image' => null,
                    'status' => $category['status'],
                ]
            );
        }
    }
}
