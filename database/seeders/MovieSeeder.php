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
            $genre = Genre :: inRandomOrder() -> first();
            $p->genre_id = $genre->id;
            $p -> save();

            $tags = Tag :: inRandomOrder() -> limit(rand(1, 5)) -> get();
            $p -> tags() -> attach($tags);
        });
    }
}