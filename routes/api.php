<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route :: get('/v1/movie/all', [ApiController :: class, 'getMovieWTagWGenre']);

Route :: post('/v1/movie/store', [ApiController :: class, 'movieStore']);