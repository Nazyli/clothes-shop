<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterFaq;
use Illuminate\Http\Request;


class MasterFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faqs = MasterFaq::all();
        return view('admin.faq.index', compact('faqs'));
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
        MasterFaq::create($request->validate([
            'title' => 'required',
            'body' => 'required',
        ]));

        return redirect()->route('faq.index')->with('success', 'FAQ created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterFaq  $masterFaq
     * @return \Illuminate\Http\Response
     */
    public function show(MasterFaq $masterFaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterFaq  $masterFaq
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterFaq $faq)
    {
        //
        $faqs = MasterFaq::all();
        return view('admin.faq.index')->with(compact('faq'))->with(compact('faqs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterFaq  $masterFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        MasterFaq::find($id)->update($request->all());

        return redirect()->route('faq.index')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterFaq  $masterFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        MasterFaq::find($id)->delete();
        return redirect()->route('faq.index')->with('success', 'FAQ deleted successfully.');

    }
}
