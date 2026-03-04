<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Table;
use App\Models\Outlet;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlets = Outlet::query()->get();

        if ($outlets->isEmpty()) {
            $this->command->warn('No outlet found. Skipping table seeding.');
            return;
        }

        foreach ($outlets as $outlet) {
            for ($i = 1; $i <= 10; $i++) {
                $tableNumber = $outlet->id . '-' . str_pad((string) $i, 2, '0', STR_PAD_LEFT);
                $tableCode = 'T' . $outlet->id . str_pad((string) $i, 2, '0', STR_PAD_LEFT);

                Table::updateOrCreate(
                    ['table_number' => $tableNumber],
                    [
                        'outlet_id' => $outlet->id,
                        'table_code' => $tableCode,
                        'capacity' => 4,
                        'status' => 'available',
                        'qr_code_url' => null,
                    ]
                );
            }
        }
    }
}
