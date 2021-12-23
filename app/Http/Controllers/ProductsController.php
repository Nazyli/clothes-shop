<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;


class ProductsController extends Controller
{
    //
    public function index()
    {
        //
        $goods = Goods::where('is_active', Goods::IS_ACTIVE_YES)->paginate(12);
        return view('products', compact('goods'));
    }
}
