<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableRoom extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'start_date', 'end_date', 'room_type', 'no_of_rooms'
    ];
}
