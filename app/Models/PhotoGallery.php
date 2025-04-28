<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PhotoGallery extends Model
{
    public static $photo_gallery, $image, $imageNewName, $directory, $imgUrl;

    use HasFactory;

    public static function savePhotoGallery($request)
    {
        self::$photo_gallery = new PhotoGallery();
        if ($request->image) {
            self::$photo_gallery->image = self::saveImage($request);
        } else {
            $defaultImagePath = 'assets/admin/img/photo_gallery/defaultImage.jpg';
            self::$photo_gallery->image = $defaultImagePath;
        }
        self::$photo_gallery->status = $request->status;
        self::$photo_gallery->save();
        return self::$photo_gallery;
    }

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'recreation' . rand() . '.' . self::$image->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/photo_gallery/';
        self::$image->move(self::$directory, self::$imageNewName);
        self::$imgUrl = self::$directory . self::$imageNewName;
        return self::$imgUrl;
    }

    public static function updatePhotoGallery($request, $id)
    {
        self::$photo_gallery = PhotoGallery::find($id);
        if ($request->file('image')) {
            if (file_exists(self::$photo_gallery->image)) {
                unlink(self::$photo_gallery->image);
            }
            self::$photo_gallery->image = self::saveImage($request);
        } else {
            self::$imgUrl = self::$photo_gallery->image;
        }
        self::$photo_gallery->status = $request->status;
        self::$photo_gallery->save();
        return self::$photo_gallery;
    }
}
