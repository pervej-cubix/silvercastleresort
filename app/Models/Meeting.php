<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    public static $meeting, $image, $imageNewName, $directory, $imgUrl;


    public static function saveMeeting($request)
    {
        self::$meeting = new Meeting();
        self::$meeting->meetingName = $request->meetingName;
        self::$meeting->description = $request->description;
        self::$meeting->Features1 = $request->Features1;
        self::$meeting->Features2 = $request->Features2;
        self::$meeting->Features3 = $request->Features3;
        self::$meeting->Features4 = $request->Features4;
        self::$meeting->Features5 = $request->Features5;
        self::$meeting->Features6 = $request->Features6;
        if($request->image)
        {
            self::$meeting->image = self::saveImage($request);
        }
        else{
            $defaultImagePath = 'assets/admin/img/meeting/defaultImage.jpg';
            self::$meeting->image = $defaultImagePath;
        }
        self::$meeting->status = $request->status;
        self::$meeting->save();
        return self::$meeting;
        
    }

    public static function saveImage($request)
    {
        self::$image = $request->file('image');
        self::$imageNewName = 'meeting' . rand() . '.' . self::$image->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/meeting/';
        self::$image->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    public function meeting_gallaries()
    {
        return $this->hasMany(MeetingGallary::class, 'meeting_id');
    }

    public static function updateMeeting($request, $id)
    {
        self::$meeting = Meeting::find($id);
        self::$meeting->meetingName = $request->meetingName;
        self::$meeting->description = $request->description;
        self::$meeting->Features1 = $request->Features1;
        self::$meeting->Features2 = $request->Features2;
        self::$meeting->Features3 = $request->Features3;
        self::$meeting->Features4 = $request->Features4;
        self::$meeting->Features5 = $request->Features5;
        self::$meeting->Features6 = $request->Features6;
        if($request->file('image'))
        {
            if(file_exists(self::$meeting->image))
            {
                unlink(self::$meeting->image);
            }
            self::$meeting->image = self::saveImage($request);
        }
        else{
            self::$imgUrl = self::$meeting->image;
        }
        self::$meeting->status = $request->status;
        self::$meeting->save();
        return self::$meeting;
    }
}
