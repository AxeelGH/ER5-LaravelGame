<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\GameStatisticsController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGameStatisticsRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;





Route::post('/login', [LoginController::class, 'login']);
Route::post('/stats', [GameStatisticsController::class, 'store']);
Route::get('/test', [TestController::class]);