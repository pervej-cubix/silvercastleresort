<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VirtualTour extends Model
{
    public static $virtual_tour, $image, $imageNewName, $directory, $imgUrl;

    use HasFactory;

    public static function saveVirtualTour($request)
    {
        self::$virtual_tour = new VirtualTour();
        self::$virtual_tour->link = $request->link;
        if($request->image)
        {
            self::$virtual_tour->image = self::saveImage($request);
        }
        else{
            $defaultImagePath = 'assets/admin/img/virtual_tour/defaultImage.jpg';
            self::$virtual_tour->image = $defaultImagePath;
        }
        self::$virtual_tour->status = $request->status;
        self::$virtual_tour->save();
        return self::$virtual_tour;
        
    }

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'virtual_tour' . rand() . '.' . self::$image->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/virtual_tour/';
        self::$image->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    public static function updateVirtualTour($request, $id)
    {
        self::$virtual_tour = VirtualTour::find($id);
        self::$virtual_tour->link = $request->link;
        if($request->file('image'))
        {
            if(file_exists(self::$virtual_tour->image))
            {
                unlink(self::$virtual_tour->image);
            }
            self::$virtual_tour->image = self::saveImage($request);
        }
        else{
            self::$imgUrl = self::$virtual_tour->image;
        }
        self::$virtual_tour->status = $request->status;
        self::$virtual_tour->save();
        return self::$virtual_tour;
    }


}
