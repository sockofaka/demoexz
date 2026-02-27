<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->with('review')->orderBy('created_at', 'desc')->get();
        return view('profile', compact('bookings'));
    }
}