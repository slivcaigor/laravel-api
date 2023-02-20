<script>
import axios from "axios";

const API_URL = "http://localhost:8000/api/";
const API_VER = "v1/";
const API = API_URL + API_VER;
// contiene un oggetto con una sola chiave tags_id con valore iniziale vuoto ([]), viene utilizzato in seguito come valore iniziale per il form di creazione/modifica di un nuovo film, quando l'utente apre il form, tutte le opzioni sono impostate su valori vuoti
const EMPTY_NEW_MOVIE = {
    tags_id: [],
};
export default {
    // La proprietà data() del componente definisce un oggetto con diverse proprietà, tra cui movies, genres e tags, che contengono rispettivamente l'elenco dei film, dei generi e dei tag recuperati dall'API.
    data() {
        return {
            movies: [],
            genres: [],
            tags: [],

            // La proprietà state definisce un oggetto con la proprietà movieForm, che viene utilizzata per visualizzare o nascondere un form per la creazione di un nuovo film.
            state: {
                movieForm: false,
            },

            // un oggetto che contiene le informazioni di un nuovo film da inserire nel database
            new_movie: { ...EMPTY_NEW_MOVIE },
        };
    },
    methods: {
        // Il metodo updateData() viene utilizzato per recuperare i dati dal backend dell'API. Quando il risultato della richiesta HTTP viene restituito, i dati vengono elaborati e assegnati alle proprietà movies, genres e tags.
        updateData() {
            axios
                .get(API + "movie/all")
                .then((res) => {
                    const data = res.data;
                    const success = data.success;

                    const response = data.response;

                    const movies = response.movies;
                    const genres = response.genres;
                    const tags = response.tags;

                    if (success) {
                        this.movies = movies;
                        this.genres = genres;
                        this.tags = tags;
                    }
                })
                .catch((err) => console.log);
        },
        // Il metodo closeForm() viene utilizzato per ripristinare il form per la creazione di un nuovo film allo stato iniziale.
        closeForm() {
            // quando l'utente apre il form per creare un nuovo film, i campi saranno vuoti
            this.new_movie = { ...EMPTY_NEW_MOVIE };
            //  imposta state.movieForm a false, il che significa che il form non è attualmente aperto
            this.state.movieForm = false;
        },
        // Il metodo submitMovie(e) viene utilizzato per inviare i dati del nuovo film al backend dell'API. Quando la richiesta HTTP viene restituita con successo, il form viene chiuso e i dati vengono aggiornati con il metodo updateData()
        submitMovie(e) {
            e.preventDefault();

            const new_movie = this.new_movie;
            // viene creato un URL per l'API, a seconda che l'oggetto new_movie contenga o meno una proprietà "id" viene concatenata la stringa "movie/update/" o "movie/store/"
            const actualApi =
                API +
                ("id" in new_movie
                    ? // Se new_movie contiene un ID, significa che è un oggetto esistente che deve essere aggiornato nel database
                      "movie/update/" + this.new_movie.id
                    : // se new_movie non contiene un ID, significa che è un nuovo oggetto che deve essere creato nel database,
                      "movie/store");
            axios
                // La variabile actualApi viene usata per specificare l'endpoint API a cui inviare la richiesta
                .post(actualApi, new_movie)
                .then((res) => {
                    const data = res.data;
                    const success = data.success;

                    if (success) {
                        this.closeForm();
                        this.updateData();
                    }
                })
                .catch((err) => console.log);
        },
        // Il metodo editMovie(movie) viene utilizzato per popolare il form di creazione di un nuovo film con i dati del film selezionato. Questo metodo è chiamato quando l'utente sceglie di modificare un film esistente
        editMovie(movie) {
            //  tutte le proprietà dell'oggetto movie vengono copiate nell'oggetto new_movie
            this.new_movie = { ...movie };

            //  l'array tags_id dell'oggetto new_movie viene inizializzato come un array vuoto
            this.new_movie.tags_id = [];

            // un ciclo for per iterare sull'array tags dell'oggetto movie e copiare gli ID dei tag nell'array tags_id dell'oggetto new_movie
            for (let i = 0; i < movie.tags.length; i++) {
                const tag = movie.tags[i];
                // in questo modo, i tag del film selezionato vengono selezionati automaticamente nella form di modifica
                this.new_movie.tags_id.push(tag.id);
            }

            //  indica all'app che deve mostrare il form di modifica del film selezionato
            this.state.movieForm = true;
        },
        // Il metodo deleteMovie(movie) viene utilizzato per eliminare un film dal database. Quando la richiesta HTTP viene restituita con successo, i dati vengono aggiornati con il metodo updateData()
        deleteMovie(movie) {
            axios
                .delete(API + "movie/delete/" + movie.id)
                .then((res) => {
                    const data = res.data;
                    const success = data.success;

                    if (success) this.updateData();
                })
                .catch((err) => console.log);
        },
    },
    mounted() {
        this.updateData();
    },
};
</script>

<template>
    <h1>Movies</h1>
    <form v-if="state.movieForm">
        <label for="name">Name</label>
        <input type="text" name="name" v-model="new_movie.name" />
        <br />
        <label for="year">Year</label>
        <input type="number" name="year" v-model="new_movie.year" />
        <br />
        <label for="cashout">Cash out</label>
        <input type="number" name="cashout" v-model="new_movie.cashout" />
        <br />
        <label for="genre">Genre</label>
        <select name="genre_id" v-model="new_movie.genre_id">
            <option v-for="genre in genres" :key="genre.id" :value="genre.id">
                {{ genre.name }}
            </option>
        </select>
        <br />
        <label>Tags:</label>
        <br />
        <div v-for="tag in tags" :key="tag.id">
            <input
                type="checkbox"
                :id="'tag-' + tag.id"
                :value="tag.id"
                v-model="new_movie.tags_id"
            />
            <label :for="'tag-' + tag.id">{{ tag.name }}</label>
        </div>

        <button @click="closeForm">CANCEL</button>
        <input
            type="submit"
            @click="submitMovie"
            :value="
                'id' in new_movie
                    ? 'UPDATE MOVIE: ' + new_movie.id
                    : 'CREATE NEW MOVIE'
            "
        />
    </form>
    <div v-else>
        <button @click="state.movieForm = true">CREATE NEW MOVIE</button>
        <ul>
            <li v-for="movie in movies" :key="movie.id">
                {{ movie.name }}
                <br />
                <button @click="editMovie(movie)">EDIT</button>
                <button @click="deleteMovie(movie)">DELETE</button>
                <ul>
                    <li v-for="tag in movie.tags" :key="tag.id">
                        {{ tag.name }}
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<style></style>
