<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validate = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8|confirmed',
        ]);

        if($validate->fails()){
            return response()->json([
                'success'=> false,
                'error'=> $validate->errors(),
            ] ,403);
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);

        return response()->json([
            'success'=>true,
            'data'=> [
                'user'=>$user,
            ],
            'message'=>'User berhasil didaftarkan!',
        ] ,201);
    }


    public function login(Request $request){
        $validate = Validator::make($request->all(), [
            'email'=>'required|string|email|max:255',
            'password'=>'required|string|min:8',
        ]);

        if($validate->fails()){
            return response()->json([
                'success'=> false,
                'error'=> $validate->errors(),
            ] ,403);
        }

        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'success'=> false,
                'error'=> 'Invalid login detail',
            ], 402);
        }

        $user = User::where('email',$request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([  
            'success'=>true,
            'data'=> [
                'user'=>$user,
                'access_token'=>$token,
                'token_type'=>'Bearer'
            ],
            'message'=>'Anda berhasil login!',
        ], );
    }

    public function logout(Request $request){   
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success'=>true,
            'message'=> 'Logout Berhasil'
        ],200);
    }
}
