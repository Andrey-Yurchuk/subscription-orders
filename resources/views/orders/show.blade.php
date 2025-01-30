@extends('layouts.app')

@section('content')
    <h1>Детали заказа #{{ $order->id }}</h1>

    <div>
        <h2>Информация о заказе</h2>
        <p><strong>Имя клиента:</strong> {{ $order->client_name }}</p>
        <p><strong>Телефон:</strong> {{ $order->client_phone }}</p>
        <p><strong>Тариф:</strong> {{ $order->tariff->ration_name }}</p>
        <p><strong>Тип расписания:</strong> {{ $order->schedule_type }}</p>
        <p><strong>Даты доставки:</strong> {{ $order->first_date }} - {{ $order->last_date }}</p>
        <p><strong>Комментарий:</strong> {{ $order->comment }}</p>
    </div>

    <div>
        <h2>Рационы питания</h2>
        <table>
            <thead>
            <tr>
                <th>Дата приготовления</th>
                <th>Дата доставки</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->rations as $ration)
                <tr>
                    <td>{{ $ration->cooking_date }}</td>
                    <td>{{ $ration->delivery_date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('orders.index') }}" class="btn">Вернуться к списку заказов</a>
@endsection
