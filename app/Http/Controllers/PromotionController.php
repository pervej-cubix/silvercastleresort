<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Special;
use Illuminate\Http\Request;
use Laravel\Prompts\Prompt;

class PromotionController extends Controller
{

    public function index(){
        return view('admin.pages.promotion.manage',[
            'promotions'=> Promotion::all(),
            'special'=> Special::first(),
        ]);
    }

    public function store(Request $request){
        Promotion::savePromotion($request);
        return back()->with('saveMessage', 'Save Successfully');
    }

    public function edit($id){
        return view('admin.pages.promotion.edit',[
            'promotion' => Promotion::find($id)
        ]);
    }

    public function update(Request $request, $id){
        Promotion::updatePromotion($request, $id);
        return redirect()->route('promotion-view')->with('success', 'Edit successfully');
    }


    public function delete($id){
        $promotion = Promotion::find($id);

        if ($promotion)
        {
            $promotion->delete();
            return back()->with('message', 'delete successfully');
        }
        else{
            return back()->with('errorr', 'image not found');
        }
    }


    public function special_edit($id){
        return view('admin.pages.promotion.specialEdit',[
            'special' => Special::find($id)
        ]);
    }

    public function special_update(Request $request, $id){
        Special::updateSpecial($request, $id);
        return redirect()->route('promotion-view')->with('special', 'Edit successfully');
    }

}