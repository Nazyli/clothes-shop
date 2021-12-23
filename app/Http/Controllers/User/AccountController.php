<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class AccountController extends Controller
{
    public function profile()
    {
        $data['user'] = auth()->user();
		// dd($data);
        return view('user.profile', $data);
    }
}
