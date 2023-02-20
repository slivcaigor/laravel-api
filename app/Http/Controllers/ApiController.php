<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Tag;

class ApiController extends Controller
{
    // funzione denominata "getMovieWTagWGenre", non accetta argomenti, restituisce un elenco di film con i loro tag e generi associati
    public function getMovieWTagWGenre() {
        // utilizza il modello "Movie" per ottenere un elenco di tutti i film dal database. Utilizzando il metodo "with" e passando come argomento il nome della relazione "tags", la funzione carica anche i tag associati a ciascun film. La lista dei film viene ordinata in ordine decrescente utilizzando il metodo "orderBy".
        $movies = Movie :: with('tags') 
            -> orderBy('created_at', 'desc')
            -> get();
        // recupera un elenco di tutti i generi e un elenco di tutti i tag utilizzando i modelli "Genre" e "Tag"
        $genres = Genre :: all();
        $tags = Tag :: all();

        // restituisce una risposta JSON contenente i film, i generi e i tag recuperati dal database
        return response() -> json([
            // La risposta include un campo booleano "success" impostato su "true" per indicare che la richiesta è stata completata con successo
            'success' => true,
            // un campo "response" che contiene i dati recuperati
            'response' => [
                // I film sono inclusi in un array denominato "movies" 
                'movies' => $movies,
                // i generi in un array denominato "genres"
                'genres' => $genres,
                // i tag in un array denominato "tags"
                'tags' => $tags,
            ]
        ]);
    }

    // funzione denominata "movieStore" e accetta un oggetto "Request" come argomento. Il parametro "$request" viene utilizzato per recuperare i dati del nuovo film che devono essere salvati nel database
    public function movieStore(Request $request) {

        // Prima di salvare i dati nel database, la funzione utilizza il metodo "validate" per verificare che i dati forniti siano validi
        $data = $request -> validate([
            'name' => 'required|string|min:3',
            'year' => 'required|integer|min:0',
            'cashout' => 'required|integer|min:0',
            'genre_id' => 'required|integer|min:1',
            'tags_id' => 'nullable|array'
        ]);

        // la funzione utilizza il modello "Genre" per trovare l'oggetto "Genre" corrispondente all'id fornito dal campo "genre_id"
        $genre = Genre :: find($data['genre_id']);
        // la funzione utilizza il modello "Movie" per creare un nuovo oggetto "Movie" e popola i suoi campi con i dati forniti nel parametro "$data". Il metodo "make" crea un nuovo oggetto "Movie" senza salvarlo nel database.
        $movie = Movie :: make($data);

        // Dopo aver creato l'oggetto "Movie", la funzione utilizza il metodo "associate" per associare l'oggetto "Genre" trovato in precedenza all'oggetto "Movie".
        $movie -> genre() -> associate($genre);
        // la funzione salva l'oggetto "Movie" nel database utilizzando il metodo "save"
        $movie -> save();

        // Se il campo "tags_id" è stato fornito,
        if (array_key_exists('tags_id', $data)) {

            // la funzione utilizza il modello "Tag" per trovare gli oggetti "Tag" corrispondenti agli id forniti nel campo "tags_id".
            $tags = Tag :: find($data['tags_id']);
            // utilizzando il metodo "sync" associamo questi oggetti "Tag" all'oggetto "Movie" appena creato
            $movie -> tags() -> sync($tags);
        }

        // la funzione restituisce una risposta JSON
        return response() -> json([
            // un campo booleano "success" impostato su "true" per indicare che la richiesta è stata completata con successo
            'success' => true,
            // un campo "response" che contiene l'oggetto "Movie" appena creato
            'response' => $movie,
            // un campo "data" che contiene tutti i dati forniti nella richiesta
            'data' => $request -> all()
        ]);
    }

    // funzione che permette di aggiornare le informazioni di un film già esistente nel database, riceve come argomento due parametri: un oggetto Request e un oggetto Movie. Request rappresenta l'input inviato dall'utente tramite una richiesta HTTP, Movie rappresenta l'oggetto del film da aggiornare nel database
    public function movieUpdate(Request $request, Movie $movie) {

        //  validazione dei dati inviati dall'utente
        $data = $request -> validate([
            'name' => 'required|string|min:3',
            'year' => 'required|integer|min:0',
            'cashout' => 'required|integer|min:0',
            'genre_id' => 'required|integer|min:1',
            'tags_id' => 'nullable|array'
        ]);

        // cerca il genere del film nel database tramite l'ID del genere passato dall'utente
        $genre = Genre :: find($data['genre_id']);
        // la funzione aggiorna i dati del film nel database tramite il metodo update() dell'oggetto Movie, passando i dati validati dall'utente come argomento
        $movie -> update($data);
        // associa il film al genere trovato tramite il metodo associate() dell'oggetto genre
        $movie -> genre() -> associate($genre);
        $movie -> save();

        // se l'utente ha fornito l'elenco degli ID dei tag associati al film, la funzione aggiorna l'elenco dei tag associati al film tramite il metodo sync() dell'oggetto tags.
        if (array_key_exists('tags_id', $data)) {

            $tags = Tag :: find($data['tags_id']);
            $movie -> tags() -> sync($tags);
        }
    
        // la funzione restituisce una risposta JSON contenente il film aggiornato, insieme ai dati di input inviati dall'utente.
        return response() -> json([
            'success' => true,
            'response' => $movie,
            'data' => $request -> all()
        ]);
    }

    // La funzione movieDelete ha come compito quello di eliminare un film dal database, riceve come parametro un oggetto Movie rappresentante il film da eliminare
    public function movieDelete(Movie $movie) {

        // viene eseguita una chiamata al metodo sync() dell'oggetto tags() associato al film. Il metodo sync([]) viene utilizzato per rimuovere tutti i tag associati al film prima di eliminarlo
        $movie -> tags() -> sync([]);
        //  esegue la cancellazione del film tramite il metodo delete() dell'oggetto Movie
        $movie -> delete();

        //  restituisce una risposta JSON contenente il messaggio di successo, indicando che il film è stato eliminato correttamente
        return response() -> json([
            'success' => true
        ]);
    }
}