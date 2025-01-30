@extends('layouts.app')

@section('content')
    <h1>Создание нового заказа</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div>
            <label for="client_name">ФИО клиента:</label>
            <input type="text" name="client_name" id="client_name" required>
        </div>
        <div>
            <label for="client_phone">Телефон:</label>
            <input type="text" name="client_phone" id="client_phone" required value="{{ old('client_phone') }}">
            @error('client_phone')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="tariff_id">Тариф:</label>
            <select name="tariff_id" id="tariff_id" required>
                @foreach($tariffs as $tariff)
                    <option value="{{ $tariff->id }}">{{ $tariff->ration_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="schedule_type">Тип расписания:</label>
            <select name="schedule_type" id="schedule_type" required>
                <option value="EVERY_DAY">Ежедневно</option>
                <option value="EVERY_OTHER_DAY">Через день</option>
                <option value="EVERY_OTHER_DAY_TWICE">Через день (2 рациона)</option>
            </select>
        </div>
        <div>
            <label for="comment">Комментарий:</label>
            <textarea name="comment" id="comment"></textarea>
        </div>

        <div id="date-ranges">
            <div class="date-range">
                <label>Интервал дат:</label>
                <input type="date" name="date_ranges[0][start]" required min="{{ now()->toDateString() }}" onchange="setEndDateMin(this)">
                <input type="date" name="date_ranges[0][end]" required min="{{ now()->toDateString() }}">
                <button type="button" class="remove-interval" onclick="removeInterval(this)" style="display: none;">Удалить интервал</button>
            </div>
        </div>

        <button type="button" id="add-date-range">Добавить интервал</button>
        <button type="submit">Создать заказ</button>
    </form>

    <a href="{{ route('orders.index') }}" class="btn">Вернуться к списку заказов</a>

    <script src="{{ asset('js/order-form.js') }}"></script>
@endsection
