<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Outlet;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Outlet::updateOrCreate(
            ['email' => 'outlet01@solusikopi.local'],
            [
                'name' => 'Solusi Kopi Main Outlet',
                'address' => 'Jl. Utama No. 1',
                'phone' => '081234567801',
                'opening_hours' => '08:00 - 22:00',
                'latitude' => '-5.147665',
                'longitude' => '119.432732',
                'logo' => null,
            ]
        );
    }
}
