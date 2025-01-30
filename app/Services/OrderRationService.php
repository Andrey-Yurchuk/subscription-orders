<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class OrderRationService
{
    public function createRations(Order $order, string $startDate, string $endDate): void
    {
        $dates = $this->generateDeliveryDates($order->schedule_type, $startDate, $endDate);

        foreach ($dates as $date) {
            $cookingDate = $order->tariff->cooking_day_before
                ? $date->copy()->subDay()
                : $date;

            $order->rations()->create([
                'cooking_date' => $cookingDate,
                'delivery_date' => $date,
            ]);
        }
    }

    private function generateDeliveryDates(string $scheduleType, string $startDate, string $endDate): Collection
    {
        $dates = collect();
        $currentDate = Carbon::parse($startDate);
        $endDateCarbon = Carbon::parse($endDate);

        while ($currentDate->lte($endDateCarbon)) {
            switch ($scheduleType) {
                case 'EVERY_DAY':
                    $dates->push($currentDate->copy());
                    $currentDate->addDay();
                    break;
                case 'EVERY_OTHER_DAY':
                    $dates->push($currentDate->copy());
                    $currentDate->addDays(2);
                    break;
                case 'EVERY_OTHER_DAY_TWICE':
                    $dates->push($currentDate->copy());
                    $dates->push($currentDate->copy());

                    if ($currentDate->isSameDay($endDateCarbon)) {
                        $dates->pop();
                    }

                    $currentDate->addDays(2);
                    break;
            }
        }

        return $dates;
    }
}
