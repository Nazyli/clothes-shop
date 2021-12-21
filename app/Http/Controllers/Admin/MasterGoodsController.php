<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\GoodsColor;
use App\Models\GoodsSize;
use App\Models\MasterCategory;
use App\Models\MasterFileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $goods = Goods::all();
        return view('admin.goods.index', compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = MasterCategory::all();
        return view('admin.goods.create', compact('category'));
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


        $this->validate($request, [
            'foto.*' => 'mimes:png,jpg,jpeg',
            'goods_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required'],
            'is_active' => ['required'],
            'base_price' => ['required', 'integer'],
        ]);

        DB::beginTransaction();
        try {

            $goodsId = Goods::create([
                'goods_name' => $request->goods_name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'is_active' => $request->is_active,
                'base_price' => $request->base_price,
                'total_qty' => isset($request->total_qty) ? $request->total_qty : 0,
            ])->id;

            $no = 1;
            $time = time();
            if ($files = $request->file('foto')) {
                foreach ($files as $file) {
                    $imageName =  $time . '-' . $no++ . '.' . $file->extension();
                    $file->move(public_path() . '/product/', $imageName);
                    $images[] = [
                        'goods_id' => $goodsId,
                        'url_path' =>  'product/' . $imageName
                    ];
                }
            }
            MasterFileUpload::insert($images);

            $total_qty = 0;
            foreach (($request->color) as $value) {
                $goodsColor = new GoodsColor();
                $goodsColor->goods_id = $goodsId;
                $goodsColor->color = $value['colorName'];
                $goodsColor->additional_price = $value['colorPrice'];
                $goodsColor->save();

                // add size by color
                $idColor = $goodsColor->id;
                foreach ($value['size']['sizeName'] as $key => $sizeName) {
                    $goodsSize = new GoodsSize();
                    $goodsSize->goods_color_id = $idColor;
                    $goodsSize->size = $sizeName;
                    $goodsSize->additional_price = $value['size']['priceSize'][$key];
                    $goodsSize->qty = $value['size']['qty'][$key];
                    $total_qty += $goodsSize->qty;
                    $goodsSize->save();
                }
            }
            
            Goods::where("id", $goodsId)->update(array('total_qty' => $total_qty));
            DB::commit();
            return redirect()->route('goods.index')->with('success', 'New Product created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('goods.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $goods = Goods::find($id);
        return view('admin.goods.show', compact('goods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function edit(Goods $goods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goods $goods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goods $goods)
    {
        //
    }
}
