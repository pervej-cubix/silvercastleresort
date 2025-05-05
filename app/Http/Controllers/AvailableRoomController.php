<?php

namespace App\Http\Controllers;
use App\Models\AvailableRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AvailableRoomController extends Controller
{
    public function index()
    {
        $availableRooms = AvailableRoom::orderBy('created_at', 'desc')->get();
    
        return view('admin.pages.room_reservation.update', compact('availableRooms'));
    }

    public function showAvailableRoom()
    {
        return view('admin.pages.room_reservation.update', [
            'availableRooms' => AvailableRoom::all(),
            ]
        );
    }

    public function getAvailability($date)
    {
        $formatedDate = Carbon::createFromFormat('d-m-y', $date)->format('y-m-d');

        $dayColumn = 'd' . Carbon::parse($formatedDate)->day;

        $rooms = AvailableRoom::select('room_type', $dayColumn)->get();

        // Format the result: ['Deluxe Single' => 2, ...]
        $formatted = $rooms->pluck($dayColumn, 'room_type');

        return response()->json($formatted);
    }

    // public function reservationCheck(Request $request)
    // {
    //     $checkin = Carbon::parse($request->checkin);
    //     $checkout = Carbon::parse($request->checkout);
    
    //     // Ensure same month to stay within d1 to d31/d32 range
    //     if ($checkin->month !== $checkout->month) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Check-in and check-out must be in the same month.',
    //             'data' => []
    //         ], 400);
    //     }
    
    //     // Build dX columns based on day range
    //     $columns = [];
    //     for ($d = $checkin->day; $d <= $checkout->day; $d++) {
    //         $columns[] = 'd' . $d;
    //     }
    
    //     $selectColumns = array_merge(['room_type'], $columns);
    
    //     $rooms = AvailableRoom::select($selectColumns)->get();
    
    //     // sum available room total based on their type
    //     $availability = [];
    
    //     foreach ($rooms as $room) {
    //         $totalAvailable = 0;
    //         foreach ($columns as $col) {
    //             $totalAvailable += (int) $room->$col;
    //         }
    //         $availability[$room->room_type] = $totalAvailable;
    //     }
    
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Room availability calculated.',
    //         'data' => [
    //             'checkin_date' => $request->checkin,
    //             'checkout_date' => $request->checkout,
    //             'availability' => $availability,
    //         ],
    //     ]);
    // } 

    public function reservationCheck(Request $request)
    {
        $checkin = Carbon::parse($request->checkin);
        $checkout = Carbon::parse($request->checkout);
    
        if ($checkin->month !== $checkout->month) {
            return response()->json([
                'success' => false,
                'message' => 'Check-in and check-out must be in the same month.',
                'data' => []
            ], 400);
        }
    
        $columns = [];
        for ($d = $checkin->day; $d <= $checkout->day; $d++) {
            $columns[] = 'd' . $d;
        }
    
        $selectColumns = array_merge(['room_type'], $columns);
        $rooms = AvailableRoom::select($selectColumns)->get();
    
        $availability = [];
    
        foreach ($rooms as $room) {
            $dailyValues = [];
    
            foreach ($columns as $col) {
                $value = (int) $room->$col;
                $dailyValues[] = $value;
    
                // Real-world logic: if any day has 0, room is unavailable
                if ($value === 0) {
                    $availability[$room->room_type] = 0;
                    continue 2; // skip to next room_type
                }
            }
    
            // All values are > 0 — calculate GCD
            $availability[$room->room_type] = $this->calculateGCDForArray($dailyValues);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Room availability calculated.',
            'data' => $availability,
        ]);
    }
    
    private function calculateGCDForArray(array $numbers)
    {
        return array_reduce($numbers, function ($carry, $item) {
            return $this->gcd($carry, $item);
        });
    }
    
    private function gcd($a, $b)
    {
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'room_types' => 'required|array',
        ]);
        
        $formatedDate = Carbon::createFromFormat('d-m-y', $request->date)->format('y-m-d');     
        $date = Carbon::parse($formatedDate);

        $dayColumn = 'd' . $date->day; // e.g., d30 for April 30
        
        foreach ($request->room_types as $roomType => $noOfRooms) {
            if ($noOfRooms === null || $noOfRooms === '') {
                continue; // Skip empty inputs
            }
    
            // Find or create row for the room type
            $availableRoom = AvailableRoom::firstOrNew(['room_type' => $roomType]);
    
            // Set the appropriate day column with number of rooms
            $availableRoom->$dayColumn = $noOfRooms;
    
            $availableRoom->save();
        }    

        return redirect()->back()->with('success', 'Room availability updated successfully for ' . $date->toFormattedDateString() . '.');

        // return redirect()->route('available_room.index')->with('success', 'Room availability created.');
    }

    public function reset()
    {
       AvailableRoom::truncate(); // Use truncate to clear all records
        return redirect()->back()->with('success', 'All availability data has been reset.');
    }

    public function deleteAvailableRoom($id){
        $availableRooms = AvailableRoom::find($id);

        if ($availableRooms)
        {
            $availableRooms->delete();
            return back()->with('message', 'delete successfully');
        }
        else{
            return back()->with('errorr', 'image not found');
        }
    }
}
