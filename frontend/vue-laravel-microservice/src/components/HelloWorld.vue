<script>
import axios from "axios";

export default {
    data() {
        return {
            movies: [],
        };
    },
    mounted() {
        axios
            .get("http://localhost:8000/api/v1/movie/all")
            .then((res) => {
                const data = res.data;
                const success = data.success;
                const movies = data.response;

                this.movies = movies;
                console.table(movies);
            })
            .catch((err) => console.error(err));
    },
};
</script>

<template>
    <div>
        <h2>Movies</h2>
        <div v-for="movie in movies" :key="movie.id">
            {{ movie.name }} ({{ movie.year }})
        </div>
    </div>
</template>

<style></style>
