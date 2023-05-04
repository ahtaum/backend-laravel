<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\CreateUserRequest;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUsers() {
        try {
            $users = User::all();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'total' => $users->count(),
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function addUser(CreateUserRequest $request) {
        try {
            $user = User::create([
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'User created successfully.',
                'data_created' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'User deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Authentication
    public function login(Request $request) {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('token_name')->plainTextToken;
    
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]);
            }

            return response()->json([
                'code' => 401,
                'status' => 'error',
                'message' => 'Unauthorized.'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
