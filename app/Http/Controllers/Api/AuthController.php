<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'address' => ['string'],
            'tell' => ['required', 'string', 'min:9', 'max:10', 'regex:/^0[0-9]{9}/']
        ]);

//        $user = User::create([
//            'name' => $fields['name'],
//            'email' => $fields['email'],
//            'password' => bcrypt($fields['password']),
//            'address' => $fields('address'),
//            'tell' => $fields('tell'),
//        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->tell = $request->input('tell');
        $user->address = $request->input('address');
        $user->password = Hash::make($request->input("password"));
        $user->save();

        $token = $user->createToken('myapp')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // check email
        $user = User::where('email',$fields['email'])->first();

        // check password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad creds'
            ],401);
        }
        if($user->status === 'BAN'){
            return response([
                'message' => 'You are banned'
            ],402);
        }

        $token = $user->createToken('myapp')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,200);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'logged out'
        ];
    }
}
