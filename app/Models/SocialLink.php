<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SocialLink extends Model
{
    public static $social_link;

    use HasFactory;

    public static function saveSocialLink($request)
    {
        self::$social_link = new SocialLink();
        self::$social_link->mobile = $request->mobile;
        self::$social_link->map_link = $request->map_link;
        self::$social_link->fb_link = $request->fb_link;
        self::$social_link->instagram_link = $request->instagram_link;
        self::$social_link->youtube_link = $request->youtube_link;
        self::$social_link->whatsapp_link = $request->whatsapp_link;
        self::$social_link->status = $request->status;
        self::$social_link->save();
        return self::$social_link;
    }

    public static function updateSocialLink($request, $id)
    {
        self::$social_link = SocialLink::find($id);
        self::$social_link->mobile = $request->mobile;
        self::$social_link->map_link = $request->map_link;
        self::$social_link->fb_link = $request->fb_link;
        self::$social_link->instagram_link = $request->instagram_link;
        self::$social_link->youtube_link = $request->youtube_link;
        self::$social_link->whatsapp_link = $request->whatsapp_link;
        self::$social_link->status = $request->status;
        self::$social_link->save();
        return self::$social_link;
    }
}
