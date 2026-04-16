<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    public function login(Request $request){
     $user = DB::table('users')
    ->where('email', $request->email)
    ->where('password', $request->password)
    ->first();

    if($user){
        Log::info('Valid credentials',['email'=>$request->email]);
        return response()->json(['ok'=>true,]);
        
    }
    Log::warning('Invalid credentials',['email'=>$request->email]);
    return response()->json(['ok'=>false,],401);
    }
}
