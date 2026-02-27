@extends('layouts.app')
@section('content')
<h1>Новая заявка на бронирование</h1>
<form method="POST" action="{{ route('bookings.store') }}">
    @csrf
    <div class="form-group">
        <label for="room">Помещение</label>
        <select name="room" id="room" required>
            @foreach($rooms as $room)
                <option value="{{ $room }}">{{ $room }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="banket_date">Дата банкета (ДД.ММ.ГГГГ)</label>
        <input type="text" name="banket_date" id="banket_date" placeholder="дд.мм.гггг" required pattern="\d{2}\.\d{2}\.\d{4}" title="Введите дату в формате ДД.ММ.ГГГГ">
        <small class="text-muted">Например: 25.12.2025</small>
    </div>
    <div class="form-group">
        <label for="payments">Способ оплаты</label>
        <select name="payments" id="payments" required>
            @foreach($payments as $payment)
                <option value="{{ $payment }}">{{ $payment }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Отправить заявку</button>
</form>
@endsection