<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
    public $photo_gallery;

    public function index()
    {
        return view('admin.pages.photo_gallery.manage', [
            'gallery_photos' => PhotoGallery::all(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.photo_gallery.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->photo_gallery = PhotoGallery::savePhotoGallery($request);
        return back()->with('messages', 'Photo save successfully');
    }

    public function edit($id)
    {
        return view('admin.pages.photo_gallery.edit', [
            'gallery_photo' => PhotoGallery::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->photo_gallery = PhotoGallery::updatePhotoGallery($request, $id);
        return back()->with('messages', 'Photo update successfully');
    }


    public function destroy($id)
    {
        $photo_gallery = PhotoGallery::find($id);

        if ($photo_gallery) {
            if (file_exists($photo_gallery->image)) {
                unlink($photo_gallery->image);
            }

            $photo_gallery->delete();
            return back()->with('message', 'Photo deleted successfully');
        }

        return back()->with('error', 'Photo not found');
    }
}
