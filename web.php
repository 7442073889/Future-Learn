<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ChatController;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'account'],function(){

//guest middle ware
Route::group(['middleware' => 'guest'],function(){
    Route::get('/welcome', [LoginController::class, 'index'])->name('account.welcome');
    Route::get('/welcome', [LoginController::class, 'register'])->name('account.welcome');
    Route::post('/process-register', [LoginController::class, 'processRegister'])->name('account.processRegister');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');

});

// Authentiated Middleware
Route::group(['middleware' => 'auth'],function(){
    Route::get('/logout', [LoginController::class, 'logout'])->name('account.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('account.dashboard');

});
});

Route::group(['prefix' => 'admin'],function(){

    //guest middle ware
    Route::group(['middleware' => 'admin.guest'],function(){
    Route::get('/welcome', [AdminLoginController::class, 'index'])->name('account.welcome');
    Route::post('/adminauthenticate', [AdminLoginController::class, 'authenticate'])->name('adminauthenticate');
    });
    
    // Authentiated Middleware
    Route::group(['middleware' => 'admin.auth'],function(){
    Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admindashboard');   
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    });
    });
 
   // learning platform
    Route::get('/courses/html', [CourseController::class, 'learnHtml'])->name('course.html');
    Route::get('/courses/css', [CourseController::class, 'learnCss'])->name('course.css');

    
   // quiz
     Route::get('/quiz/html', [QuizController::class, 'htmlQuiz'])->name('quiz.html');
     Route::post('/quiz/html', [QuizController::class, 'submitHtmlQuiz'])->name('quiz.html.submit');
     Route::get('/quiz/css', [QuizController::class, 'cssQuiz'])->name('quiz.css');
     Route::post('/quiz/css', [QuizController::class, 'submitCssQuiz'])->name('quiz.css.submit');

     //live chat

    Route::get('/livechat', [ChatController::class, 'index'])->name('livechat');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send.message');
    Route::get('/get-messages', [ChatController::class, 'getMessages'])->name('get.messages');
