<template>
    <h1>HOME </h1> <br>
    <label for="apartmentSearch">
        Destinazione
    </label>
    <input type="search" name="apartmentSearch" v-model="apartmentSearch">
    <button @click="getCoordinates">Cerca</button>
</template>

<script>
export default {
    data() {
        return {
            apartmentSearch: "",
            modelLat: "",
            modelLong: "",
            radius: 20
        }
    },
    methods: {
        getCoordinates() {

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

            axios.post("searchApartment", formData)
                .then(res => {
                    console.log(res);
                })
        }
    }
}
</script>