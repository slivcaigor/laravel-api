@extends('layouts.main-layout')

@section('content')
    
    <h1>CREATE NEW MOVIE</h1>
    <form action="{{ route('movie.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name">
        <br>
        <label for="year">Year</label>
        <input type="text" name="year">
        <br>
        <label for="cashout">Cashout</label>
        <input type="text" name="cashout">
        <br>
        <label for="tag">Tag</label>
        <select name="tag_id">
            @foreach ($tags as $tag)
                <option value="{{ $tag -> id }}">{{ $tag -> name }}</option>    
            @endforeach
        </select>
        <br>
        <h3>Genres</h3>
        @foreach ($genres as $genre)
            <input type="checkbox" name="genres[]" value={{ $genre -> id }}>
            <label for="genres">{{ $genre -> name }}</label>
            <br>           
        @endforeach
        <input type="submit" value="CREATE MOVIE">
    </form>

@endsection 