<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PageController;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $error = null)
    {
        $error = (!empty($error))? "We could not find the page you requested" : null;

        $pokemon_list = [];
        $pokeapi_response = json_decode(file_get_contents('https://pokeapi.co/api/v2/pokemon?offset=0&limit=15000'));
        foreach ($pokeapi_response->results as $pokemon => $details) {
            $pokemon_list[] = [
                "pokeapi_id" => explode("/", $details->url)[6],
                "name" => $details->name,
            ];
        }
        return  view('pokemon_list')->with("pokemon_list",$pokemon_list)->with('error', $error)->with('count', $pokeapi_response->count);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $pokeapi_id = 0)
    {
        $pokemon = [
            'id' => $pokeapi_id,
            'name' => '',
            'default' => false,
            'mega' => false,
            'images' => [
                'back' => '/images/qm.png',
                'back_shiny' => '/images/qm.png',
                'front' => '/images/qm.png',
                'front_shiny' => '/images/qm.png',
            ],
            'types' => [],
            'abilities' => [],
            'height' => '',
            'weight' => '',
            'moves' => [],
        ];

        if (is_numeric($pokeapi_id) && is_int($pokeapi_id) && $pokeapi_id > 0) {
            $pokeapi_response = @file_get_contents("https://pokeapi.co/api/v2/pokemon/{$pokeapi_id}");
            if (!empty($pokeapi_response)) {
                $pokeapi_response = json_decode($pokeapi_response);
                $pokemon_detail = json_decode(file_get_contents($pokeapi_response->forms[0]->url));

                $pokemon['name'] = $pokemon_detail->name;
                $pokemon['default'] = (!empty($pokemon_detail->is_default))? true : false;
                $pokemon['mega'] = (!empty($pokemon_detail->is_mega))? true : false;
                $pokemon['height'] = $pokeapi_response->height;
                $pokemon['weight'] = $pokeapi_response->weight;

                foreach ($pokeapi_response->abilities as $key => $a) {
                    $ability = json_decode(file_get_contents($a->ability->url));
                    foreach ($ability->effect_entries as $desc) {
                        if($desc->language->name == "en") {
                            $pokemon['abilities'][$a->ability->name] = $desc->effect;
                        }
                    }
                }

                $pokemon['images'] = [
                    'back' => (!empty($pokemon_detail->sprites->back_female))? $pokemon_detail->sprites->back_female : $pokemon_detail->sprites->back_default,
                    'back_shiny' => (!empty($pokemon_detail->sprites->back_shiny_female))? $pokemon_detail->sprites->back_shiny_female : $pokemon_detail->sprites->back_shiny,
                    'front' => (!empty($pokemon_detail->sprites->front_female))? $pokemon_detail->sprites->front_female : $pokemon_detail->sprites->front_default,
                    'front_shiny' => (!empty($pokemon_detail->sprites->front_shiny_female))? $pokemon_detail->sprites->front_shiny_female : $pokemon_detail->sprites->front_shiny,
                ];
    
                foreach ($pokeapi_response->moves as $key => $m) {
                    $pokemon['moves'][$key] = $m->move->name;
                }


                foreach ($pokeapi_response->types as $key => $t) {
                    $pokemon['types'][$t->slot] = $t->type->name;
                }
            }
        }
        return view('pokemon_show', ['pokemon' => $pokemon]);
    }
}
