<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivePracticeController extends Controller
{
    public function index()
    {
        return view('Livepractice'); // This will load progress.blade.php
    }
}
