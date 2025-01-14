<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate input (you can customize this as needed)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        // Attempt login
        if (Auth::attempt($credentials)) {
            // Retrieve the authenticated user
            $user = Auth::user();
    
            // Redirect based on the user name (you can replace this with a 'role' column or other conditions)
            if ($user->name === 'admin') {
                return redirect()->route('dashboard'); // Admin redirects to dashboard
            }
    
            if ($user->name === 'supplier') {
                return redirect()->route('products.index'); // Supplier redirects to products
            }
    
            // For any other user, redirect to sales page
            return redirect()->route('sales.index');
        }
    
        // If authentication fails, redirect back with error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }
    
    

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}