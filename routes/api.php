<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

// /v1/movie/all: Restituisce una lista di tutti i film con i loro tag e genere.
Route :: get('/v1/movie/all', [ApiController :: class, 'getMovieWTagWGenre']);

// /v1/movie/store: Aggiunge un nuovo film al database.
Route :: post('/v1/movie/store', [ApiController :: class, 'movieStore']);

// /v1/movie/update/{movie}: Aggiorna un film esistente nel database.
Route :: post('/v1/movie/update/{movie}', [ApiController :: class, 'movieUpdate']);

// /v1/movie/delete/{movie}: Elimina un film esistente dal database.
Route :: delete('/v1/movie/delete/{movie}', [ApiController :: class, 'movieDelete']);