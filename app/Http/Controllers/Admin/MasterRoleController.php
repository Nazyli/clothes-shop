<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleMembership;
use Illuminate\Http\Request;

class MasterRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = RoleMembership::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
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
        RoleMembership::create($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoleMembership  $roleMembership
     * @return \Illuminate\Http\Response
     */
    public function show(RoleMembership $role)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleMembership  $roleMembership
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleMembership $role)
    {
        //
        $roles = RoleMembership::all();
        return view('admin.role.index')->with(compact('role'))->with(compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoleMembership  $roleMembership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
        RoleMembership::find($id)->update($request->all());

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleMembership  $roleMembership
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        RoleMembership::find($id)->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
    }
}
