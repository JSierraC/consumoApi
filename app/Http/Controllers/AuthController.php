<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;


class AuthController extends Controller
{
    public function register(Request $req){

        $validate = $req->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:4'

        ]);

        $user = User::create([
            'name'=>$validate['name'],
            'email'=>$validate['email'],
            'password'=>Hash::make($validate['password'])

        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer'

        ]);

    }


    public function login(Request $req){
        
        if(!Auth::attempt($req->only('email','password'))){
            return response()->json([
                'mensaje'=>'invalido',
            ], 401);
        }

        $user = User::where('email',$req->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer',
            'user_id'=>$user->id
        ]);
    }


    public function infouser(Request $req){
        return $req->user();
    }

    public function logout(){
        Auth::user()->tokens()->delete();
        return response()->json([
                'mensaje'=>'cerrado session',
        ], 200);

    }
}


?>