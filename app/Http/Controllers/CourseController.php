<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function learnHtml()
    {
        return view('courses.html');
    }

    public function learnCss()
    {
        return view('courses.css');
    }
}
