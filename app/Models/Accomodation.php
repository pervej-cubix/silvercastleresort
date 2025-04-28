<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Accomodation extends Model
{
    public static $accomodation, $image, $imageNewName, $directory, $imgUrl;

    use HasFactory;

    public static function saveAccomodation($request)
    {
        self::$accomodation = new Accomodation();
        self::$accomodation->roomType = $request->roomType;
        self::$accomodation->slug = self::generateUniqueSlug($request->roomType);
        self::$accomodation->roomSize = $request->roomSize;
        self::$accomodation->noRoom = $request->noRoom;
        self::$accomodation->occupancy = $request->occupancy;
        self::$accomodation->rakeRate = $request->rakeRate;
        self::$accomodation->description = $request->description;
        if($request->image)
        {
            self::$accomodation->image = self::saveImage($request);
        }
        else{
            $defaultImagePath = 'assets/admin/img/accommodation/defaultImage.jpg';
            self::$accomodation->image = $defaultImagePath;
        }
        self::$accomodation->status = $request->status;
        self::$accomodation->save();
        return self::$accomodation;
        
    }

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'accommodation' . rand() . '.' . self::$image->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/accommodation/';
        self::$image->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    private static function generateUniqueSlug($roomType) {
        $slug = Str::slug($roomType);
        $uniqueSlug = $slug;
        $count = 1;
    
        while (Accomodation::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $count;
            $count++;
        }
    
        return $uniqueSlug;
    }

    public function accommodation_gallaries()
    {
        return $this->hasMany(AccomodationGallary::class, 'accommodation_id'); // Use 'accommodation_id'
    }

    public static function updateAccomodation($request, $id)
    {
        self::$accomodation = Accomodation::find($id);
        self::$accomodation->roomType = $request->roomType;
        self::$accomodation->slug = self::generateUniqueSlug($request->roomType, self::$accomodation->id);
        self::$accomodation->roomSize = $request->roomSize;
        self::$accomodation->noRoom = $request->noRoom;
        self::$accomodation->occupancy = $request->occupancy;
        self::$accomodation->rakeRate = $request->rakeRate;
        self::$accomodation->description = $request->description;
        if($request->file('image'))
        {
            if(file_exists(self::$accomodation->image))
            {
                unlink(self::$accomodation->image);
            }
            self::$accomodation->image = self::saveImage($request);
        }
        else{
            self::$imgUrl = self::$accomodation->image;
        }
        self::$accomodation->status = $request->status;
        self::$accomodation->save();
        return self::$accomodation;
    }


}
