<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PokemonService;


class PokemonController extends Controller
{
    protected $servicePokemon ;
    
    public function __construct(PokemonService $pService){
        $this->servicePokemon = $pService;
    }

    public function index(){
        return $this->servicePokemon->getApi();
    }
}
