<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LivepracticeController extends Controller
{
    public function index()
    {
        return view('admin.livepractice'); // Make sure this view file exists
    }
}



