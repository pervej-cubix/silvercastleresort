<?php

namespace App\Http\Controllers;

use App\Models\Stars;
use Illuminate\Http\Request;

class StarsController extends Controller
{
    public $stars;

    public function index()
    {
        return view('admin.pages.stars.manage', [
            'stars' => Stars::all(),
        ]);
    }

    public function create()
    {
        $title = Stars::select('title')->where('title', '!=', '')->first();
        // dd($title);
        return view('admin.pages.stars.create', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'string|max:255|nullable',
            'second_title' => 'required|string|max:255',
            'icon' => 'string|max:255|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'description' => 'required|min:3|max:1000',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->stars = Stars::saveStars($request);
        return back()->with('messages', 'Stars save successfully');
    }

    public function edit($id)
    {
        return view('admin.pages.stars.edit', [
            'star' => Stars::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'string|max:255|nullable',
            'second_title' => 'required|string|max:255',
            'icon' => 'string|max:255|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'description' => 'required|min:3|max:1000',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->stars = Stars::updateStars($request, $id);
        return back()->with('messages', 'Stars update successfully');
    }


    public function destroy($id)
    {
        $star = Stars::find($id);

        if ($star) {
            if (file_exists($star->image)) {
                unlink($star->image);
            }

            $star->delete();
            return back()->with('message', 'Star deleted successfully');
        }

        return back()->with('error', 'Star   not found');
    }
}
