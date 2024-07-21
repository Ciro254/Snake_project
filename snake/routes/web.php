<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnakeController;

Route::get('/', function () {return view('welcome');});
Route::get('/snake', [SnakeController::class, 'index']);