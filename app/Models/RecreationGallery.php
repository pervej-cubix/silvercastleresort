<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecreationGallery extends Model
{
    public static $recreationGallery, $recreationGalleries, $image, $imageNewName, $directory, $imgUrl;

    use HasFactory;

    public static function saveRecreationGallery($recreation_galleries, $id)
    {
        if ($recreation_galleries) {
            foreach ($recreation_galleries as $recreation_gallery) {
                self::$recreationGallery = new RecreationGallery();
                self::$recreationGallery->recreation_id = $id;
                self::$recreationGallery->recreation_photo = self::saveGalleryImage($recreation_gallery);
                self::$recreationGallery->save();
            }
        }
    }

    public static function saveGalleryImage($recreation_gallery)
    {
        self::$imageNewName = 'galleries' . rand() . '.' . $recreation_gallery->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/recreation/';
        $recreation_gallery->move(self::$directory, self::$imageNewName);
        self::$imgUrl = self::$directory . self::$imageNewName;
        return self::$imgUrl;
    }

    public function recreation()
    {
        return $this->belongsTo(Recreation::class, 'recreation_id'); // Use 'recreation_id'
    }


    public static function updateRecreationGallery($recreation_galleries, $id)
    {
        self::$recreationGalleries = RecreationGallery::where('recreation_id', $id)->get();

        foreach (self::$recreationGalleries as $recreationGallery) {
            if ($recreationGallery->recreation_photo) {
                unlink($recreationGallery->recreation_photo);
            }
            $recreationGallery->delete();
        }
        self::saveRecreationGallery($recreation_galleries, $id);
    }
}
