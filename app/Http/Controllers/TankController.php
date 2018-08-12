<?php

namespace App\Http\Controllers;

use App\Http\Requests\TankRequest;
use App\Tank;
use Illuminate\Http\Request;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class TankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanks = Tank::all();

        return view("tanks.index",['tanks'=> $tanks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tanks.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TankRequest  $request
     * @return \Illuminate\Http\Response
     * @param  \App\Tank $tank
     */
    public function store(TankRequest $request, Tank $tank)
    {
        $tank->fill($request->all());
        $tank->save();

        return redirect('admin/tanks');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
    // * @param Tank $tank
     * @return \Illuminate\Http\Response
     */
    public function show($id) // ознакомься и пойми, зачем я добавил эти строки
    //public function show(Tank $tank)
    {
        $tank = Tank::with('params', 'params.settings')->find($id); // debugger в помощь
        return view("tanks.single",['tank' => $tank]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function edit(Tank $tank)
    {
        return view("tanks.create",['tank' => $tank]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TankRequest  $request
     * @param  \App\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function update(TankRequest $request, Tank $tank)
    {
        $tank->fill($request->all());
        $tank->update();
        return redirect('admin/tanks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tank::findOrFail($id)->delete();

        return redirect()->back();

    }
}
