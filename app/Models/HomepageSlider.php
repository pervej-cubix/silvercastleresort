<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HomepageSlider extends Model
{
    // public static $promotion, $image, $imageNewName, $directory, $imgUrl;
    public static $homepageSlider, $file, $fileType, $fileNewName, $directory, $fileUrl;
    use HasFactory;

    public static function saveHomepageSlider($request)
    {
        self::$homepageSlider = new HomepageSlider();
        if ($request->file('file'))
        {
            self::$homepageSlider->file = self::saveFile($request);
        }
        else{
            $defaultFilePath = 'default-slide.jpg';
            self::$homepageSlider->file = $defaultFilePath;
        } 
        $fileType = $request->input('fileType', 'image');  // Default to 'image' if not set
        self::$homepageSlider->fileType = $fileType;
        self::$homepageSlider->status = $request->status;
        self::$homepageSlider->save();
        return self::$homepageSlider;
    }

    public static function saveFile($request)
    {
        self::$file = $request->file('file');
        self::$fileNewName = 'homepageSlider'.rand().'.'.self::$file->getClientOriginalExtension();
        self::$directory = 'assets/web/homepageSlider';
        self::$file->move(self::$directory,self::$fileNewName);
        self::$fileUrl = self::$fileNewName;
        return self::$fileUrl;
    }

    public static function updateHomepageSlider($request, $id){
        self::$homepageSlider = HomepageSlider::find($id);
        if($request->file('file'))
        {
            if(file_exists(self::$homepageSlider->file))
            {
                unlink(self::$homepageSlider->file);
            }
            self::$homepageSlider->file = self::saveFile($request);
        }
        else
        {
            self::$fileUrl = self::$homepageSlider->file;
        }
        self::$homepageSlider->status = $request->status;
        self::$homepageSlider->save();

    }
}
