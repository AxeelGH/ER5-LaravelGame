<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\GameStatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;





Route::post('/login', [LoginController::class, 'login']);
Route::post('/stats', [GameStatisticsController::class, 'store']);
