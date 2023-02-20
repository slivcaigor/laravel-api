<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Questa migrazione aggiunge due foreign keys alle tabelle movies e movie_tag della base di dati
    public function up()
    {
        // La prima chiave esterna genre_id nella tabella movies si riferisce alla tabella genres che rappresenta il genere del film
        Schema::table('movies', function (Blueprint $table) {
            $table -> foreignId('genre_id')
                   -> constrained();
        });
        // La seconda chiave esterna nella tabella movie_tag si riferisce alle tabelle movies e tags, e viene utilizzata per associare un tag ad un film, in quanto la relazione tra i due modelli è di molti a molti.
        Schema::table('movie_tag', function (Blueprint $table) {
            $table -> foreignId('movie_id')
                   -> constrained();
            $table -> foreignId('tag_id')
                   -> constrained();
        });
    }

    // Il metodo down() viene utilizzato per eliminare le chiavi esterne create nel metodo up(). In particolare, il metodo elimina la chiave esterna genre_id nella tabella movies e le chiavi esterne movie_id e tag_id nella tabella movie_tag.
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table -> dropForeign('movies_genre_id_foreign');
        });
        Schema::table('movie_tag', function (Blueprint $table) {
            $table -> dropForeign('movie_tag_movie_id_foreign');
            $table -> dropForeign('movie_tag_tag_id_foreign');
        });
    }
};