<template>
    <div class="container-fluid">
        <!-- container del form -->
        <div class="container">
            <form action="" method="post">
                <input type="text" v-model="apartmentSearch">
                <div>
                    <label for="">Rooms Number</label>
                    <select name="rooms_num" v-model="roomsNum">
                        <option value="0">-</option>
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
                        <option value="0">-</option>
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
                    Raggio : {{ radius }}
                </div>

                <div v-for="service in services">
                    <input type="checkbox" :value="service.id" name=services v-model="modelServices">
                    <label for="services">{{ service.name }}</label>
                </div>
                <button @click="getCoordinates">Cerca</button>
            </form>
        </div>

        <!-- container delle card -->
        <div
            class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 align-items-stretch g-2 g-lg-3 mt-5 ms_ctn_card_home">
            <div class="col ms_slot_card" v-for="apartment in apartmentsSponsored">
                <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }" class="router">
                    <div class="card h-100 rounded ms_card_efct">
                        <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                            class="rounded fluid card-img-top h-50">
                        <div class="ms_card_sponsored">Sponsored</div>
                        <div class="card-body h-35">
                            <h5 class="card-title text-center ms_aps_text">{{ apartment.title }}</h5>
                            <div class="text-center small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                            <div class="text-center "><strong>{{ apartment.price }}€</strong>/notte</div>
                        </div>

                    </div>
                </router-link>
            </div>

            <div class="col ms_slot_card" v-for="apartment in apartments">
                <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }" class="router">
                    <div class="card h-100 rounded ms_card_efct">
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
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {



    data() {
        return {
            roomsNum: 0,
            bedsNum: 0,
            error: "",
            apartmentSearch: "",
            modelLat: "",
            modelLong: "",
            radius: 1,
            apartments: [],
            apartmentsSponsored: [],
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
            console.log(this.modelServices);
            this.modelServices.forEach((value) => formData.append("services[]", value))

            axios.post("/api/advancedSearch", formData)
                .then(res => {
                    console.log(res);
                    this.apartments = res.data.apartments;
                    this.apartmentsSponsored = res.data.apartmentsSponsored;
                    console.log(res);
                    console.log("norm", this.apartments);
                    console.log("spons", this.apartmentsSponsored);

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

// ============================================

// grafica container card
.router {
    text-decoration: none;
    color: black;
}

// .ms_slot_card {
//     height: 19rem;
// }

.ms_ctn_card_home {
    padding: 0 100px;
}

.ms_ctn_main::-webkit-scrollbar-thumb {
    background-color: #ff385c;
    outline: 1px solid #ff385c;
}

.ms_ctn_main::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

.ms_ctn_main::-webkit-scrollbar {
    width: 0.5em;
    color: #ff385c;
}

.ms_aps_text {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.ms_aps_sm_text {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}

.ms_card_efct:hover {
    transform: scale(1.05);
}

.ms_card_efct {
    position: relative;

    .ms_card_sponsored {
        background-color: rgba($principalColor, 0.8);
        color: $secondColor;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 30px;
        position: absolute;
        top: 10px;
        left: 10px;
    }
}

// ===========================================

// responsive home
@media screen and (max-width: 992px) {
    .ms_ctn_card_home {
        padding: 0 20px;
    }

    .ms_ctn_search {
        width: 90%;
    }
}

// =====================================
</style>