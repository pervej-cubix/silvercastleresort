<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\AccomodationGallary;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public $accomodation;

    public function index(){
        return view('admin.pages.accommodation.manage',[
            'accomodations'=>Accomodation::all(),
        ]);
    }

    public function create(){
        return view('admin.pages.accommodation.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'roomType' => 'required|string|max:255',
            'roomSize' => 'required|string|max:255',
            'noRoom' => 'required|integer|min:1',
            'occupancy' => 'required|integer|min:1',
            'rakeRate' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'accommodation_gallaries' => 'nullable|array',
            'accommodation_gallaries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());
    
        $this->accomodation= Accomodation::saveAccomodation($request);
        AccomodationGallary::saveAccommodationGallary($request->accommodation_gallaries, $this->accomodation->id);
        return back()->with('messages', 'Accommodation save successfully');
    }

    public function edit($id){
        return view('admin.pages.accommodation.edit',[
            'accomodation'=> Accomodation::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'roomType' => 'required|string|max:255',
            'roomSize' => 'required|string|max:255',
            'noRoom' => 'required|integer|min:1',
            'occupancy' => 'required|integer|min:1',
            'rakeRate' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'accommodation_gallaries' => 'nullable|array',
            'accommodation_gallaries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());
    
        $this->accomodation= Accomodation::updateAccomodation($request, $id);
        if ($request->accommodation_gallaries){
            AccomodationGallary::updateAccommodationGallary($request->accommodation_gallaries, $id);
        }
        return back()->with('messages', 'Accommodation save successfully');
    }

    public function destroy($id)
    {
        $accomodation = Accomodation::find($id);

        if ($accomodation) {
            if (file_exists($accomodation->image)) {
                unlink($accomodation->image);
            }
            foreach ($accomodation->accommodation_gallaries as $gallery) {
                if (file_exists($gallery->accommodation_photo)) {
                    unlink($gallery->accommodation_photo);
                }
                $gallery->delete();
            }

            $accomodation->delete();
            return back()->with('message', 'Product deleted successfully');
        }

        return back()->with('error', 'Product not found');
    }
}
