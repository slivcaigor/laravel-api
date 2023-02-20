<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    // viene utilizzata la funzione factory() per creare un nuovo oggetto della classe Genre. La funzione factory() viene fornita da Laravel e ci permette di creare dati di prova utilizzando le Factory.
    public function run()
    {
        Genre :: factory() -> count(25) -> create();
    }
}