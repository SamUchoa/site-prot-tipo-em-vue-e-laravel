<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate(['name' => 'required|string', 'email' => 'required|string|unique:users,email', 'password' => 'required|string|confirmed']);

        $user = User::create(['name' => $fields['name'], 'email' => $fields['email'], 'password' => Hash::make($fields['password'])]);

        $reponse = ['message' => 'Account created successfully', 'user' => $user];
        return response($reponse, 201);

    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken($user->id);
        
            return response(['message' => 'Login successfuly', 'token' => $token->plainTextToken], 201);
        }
        
        return response(['message' => 'Wrong credentials'], 402);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(['message' => 'token deleted successfully']);
    }
    public function logoutAll(Request $request)
    {
        $fields = $request->validate(['email' => 'required|string', 'password' => 'required|string']);
        $user = User::where('email', $fields['email'])->first();

        if (Auth::attempt($fields)) {
            $user->tokens()->delete();
            return response(['message' => 'tokens deleted successfully']);
        }
    }
    public function getTokens(Request $request)
    {
        $fields = $request->validate(['email' => 'required|string']);
        $user = User::where('email', $fields['email'])->first();
        return response($user->tokens);

    }
}
