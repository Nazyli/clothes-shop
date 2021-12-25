<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $address = Address::where("user_id", Auth::user()->id)->get();
        return view('user.address.index', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('user.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'address_name' => ['required'],
            'full_address' => ['required'],
            'zip_code' => ['required'],
            'lat' => ['required'],
            'long' => ['required'],
        ]);
        if ($request->is_main == "on") {
            Address::where("is_main", TRUE)->update(['is_main' => FALSE]);
        }

        Address::create([
            'user_id' => Auth::user()->id,
            'is_main' => $request->is_main == "on" ? TRUE : FALSE,
            'address_name' => $request->address_name,
            'full_address' => $request->full_address,
            'zip_code' => $request->zip_code,
            'lat' => $request->lat,
            'long' => $request->long,
        ]);
        return redirect()->route('address.index')->with('success', 'Address created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return json_encode(Address::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
        return view('user.address.edit')->with(compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'address_name' => ['required'],
            'full_address' => ['required'],
            'zip_code' => ['required'],
            'lat' => ['required'],
            'long' => ['required'],
        ]);

        $address = Address::find($id);
        if ($request->is_main == "on") {
            Address::where("is_main", 1)->update(array('is_main' => '0'));
        }
        $address->update([
            'is_main' => $request->is_main == "on" ? TRUE : FALSE,
            'address_name' => $request->address_name,
            'full_address' => $request->full_address,
            'zip_code' => $request->zip_code,
            'lat' => $request->lat,
            'long' => $request->long,
        ]);


        return redirect()->route('address.index')->with('success', 'Address updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Address::find($id)->delete();
        return redirect()->route('address.index')->with('success', 'Address deleted successfully.');
    }
}
