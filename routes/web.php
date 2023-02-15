<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route :: get('/', [MainController :: class, 'home'])
    -> name('home');

Route :: get('/movies', [MainController :: class, 'movies'])
    -> name('movie.home');