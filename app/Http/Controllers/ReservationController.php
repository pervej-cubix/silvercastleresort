<?php

namespace App\Http\Controllers;

use App\Mail\ReservationMail;
use App\Mail\ReservationApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use App\Models\AboutUs;

class ReservationController extends Controller
{
    public function sendReservationMail(Request $request){
        $checkinDate = Carbon::parse($request->input('checkin'));
        $checkoutDate = Carbon::parse($request->input('checkout'));
        $dayCount = $checkinDate->diffInDays($checkoutDate);
    
        DB::beginTransaction();
        try {
        // Prepare the data
        foreach ($request->roomTypes as $roomTypeData) {
            $data = [
                'checkin_date'      => $request->checkin,
                'checkout_date'     => $request->checkout,
                'room_type'         => $roomTypeData['roomType'], // from JS: roomType
                'noOf_room'         => $roomTypeData['noOfRoom'], // from JS: noOfRoom
                'pax_in'            => $request->adult_no,
                'child_in'          => $request->child_no,
                'country'           => $request->country,
                'title'             => $request->title,
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'email'             => $request->email,
                'phone'             => $request->phone,
                'address'           => $request->address,
                'guest_remarks'     => $request->requirements ?? 'N/A',
                'day_count'         => $dayCount,
                'reservation_mode'  => 1,
                'currency_type'     => 1,
                'conversion_rate'   => 1,
                'guest_source_id'   => 1,
                'reference_id'      => 29,
                'reservation_status'=> 0,
            ];
        
            // Save the data (example using Eloquent)
            Reservation::create($data);
        }        
                      
            // Send Mail to Website
            // Mail::to('pervej@cubixbd.com')->send(new ReservationMail($request->all()));
            DB::commit(); 
    
            return response()->json([
                'success' => true,
                'message' => 'Reservation saved and email sent successfully!'
            ], 200);
    
        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json([
                'success' => false,
                'message' => 'Failed to save reservation or send email. Error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function sendReservation(Request $request)
    {
        $apiUrl = env('API_URL');
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
   
        $checkinDate = Carbon::parse($request->input('checkin'));
        $checkoutDate = Carbon::parse($request->input('checkout'));

        $dayCount = $checkinDate->diffInDays($checkoutDate);

    //     $formData = $request->all();


        $data = [
            'checkin_date' => $request->checkin,
            'checkout_date' => $request->checkout,
            'room_type' => $request->roomtype,
            'pax_in' => $request->adult_no,
            'child_in' => $request->child_no,
            'country' => $request->country,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'guest_remarks' => $request->requirements??'N/A',
            // static property
            'day_count'  => $dayCount,
            'reservation_mode' => 1,
            'currency_type' => 1,
            'conversion_rate' => 1,
            'guest_source_id' => 1,
            'reference_id' => 29,
            'reservation_status' => 1,
        ];

        // $data = [
        //     'checkin_date' => $request->input('checkin'),
        //     'checkout_date' => $request->input('checkout'),
        //     'room_type' => $request->input('roomtype'),
        //     'pax_in' => $request->input('adult_no'),
        //     'child_in' => $request->input('child_no'),
        //     'country' => $request->input('country'),
        //     'title' => $request->input('title'),
        //     'first_name' => $request->input('first_name'),
        //     'last_name' => $request->input('last_name'),
        //     'email' => $request->input('email'),
        //     'phone' => $request->input('phone'),
        //     'address' => $request->input('address'),
        //     'guest_remarks' => $request->input('requirements')??'N/A',
        //     // static property
        //     'day_count'  => $dayCount,
        //     'reservation_mode' => 1,
        //     'currency_type' => 1,
        //     'conversion_rate' => 1,
        //     'guest_source_id' => 1,
        //     'reference_id' => 29,
        //     'reservation_status' => 2,
        // ];

        $server_url = "$apiUrl/store_reservation";
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $server_url);            // URL to send request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        // Return response as a string
        curl_setopt($ch, CURLOPT_POST, true);                  // Specify the request type (POST)
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  // The data to send

        // Set cURL options with proper header format
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: ' . $key,  // Make sure $key is correctly set in your code
        ]);

        // Execute cURL request
        $response = curl_exec($ch);

        // Check if cURL execution was successful
        if($response === false) {
            $errorMessage = curl_error($ch);
            curl_close($ch);  // Close cURL session
            // Log the cURL error or display it
            return back()->with([
                'messages' => 'cURL Error: ' . $errorMessage,
                'status' => 'error'
            ]);
        }


        curl_close($ch);

        // Decode the response
        $response = json_decode($response);

        // Check if the response is valid JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Handle the error if JSON is invalid
            return back()->with([
                'messages' => 'Invalid JSON response from API',
                'status' => 'error'
            ]);
        }

        // Check if the response contains the expected status
        if (isset($response->status) && $response->status == 'success') {
            $errorMessage = $response;

            return response()->json([
                'messages' => $errorMessage->message,
                'status' => $errorMessage->status
            ]);
        } else {
            $errorMessage = isset($response->fields) ? $response->fields : 'Unknown error';
            response()->json([
                'messages' => $errorMessage->message ?? 'Unknown error',
                'status' => $response->status ?? 'error'
            ]);
        }
    }

