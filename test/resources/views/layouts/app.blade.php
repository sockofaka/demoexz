<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Банкетам.Нет</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
        body {
            font-family: 'Oswald', sans-serif;
            background-color: #FFFDD0; 
            color: #000000;
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 36px;
            color: #DC143C;
            margin-bottom: 0.5em;
        }
        h2 {
            font-size: 24px;
            color: #DAA520;
            margin-bottom: 0.5em;
        }
        h3 {
            font-size: 18px;
            color: #DAA520;
            margin-bottom: 0.5em;
        }
        p, li, td, th, input, button, .form-group label {
            font-size: 16px;
            color: #000000;
        }
        small, .text-small, .alert, .help-text {
            font-size: 12px;
            color: #006400;
        }
        a {
            color: #DAA520;
            text-decoration: none;
        }
        a:hover {
            color: #DC143C;
        }
        button, .button, input[type="submit"], .btn {
            background-color: #DAA520;
            color: #000000;
            border: none;
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        button:hover, .button:hover, input[type="submit"]:hover, .btn:hover {
            background-color: #FFDAB9;
        }
        input[type="text"], input[type="password"], input[type="email"], input[type="tel"], textarea, select {
            border: 1px solid #DAA520;
            padding: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
            border-radius: 4px;
        }
        input:focus, textarea:focus, select:focus {
            outline: 2px solid #DC143C;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #DAA520;
            color: #000000;
            font-weight: bold;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #FFDAB9;
        }
        tr:hover {
            background-color: #FFDAB9;
        }
        .alert.success {
            background-color: #006400;
            color: #FFFDD0;
            padding: 10px;
            border-radius: 4px;
        }
        .alert.error {
            background-color: #DC143C;
            color: #FFFDD0;
            padding: 10px;
            border-radius: 4px;
        }
        .navbar {
            background-color: #DAA520;
            padding: 10px 0;
        }
        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: #000000;
        }
        .nav-links a, .nav-links span, .nav-links button {
            color: #000000;
            margin-left: 15px;
        }
        .nav-links button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .nav-links button:hover {
            color: #DC143C;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        footer {
            background-color: #006400;
            color: #FFFDD0;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('welcome') }}" class="logo">Банкетам.Нет</a>
            <div class="nav-links">
                @auth
                    <span>{{ Auth::user()->name }}</span>
                    <a href="{{ route('profile') }}">Личный кабинет</a>
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.index') }}">Админ-панель</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit">Выйти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Вход</a>
                    <a href="{{ route('register') }}">Регистрация</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="container">
        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>