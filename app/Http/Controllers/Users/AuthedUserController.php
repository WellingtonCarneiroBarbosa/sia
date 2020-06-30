<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthedUserController extends Controller
{
    public function showMyProfile()
    {
        return view('app.dashboard.my-profile.index');
    }

    public function editProfile()
    {
        return view('app.dashboard.my-profile.edit');
    }

    public function update(Request $request)
    {
        //
    }
}
