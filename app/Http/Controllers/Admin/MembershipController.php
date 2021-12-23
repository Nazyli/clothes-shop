<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleMembership;
use App\Models\TransUserAuthLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = RoleMembership::all();
        return view('admin.user.create', compact('roles'));
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
        $image = $request->file('foto');
        if (isset($image)) {
            $publicPath = "user";
            $imageName = time() . '.' . $image->extension();
            $image->move($publicPath, $imageName);
            $img_url = $publicPath . "/" . $imageName;
        }

        // return response()->json(['success'=>$imageName]);

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'role_id' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'img_url' => isset($image) ? $img_url : null,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $roles = RoleMembership::all();
        return view('admin.user.create')->with(compact('user'))->with(compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);

        $image = $request->file('foto');
        if (isset($image)) {
            $publicPath = "user";
            $imageName = time() . '.' . $image->extension();
            $image->move($publicPath, $imageName);
            File::delete($user->img_url);
            $img_url = $publicPath . "/" . $imageName;
        }

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'role_id' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'img_url' => isset($image) ? $img_url : $user->img_url,
        ]);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        TransUserAuthLog::where('user_id', $id)->delete();
        $user = User::find($id);
        File::delete($user->img_url);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
