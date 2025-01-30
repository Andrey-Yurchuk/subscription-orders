<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tariff;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function index(): View
    {
        $orders = Order::with('rations', 'tariff')->get();

        return view('orders.index', compact('orders'));
    }

    public function create(): View
    {
        $tariffs = Tariff::all();

        return view('orders.create', compact('tariffs'));
    }

    public function show(Order $order): View
    {
        $order->load('rations', 'tariff');

        return view('orders.show', compact('order'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|unique:orders,client_phone',
            'tariff_id' => 'required|exists:tariffs,id',
            'schedule_type' => 'required|in:EVERY_DAY,EVERY_OTHER_DAY,EVERY_OTHER_DAY_TWICE',
            'comment' => 'nullable|string',
            'date_ranges' => 'required|array',
            'date_ranges.*.start' => 'required|date',
            'date_ranges.*.end' => 'required|date|after_or_equal:date_ranges.*.start',
        ], [
            'client_phone.unique' => 'Заказ с этим номером телефона уже существует. Пожалуйста, используйте другой номер.',
        ]);

        try {
            $this->orderService->createOrder($validated, collect($validated['date_ranges']));

            return redirect()->route('orders.index');
        } catch (Exception) {
            return redirect()->back()
                ->withErrors(['error' => 'Произошла ошибка при создании заказа. Пожалуйста, попробуйте еще раз.'])
                ->withInput();
        }
    }
}
