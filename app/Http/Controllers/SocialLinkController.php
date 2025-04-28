<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use App\Models\VirtualTour;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public $social_link;

    public function index()
    {
        return view('admin.pages.social_links.manage', [
            'social_links' => SocialLink::all(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.social_links.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'mobile' => 'required',
            'map_link' => 'required|url',
            'fb_link' => 'required|url',
            'instagram_link' => 'required|url',
            'youtube_link' => 'required|url',
            'whatsapp_link' => 'required|url',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->social_link = SocialLink::saveSocialLink($request);
        return back()->with('messages', 'Social Link save successfully');
    }

    public function edit($id)
    {
        return view('admin.pages.social_links.edit', [
            'social_link' => SocialLink::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'mobile' => 'required',
            'map_link' => 'required|url',
            'fb_link' => 'required|url',
            'instagram_link' => 'required|url',
            'youtube_link' => 'required|url',
            'whatsapp_link' => 'required|url',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->social_link = SocialLink::updateSocialLink($request, $id);
        return back()->with('messages', 'Social link update successfully');
    }


    public function destroy($id)
    {
        $social_link = SocialLink::find($id);

        if ($social_link) {

            $social_link->delete();
            return back()->with('message', 'Social link deleted successfully');
        }

        return back()->with('error', 'Social link not found');
    }
}
