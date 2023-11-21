<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware("auth");

Route::get("login", [LoginController::class, "index"])->name("login");

Route::post("login", [LoginController::class, "login"]);
Route::post("logout", [LoginController::class, "logout"]);
Route::post("register", [LoginController::class, "register"]);
