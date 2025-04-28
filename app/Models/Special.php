<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    use HasFactory;

    public static $special, $image, $imageNewName, $directory, $imgUrl;

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'special'.rand().'.'.self::$image->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/promotion';
        self::$image->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory. '/' .self::$imageNewName;
        return self::$imgUrl;
    }

    public static function updateSpecial($request, $id){
        self::$special = Special::find($id);
        if($request->file('image'))
        {
            if(file_exists(self::$special->image))
            {
                unlink(self::$special->image);
            }
            self::$special->image = self::saveImage($request);
        }
        else
        {
            self::$imgUrl = self::$special->image;
        }
        self::$special->status = $request->status;
        self::$special->save();

    }
}
