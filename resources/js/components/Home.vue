<template>
    <h1>Apartments</h1> <br>
    <ul>
        <li v-for="apartment in apartments">
            {{ apartment.title }}
        </li>
    </ul>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {

            apartments: [],


        }
    },
    methods: {
        allApartments() {
            axios.get("/api/allApartments")
                .then(res => {
                    this.apartments = res.data.response;

                }).catch((errors) => {
                    console.log(errors);
                });
        }
    },

    mounted() {
        this.allApartments()
    }
}
</script>