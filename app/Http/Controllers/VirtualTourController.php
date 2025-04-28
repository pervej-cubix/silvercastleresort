<?php

namespace App\Http\Controllers;

use App\Models\VirtualTour;
use Illuminate\Http\Request;

class VirtualTourController extends Controller
{
    public $virtual_tour;

    public function index()
    {
        return view('admin.pages.virtual_tour.manage', [
            'virtual_tours' => VirtualTour::all(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.virtual_tour.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->virtual_tour = VirtualTour::saveVirtualTour($request);
        return back()->with('messages', 'Virtual tour save successfully');
    }

    public function edit($id)
    {
        return view('admin.pages.virtual_tour.edit', [
            'virtual_tour' => VirtualTour::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->virtual_tour = VirtualTour::updateVirtualTour($request, $id);
        return back()->with('messages', 'Virtual tour update successfully');
    }


    public function destroy($id)
    {
        $virtual_tour = VirtualTour::find($id);

        if ($virtual_tour) {
            if (file_exists($virtual_tour->image)) {
                unlink($virtual_tour->image);
            }

            $virtual_tour->delete();
            return back()->with('message', 'Virtual tour deleted successfully');
        }

        return back()->with('error', 'Virtual tour not found');
    }
}
