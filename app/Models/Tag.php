<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // utilizza il trait HasFactory per fornire una serie di funzionalità per la creazione di oggetti modello
    use HasFactory;

    // Il modello Tag ha due attributi chiave: name e description, che possono essere assegnati in modo diretto attraverso il costruttore del modello
    protected $fillable = [
        'name',
        'description',
    ];

    // utilizza il metodo belongsToMany() per definire la relazione tra i modelli, essa rappresenta una relazione molti-a-molti tra i modelli Tag e Movie
    public function movies() {
        return $this -> belongsToMany(Movie :: class);
    }
}