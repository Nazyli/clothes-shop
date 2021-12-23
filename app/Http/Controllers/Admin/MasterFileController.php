<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\MasterFileUpload;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class MasterFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'url_path' => ['required', 'mimes:png,jpg,jpeg'],
        ]);
        $publicPath = "product";
        $file = $request->file('url_path');
        $imageName =  time() . '-0.' . $file->extension();
        $file->move($publicPath, $imageName);
        MasterFileUpload::create([
            'goods_id' => $request->goods_id,
            'url_path' =>  $publicPath . "/" . $imageName
        ]);

        return redirect()->route('files.show', $request->goods_id)->with('success', 'Product Picture upload successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterFileUpload  $masterFileUpload
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $files = MasterFileUpload::where('goods_id', $id)->get();
        $goods = Goods::find($id);
        return view('admin.goods.showfile')->with(compact('goods'))->with(compact('files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterFileUpload  $masterFileUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterFileUpload $file)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterFileUpload  $masterFileUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterFileUpload $masterFileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterFileUpload  $masterFileUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $fileUpload = MasterFileUpload::find($id);
        File::delete($fileUpload->url_path);
        $fileUpload->delete();
        return redirect()->route('files.show', $fileUpload->goods_id)->with('success', 'Product Picture deleted successfully.');
    }
}
