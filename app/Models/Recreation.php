<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recreation extends Model
{
    public static $recreation, $image, $imageNewName, $directory, $imgUrl;

    use HasFactory;

    public static function saveRecreation($request)
    {
        self::$recreation = new Recreation();
        self::$recreation->name = $request->name;
        self::$recreation->icon = $request->icon;
        if($request->image)
        {
            self::$recreation->image = self::saveImage($request);
        }
        else{
            $defaultImagePath = 'assets/admin/img/recreation/defaultImage.jpg';
            self::$recreation->image = $defaultImagePath;
        }
        self::$recreation->status = $request->status;
        self::$recreation->save();
        return self::$recreation;
        
    }

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'recreation' . rand() . '.' . self::$image->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/recreation/';
        self::$image->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    public function recreation_galleries()
    {
        return $this->hasMany(RecreationGallery::class, 'recreation_id'); // Use 'recreation_id'
    }

    public static function updateRecreation($request, $id)
    {
        self::$recreation = Recreation::find($id);
        self::$recreation->name = $request->name;
        self::$recreation->icon = $request->icon;
        if($request->file('image'))
        {
            if(file_exists(self::$recreation->image))
            {
                unlink(self::$recreation->image);
            }
            self::$recreation->image = self::saveImage($request);
        }
        else{
            self::$imgUrl = self::$recreation->image;
        }
        self::$recreation->status = $request->status;
        self::$recreation->save();
        return self::$recreation;
    }

}
