<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){
        return view('users.create');
    }
    public function store(){
        $validData = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'password' => ['required','confirmed'],
        ],[
            '*.required' => 'Ce champ est obligatoire',
            'email.unique' => 'email est déjà pris',
            'password.confirmed' => 'La confirmation de mot de passe ne correspond pas',
        ]);
        User::create($validData);
        return redirect()->back()->with('success', "compte a été créé avec succès.");
    }
}
