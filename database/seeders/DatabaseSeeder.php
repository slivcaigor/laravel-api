<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    // viene utilizzata per popolare il database con dei dati di default durante il seeding del database.
    public function run()
    {
        // viene utilizzata la funzione call() per richiamare i seeder che andranno a creare i dati di default
        $this -> call([
            // Il metodo call() accetta come parametro un array di classi di seeder. Questi seeder vengono eseguiti in ordine, e il loro compito è quello di inserire i dati di default all'interno del database. Ad esempio, il GenreSeeder andrà a creare una serie di generi di film, il TagSeeder andrà a creare i tag, mentre il MovieSeeder andrà a creare i dati dei film.
            GenreSeeder :: class,
            TagSeeder :: class,
            MovieSeeder :: class,
        ]);
    }
}