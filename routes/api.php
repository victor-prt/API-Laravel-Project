<?php

use App\Http\Controllers\Api\QuestionController;
use Illuminate\Support\Facades\Route;

Route::post('/questions', [QuestionController::class, 'fetchQuestions'])->name('questions.fetchQuestions');

