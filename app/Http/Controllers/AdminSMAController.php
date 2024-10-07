<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSMAController extends Controller
{
    public function index()
    {
        return view('admin.indexsma');
    }
}
