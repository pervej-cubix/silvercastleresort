<?php

namespace App\Http\Controllers;

use App\Mail\ReservationMail;
use App\Mail\ReservationReceived;
use App\Mail\ReservationApproved;
use App\Mail\ReservationCancelled;
use App\Models\AvailableRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use App\Models\AboutUs;

class ReservationController extends Controller
{
    public function sendReservationMail(Request $request)
    {
        $data = $request->all();

        $checkin = Carbon::createFromFormat('d-m-Y', $request->checkin)->format('Y-m-d');
        $checkout = Carbon::createFromFormat('d-m-Y', $request->checkout)->format('Y-m-d');

        DB::beginTransaction();

        try {
            // Store reservation data
     $reservation = Reservation::create([
            'checkin'      => $checkin,
            'checkout'     => $checkout,
            'guest_type'   => $data['guestType'],
            'full_name'    => $data['guestDetails']['fullName'],
            'email'        => $data['guestDetails']['email'],
            'phone'        => $data['guestDetails']['phone'],
            'country'      => $data['guestDetails']['country'],
            'address'      => $data['guestDetails']['address'],
            'requirements' => $data['guestDetails']['requirements'] ?? 'N/A',
        ]);

            // Insert room types
            foreach ($data['roomTypes'] as $roomType) {
                $reservation->roomTypes()->create([
                    'room_type'  => $roomType['roomType'],
                    'no_of_room' => $roomType['no_of_room'],
                ]);
            }

            // Insert guest rooms
            foreach ($data['guestRooms'] as $room) {
                $reservation->guestRooms()->create([
                    'room_type' => $room['roomType'],
                    'room'      => $room['room'],
                    'adults'    => $room['adults'],
                    'children'  => $room['children'],
                ]);
            }

            // Prepare and send email
            $reservation->load(['roomTypes', 'guestRooms']); // eager load
            $mailData = $reservation->toArray();

            // Send to admin
            // Mail::to('pervej@cubixbd.com')->send(new ReservationMail($mailData));

            // Send to guest
            // Mail::to($reservation->email)->send(new ReservationReceived($mailData)); 

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reservation saved and email sent successfully!',
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
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

    public function showReservation(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $reservations = Reservation::with(['roomTypes', 'guestRooms'])->paginate($perPage);
  
        return view('admin.pages.room_reservation.manage', compact('reservations'));
    }

    public function sendGuestMail(Request $request, $id)
    {
        $data = Reservation::with('roomTypes')->findOrFail($id);    
    
        $status = $request->input('confirmation_status');
    
        if ($status == "1") {

            // Mail::to($data['email'])->send(new ReservationApproved($data));
            return back()->with('success', 'Reservation approval email sent successfully!');
        } elseif ($status == "0") {
            
            // Mail::to($data['email'])->send(new ReservationCancelled($data));
            return back()->with('success', 'Reservation cancellation email sent successfully!');
        } else {
            return back()->with('error', 'Invalid status! Please enter 0 for cancel or 1 for approve.');
        }
    }
    

    // public function createAvailableReservation(Request $request){        
        
    // }

    // public function showAvailableReservation(Request $request){        
        
    //     return view('admin.pages.create.manage', compact('reservations'));
    // }
    
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

        if ($request->filled('checkin')) {
            $query->whereDate('checkin', '>=', $request->checkin);
        }

        if ($request->filled('checkout')) {
            $query->whereDate('checkout', '<=', $request->checkout);
        }

        if ($request->filled('guest_type')) {
            $query->where('guest_type', $request->guest_type);
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        $reservations = $query->orderBy('checkin', 'asc')->paginate(10);

        return view('admin.pages.room_reservation.manage', compact('reservations'));
    }

    public function updateStatus(Request $request, $id)
    { 
        $data = Reservation::with('roomTypes')->findOrFail($id); // Retrieve the record or fail
        
        $inputStatus = $request->input('reservation_status');
        $data->reservation_status = $inputStatus;

        $data->save(); // Save changes
        

       if($inputStatus == "1"){
            Mail::to($data['email'])->send(new ReservationApproved($data));  
            return redirect()->back()->with('success', 'Status updated & email sent successfully.');      
       }else if ($inputStatus == "0"){
            Mail::to($data['email'])->send(new ReservationCancelled($data));
            return redirect()->back()->with('success', 'Status updated & email sent successfully.');           
       }
    
        return redirect()->back()->with('success', 'Status updated successfully.');
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