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
    <div>{{ error }}</div>
    <div class="container-fluid p-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 g-4">

            <div class="col"
                v-for="apartment in apartments">
                <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }"
                    class="router">
                    <div class="card rounded ms_card_efct">
                        <img :src="'/storage/' + apartment.imageApartment"
                            :alt="apartment.title"
                            class="rounded fluid card-img-top h-50">
                        <div class="card-body h-35">
                            <h5 class="card-title text-center ms_aps_text">{{ apartment.title }}</h5>
                            <div class="text-center small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                            <div class="text-center "><strong>{{ apartment.price }}€</strong>/notte</div>
                        </div>

                    </div>
                </router-link>
            </div>
            <div class="col"
                v-for="apartment in apartmentsGeo">
                <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }"
                    class="router">
                    <div class="card rounded ms_card_efct">
                        <img :src="'/storage/' + apartment.imageApartment"
                            :alt="apartment.title"
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

    <!-- <ul>
        <div>{{ error }}</div>
        <li v-for="apartment in apartments">
            {{ apartment.title }}
        </li>
    </ul>
    <ul>
        <li v-for="ap in apartmentsGeo">
            {{ ap.title }}
        </li>
    </ul> -->
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

            console.log("json", json);
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
                    console.log("apSear", res);
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
<style lang="scss" scoped>
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
}</style>