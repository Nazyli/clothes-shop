<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterCategory;
use App\Models\Goods;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $data['categorys'] = MasterCategory::all();
        $data['goods'] = Goods::with(['category'])->where('is_active', Goods::IS_ACTIVE_YES)->limit(9)->orderBy('id', 'desc')->get();
        return view('welcome', $data);
    }

    public function adminHome()
    {
        return view('admin.index');
    }

    public function userHome()
    {
        return view('user.index');
    }
}
