<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LivePracticeController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\CourseController as AdminCourseController;
use App\Http\Controllers\admin\QuizController as AdminQuizController;
use App\Http\Controllers\admin\LivepracticeController as AdminLivePracticeController;
use App\Http\Controllers\admin\ChatController as AdminChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// User Account Routes
Route::group(['prefix' => 'account'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/welcome', [LoginController::class, 'index'])->name('account.welcome');
        Route::get('/register', [LoginController::class, 'register'])->name('account.register');
        Route::post('/process-register', [LoginController::class, 'processRegister'])->name('account.processRegister');
        Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
    });
});

// Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/welcome', [AdminLoginController::class, 'index'])->name('account.welcome');
        Route::post('/adminauthenticate', [AdminLoginController::class, 'authenticate'])->name('adminauthenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
     


        // Admin Learning Routes
        Route::get('/courses/html', [AdminCourseController::class, 'learnHtml'])->name('admin.course.html');
        Route::get('/courses/css', [AdminCourseController::class, 'learnCss'])->name('admin.course.css');
        

        // Admin Quiz Routes
        Route::get('/quiz/html', [AdminQuizController::class, 'htmlQuiz'])->name('admin.quiz.html');
        Route::post('/quiz/html', [AdminQuizController::class, 'submitHtmlQuiz'])->name('admin.quiz.html.submit');
        Route::get('/quiz/css', [AdminQuizController::class, 'cssQuiz'])->name('admin.quiz.css');
        Route::post('/quiz/css', [AdminQuizController::class, 'submitCssQuiz'])->name('admin.quiz.css.submit');

        // ✅ Add LivePractice Route Here
        Route::get('/livepractice', [AdminLivepracticeController::class, 'index'])->name('admin.livepractice');

        // Admin Live Chat
        Route::get('/livechat', [AdminChatController::class, 'index'])->name('admin.livechat');
        Route::post('/send-message', [AdminChatController::class, 'sendMessage'])->name('admin.send.message');
        Route::get('/get-messages', [AdminChatController::class, 'getMessages'])->name('admin.get.messages');

    });
});

// Learning platform
// Admin Learning Routes (HTML Course Sections)
Route::get('/admin/courses/html', [AdminCourseController::class, 'learnHtml'])->name('admin.course.html');
Route::get('/admin/courses/html/videos', [AdminCourseController::class, 'htmlVideos'])->name('admin.course.html.videos');
Route::get('/admin/courses/html/notes', [AdminCourseController::class, 'htmlNotes'])->name('admin.course.html.notes');
Route::get('/admin/courses/html/theory', [AdminCourseController::class, 'htmlTheory'])->name('admin.course.html.theory');

Route::get('/courses/css', [CourseController::class, 'learnCss'])->name('course.css');
// ✅ Route to Store Notes
Route::post('/admin/courses/html/notes/store', [AdminCourseController::class, 'storeHtmlNote'])->name('admin.course.html.notes.store');

// ✅ Route to Delete Notes
Route::delete('/admin/courses/html/notes/delete', [AdminCourseController::class, 'deleteHtmlNote'])->name('admin.course.html.notes.delete');



// Quiz Routes
Route::get('/quiz/html', [QuizController::class, 'htmlQuiz'])->name('quiz.html');
Route::post('/quiz/html', [QuizController::class, 'submitHtmlQuiz'])->name('quiz.html.submit');
Route::get('/quiz/css', [QuizController::class, 'cssQuiz'])->name('quiz.css');
Route::post('/quiz/css', [QuizController::class, 'submitCssQuiz'])->name('quiz.css.submit');

// Live Chat
Route::get('/livechat', [ChatController::class, 'index'])->name('livechat');
Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send.message');
Route::get('/get-messages', [ChatController::class, 'getMessages'])->name('get.messages');

 // ✅ Add LivePractice Route Here
 Route::get('/livepractice', [LivepracticeController::class, 'index'])->name('livepractice');