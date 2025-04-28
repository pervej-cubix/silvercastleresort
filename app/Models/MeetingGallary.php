<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingGallary extends Model
{
    use HasFactory;

    public static $meetingGallaray, $meetingGallaries, $image, $imageNewName, $directory, $imgUrl;

    public static function saveMeetingGallary($meeting_gallaries, $id)
    {
        if($meeting_gallaries)
        {
            foreach($meeting_gallaries as $meeting_gallaray)
            {
                self::$meetingGallaray = new MeetingGallary();
                self::$meetingGallaray->meeting_id = $id;
                self::$meetingGallaray->meeting_photo = self::saveGallaryImage($meeting_gallaray);
                self::$meetingGallaray->save();
            }
        }

    }

    public static function saveGallaryImage($meeting_gallaray)
    {
        self::$imageNewName = 'gallaries'. rand(). '.' . $meeting_gallaray->getClientOriginalExtension();
        self::$directory = 'assets/admin/img/meeting/';
        $meeting_gallaray->move(self::$directory,self::$imageNewName);
        self::$imgUrl = self::$directory.self::$imageNewName;
        return self::$imgUrl;
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }


    public static function updateMeetingGallary($meeting_gallaries, $id)
    {
        self::$meetingGallaries = MeetingGallary::where('meeting_id', $id)->get();

        foreach (self::$meetingGallaries as $meetingGallary){
            if ($meetingGallary->meeting_photo){
                unlink($meetingGallary->meeting_photo);
            }
            $meetingGallary->delete();
        }
        self::saveMeetingGallary($meeting_gallaries, $id);

    }
}
