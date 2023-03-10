<template>
    <input type="text">
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
        reloadPage() {
            var currentDocumentTimestamp = new Date(performance.timing.domLoading).getTime();
            // Current Time //
            var now = Date.now();
            // Total Process Lenght as Minutes //
            var tenSec = 10 * 1000;
            // End Time of Process //
            var plusTenSec = currentDocumentTimestamp + tenSec;
            if (now > plusTenSec) {
                location.reload();
            }
        },
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
        this.reloadPage();
        this.allApartments()

    }
}
</script>