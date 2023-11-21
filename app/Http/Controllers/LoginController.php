<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index() {

        if (Auth::check()) {
            return redirect("/");
        }

        return view("login");
    }

    public function register(Request $request) {

        $payload = $request->validate([
            "username" => "required|unique:users",
            "password" => "required|confirmed"
        ]);

        $payload["name"] = $payload["username"];
        $payload["email"] = $payload["username"] . "@example.com";

        $user = User::create($payload);

        Auth::login($user);

        return redirect()->intended("/");

    }

    public function login(Request $request) {

        $payload = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($payload)) {
            $request->session()->regenerate();

            return redirect()->intended("/");
        }

        return back()->withErrors([
            "username" => "The provided credentials do not match our records."
        ]);
        
    }

    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");

    }

}
