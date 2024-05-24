<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'name'      =>  'required|string|max:255',
            'surname'   =>  'required|string|max:255',
            'email'     =>  'required|email|unique:users,email',
            'password'  =>  'required|string|min:6,confirmed',
            'address'   =>  'nullable|string',
            'phone'     =>  'nullable|string|max:20',
            'biography' =>  'nullable|string',
            'avatar'    =>  'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name'      => $request->input('name'),
            'surname'  => $request->input('surname'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
            'address'   => $request->input('address'),
            'phone'     => $request->input('phone'),
            'biography' => $request->input('biography'),
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars');
            $user->avatar = $avatarPath;
            $user->save();
        }

        $credentials = [
            "email" => $request->input('email'),
            "password" => $request->input('password')
        ];

        Auth::attempt($credentials);
        $accessToken = auth()->user()->createToken('api_access')->plainTextToken;

        return response()->json(['message' => 'User created successfully', 'access_token' => $accessToken], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $accessToken = auth()->user()->createToken('api_access')->plainTextToken;
            return response()->json(['access_token' => $accessToken], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'current_password'  => 'required|string',
            'new_password'      => 'required|string|min:6',
            'confirm_password'  => 'required|string|same:new_password',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'User loggeout successfully'], 200);
    }
}
