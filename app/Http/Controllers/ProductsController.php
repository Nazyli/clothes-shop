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
        $goods = Goods::paginate(12);
        return view('products', compact('goods'));
    }
}
