<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        // If already logged in, redirect to home
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        }

        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')
                ->with('success', 'Login berhasil! Selamat datang, ' . Auth::user()->name);
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'Kredensial tidak cocok atau tidak ditemukan.',
        ])->withInput($request->only('email'));
    }
}
