<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaSMAController extends Controller
{
     public function index()
    {
        return view('siswa.sma.index');
    }
}
