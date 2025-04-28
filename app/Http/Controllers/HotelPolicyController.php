<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class HotelPolicyController extends Controller
{
    public function hotelPolicy(){
        $data = [
            'aboutUs' => AboutUs::where('status', 1)->get()
        ];

        return view('web.pages.hotelPolicy', $data);
    }
}
