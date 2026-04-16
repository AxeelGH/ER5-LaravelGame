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
        return response()->json([
            'ok'=>true,
            'message'=>'Correct credentials']);
        
    }
    echo("Incorrect credentials");
    return response()->json([
        'ok'=>false,
        'message'=>'Incorrect credentials'
    ],401);
    
});