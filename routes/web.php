<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ApiController;

Route :: get('/', [MainController :: class, 'home'])
    -> name('home');
Route :: get('/movies', [MainController :: class, 'movies'])
    -> name('movie.home');


Route :: get('/movie/create', [MainController :: class, 'movieCreate'])
    -> name('movie.create');
Route :: post('/movie/create', [MainController :: class, 'movieStore'])
    -> name('movie.store');

Route :: get('/movie/edit/{movie}', [MainController :: class, 'movieEdit'])
    -> name('movie.edit');
Route :: post('/movie/edit/{movie}', [MainController :: class, 'movieUpdate'])
    -> name('movie.update');


Route :: get('/movie/delete/{movie}', [MainController :: class, 'movieDelete'])
    -> name('movie.delete');