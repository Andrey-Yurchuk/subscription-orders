@extends('layouts.app')

@section('content')
    <div class="header-container">
        <h1>Список заказов</h1>
        <a href="{{ route('orders.create') }}" class="btn">Создать новый заказ</a>
    </div>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>ФИО клиента</th>
            <th>Телефон</th>
            <th>Тариф</th>
            <th>Тип расписания</th>
            <th>Даты доставки</th>
            <th>Комментарий</th>
            <th>Детали заказа</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->client_name }}</td>
                <td>{{ $order->client_phone }}</td>
                <td>{{ $order->tariff->ration_name }}</td>
                <td>{{ $order->schedule_type }}</td>
                <td>{{ $order->first_date }} - {{ $order->last_date }}</td>
                <td>{{ $order->comment }}</td>
                <td>
                    <a href="{{ route('orders.show', $order) }}">Просмотреть</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
