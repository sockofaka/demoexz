<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable=['booking_id', 'comment'];
    public function bookings()
    { return $this->belongsTo(Booking::class);
     }

};
