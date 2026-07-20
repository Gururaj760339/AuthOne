<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
            'profile_picture' => 'required|mimes:jpg,png,jpeg'
        ]);

        $profilePicPath = $request->file('profile_picture')->store('images', 'public');

        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'avatar' => $profilePicPath
        ]);

        Auth::login($user);

        return redirect('/')
            ->with('success', 'Registration completed successfully.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'customer',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect('/')
                ->with('success', 'Login successful.');
        }

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'admin',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Login successful.');
        }

        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Logged out successfully.');
    }

    public function showAdminPanelUser(){
        $users = User::get();
        return view('admin.users.all_users_show', compact('users'));
    }

    public function userPanel(){
        $setting = Setting::first();
        return view('home', compact('setting'));
    }

    public function aboutPage(){
        $setting = Setting::first();
        return view('about', compact('setting'));
    }
}
