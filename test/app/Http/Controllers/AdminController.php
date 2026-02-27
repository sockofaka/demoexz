<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user')->latest()->get();
        return view('admin.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:Новая,Банкет назначен,Банкет завершен',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->route('admin.index')->with('success', 'Статус обновлён');
    }
}