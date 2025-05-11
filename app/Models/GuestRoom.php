<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Reservation;

class GuestRoom extends Model
{
    use HasFactory;

      protected $fillable = [
        'reservation_id', 'room_type', 'room', 'adults', 'children'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
