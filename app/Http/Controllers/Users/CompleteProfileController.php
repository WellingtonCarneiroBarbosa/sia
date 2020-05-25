<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompleteProfileController extends Controller
{
    public function index()
    {
        return view('auth.complete-profile.index');
    }

    public function stageOne()
    {
        return view('auth.complete-profile.stageOne');
    }

    public function stageTwo()
    {
        return view('auth.complete-profile.stageTwo');
    }

    public function stageThree()
    {
        return view('auth.complete-profile.stageThree');
    }
}