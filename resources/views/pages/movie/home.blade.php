@extends('layouts.main-layout')

@section('content')
    
    <h1>Movies</h1>
    <a href="{{ route('movie.create') }}">CREATE NEW MOVIE</a>
    <ul>
        @foreach ($movies as $movie)
        <a href="{{ route('movie.edit', $movie) }}">
            EDIT
        </a>
        -
        <a href="{{ route('movie.delete', $movie) }}">
            DELETE
        </a>
            @include('components.movie.movie-elem')
        @endforeach
    </ul>

@endsection