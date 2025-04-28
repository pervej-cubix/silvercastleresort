<?php

namespace App\Http\Controllers;

use App\Models\Recreation;
use App\Models\RecreationGallery;
use Illuminate\Http\Request;

class RecreationController extends Controller
{
    public $recreation;

    public function index()
    {
        return view('admin.pages.recreation.manage', [
            'recreations' => Recreation::all(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.recreation.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'recreation_galleries' => 'nullable|array',
            'recreation_galleries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->recreation = Recreation::saveRecreation($request);
        RecreationGallery::saveRecreationGallery($request->recreation_galleries, $this->recreation->id);
        return back()->with('messages', 'Recreation save successfully');
    }

    public function edit($id)
    {
        return view('admin.pages.recreation.edit', [
            'recreation' => Recreation::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'recreation_galleries' => 'nullable|array',
            'recreation_galleries.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->recreation = Recreation::updateRecreation($request, $id);
        if ($request->recreation_galleries) {
            RecreationGallery::updateRecreationGallery($request->recreation_galleries, $id);
        }
        return back()->with('messages', 'Recreation update successfully');
    }


    public function destroy($id)
    {
        $recreation = Recreation::find($id);

        if ($recreation) {
            if (file_exists($recreation->image)) {
                unlink($recreation->image);
            }
            foreach ($recreation->recreation_galleries as $gallery) {
                if (file_exists($gallery->recreation_photo)) {
                    unlink($gallery->recreation_photo);
                }
                $gallery->delete();
            }

            $recreation->delete();
            return back()->with('message', 'Recreation deleted successfully');
        }

        return back()->with('error', 'Recreation not found');
    }
}
