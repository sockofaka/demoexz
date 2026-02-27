<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable=['user_id', 'room', 'banket_date', 'status', 'payments' ];

    protected $casts = [ 'banket_date' => 'date'];

public function users()
{ return $this->belongsTo(User::class); }

public function review()
{ return $this->hasOne(Reviews::class); }

}

