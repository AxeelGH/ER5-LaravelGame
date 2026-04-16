<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;





Route::post('/login', function (Request $request){

    $user = DB::table('users')
    ->where('email', $request->email)
    ->where('password', $request->password)
    ->first();

    if($user){
        return response()->json(['ok'=>true]);
    }
    return response()->json(['ok'=>false],401);
});