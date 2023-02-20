<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Tag;
class MovieSeeder extends Seeder
{
    public function run()
{
    //  il metodo factory() viene utilizzato per generare 100 record del modello Movie utilizzando la Factory associata a quel modello. La funzione make() viene quindi utilizzata per creare gli oggetti ma senza salvarli nel database, la funzione each() per iterare su ogni oggetto creato dalla Factory e per assegnare casualmente un genere del film tra quelli disponibili
    Movie :: factory() -> count(100) -> make() -> each(function($m) {

        $genre = Genre :: inRandomOrder() -> first();
        $m -> genre() -> associate($genre);
        $m -> save();

        // Una volta associato un genere al film, viene generato un numero casuale di tag tra 1 e 5 utilizzando la funzione rand().
        $tags = Tag :: inRandomOrder() -> limit(rand(1, 5)) -> get();
        //  i tag vengono associati al film utilizzando il metodo sync() che permette di sincronizzare le associazioni tra le due entità: il film e i tag selezionati
        $m -> tags() -> sync($tags);
    }); 
}

}