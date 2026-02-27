@extends('layouts.app')

@section('content')
<h1>Администрирование бронирований</h1>

@if(session('success'))
    <div class="alert success">{{ session('success') }}</div>
@endif

<table class="bookings-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Помещение</th>
            <th>Дата банкета</th>
            <th>Способ оплаты</th>
            <th>Статус</th>
            <th>Действие</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->user->name ?? 'Неизвестно' }}</td>
            <td>{{ $booking->room }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->banket_date)->format('d.m.Y') }}</td>
            <td>{{ $booking->payments }}</td>
            <td>{{ $booking->status }}</td>
            <td>
                <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                    @csrf
                    @method('PATCH')
                    <select name="status">
                        <option value="Новая" {{ $booking->status == 'Новая' ? 'selected' : '' }}>Новая</option>
                        <option value="Подтверждена" {{ $booking->status == 'Банкет назначен' ? 'selected' : '' }}>Подтверждена</option>
                        <option value="Банкет завершен" {{ $booking->status == 'Банкет завершен' ? 'selected' : '' }}>Банкет завершен</option>
                    </select>
                    <button type="submit">Обновить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection