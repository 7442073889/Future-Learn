<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseContent;

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

    // ✅ User - View HTML Videos (Same as Admin)
    public function userHtmlVideos()
    {
        $videos = CourseContent::where('type', 'video')->get();
        return view('courses.html-videos', compact('videos'));
    }

    // ✅ User - View HTML Notes (Same as Admin)
    public function userHtmlNotes()
    {
        $notes = CourseContent::where('type', 'note')->pluck('content')->toArray();
        return view('courses.html-notes', compact('notes'));
    }

    // ✅ User - View HTML Theory (With PDF Links)
    public function userHtmlTheory()
    {
        $theory = CourseContent::where('type', 'theory')->get();
        return view('courses.html-theory', compact('theory'));
    }
}

