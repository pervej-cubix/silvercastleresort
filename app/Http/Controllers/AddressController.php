<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Contact;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public $address;

    public function index()
    {
        return view('admin.pages.address.manage', [
            'addresses' => Address::all(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.address.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'address' => 'required|min:3|max:1000',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->address = Address::saveAddress($request);
        return back()->with('messages', 'Address save successfully');
    }

    public function edit($id)
    {
        return view('admin.pages.address.edit', [
            'address' => Address::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'address' => 'required|min:3|max:1000',
            'status' => 'required|in:0,1',
        ]);

        // dd($request->all());

        $this->address = Address::updateAddress($request, $id);
        return back()->with('messages', 'Address update successfully');
    }


    public function destroy($id)
    {
        $address = Address::find($id);

        if ($address) {
            $address->delete();
            return back()->with('message', 'Address deleted successfully');
        }

        return back()->with('error', 'Address not found');
    }
}
