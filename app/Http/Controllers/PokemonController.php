<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikedPokemon;
use App\Models\User;
use Session;

class PokemonController extends Controller
{
    
    public function index(){
    }

     public function likePokemon(Request $request, $user_id, $poke_id){

        $likedPokemon = LikedPokemon::where([["user_id",  $user_id], ["pokemon_id", $poke_id]])->get();
        
        if($likedPokemon->count() > 0 ){
            return "Pokemon already liked.";
        }
        else{
            $pokemon= new LikedPokemon();
            $pokemon->pokemon_id = $poke_id;
            $pokemon->name = $request->pokemon['name'];
            $pokemon->user_id = $user_id;
            $pokemon->save();

            return "You liked ".$request->pokemon["name"];
           
        }

    }

    public function fetchLikedPokemons($user_id){
        return $pokemons = LikedPokemon::where('user_id', $user_id)->get();
    }

     public function getUserById($user_id){
        try {
            $u = User::findOrFail($user_id);

        } catch (Exception $e) {
            
        }

        return response()->json($u->ToArray());
    }

    public function updateProfile($user_id, Request $request){
        $user = User::find($user_id);
        
        $user->address = $request->detail['address'];
        $user->birthdate = $request->detail['birthdate'];
        $user->city = $request->detail['city'];
        $user->save();

        return $user;
        
    }

    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
        ///return $redirect()->route('front');
    }
}

?>