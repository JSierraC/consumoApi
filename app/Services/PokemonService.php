<?php

namespace App\Services;

use Http;


Class PokemonService {

	public function getApi(){
		$url = 'https://pokeapi.co/api/v2/pokemon/';
		
		for ($i=1; $i <= 2 ; $i++) { 

		    $response = Http::get($url.$i.'/');
		    $pokemons = $response->json();
		    
		}

		return $pokemons;
	}


}




?>