<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    public function store(){
        $validated = request()->validate([
            "email" => ['required','email'],
            "password" => ['required'],
        ]);
        if(Auth::attempt($validated)){
            return 'hello';
        }
    }
}
