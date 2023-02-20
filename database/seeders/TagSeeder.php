<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    // viene utilizzata la funzione factory() per creare un nuovo oggetto della classe Genre. La funzione factory() viene fornita da Laravel e ci permette di creare dati di prova utilizzando le Factory.
    public function run()
    {
        Tag :: factory() -> count(60) -> create();
    }
}