<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    // utilizza il trait HasFactory per fornire una serie di funzionalità per la creazione di oggetti modello
    use HasFactory;

    // Il modello Movie ha tre attributi chiave: name, year e cashout, che possono essere assegnati in modo diretto attraverso il costruttore del modello
    protected $fillable = [
        'name',
        'year',
        'cashout',
    ];

    // La relazione è definita in modo tale che ogni film appartiene ad un solo genere, ma ogni genere può essere associato a molti film.
    public function genre() {
        return $this -> belongsTo(Genre :: class);
    }
    
    // Questa relazione permette di associare più tag a un film e viceversa
    public function tags() {
        return $this -> belongsToMany(Tag :: class);
    }

}