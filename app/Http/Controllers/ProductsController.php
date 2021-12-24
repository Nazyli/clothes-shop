<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\GoodsSize;

class ProductsController extends Controller
{
    //
    public function index()
    {
        //
        $goods = Goods::where('is_active', Goods::IS_ACTIVE_YES)->paginate(12);
        return view('products', compact('goods'));
    }

    public function show($id)
    {
        //
        $goods = Goods::find($id);
        return view('products-detail')->with(compact('goods'));
    }

    public function getSizeByColorId($id)
    {
        $kec = GoodsSize::where('goods_color_id', $id)->get();
        return json_encode($kec);
    }
}
