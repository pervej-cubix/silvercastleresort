<?php

namespace App\Http\Controllers;

use App\Models\Dining;
use App\Models\DiningGallary;
use Illuminate\Http\Request;

class DiningController extends Controller
{
    public $dining;

    public function index(){
        return view('admin.pages.dining.manage',[
            'dininges'=>Dining::all(),
        ]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'diningName' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'Features1' => 'required|string|max:255',
            'Features2' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dining_gallaries' => 'nullable|array',
            'dining_gallaries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:1,0',
        ]);
    
        $this->dining= Dining::saveDining($request);
        DiningGallary::saveDiningGallary($request->dining_gallaries, $this->dining->id);
        return back()->with('messages', 'Dining save successfully');
    }

    public function edit($id){
        return view('admin.pages.dining.edit',[
            'dining'=> Dining::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'diningName' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'Features1' => 'required|string|max:255',
            'Features2' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dining_gallaries' => 'nullable|array',
            'dining_gallaries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:1,0',
        ]);

        // dd($request->all());
    
        $this->dining= Dining::updateDining($request, $id);
        if ($request->dining_gallaries){
            DiningGallary::updateDiningGallary($request->dining_gallaries, $id);
        }
        return back()->with('messages', 'Dining save successfully');
    }


    public function destroy($id)
    {
        $dining = Dining::find($id);

        if ($dining) {
            if (file_exists($dining->image)) {
                unlink($dining->image);
            }
            foreach ($dining->dining_gallaries as $gallery) {
                if (file_exists($gallery->dining_photo)) {
                    unlink($gallery->dining_photo);
                }
                $gallery->delete();
            }

            $dining->delete();
            return back()->with('message', 'Dining deleted successfully');
        }

        return back()->with('error', 'Product not found');
    }
}
