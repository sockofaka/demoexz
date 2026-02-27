@extends('layouts.app')
@section('content')
<h1>Личный кабинет</h1>
<div class="slider-container">
    <div class="slider">
        <div class="slides">
            <div class="slide"><img src="{{ asset('1.jpg') }}" alt="Банкет"></div>
            <div class="slide"><img src="{{ asset('2.jpg') }}" alt="Банкет"></div>
            <div class="slide"><img src="{{ asset('3.jpg') }}" alt="Банкет"></div>
            <div class="slide"><img src="{{ asset('4.jpeg') }}" alt="Банкет"></div>
        </div>
        <button class="prev">❮</button>
        <button class="next">❯</button>
    </div>
</div>

<h2>Мои заявки</h2>
@if($bookings->isEmpty())
    <p>У вас пока нет заявок. <a href="{{ route('bookings.create') }}">Создать заявку</a></p>
@else
    <table class="bookings-table">
        <thead>
            <tr>
                <th>Помещение</th>
                <th>Дата банкета</th>
                <th>Способ оплаты</th>
                <th>Статус</th>
                <th>Отзыв</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td data-label="Помещение">{{ $booking->room }}</td>
                <td data-label="Дата">{{ \Carbon\Carbon::parse($booking->banket_date)->format('d.m.Y') }}</td>
                <td data-label="Оплата">{{ $booking->payments }}</td>
                <td data-label="Статус">{{ $booking->status }}</td>
                <td data-label="Отзыв">
                    @if($booking->status === 'Банкет завершен')
                        @if($booking->review)
                            {{ $booking->review->comment }}
                        @else
                            <form method="POST" action="{{ route('reviews.store') }}">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                <textarea name="comment" placeholder="Оставьте отзыв..." required></textarea>
                                <button type="submit">Отправить</button>
                            </form>
                        @endif
                    @else
                        <em>Отзыв можно оставить после завершения</em>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelector('.slides');
    const slideCount = document.querySelectorAll('.slide').length;
    let current = 0;
    function showSlide(index) {
        if (index < 0) index = slideCount-1;
        if (index >= slideCount) index = 0;
        slides.style.transform = `translateX(-${index*100}%)`;
        current = index;
    }
    document.querySelector('.prev').addEventListener('click', () => showSlide(current-1));
    document.querySelector('.next').addEventListener('click', () => showSlide(current+1));
    setInterval(() => showSlide(current+1), 3000);
});
</script>
@endpush
@push('styles')
<style>
    .slider-container {
        position: relative;
        max-width: 800px;
        margin: 20px auto;
        overflow: hidden;
    }
    .slider {
        position: relative;
    }
    .slides {
        display: flex;
        transition: transform 0.5s ease;
    }
    .slide {
        min-width: 100%;
        box-sizing: border-box;
    }
    .slide img {
        width: 100%;
        height: auto;
        display: block;
    }
    .prev, .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(218, 165, 32, 0.7);
        color: black;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 18px;
        z-index: 10;
        border-radius: 4px;
    }
    .prev { left: 10px; }
    .next { right: 10px; }
    .prev:hover, .next:hover {
        background-color: #DC143C;
        color: white;
    }
</style>
@endpush
@endsection