<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController  {
    
    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60*60
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    } 

    public function login(Request $request) {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json(['name' => 'email_not_found'], 400);
        }

        if (Hash::check($request->password, $user->password)) {
            return response()->json(['token' => $this->jwt($user)], 200);
        }

        return response()->json(['name' => 'password_not_found'], 400);
    }

    public function register(Request $request) {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => app('hash')->make($request->password)
        ]);

        return response()->json(['token' => $this->jwt($user)], 200);
    }
}