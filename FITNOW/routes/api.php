<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function(){
  Route::get('/user', function (Request $request){
    return $request->user();
  });
  Route::post('logout',[UserAuthController::class,'logout']);
  Route::get('sessions',[SessionController::class,'index'])->name('session.index');
  Route::post('sessions',[SessionController::class,'store'])->name('sessions.store');
  Route::put('sessions/{id}',[SessionController::class,'update'])->name('sessions.update');
  Route::delete('sessions/{id}',[SessionController::class,'destroy'])->name('sessions.destroy');
  Route::patch('sessions/{session}',[SessionController::class,'status'])->name('sessions.status');
});

