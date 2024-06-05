<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::post('/play', [GameController::class, 'play']);


