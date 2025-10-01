<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user=User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password,$user->password)) {
            return response(['The provided credentials are incorrect.']);
        }
        return response([
            'token'=>$user->createToken($user->name)->plainTextToken
        ]);
    }

    public function register_api(Request $request){
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        $token=$user->createToken($user->name)->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ]);
    }

    public function logout_api(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response([
            'Logged out'
        ]);
    }
}
