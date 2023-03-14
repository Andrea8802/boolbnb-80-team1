<template>
    <form action="" method="post">
        <input type="text" v-model="apartmentSearch">
        <div>
            <label for="">Rooms Number</label>
            <select name="rooms_num" v-model="roomsNum">
                <option value="">-</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>

        <div>
            <label for="">Beds Number</label>
            <select name="rooms_num" v-model="bedsNum">
                <option value="">-</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div>

        <div class="slidecontainer">
            <input type="range" min="1" max="50" class="slider" v-model="radius">
        </div>
        <div>
            {{ radius }}
        </div>

        <div v-for="service in services">
            <input type="checkbox" :value="service.id" name=services v-model="modelServices">
            <label for="services">{{ service.name }}</label>
        </div>
        <button @click="getCoordinates">Cerca</button>
    </form>

    <div class="col" v-for="apartment in apartments">
        <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }" class="router">
            <div class="card rounded ms_card_efct">
                <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                    class="rounded fluid card-img-top h-50">
                <div class="card-body h-35">
                    <h5 class="card-title text-center ms_aps_text">{{ apartment.title }}</h5>
                    <div class="text-center small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                    <div class="text-center "><strong>{{ apartment.price }}€</strong>/notte</div>
                </div>

            </div>
        </router-link>
    </div>
</template>

<script>
import axios from 'axios'

export default {



    data() {
        return {
            roomsNum: "",
            bedsNum: "",
            error: "",
            apartmentSearch: "",
            modelLat: "",
            modelLong: "",
            radius: 1,
            apartments: [],
            services: [],
            modelServices: []
        }
    },
    methods: {
        getCoordinates(e) {
            e.preventDefault();
            if (!this.apartmentSearch) return;

            var theUrl = `https://api.tomtom.com/search/2/geocode/${this.apartmentSearch}.json?key=7WvQPGS4KEheGe1NqjeIiLoLFdGWHmbO`;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", theUrl, false);
            xmlHttp.send(null);
            var json = JSON.parse(xmlHttp.responseText);
            console.log("json", json);
            this.modelLat = parseFloat(json.results[0].position.lat);
            this.modelLong = parseFloat(json.results[0].position.lon);
            this.getApartment();


        },
        getApartment() {
            let formData = new FormData();
            formData.append("lat", this.modelLat);
            formData.append("long", this.modelLong);
            formData.append("radius", this.radius);
            formData.append("rooms_num", this.roomsNum);
            formData.append("beds_num", this.bedsNum);
            this.modelServices.forEach((value) => formData.append("services[]", value))

            axios.post("/api/advancedSearch", formData)
                .then(res => {
                    console.log("apSear", res);

                    this.apartments = res.data.response;
                    if (this.apartments.length == 0) {
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
        getData() {
            console.log("prova");
            axios.get("/api/getData")
                .then(res => {
                    this.services = res.data.response.services;
                    console.log(this.services);


                }).catch((errors) => {
                    console.log(errors);
                });
        },


    },
    mounted() {
        this.reloadPage();
        this.getData();

    }
}
</script>

<style lang="scss" scoped>
@use '/resources/sass/variables' as *;

// Stile slider
.slider {
    appearance: none;
    width: 30%;
    height: 15px;
    margin-left: 20px;
    border-radius: 5px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider::-webkit-slider-thumb {
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: $principalColor;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: $principalColor;
    cursor: pointer;
}
</style>