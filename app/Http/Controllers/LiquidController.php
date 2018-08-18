<?php

namespace App\Http\Controllers;

use App\Liquid;
use Illuminate\Http\Request;
use \App\Http\Requests\LiquidRequest;

class LiquidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liquids = Liquid::all();

        return view("liquids.index",['liquids'=> $liquids]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("liquids.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LiquidRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @param  \App\Liquid $liquid
     */
    public function store(LiquidRequest $request, Liquid $liquid)
    {
        $liquid->fill($request->all());
        $liquid->save();

        return redirect(route('liquids.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $liquid = Liquid::with('params', 'params.settings')->find($id); // debugger в помощь
        return view("liquids.single",['liquid' => $liquid]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Liquid  $liquid
     * @return \Illuminate\Http\Response
     */
    public function edit(Liquid $liquid)
    {
        return view("liquids.create",['liquid' => $liquid]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LiquidRequest  $request
     * @param  Liquid  $liquid
     * @return \Illuminate\Http\Response
     */
    public function update(LiquidRequest $request,Liquid $liquid)
    {
        $liquid->fill($request->all());
        $liquid->update();
        return redirect(route('liquids.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Liquid::findOrFail($id)->delete();

        return redirect()->back();
    }
}
