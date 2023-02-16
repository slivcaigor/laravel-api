@extends('layouts.main-layout')

@section('content')
    
    <h1>Movies</h1>
    <a href="{{ route('movie.create') }}">CREATE NEW MOVIE</a>
    @foreach ($genres as $genre)
        <h2>Genre: {{ $genre -> name }}</h2>
        <ul>
          <h2>Movies</h2>
            @foreach ($genre -> movies as $movie)
                @include('components.movie.movie-elem')
                <a href="{{ route('movie.edit', $movie) }}">
                    EDIT
                </a>
                -
                <a href="{{ route('movie.delete', $movie) }}">
                    DELETE
                </a>
            @endforeach
        </ul>
    @endforeach

@endsection