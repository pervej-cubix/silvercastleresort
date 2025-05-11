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
        'checkin',
        'checkout',
        'guest_type',
        'full_name',
        'email',
        'phone',
        'country',
        'address',
        'requirements',
        'reservation_mode',  
        'currency_type',     
        'conversion_rate',   
        'guest_source_id',   
        'reference_id',       
        'reservation_status', 
        'totalAmount',        
        'payableAmount',       
    ];
 
    public function guestRooms()
    {
        return $this->hasMany(GuestRoom::class);
    }

    public function roomTypes(): HasMany
    {
        // If foreign key is not standard
        return $this->hasMany(ReservationRoomType::class, 'reservation_id');
    }
    
}
