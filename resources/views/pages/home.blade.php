@extends('layouts.main-layout')

@section('content')
    
    <h1>Movies</h1>

    @foreach ($genres as $genre)
        <h2>Genre: {{ $genre -> name }}</h2>
        <ul>
          <h2>Movies</h2>
            @foreach ($genre -> movies as $movie)
                @include('components.movie.movie-elem')
            @endforeach
        </ul>
    @endforeach

@endsection