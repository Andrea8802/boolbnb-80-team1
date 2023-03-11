<template>
    <h1>HOME </h1> <br>
    <label for="apartmentSearch">
        Destinazione
    </label>
    <input type="search"
        name="apartmentSearch"
        v-model="apartmentSearch"
        @keydown.enter="getCoordinates">
    <button @click="getCoordinates">Cerca</button>
    <h1>Apartments</h1> <br>
    <ul>
        <div>{{ error }}</div>
        <li v-for="apartment in apartments">
            {{ apartment.title }}
        </li>
    </ul>
    <ul>
        <li v-for="ap in apartmentsGeo">
            {{ ap.title }}
        </li>
    </ul>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            error: "",
            apartmentSearch: "",
            modelLat: "",
            modelLong: "",
            radius: 20,
            apartments: [],
            apartmentsGeo: [],


        }
    },
    methods: {
        getCoordinates() {
            this.apartments.length = 0;
            var theUrl = `https://api.tomtom.com/search/2/geocode/${this.apartmentSearch}.json?key=7WvQPGS4KEheGe1NqjeIiLoLFdGWHmbO`;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", theUrl, false);
            xmlHttp.send(null);
            var json = JSON.parse(xmlHttp.responseText);

            console.log(json);
            this.modelLat = parseFloat(json.results[0].position.lat);
            this.modelLong = parseFloat(json.results[0].position.lon);
            this.getApartment();


        },
        getApartment() {
            let formData = new FormData();
            formData.append("latitude", this.modelLat);
            formData.append("longitude", this.modelLong);
            formData.append("radius", this.radius);

            axios.post("/api/searchApartment", formData)
                .then(res => {
                    console.log(res);
                    this.apartmentsGeo = res.data.response;
                    if (this.apartmentsGeo.length == 0) {
                        this.error = "nessun appartamento trovato";
                    }
                    else {
                        this.error = null
                    }
                })
        },

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