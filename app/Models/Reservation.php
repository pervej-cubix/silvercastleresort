<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'checkin_date', 'checkout_date', 'room_type', 'pax_in', 'child_in', 'country', 'title',
        'first_name', 'last_name', 'email', 'phone', 'address', 'guest_remarks',
        'day_count', 'reservation_mode', 'currency_type', 'conversion_rate',
        'guest_source_id', 'reference_id', 'reservation_status'
    ];
 
    public function roomTypes(): HasMany
    {
        // If foreign key is not standard
        return $this->hasMany(ReservationRoomType::class, 'reservation_id');
    }
    
}
