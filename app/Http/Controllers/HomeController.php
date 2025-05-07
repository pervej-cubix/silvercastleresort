<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\AccomodationGallary;
use App\Models\Address;
use App\Models\Dining;
use App\Models\Meeting;
use App\Models\PhotoGallery;
use App\Models\Promotion;
use App\Models\Recreation;
use App\Models\SocialLink;
use App\Models\Special;
use App\Models\Stars;
use App\Models\VirtualTour;
use App\Models\HomepageSlider;
use App\Models\AboutUs;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'special' => Special::where('status', 1)->first(),
            'promotions' => Promotion::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get(),
            'Recreations' => Recreation::where('status', 1)->get(),
            'accomodations' => Accomodation::where('status', 1)->get(),
            'testimonial' => Testimonial::where('status', 1)->get(),
            'social_link' => SocialLink::select('map_link')->where('status', 1)->first(),
            'aboutUs' => AboutUs::where('status', 1)->get()
            ];
        
        if ($request->is('/')) {
            $data['homepage_sliders'] = HomepageSlider::where('status', 1)
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return view('web.pages.home', $data);
    }

    public function chat()
    {
        $loggedInUserId = Auth::id();
        $users = User::where('id', '!=', $loggedInUserId)->get();
        return view('chat',compact('users'));
    }

    public function accommodation()
    {
        $accommodation = Accomodation::where('status', 1)->get();
        return view('web.pages.accommodation', [
            'accommodations' => $accommodation,
        ]);
    } 

    public function dining()
    {
        $dining = Dining::where('status', 1)->get();

        return view('web.pages.dining', [
            'dininges' => $dining,
        ]);
    }

    public function promotion()
    {
        return view('web.pages.promotions', [
            'promotions' => Promotion::where('status', 1)->get(),
            'special' => Special::where('status', 1)->first(),
            'social_link' => SocialLink::select('map_link')->where('status', 1)->first()
        ]);
    }

    public function meetingsEvents()
    {
        $meeting = Meeting::where('status', 1)->get();

        return view('web.pages.meetingsEvents', [
            'meetings' => $meeting,
        ]);
    }

    public function recreation()
    {
        $recreation = Recreation::with('recreation_galleries')->where('status', 1)->get();
        // echo "<pre>";
        // print_r($recreation);
        // exit;
        return view('web.pages.recreation', [
            'recreations' => $recreation,
        ]);
    }

    public function payOnLine()
    {
        return view('web.pages.payOnLine');
    }

    public function virtualTours()
    {
        $virtual_tour = VirtualTour::where('status', 1)->get();

        return view('web.pages.virtualTours', [
            'virtual_tours' => $virtual_tour,
        ]);
    }

    public function photoGallery()
    {
        $gallery_photos = PhotoGallery::where('status', 1)->get();

        return view('web.pages.photoGallery', [
            'gallery_photos' => $gallery_photos,
        ]);
    }

    public function loyaltyProgram()
    {
        $with_title = Stars::where('status', 1)->where('title', '!=', '')->first();
        $without_title = Stars::where('status', 1)->where('title', '=', null)->get();
        $images = Stars::select('image')->where('status', 1)->where('image', '!=', '')->get();
        // dd($images);

        return view('web.pages.loyaltyProgram', [
            'with_title' => $with_title,
            'without_title' => $without_title,
            'images' => $images
        ]);
    }

    public function contact(Request $request)
    {
        $addresses = Address::where('status', 1)->get();
        $social_link = SocialLink::select('map_link')->where('status', 1)->first();

        // dd($social_link);
        return view('web.pages.contact', [
            'addresses' => $addresses,
            'social_link' => $social_link
        ]);
    }

    public function bookingQuery(Request $request)
    {
        $addresses = Address::where('status', 1)->get();
        $social_link = SocialLink::select('map_link')->where('status', 1)->first();

        // dd($social_link);
        return view('web.pages.bookingQuery', [
            'addresses' => $addresses,
            'social_link' => $social_link
        ]);
    }

    public function contactMail(Request $request) {
        $data = $request->except('_token');

        try {
            Mail::to('pervej@cubixbd.com')->send(new ContactMail($data));

            return back()->with('success', 'Your message has been sent successfully!');

        } catch (Exception $e) {
             return back()->with('error', 'Something went wrong!');
        }
    }

    public function bookNow()
    {
        $accommodation = Accomodation::where('status', 1)->get();

        return view('web.pages.bookNow', [
            'accommodations' => $accommodation,
        ]);
    }

    public function BookingDetails()
{
    $apiUrl = env('API_URL');

    $countryUrl = "$apiUrl/countrysList";
    $roomTypesUrl = "$apiUrl/roomTypes";
    $settingsUrl = "$apiUrl/settings";

    $chCurl = curl_init();
    // Set cURL options
    curl_setopt($chCurl, CURLOPT_URL, $settingsUrl);
    curl_setopt($chCurl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($chCurl, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
    ]);

    $settingsResponse = curl_exec($chCurl);
    if (curl_errno($chCurl)) {
        echo 'cURL error: ' . curl_error($chCurl);
        curl_close($chCurl);
        exit;
    }

    curl_close($chCurl);
    $settingsData = json_decode($settingsResponse, true);
    $token_rules=explode('#', base64_decode($settingsData['data']['rules_for_keys']));
    
    $key=md5($token_rules[0].date("Y-m-d"));

    $chCountry = curl_init();
    curl_setopt($chCountry, CURLOPT_URL, $countryUrl);
    curl_setopt($chCountry, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($chCountry, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' . $key,  
    ]);
    
    $countryResponse = curl_exec($chCountry);

    // Handle cURL errors for country request
    if(curl_errno($chCountry)) {
        // Handle the error (for example, log the error)
        curl_close($chCountry);
        return view('web.pages.bookNow')->with('error', 'Error fetching countries: ' . curl_error($chCountry));
    }
    curl_close($chCountry);

    $chRoomTypes = curl_init();
    
    curl_setopt($chRoomTypes, CURLOPT_URL, $roomTypesUrl);
    curl_setopt($chRoomTypes, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($chRoomTypes, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' .$key, 
    ]);
    $roomTypesResponse = curl_exec($chRoomTypes);

    // Handle cURL errors for room types request
    if(curl_errno($chRoomTypes)) {
        // Handle the error (for example, log the error)
        curl_close($chRoomTypes);
        return view('web.pages.bookNow')->with('error', 'Error fetching room types: ' . curl_error($chRoomTypes));
    }
    curl_close($chRoomTypes);

    // Decode the JSON responses to arrays
    $countries = json_decode($countryResponse, true);
    $roomTypes = json_decode($roomTypesResponse, true);
    $countrylist= $countries['data'];
    $roomType= $roomTypes['data'];

    return view('web.pages.bookNow', ['roomTypes' => $roomType, 'countries' => $countrylist]);
}
    public function roomDetails($slug)
    {
        $accommodation = Accomodation::where('slug', $slug)
            ->with('accommodation_gallaries')
            ->firstOrFail();
        

            // dd($accommodation->accommodation_gallaries->toArray());


        return view('web.pages.roomDetails', [
            'accommodation' => $accommodation,
        ]);
    }
}