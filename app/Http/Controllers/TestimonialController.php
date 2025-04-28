<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index(){
        return view('admin.pages.testimonial.manage',[
            'testimonial'=> Testimonial::all(),
        ]);
    }

    public function store(Request $request){
        $data = $request->all();
        Testimonial::saveTestimonail($request); 
        return back()->with('saveMessage', 'Save Successfully'); 
   }

   public function edit($id){
    return view('admin.pages.testimonial.edit',[
        'testimonial' => Testimonial::find($id)
    ]);
    }

    public function update(Request $request, $id){
        Testimonial::updateTestimonial($request, $id);
        return redirect()->route('testimonial-view')->with('success', 'Edited successfully');
    }

    public function delete($id){
        $testimonial = Testimonial::find($id);
 
        if ($testimonial)
        {
            $testimonial->delete();
            return back()->with('message', 'Deleted successfully');
        }
        else{
            return back()->with('errorr', 'image not found');
        }
    }
}
