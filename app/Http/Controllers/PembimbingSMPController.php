<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembimbingSMPController extends Controller
{
    public function index()
    {
        return view('pembimbing.smp.index');
    }
}
