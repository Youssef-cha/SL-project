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
        
        if (Auth::attempt($validated , request()->remember ? true : false)) {
            request()->session()->regenerate();
            return redirect('/');
        }
        throw ValidationException::withMessages([
            'email' => 'email ou mot de passe incorrect.'
        ]);
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
