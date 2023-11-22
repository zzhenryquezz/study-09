<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Todo;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $todos = Todo::where("user_id", $user->id)->get();

        return view("home", [
            "todos" => $todos
        ]);
    }
}
