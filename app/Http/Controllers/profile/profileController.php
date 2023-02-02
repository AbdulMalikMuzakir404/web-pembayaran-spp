<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class profileController extends Controller
{
    public function showProfile()
    {
        return view('profile.showProfile');
    }

    public function changeProfile()
    {
        return view('profile.changeProfile');
    }
}
