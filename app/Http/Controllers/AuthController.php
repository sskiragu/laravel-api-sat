<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function signup(Request $request){
        $user = new User();
        $user->username =  $request->username;
        $user->email =  $request->email;
        $user->password =  $request->password;
        $user->save();
        return response()->json(['message' => 'Signup successful'], 201);
    }
    public function login(Request $request){
        $user_credetials = $request->only(['email', 'password']);

        if (Auth::attempt($user_credetials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user->username], 200);
        }else{
            return "Login failed";
        }
    }
    public function logout(){
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Logout successful']);
    }
}
