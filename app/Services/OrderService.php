<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Collection;

class OrderService
{
    public function __construct(private OrderRationService $rationService)
    {
    }

    public function createOrder(array $validatedData, Collection $dateRanges): Order
    {
        $order = Order::create([
            'client_name' => $validatedData['client_name'],
            'client_phone' => preg_replace('/\D/', '', $validatedData['client_phone']),
            'tariff_id' => $validatedData['tariff_id'],
            'schedule_type' => $validatedData['schedule_type'],
            'comment' => $validatedData['comment'],
            'first_date' => $dateRanges->min('start'),
            'last_date' => $dateRanges->max('end'),
        ]);

        foreach ($dateRanges as $range) {
            $this->rationService->createRations($order, $range['start'], $range['end']);
        }

        return $order;
    }
}
