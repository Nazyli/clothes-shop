<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterCategory;
use Illuminate\Http\Request;

class MasterCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = MasterCategory::all();
        return view('admin.category.index', compact('categories'));
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
        MasterCategory::create($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterCategory  $masterCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MasterCategory $masterCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterCategory  $masterCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterCategory $category)
    {
        //
        $categories = MasterCategory::all();
        return view('admin.category.index')->with(compact('category'))->with(compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterCategory  $masterCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
        MasterCategory::find($id)->update($request->all());

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterCategory  $masterCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        MasterCategory::find($id)->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
