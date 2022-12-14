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
Route::post('logout',[PokemonController::class, 'logout']); 
Route::post('pokemons/like/{user_id}/{pokemon_id}', [PokemonController::class,'likePokemon']); 
Route::get('pokemons/likes/{user_id}', [PokemonController::class, 'fetchLikedPokemons']);
Route::get('userDetails/{user_id}',[PokemonController::class, 'getUserById']);
Route::put('userDetails/{user_id}', [PokemonController::class, 'updateProfile']);