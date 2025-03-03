<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Main HTML Course Screen (Shows Options for Videos, Notes, and Theory)
    public function learnHtml()
    {
        return view('admin.courses.html');
    }

    // Videos Section
    public function htmlVideos()
    {
        $videos = [
            ['title' => 'HTML Basics', 'video' => 'qz0aGYrrlhU'],
            ['title' => 'HTML for Beginners', 'video' => 'BsDoLVMnmZs'],
            ['title' => 'HTML Crash Course', 'video' => 'UB1O30fR-EE'],
        ];

        return view('admin.courses.html-video', compact('videos'));
    }

    // Notes Section
    public function htmlNotes()
    {
        $notes = [
            'HTML (HyperText Markup Language) is the standard for web pages.',
            'HTML consists of elements like headings, paragraphs, and images.',
            'Use `<h1>` to `<h6>` for headings, `<p>` for paragraphs.',
            'Use `<a href="url">Link</a>` for hyperlinks.',
            'Use `<img src="image.jpg" alt="description">` for images.',
        ];

        return view('admin.courses.html-notes', compact('notes'));
    }

    // Theory Section
    public function htmlTheory()
    {
        return view('admin.courses.html-theory');
    }
}



