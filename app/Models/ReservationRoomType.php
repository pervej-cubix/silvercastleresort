<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Reservation;

class ReservationRoomType extends Model
{
    use HasFactory;

    protected $fillable = ['reservation_id', 'room_type', 'no_of_room'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
