<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/login', function (Request $request){
    if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
        return response()->json(['ok'=>true]);
    }
    return response()->json(['ok'=>false],401);
});