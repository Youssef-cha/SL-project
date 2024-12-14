<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store()
    {
        $validated = request()->validate([
            "email" => ['required', 'email'],
            "password" => ['required'],
        ]);
        if (Auth::attempt($validated)) {
            request()->session()->regenerate();
            return redirect('/');
        }
        throw ValidationException::withMessages([
            'email' => 'sorry, those credentials do not match.'
        ]);
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
