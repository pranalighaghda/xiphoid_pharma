<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
// C:\xampp\htdocs\laravel\xiphoid_pharma\resources\views\admin\login\login.blade.php
        return view('admin.login.login');
    }

    // Handle login
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if user is active
            if ($user->status != 1) {
                Auth::logout();

                return redirect()->back()
                    ->withErrors(['email' => 'Your account is inactive. Please contact administrator.'])
                    ->withInput();
            }

            // Redirect to admin dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // Invalid credentials
        return redirect()->back()
            ->withErrors(['email' => 'Invalid credentials.'])
            ->withInput();
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
