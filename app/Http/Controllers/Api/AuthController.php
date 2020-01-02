<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validate->fails()) return 'Loi';
        
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user'=> $user, 'accessToken' => $accessToken]);
    }
}
