<?php

namespace App\Http\Controllers;
use App\Models\HomepageSlider;
use Illuminate\Http\Request; 

class HomepageSliderController extends Controller
{
    public function index(){
        return view('admin.pages.homepage_slider.manage',[
            'homepageSliders'=> HomepageSlider::all(),
        ]);
    }

    public function store(Request $request){
        $data = HomepageSlider::all();
        HomepageSlider::saveHomepageSlider($request); 
        return back()->with('saveMessage', 'Save Successfully');
    }

    public function edit($id){
        return view('admin.pages.homepage_slider.edit',[
            'homepageSlider' => HomepageSlider::find($id)
        ]);
    }

    public function update(Request $request, $id){
        HomepageSlider::updateHomepageSlider($request, $id);
        return redirect()->route('homepage-slider-view')->with('success', 'Edit successfully');
    }

    public function delete($id){
        $homepageSlider = HomepageSlider::find($id);

        if ($homepageSlider)
        {
            $homepageSlider->delete();
            return back()->with('message', 'delete successfully');
        }
        else{
            return back()->with('errorr', 'image not found');
        }
    }

}
