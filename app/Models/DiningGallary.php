<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiningGallary extends Model
{
    use HasFactory;


    public static $diningGallaray, $diningGallaries, $image, $imageNewName, $directory, $imgUrl;

    public static function saveDiningGallary($dining_gallaries, $id)
    {
        if($dining_gallaries)
        {
            foreach($dining_gallaries as $dining_gallaray)
            {
                self::$diningGallaray = new DiningGallary();
                self::$diningGallaray->dining_id = $id;
                self::$diningGallaray->dining_photo = self::saveGallaryImage($dining_gallaray);
                self::$diningGallaray->save();
            }
        }

    }

    public static function saveGallaryImage($dining_gallaray)
    {
        self::$imageNewName = 'gallaries'. rand(). '.' . $dining_gallaray->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/dining/';
        $dining_gallaray->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    public function dining()
    {
        return $this->belongsTo(Dining::class, 'dining_id');
    }

    public static function updateDiningGallary($dining_gallaries, $id)
    {
        self::$diningGallaries = DiningGallary::where('dining_id', $id)->get();

        foreach (self::$diningGallaries as $diningGallary){
            if ($diningGallary->dining_photo){
                unlink($diningGallary->dining_photo);
            }
            $diningGallary->delete();
        }
        self::saveDiningGallary($dining_gallaries, $id);

    }


}
