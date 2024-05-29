<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\PageController;

Route::get('/', [PokemonController::class, 'index']);
Route::get('/view/{id}', [PokemonController::class, 'show']);

Route::any('{catchall}', [PageController::class, 'notfound'])->where('catchall', '.*');
