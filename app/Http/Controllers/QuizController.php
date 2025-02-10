<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function htmlQuiz()
    {
        return view('quizzes.html');
    }

    public function cssQuiz()
    {
        return view('quizzes.css');
    }

    public function submitHtmlQuiz(Request $request)
    {
        // Process quiz answers (this is just an example)
        $score = 0;

        if ($request->q1 == "HyperText Markup Language") {
            $score += 1;
        }
        if ($request->q2 == "<a>") {
            $score += 1;
        }

        return redirect()->route('quiz.html')->with('success', "Your HTML Quiz score is $score/2");
    }

    public function submitCssQuiz(Request $request)
    {
        // Process quiz answers
        $score = 0;

        if ($request->q1 == "Cascading Style Sheets") {
            $score += 1;
        }
        if ($request->q2 == "background-color") {
            $score += 1;
        }

        return redirect()->route('quiz.css')->with('success', "Your CSS Quiz score is $score/2");
    }
}

