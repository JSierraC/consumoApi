<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register',[App\Http\Controllers\AuthController::class, 'register']);
Route::post('login',[App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('userInfo',[App\Http\Controllers\AuthController::class, 'infouser'])->middleware('auth:sanctum');
Route::get('logout',[App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum'); 
Route::post('/pokemons/like/{user_id}/{pokemon_id}', [PokemonController::class,'likePokemon']); 