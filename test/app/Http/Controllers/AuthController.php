<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister()
    { return view('auth.register');}

    public function register(Request $request)
    { $data = $request->validate([
        'login' => [ 'required', 'string', 'min:6', 'regex:/^[a-zA-Z0-9]+$/',
        Rule::unique('users')],
        'password' => 'required|string|min:8|confirmed',
        'name' => 'required|string|max:50|',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|unique:users',
    ]);
    $user = User::create([
        'login' => $data['login'],
        'password' => Hash::make($data['password']),
        'name' => $data['name'],
        'phone' => $data['phone'],
        'email' => $data['email'],
    ]);
    Auth::login(user);
    return redirect()->route('/profile')->with('success', 'Регистрация успешна');
    
    }
    public function showLogin()
    { return view('auth.login');}
    public function login(Request $request)
    { $credentials = $request->validate([
        'login' => 'required|string',
        'password' => 'required|string',
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route(''));
    }
    return back()->withErrors([
        'login' => 'Неверный логин или пароль',
    ]);

    }

        public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
