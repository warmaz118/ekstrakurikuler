<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaSMPController extends Controller
{
    public function index()
    {
        return view('siswa.smp.index');
    }
}
