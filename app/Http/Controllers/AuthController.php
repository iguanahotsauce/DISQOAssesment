<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Function to create a new user
    public function register(Request $request) {
        $fields = $request->validate([
            'email' => 'email|required|unique:users,email',
            'password' => 'string|required'
        ]);

        $user = User::create([
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('DISQOAssesmentToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    // Delete all tokens in the DB associated with the user that is logging out
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'Successfully Logged Out'
        ];
        
        return response($response, 200);
    }
}
