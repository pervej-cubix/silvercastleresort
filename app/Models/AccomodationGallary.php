<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccomodationGallary extends Model
{
    public static $accommodationGallary, $accommodationGallaries, $image, $imageNewName, $directory, $imgUrl;

    use HasFactory;

    public static function saveAccommodationGallary($accommodation_gallaries, $id)
    {
        if($accommodation_gallaries)
        {
            foreach($accommodation_gallaries as $accommodation_gallary)
            {
                self::$accommodationGallary = new AccomodationGallary();
                self::$accommodationGallary->accommodation_id = $id;
                self::$accommodationGallary->accommodation_photo = self::saveGallaryImage($accommodation_gallary);
                self::$accommodationGallary->save();
            }
        }

    }

    public static function saveGallaryImage($accommodation_gallary)
    {
        self::$imageNewName = 'gallaries'. rand(). '.' . $accommodation_gallary->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/accommodation/';
        $accommodation_gallary->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    public function accommodation()
    {
        return $this->belongsTo(Accomodation::class, 'accommodation_id'); // Use 'accommodation_id'
    }


    public static function updateAccommodationGallary($accommodation_gallaries, $id)
    {
        self::$accommodationGallaries = AccomodationGallary::where('accommodation_id', $id)->get();

        foreach (self::$accommodationGallaries as $accommodationGallary){
            if ($accommodationGallary->accommodation_photo){
                unlink($accommodationGallary->accommodation_photo);
            }
            $accommodationGallary->delete();
        }
        self::saveAccommodationGallary($accommodation_gallaries, $id);

    }

}
