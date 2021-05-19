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

    // Function to login a user that has already created an account
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'email|required',
            'password' => 'string|required'
        ]);

        // Check given email to make sure it exists in the users table
        $user = User::where('email', $fields['email'])->first();

        // If the email does exist in the users table then check the given password to make sure that it matches, if it doesn't or if the
        // user does not exist in the users table return a 401
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            $response = [
                'message' => 'Invalid Credentials'
            ];

            return response($response, 401);
        }

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
