<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    public static $title, $description, $image, $imgUrl, $imageNewName, $directory, $aboutUs;
    use HasFactory;

    public static function saveAboutUs($request){
        self::$aboutUs = new AboutUs();
        
        if ($request->file('image'))
        {
            self::$aboutUs->image = self::saveImage($request);
        }else{
            $defaultFilePath = 'default-slide.jpg';
            self::$aboutUs->image = $defaultFilePath;
        }
        self::$aboutUs->title = $request->title;
        self::$aboutUs->description = $request->description;
        self::$aboutUs->status = $request->status;
        self::$aboutUs->save();
        return self::$aboutUs;
    }
    
    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'about_us' . rand() . '.' . self::$image->getClientOriginalExtension();
        self::$directory = 'assets/web/about_us/';
        self::$image->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    public static function updateAboutUs($request, $id){
        self::$aboutUs = AboutUs::find($id);
        if($request->file('image'))
        {
            if(file_exists(self::$aboutUs->image))
            {
                unlink(self::$aboutUs->image);
            }
            self::$aboutUs->image = self::saveImage($request);
        }
        else
        {
            self::$imgUrl = self::$aboutUs->image;
        }
        self::$aboutUs->title = $request->title;
        self::$aboutUs->description = $request->description;
        self::$aboutUs->status = $request->status;
        self::$aboutUs->save();
    }
}
