<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public static $promotion, $image, $imageNewName, $directory, $imgUrl;
    use HasFactory;

    public static function savePromotion($request)
    {
        self::$promotion = new Promotion();
        if ($request->file('image'))
        {
            self::$promotion->image = self::saveImage($request);
        }
        else{
            $defaultImagePath = 'assets/admin/img/promotion/defaultImage.jpg';
            self::$promotion->image = $defaultImagePath;
        }
        self::$promotion->status = $request->status;
        self::$promotion->save();
        return self::$promotion;
    }

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'promotion'.rand().'.'.self::$image->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/promotion';
        self::$image->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory. '/' .self::$imageNewName;
        return self::$imgUrl;
    }

    public static function updatePromotion($request, $id){
        self::$promotion = Promotion::find($id);
        if($request->file('image'))
        {
            if(file_exists(self::$promotion->image))
            {
                unlink(self::$promotion->image);
            }
            self::$promotion->image = self::saveImage($request);
        }
        else
        {
            self::$imgUrl = self::$promotion->image;
        }
        self::$promotion->status = $request->status;
        self::$promotion->save();

    }
    
}