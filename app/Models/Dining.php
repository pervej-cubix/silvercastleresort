<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dining extends Model
{
    use HasFactory;

    public static $dining, $image, $imageNewName, $directory, $imgUrl;


    public static function saveDining($request)
    {
        self::$dining = new Dining();
        self::$dining->diningName = $request->diningName;
        self::$dining->description = $request->description;
        self::$dining->Features1 = $request->Features1;
        self::$dining->Features2 = $request->Features2;
        self::$dining->Features3 = $request->Features3;
        self::$dining->Features4 = $request->Features4;
        self::$dining->Features5 = $request->Features5;
        self::$dining->Features6 = $request->Features6;
        if($request->image)
        {
            self::$dining->image = self::saveImage($request);
        }
        else{
            $defaultImagePath = 'assets/admin/img/dining/defaultImage.jpg';
            self::$dining->image = $defaultImagePath;
        }
        self::$dining->status = $request->status;
        self::$dining->save();
        return self::$dining;
        
    }

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'dining' . rand() . '.' . self::$image->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/dining/';
        self::$image->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    public function dining_gallaries()
    {
        return $this->hasMany(DiningGallary::class, 'dining_id'); // Use 'accommodation_id'
    }


    public static function updateDining($request, $id)
    {
        self::$dining = Dining::find($id);
        self::$dining->diningName = $request->diningName;
        self::$dining->description = $request->description;
        self::$dining->Features1 = $request->Features1;
        self::$dining->Features2 = $request->Features2;
        self::$dining->Features3 = $request->Features3;
        self::$dining->Features4 = $request->Features4;
        self::$dining->Features5 = $request->Features5;
        self::$dining->Features6 = $request->Features6;
        if($request->file('image'))
        {
            if(file_exists(self::$dining->image))
            {
                unlink(self::$dining->image);
            }
            self::$dining->image = self::saveImage($request);
        }
        else{
            self::$imgUrl = self::$dining->image;
        }
        self::$dining->status = $request->status;
        self::$dining->save();
        return self::$dining;
    }


}
