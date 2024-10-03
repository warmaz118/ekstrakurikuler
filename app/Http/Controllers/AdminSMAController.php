<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSMAController extends Controller
{
    public function index()
    {
        return view('admin.sma.index');
    }
}
