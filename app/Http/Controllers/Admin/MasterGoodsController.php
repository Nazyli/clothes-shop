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
use Illuminate\Support\Facades\File;

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
                $publicPath = "product";
                foreach ($files as $file) {
                    $imageName =  $time . '-' . $no++ . '.' . $file->extension();
                    $file->move($publicPath, $imageName);
                    $images[] = [
                        'goods_id' => $goodsId,
                        'url_path' =>  $publicPath . "/" . $imageName
                    ];
                }
            }
            MasterFileUpload::insert($images);

            if ($request->color) {
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
            }

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
        $category = MasterCategory::all();
        return view('admin.goods.show')->with(compact('goods'))->with(compact('category'));
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
    public function update(Request $request, $id)
    {
        //
        $goods = Goods::find($id);


        $goods->update([
            'goods_name' => $request->goods_name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_active' => $request->is_active,
            'base_price' => $request->base_price,
            'total_qty' => GoodsSize::totalQty($id),
        ]);
        return response()->json(['success' => true]);
    }

    function addColor(Request $request)
    {
        $goodsId = $request->goods_id;

        DB::beginTransaction();
        try {
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
                    $goodsSize->save();
                }
            }
            Goods::where("id", $goodsId)->update(array('total_qty' => GoodsSize::totalQty($goodsId)));
            DB::commit();
            return redirect()->route('goods.show', $goodsId)->with('success', 'New color created successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('goods.show', $goodsId)->with('error', 'Failed to created new color');
        }
    }

    function colorUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->input('pk')) {
                GoodsColor::find($request->input('pk'))->update(
                    [$request->input('name') => $request->input('value')]
                );
                DB::commit();
                return response()->json(['success' => 'Size updated successfully.']);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->errorInfo[2]], 500);
        }
    }

    function sizeUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            $message = [];
            $goodsColorId = 0;
            if ($request->input('pk')) {
                $goodSize = GoodsSize::find($request->input('pk'));
                $goodSize->update(
                    [$request->input('name') => $request->input('value')]
                );
                $goodsColorId = $goodSize->goods_color_id;
                $message = ['success' => 'Size updated successfully.'];
            } else {
                $goodsSize = new GoodsSize();
                $goodsSize->goods_color_id = $request->goods_color_id;
                $goodsSize->size = $request->size;
                $goodsSize->additional_price = $request->additional_price;
                $goodsSize->qty = $request->qty;
                $goodsSize->save();
                $goodsColorId =  $request->goods_color_id;
                $message = ['success' => 'Size created successfully.'];
            }
            $goodsId = GoodsColor::find($goodsColorId)->goods_id;
            Goods::where("id", $goodsId)->update(array('total_qty' => GoodsSize::totalQty($goodsId)));
            DB::commit();
            return response()->json($message);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->errorInfo[2]], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();
        try {
            $goods = Goods::find($id);
            $goodsColor = GoodsColor::where('goods_id', $id)->get();
            foreach ($goodsColor as $color) {
                GoodsSize::where('goods_color_id', $color->id)->delete();
                $color->delete();
            }
            $fileUpload = MasterFileUpload::where('goods_id', $id)->get();
            foreach ($fileUpload as $f) {
                File::delete($f->url_path);
                $f->delete();
            }
            $goods->delete();
            DB::commit();
            return redirect()->route('goods.index')->with('success', 'Goods deleted successfully.');
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->route('goods.index')->with('error', $e->errorInfo[2]);
        }
    }

    public function destroyColor($id)
    {
        //
        $goodsColor = GoodsColor::find($id);
        $goodsId = $goodsColor->goods_id;

        DB::beginTransaction();
        try {
            GoodsSize::where('goods_color_id', $id)->delete();
            $goodsColor->delete();

            Goods::where("id", $goodsId)->update(array('total_qty' => GoodsSize::totalQty($goodsId)));
            DB::commit();
            return redirect()->route('goods.show', $goodsId)->with('success', 'Color deleted successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('goods.show', $goodsId)->with('error', $e->errorInfo[2]);
        }
    }

    public function destroySize($id)
    {
        //
        $goodSize = GoodsSize::find($id);
        $goodsId = GoodsColor::find($goodSize->goods_color_id)->goods_id;
        $goodSize->delete();
        Goods::where("id", $goodsId)->update(array('total_qty' => GoodsSize::totalQty($goodsId)));
        return redirect()->route('goods.show', $goodsId)->with('success', 'Size deleted successfully.');
    }
}
