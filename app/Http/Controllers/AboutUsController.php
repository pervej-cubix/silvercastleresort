<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function index(){
        return view('admin.pages.about_us.manage',[
            'aboutUs'=> aboutUs::all(),
            // 'homepageSliders'=> HomepageSlider::all(),
        ]);
    }

    public function store(Request $request){
        $data = $request->all();
        aboutUs::saveAboutUs($request); 
        return back()->with('saveMessage', 'Save Successfully'); 
   }
    
   public function edit($id){
        return view('admin.pages.about_us.edit',[
            'aboutUs' => AboutUs::find($id)
        ]);
    }

    public function update(Request $request, $id){
        AboutUs::updateAboutUs($request, $id);
        return redirect()->route('aboutUs-view')->with('success', 'Edit successfully');
    }

    public function delete($id){
        $aboutUs = AboutUs::find($id);

        if ($aboutUs)
        {
            $aboutUs->delete();
            return back()->with('message', 'delete successfully');
        }
        else{
            return back()->with('errorr', 'image not found');
        }
    }

}
