<template>
    <h1>HOME </h1>
    <label for="apartmentSearch">
        Destinazione
    </label>
    <input type="text" name="apartmentSearch" v-model="apartmentSearch" @keydown.enter="getCoordinates"
        @keyup.delete="checkSearchBar">
    <button @click="getCoordinates">Cerca</button>
    <button @click="deleteText">Cancella</button>
    <button><router-link :to="{ name: 'advancedSearch' }">Advanced Search</router-link></button>

    <h1>Apartments</h1> <br>
    <div>{{ error }}</div>
    <div class="container-fluid p-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 g-4">
            <h3 @click="logsp">Apartments with Sponsor</h3>
            <div class="col" v-for="apartment in apartmentsSponsored" v-if="!onSearch">
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

            <div class="col" v-for="apartment in apartments" v-if="!onSearch">
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
            <div v-else>
                <div class="col" v-for="apartment in apartmentsGeoSponsored">

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
                <div class="col" v-for="apartment in apartmentsGeo">
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
            </div>
        </div>
    </div>
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
            onSearch: false,
            rooms_num: "",
            apartmentsSponsored: [],
            apartmentsGeoSponsored: [],



        }
    },
    methods: {
        // apartmentsSponsored() {
        //     axios.get("/api/apartmentsSponsor")
        //         .then(res => {
        //             this.apartmentsSponsor = res.data.response;
        //             console.log(this.apartmentsSponsor)

        //         }).catch((errors) => {
        //             console.log(errors);
        //         });
        // },
        logsp() {
            console.log(this.apartmentsSponsor);
        },
        getCoordinates() {
            this.onSearch = false;
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

            axios.post("/api/searchApartment", formData)
                .then(res => {
                    console.log("apSear", res);
                    this.onSearch = true;

                    this.apartmentsGeo = res.data.apartments;
                    this.apartmentsGeoSponsored = res.data.apartmentsSponsored;
                    console.log(this.apartmentsGeo);
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
                    this.apartments = res.data.apartments;

                    this.apartmentsSponsored = res.data.apartmentsSponsored



                }).catch((errors) => {
                    console.log(errors);
                });
        },
        checkSearchBar() {
            if (!this.apartmentSearch) {
                this.onSearch = false;
            }
        },
        deleteText() {
            this.apartmentSearch = "";
            this.onSearch = false;
            this.rooms_num = "";
        }
    },

    mounted() {
        this.reloadPage();
        this.allApartments()
        // this.apartmentsSponsored()

    }
}
</script>
<style lang="scss" scoped>
@use '/resources/sass/variables' as *;

.router {
    text-decoration: none;
    color: black;
}

.ms_ctn_main {
    overflow-y: auto;
    height: calc(100vh - 110px);

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
</style>