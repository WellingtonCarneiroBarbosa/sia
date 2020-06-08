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
}
