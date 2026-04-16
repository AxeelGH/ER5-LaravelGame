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
        $token = bin2hex(random_bytes(32));

        DB::table('users')
        ->where('id',$user->id)
        ->update(['remember_token'=>$token]);
        Log::info('Valid credentials',['email'=>$request->email]);
        return response()->json(['ok'=>true,'token'=>$token]);
        
    }
    Log::warning('Invalid credentials',['email'=>$request->email]);
    return response()->json(['ok'=>false,],401);
    }
}
