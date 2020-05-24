<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Lang;

class SystemUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->where('id', '!=', auth()->user()->id)->orderBy('name')->paginate(config('app.paginate_limit'));
        
        $hasUsers = hasData($users);

    	return view('app.dashboard.users.index',
    	[
    		'users' => $users, 'hasUsers' => $hasUsers
    	]);

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return view('app.dashboard.users.show',
        [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Confirm before disable
     * a user
     * 
     */
    public function confirmDestroy($id)
    {
        $user = User::findOrFail($id);

        return view('app.dashboard.users.confirmDestroy',
        [
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $disable = User::destroy($id);

        if(!$disable)
        {
            return redirect()->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }


        return redirect()->route('users.index')->with(['status' => Lang::get('Disabled User')]);
    }

    /**
     * Confirm before restore
     * 
     */
    public function confirmRestore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        return view('app.dashboard.users.confirmRestore',
        [
            'user' => $user
        ]);
    }

    /**
     * Restore a disabled user
     * 
     */
    public function restore($id){
        $activate = User::onlyTrashed()->restore($id);

        if(!$activate)
        {
            return redirect()->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        return redirect()->route('users.index')->with(['status' => Lang::get('Activated User')]);
    }
}