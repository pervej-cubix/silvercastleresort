<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stars extends Model
{
    public static $stars, $image, $imageNewName, $directory, $imgUrl;

    use HasFactory;

    public static function saveStars($request)
    {
        self::$stars = new Stars();
        self::$stars->title = $request->title;
        self::$stars->second_title = $request->second_title;
        self::$stars->icon = $request->icon;
        self::$stars->description = $request->description;
        if ($request->image) {
            self::$stars->image = self::saveImage($request);
        } else {
            $defaultImagePath = 'assets/admin/img/stars/defaultImage.jpg';
            self::$stars->image = $defaultImagePath;
        }
        self::$stars->status = $request->status;
        self::$stars->save();
        return self::$stars;
    }

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'stars' . rand() . '.' . self::$image->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/stars/';
        self::$image->move(self::$directory, self::$imageNewName);
        self::$imgUrl = self::$directory . self::$imageNewName;
        return self::$imgUrl;
    }

    public static function updateStars($request, $id)
    {
        self::$stars = Stars::find($id);
        self::$stars->title = $request->title;
        self::$stars->second_title = $request->second_title;
        self::$stars->icon = $request->icon;
        self::$stars->description = $request->description;
        if ($request->file('image')) {
            if (file_exists(self::$stars->image)) {
                unlink(self::$stars->image);
            }
            self::$stars->image = self::saveImage($request);
        } else {
            self::$imgUrl = self::$stars->image;
        }
        self::$stars->status = $request->status;
        self::$stars->save();
        return self::$stars;
    }
}
