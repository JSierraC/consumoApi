<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikedPokemon;

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
}

?>