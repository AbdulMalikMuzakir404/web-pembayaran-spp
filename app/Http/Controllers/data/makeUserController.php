<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class makeUserController extends Controller
{
    public function showFormSiswa()
    {
        return view('data.makeUser');
    }

    public function showFormPetugas()
    {
        return view('data.makePetugas');
    }

    public function showDataCreate()
    {
        return view('data.dataCreate');
    }
}