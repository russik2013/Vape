<?php

namespace App\Http\Controllers;

use App\User;
use App\Tank;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AdditionalParamsRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view("users.index",['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        if($request->exists('tanks')) {
            $ids = collect( Tank::whereIn( 'name', $request->input( 'tanks' ) )->get() )->map( function ($value){
                return $value->id;
            });
            $user->tanks()->attach($ids);
        }

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.single', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = User::with('tanks')->find($user_id);
        $tanks_names = $user->tanks->map(function($value){ return $value->name; });

        return view('users.create', ['user' => $user, 'tanks_names' => $tanks_names]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->update();

        if($request->exists('tanks')) {
            //delete old tanks
            $user->tanks()->detach();
            //add new tanks to user
            $ids = collect(Tank::whereIn('name', $request->input('tanks'))->get())->map(function ($value) {
                return $value->id;
            });
            $user->tanks()->attach($ids);
        }
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back();
    }

    /**
     * Get additional view for adding tanks to users
     *
     * @param \App\Http\Requests\AdditionalParamsRequest $request
     * @return \Illuminate\Http\Response
     * */
    public function getAdditionalViewForUsers( AdditionalParamsRequest $request)
    {
        return view('users.forAdditionalParams', ['index' => $request->input('index')]);
    }
}
