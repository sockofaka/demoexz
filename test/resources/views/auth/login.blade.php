@extends('layouts.app')
@section('content')
<h1>Вход</h1>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" name="login" id="login" value="{{ old('login') }}" required>
        @error('login') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Войти</button>
</form>
<p>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
@endsection