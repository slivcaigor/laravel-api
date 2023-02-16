<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Tag;
use App\Models\Movie;

class MainController extends Controller
{
    public function home() {
        $genres = Genre :: all();
        return view('pages.home', compact('genres'));
    }

    public function movies() {

        $movies = Movie :: all();

        return view('pages.movie.home', compact('movies'));
    }

    public function movieCreate() {

        $genres = Genre :: all();
        $tags = Tag :: all();

        return view('pages.movie.create', 
                compact('genres', 'tags')
            );
    }

    public function movieStore(Request $request) {

        $data = $request->validate([
            'name' => 'required|string|max:64',
            'year' => 'required|numeric',
            'cashout' => 'required|numeric',
            'tag_id' => 'required|integer',
            'genres' => 'required|array'
        ]);
    
        $movie = Movie :: make($data);
        $genre = Genre :: find($data['genres']);

        $movie -> genre() -> associate($genre);
        $movie -> save();
        
        $tag = Tag :: find($data['tag_id']);
        $movie -> tags() -> attach($tag);
        return redirect()->route('movie.home');
    }
    
    
    
    
    
}