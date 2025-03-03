<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function learnHtml()
    {
        return view('course.html');
    }

    public function learnCss()
    {
        return view('course.css');
    }

    public function viewCourse($course)
    {
        // Define YouTube Video IDs for each course
        $videos = [
            'html-basics' => 'qz0aGYrrlhU', // HTML Basics
            'advanced-html5' => '2PWKoB5hIeo', // Advanced HTML5
            'html-seo-optimization' => 'viRJcfNX6lg', // SEO Optimization for HTML
            'responsive-html-design' => 'eog0e_9SoRk', // Responsive Design
            'html-for-beginners' => 'BsDoLVMnmZs', // HTML for Beginners
            'forms-validations-in-html' => 'E3XxeJHzGfY', // HTML Forms & Validations
            'html5-multimedia' => 'WbyS4OsB9Wk', // HTML5 Multimedia (Video & Audio)
            'html-best-practices' => 'jKB1a9AglQk', // HTML Best Practices
            'html-email-templates' => 'k8Z3fD6b7jM', // HTML Email Templates
            'html-crash-course' => 'UB1O30fR-EE', // HTML Crash Course
            'html-css-grid-layouts' => 't6CBKf8K_Ac', // CSS Grid & HTML
            'building-forms-with-html' => 'tp8JIuCXBaU', // HTML Form Design
            'html-svg-graphics' => 'GxlrBdDr5H8', // SVG Graphics in HTML
            'html-animations-effects' => 'e4TYvF1h_bM', // HTML & CSS Animations
            'html-bootstrap' => '91Q6RvKvd7s', // Using Bootstrap with HTML
            'html-semantics-accessibility' => 'zyZK4oAM4B0', // HTML Semantics & Accessibility
            'html-api-integration' => 'f7AU2Ozu8eo', // HTML & API Integration
            'html-for-web-apps' => 'N9nucZcOlpA', // HTML for Web Apps
            'html5-game-development' => 'q5I3K4Yk5nk', // HTML5 Game Development
            'mastering-html-elements' => 'upDLs1sn7g4' // Mastering HTML Elements
        ];

        // Convert course name to URL-friendly format
        $formattedCourse = strtolower(str_replace([' ', '&'], ['-', 'and'], $course));
        $videoId = $videos[$formattedCourse] ?? null;

        // If course is not found, show 404 error
        if (!$videoId) {
            abort(404, "Course not found");
        }

        // Pass data to the view
        return view('courses.view', compact('course', 'videoId'));
    }
}
