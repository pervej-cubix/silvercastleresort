<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    public static $name, $company, $designation, $image, $imgUrl, $imageNewName, $message, $directory, $testimonial;
    use HasFactory;

    public static function saveTestimonail($request){
        self::$testimonial = new Testimonial();

        if($request -> file('image')){
            self::$testimonial->image = self::saveImage($request);
        }else{
            $defaultFilePath = 'default-slide.jpg';
            self::$testimonial->image = $defaultFilePath;
        }

        self::$testimonial->name = $request->name;
        self::$testimonial->company = $request->company;
        self::$testimonial->designation = $request->designation;
        self::$testimonial->message = $request->message;
        self::$testimonial->status = $request->status;
        self::$testimonial->save();
        return self::$testimonial;
    }

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'testimonial' . rand() . '.' . self::$image->getClientOriginalExtension();
        self::$directory = 'assets/web/testimonial/';
        self::$image->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    public static function updateTestimonial($request, $id){
        self::$testimonial = Testimonial::find($id);
        if($request->file('image'))
        {
            if(file_exists(self::$testimonial->image))
            {
                unlink(self::$testimonial->image);
            }
            self::$testimonial->image = self::saveImage($request);
        }
        else
        {
            self::$imgUrl = self::$testimonial->image;
        }
        self::$testimonial->name = $request->name;
        self::$testimonial->company = $request->company;
        self::$testimonial->designation = $request->designation;
        self::$testimonial->message = $request->message;
        self::$testimonial->status = $request->status;
        self::$testimonial->save();
    }
}
