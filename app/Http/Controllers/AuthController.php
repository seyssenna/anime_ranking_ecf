<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // gere la connexion de l'utilisateur
    public function logIn(Request $request)
    {
        $validated = $request->validate([
            "username" => "required",
            "password" => "required",
          ]);
          if (Auth::attempt($validated)) {
            return redirect()->intended('/');
          }
          return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
          ]);   
    }

    // gere la creation de compte
    public function signUp (Request $request) {
        $validated = $request->validate([
          "username" => "required",
          "password" => "required",
          "password_confirmation" => "required|same:password"
        ]);
        $user = new User();
        $user->username = $validated["username"];
        $user->password = Hash::make($validated["password"]);
        $user->save();
        Auth::login($user);
      
        return redirect('/');
    }

    // gere la deconnexion
    public function logOut (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
