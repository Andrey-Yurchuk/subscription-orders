<?php

namespace Database\Seeders;

use App\Models\Tariff;
use Illuminate\Database\Seeder;

class TariffSeeder extends Seeder
{
    public function run(): void
    {
        Tariff::create([
            'ration_name' => 'Стандартный',
            'cooking_day_before' => true,
        ]);

        Tariff::create([
            'ration_name' => 'Премиум',
            'cooking_day_before' => false,
        ]);

        Tariff::create([
            'ration_name' => 'Вегетарианский',
            'cooking_day_before' => true,
        ]);
    }
}
