<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Address extends Model
{
    public static $address;

    use HasFactory;

    public static function saveAddress($request)
    {
        self::$address = new Address();
        self::$address->title = $request->title;
        self::$address->icon = $request->icon;
        self::$address->address = $request->address;
        self::$address->status = $request->status;
        self::$address->save();
        return self::$address;
    }

    public static function updateAddress($request, $id)
    {
        self::$address = Address::find($id);
        self::$address->title = $request->title;
        self::$address->icon = $request->icon;
        self::$address->address = $request->address;
        self::$address->status = $request->status;
        self::$address->save();
        return self::$address;
    }
}