    public function showReservation(Request $request){
        
        return view('admin.pages.room_reservation.manage', [
            'reservations'=> Reservation::all(),
        ]);
    }

    public function sendGuestMail($id)
    {
        $reservation = Reservation::findOrFail($id);
    
        // Prepare data for the mail
        $data = [
            'email' => $reservation->email,
            'title' => $reservation->title,
            'first_name' => $reservation->first_name,
            'last_name' => $reservation->last_name,
            'room_type' => $reservation->room_type,
            'checkin_date' => $reservation->checkin_date,
            'checkout_date' => $reservation->checkout_date,
        ];

        // Send email
        Mail::to($data['email'])->send(new ReservationApproved($data));
    
        return back()->with('success', 'Reservation approval email sent successfully!');
    }

    // public function createAvailableReservation(Request $request){        
        
    // }

    // public function showAvailableReservation(Request $request){        
        
    //     return view('admin.pages.create.manage', compact('reservations'));
    // }

    public function reservationCheck(Request $request){         
        $data = [
            'checkin_date' => $request->checkin,
            'checkout_date' => $request->checkout,
            'room_type' => $request->roomtype,
            'room_quantity' => 1,
            "editRoomList" => []
        ];

        return response()->json([
            'success' => true,
            'message' => 'Reservation saved and email sent successfully!',
            'data' => $data
        ], 200);
        exit();
    }
    
    public function reservationCheckForApi(Request $request){        
        $apiUrl = env('API_URL');      
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
        
        $availabilityCheckUrl = "http://192.168.0.185/pms-ci/api/check_availabilty";
        
        $ch = curl_init($availabilityCheckUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        
        $data = [
            'checkIn2' => $request->checkin,
            'checkOut2' => $request->checkout,
            'roomTypeId' => $request->roomtype,
            'room_quantity' => 1,
            "editRoomList" => []
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: ' . $key 
        ]);

        $availabilityCheckResponse = curl_exec($ch);
        
        // Check for errors 
        if (curl_errno($ch)) {
            $error = curl_error($availabilityCheckResponse);
            curl_close($ch);
            return response()->json(['error' => $error], 500);
        }

        // Close cURL
        curl_close($ch);

        // Decode and return response
        $responseData = json_decode($availabilityCheckResponse, true);
        return response()->json($responseData);
    }

    public function index(Request $request)
    {
        $query = Reservation::query();

        if($request->filled('checkin_date')){
            redirect()->back()->with('error', 'Reservation status updated successfully.');
        }

        if ($request->filled('checkin_date')) {
            $query->whereDate('checkin_date', '>=', $request->checkin_date);
        }

        if ($request->filled('checkout_date')) {
            $query->whereDate('checkout_date', '<=', $request->checkout_date);
        }

        if ($request->filled('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        if ($request->filled('reservation_status')) {
            $query->where('reservation_status', $request->reservation_status);
        }

        $reservations = $query->orderBy('checkin_date')->paginate(10);

        return view('admin.pages.room_reservation.manage', compact('reservations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id); // Retrieve the record or fail
    
        $reservation->reservation_status = $request->input('reservation_status'); // Set new status
        $reservation->save(); // Save changes
    
        return redirect()->back()->with('success', 'Reservation status updated successfully.');
    }

    public function delete($id){
        $reservation = Reservation::find($id);

        if ($reservation)
        {
            $reservation->delete();
            return back()->with('message', 'delete successfully');
        }
        else{
            return back()->with('errorr', 'image not found');
        }
    }
}