<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\NewCustomer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'username' => 'required|email|max:255|unique:user,username',
            'contact_no' => 'required|string|max:15',
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'username.required' => 'The email field is required.',
            'username.email' => 'The email must be a valid email address.',
            'username.max' => 'The email may not be greater than 255 characters.',
            'username.unique' => 'The email has already been taken.',
        ]);

        if ($validator->fails()) {
            return response()->json([
            'http_status' => 400,
            'http_status_message' => 'Bad Request',
            'message' => 'Validation failed. Please check your input data.',
            'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'registered_date' => now(),
            'added_by' => 0,
            'added_date' => now(),
            'contact_no' => $request->contact_no,
            'type' => 'Client',
        ]);

        $toEmail = $request->username;
        $data = ['name' => $request->full_name];

        Mail::to($toEmail)->queue(new NewCustomer($data));

        if (! $user) {
            return response()->json([
                'http_status' => 500,
                'http_status_message' => 'Internal Server Error',
                'message' => 'Registration failed',
            ], 500);
        }

        $token = $user->createToken('web')->plainTextToken;

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'message' => 'Registration successful',
            'data' => [
                'token' => $token,
                'info' => $user,
            ],
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|email|exists:user,username',
            'password' => 'required',
        ], [
            'username.required' => 'The email field is required.',
            'username.email' => 'The email must be a valid email address.',
            'username.exists' => 'Invalid email or password.',
            'password.required' => 'The password field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'http_status' => 400,
                'http_status_message' => 'Bad Request',
                'message' => 'Validation failed. Please check your input data.',
                'errors' => $validator->errors(),
            ], 400);
        }

        if (! Auth::attempt($request->only('username', 'password'), $request->boolean('remember'))) {
            return response()->json([
                'http_status' => 401,
                'http_status_message' => 'Unauthorized',
                'message' => 'Login failed',
                'error' => ['info' => 'Invalid password'],
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('web')->plainTextToken;

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'Success',
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'info' => $user,
            ],
        ], 200);
    }
}
