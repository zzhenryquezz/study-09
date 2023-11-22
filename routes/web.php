<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodosController;

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

Route::get('/', [HomeController::class, "index"])->middleware("auth");

Route::get("login", [LoginController::class, "index"])->name("login");

Route::post("login", [LoginController::class, "login"]);
Route::post("logout", [LoginController::class, "logout"]);
Route::post("register", [LoginController::class, "register"]);


Route::post("todos", [TodosController::class, "store"]);
Route::post("todos/{id}/done", [TodosController::class, "done"]);
Route::delete("todos/{id}", [TodosController::class, "destroy"]);