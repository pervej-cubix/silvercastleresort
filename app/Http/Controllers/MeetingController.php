<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingGallary;
use Illuminate\Http\Request;

class MeetingController extends Controller
{


    public $meeting;

    public function index(){
        return view('admin.pages.meeting.manage',[
            'meetings'=>Meeting::all(),
        ]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'meetingName' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'Features1' => 'required|string|max:255',
            'Features2' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meeting_gallaries' => 'nullable|array',
            'meeting_gallaries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:1,0',
        ]);
    
        $this->meeting= Meeting::saveMeeting($request);
        MeetingGallary::saveMeetingGallary($request->meeting_gallaries, $this->meeting->id);
        return back()->with('messages', 'Meeting & Events save successfully');
    }

    public function edit($id){
        return view('admin.pages.meeting.edit',[
            'meeting'=> Meeting::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'meetingName' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'Features1' => 'required|string|max:255',
            'Features2' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meeting_gallaries' => 'nullable|array',
            'meeting_gallaries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:1,0',
        ]);

        // dd($request->all());
    
        $this->meeting= Meeting::updateMeeting($request, $id);
        if ($request->meeting_gallaries){
            MeetingGallary::updateMeetingGallary($request->meeting_gallaries, $id);
        }
        return back()->with('messages', 'Meetings & Events save successfully');
    }


    public function destroy($id)
    {
        $meeting = Meeting::find($id);

        if ($meeting) {
            if (file_exists($meeting->image)) {
                unlink($meeting->image);
            }
            foreach ($meeting->meeting_gallaries as $gallery) {
                if (file_exists($gallery->meeting_photo)) {
                    unlink($gallery->meeting_photo);
                }
                $gallery->delete();
            }

            $meeting->delete();
            return back()->with('message', 'Meetings & Events deleted successfully');
        }

        return back()->with('error', 'Meetings & Events not found');
    }


}
