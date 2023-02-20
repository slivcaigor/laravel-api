<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // utilizza il trait HasFactory per fornire una serie di funzionalità per la creazione di oggetti modello
    use HasFactory;

    // Il modello Genre ha due attributi chiave: name e description, che possono essere assegnati in modo diretto attraverso il costruttore del modello
    protected $fillable = [
        'name',
        'description',
    ];

    // La funzione movies() rappresenta una relazione uno-a-molti tra i modelli Genre e Movie. La funzione restituisce una collezione di tutti i film associati al genere.
    public function movies() {
        return $this -> hasMany(Movie :: class);
    }
}