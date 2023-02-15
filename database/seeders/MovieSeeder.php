<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Tag;
class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Movie :: factory() -> count(100) -> make() -> each(function($p) {
            $genres = Genre :: inRandomOrder() -> first();
            $p -> genres() -> associate($genres);
            $p -> save();

            $tag = Tag :: inRandomOrder() -> limit(rand(1, 5)) -> get();
            $p -> tags() -> attach($tag);
        });
    }
}