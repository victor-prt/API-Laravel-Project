<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuestionController;
// Route::get('/', function () {
//     return view('questions.index');
// });

Route::get('/', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/searchedQuestions', [QuestionController::class,'searchedQuestions'])->name('questions.searchedQuestions');
