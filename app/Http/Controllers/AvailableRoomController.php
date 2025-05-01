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
    
        return view('admin.pages.room_reservation.create', compact('availableRooms'));
    }

    public function showAvailableRoom()
    {

        return view('admin.pages.room_reservation.create', [
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
