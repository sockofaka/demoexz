@extends('layouts.app')
@section('content')
<h1>Регистрация</h1>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
        <label for="login">Логин (лат. буквы и цифры, мин. 6)</label>
        <input type="text" name="login" id="login" value="{{ old('login') }}" required pattern="[a-zA-Z0-9]{6,}" title="Только латинские буквы и цифры, не менее 6">
        @error('login') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="password">Пароль (мин. 8)</label>
        <input type="password" name="password" id="password" required minlength="8">
        @error('password') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Подтверждение</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    <div class="form-group">
        <label for="name">ФИО</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="phone">Телефон</label>
        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required>
        @error('phone') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>
    <button type="submit">Зарегистрироваться</button>
</form>
<p>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
@endsection