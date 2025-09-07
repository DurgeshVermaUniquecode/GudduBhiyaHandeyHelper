<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {    // dd(Hash::make('123456'));
        return view('admin.login'); // create Blade file
       
    }

    // Handle login
  public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');
    
    if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard')
                         ->with('success', 'Login successful!');
    }

    // Instead of withErrors, use with('error') for alert
    return back()->with('error', 'Invalid credentials')->withInput();
}


    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }

    // Optional: show dashboard
    public function dashboard()
    {
        return view('admin.dashboard'); // create Blade file
    }
}
