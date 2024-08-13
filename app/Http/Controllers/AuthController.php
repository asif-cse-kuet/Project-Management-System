<?php

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function finduser(Request $request)
    {
        $userId = (int) $request->input('user_id');

        // Validate the user_id
        $validator = Validator::make(['user_id' => $userId], [
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid user ID.'], 400);
        }

        // Retrieve the user's first name
        $user = User::find($userId);

        if ($user) {
            return response()->json(['fname' => $user->fname]);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }


    public function search_user(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $users = User::where('fname', 'like', '%' . $search . '%')
                ->orWhere('lname', 'like', '%' . $search . '%')
                ->get();
        } else {
            $users = collect(); // Return an empty collection if no search query
        }

        return response()->json($users);
    }

    public function showRegistrationForm()
    {
        return view('layout.index');
    }

    public function showLoginForm()
    {
        return view('layout.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed, retrieve the user's role
            $user = Auth::user();
            $request->session()->regenerateToken();
            // Redirect to the appropriate dashboard based on the role
            if ($user->role === 'admin') {
                return redirect()->intended('AdminDashboard')->with('user', $user);
            } elseif ($user->role === 'user') {
                return redirect()->intended('UserDashboard')->with('user', $user);
            }
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Log the user in
        Auth::login($user);
        // Authentication passed, retrieve the user's role
        $role = Auth::user()->role;

        // Redirect to the appropriate dashboard based on the role
        if ($role === 'admin') {
            return redirect()->intended('AdminDashboard');
        } elseif ($role === 'user') {
            return redirect()->intended('UserDashboard');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
