<?php

namespace App\Http\Controllers;

use App\Models\Booking;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{

    public function create()
    {
        $rooms = ['зал', 'ресторан', 'летняя веранда', 'закрытая веранда'];
        $payments = ['наличные', 'карта', 'онлайн'];
        return view('bookings.create', compact('rooms', 'payments'));
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'room' => 'required|in:зал,ресторан,летняя веранда,закрытая веранда',
            'banket_date' => 'required|date_format:d.m.Y|after:today',
            'payments' => 'required|in:наличные,карта,онлайн',
        ]);

        $data['banket_date'] = Carbon::createFromFormat('d.m.Y', $data['banket_date'])->format('Y-m-d');
        $data['user_id'] = Auth::id();
        $data['status'] = 'Новая';

        Booking::create($data);

        return redirect()->route('profile')->with('success', 'Заявка создана');
    }
}