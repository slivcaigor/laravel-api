<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function movieAll() {

        $movies = Movie :: all();

        return response() -> json([
            'success' => true,
            'response' => $movies
        ]);
    }
}