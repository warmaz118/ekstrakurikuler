<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembimbingSMAController extends Controller
{
    public function index()
    {
        return view('pembimbing.sma.index');
    }
}
