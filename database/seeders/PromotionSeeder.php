<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promotion;
use Illuminate\Support\Carbon;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = [
            [
                'code' => 'PROMO10',
                'name' => 'Diskon 10%',
                'description' => 'Diskon 10% untuk semua minuman.',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'min_order_amount' => 50000,
                'status' => 'active',
            ],
            [
                'code' => 'PROMO20',
                'name' => 'Diskon 20%',
                'description' => 'Diskon 20% untuk transaksi tertentu.',
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'min_order_amount' => 100000,
                'status' => 'active',
            ],
            [
                'code' => 'HEMAT5K',
                'name' => 'Potongan 5K',
                'description' => 'Potongan harga Rp5.000.',
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'min_order_amount' => 30000,
                'status' => 'active',
            ],
            [
                'code' => 'HEMAT10K',
                'name' => 'Potongan 10K',
                'description' => 'Potongan harga Rp10.000.',
                'discount_type' => 'fixed',
                'discount_value' => 10000,
                'min_order_amount' => 75000,
                'status' => 'inactive',
            ],
            [
                'code' => 'WEEKEND15',
                'name' => 'Weekend 15%',
                'description' => 'Promo akhir pekan 15%.',
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'min_order_amount' => 60000,
                'status' => 'inactive',
            ],
        ];

        foreach ($promotions as $promo) {
            Promotion::updateOrCreate(
                ['code' => $promo['code']],
                array_merge($promo, [
                    'start_date' => Carbon::now()->subDays(7),
                    'end_date' => Carbon::now()->addDays(30),
                ])
            );
        }
    }
}
