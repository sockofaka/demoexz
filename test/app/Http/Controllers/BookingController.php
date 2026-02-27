<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $roomTypes = ['зал', 'ресторан', 'летняя веранда', 'закрытая веранда'];
       $paymentsMetod = ['наличные', 'карта', 'онлайн'];
       return view('bookings.create', compact('roomTypes', 'paymentsMetod'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'room' => 'required|in:зал, ресторан, летняя веранда, закрытая веранда',
            'banket_date' => 'requied|date|after:today',
            'payments' => 'required|in:наличные, карта, онлайн',
        ]);
        $bookings = Booking::create([
            'user_id' => Auth::id(),
            'room' => $data['room'],
            'banket_date' => $data['banket_date'],
            'payments' => $data['payments'],
            'status' => 'Новая',
        ]);
        return redirect()->route('/profile')-with('success', 'Заявка создана и отправлена администратору');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
