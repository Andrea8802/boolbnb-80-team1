<template>
    <div class="container-fluid">
        <!-- container del form -->
        <div class="container mt-2 text-center">
            <h1 id="msTitlePage" class="ms_home_title mb-3">Select search filters</h1>
            <div class="ms_ctn_form">
                <form>

                    <input type="text" v-model="apartmentSearch" placeholder="Enter your destination..."
                        class="ms_search_bar form-control mb-3" @keydown.enter="getCoordinates">
                    <div class="d-flex justify-content-center align-items-centet gap-3">
                        <div>
                            <label for="" class="ms_label_ni">Rooms number </label>
                            <input type="number" name="rooms_num" v-model="roomsNum"
                                class="ms_number_bar form-control mb-3">
                        </div>

                        <div>
                            <label for="" class="ms_label_ni">Beds number </label>
                            <input type="number" name="rooms_num" v-model="bedsNum" class="ms_number_bar form-control mb-3">
                        </div>

                    </div>

                    <div class="slidecontainer">
                        <input type="range" min="1" max="50" class="slider" v-model="radius">
                    </div>
                    <div class="ms_radius">
                        Radius : {{ radius }}KM
                    </div>

                    <div class="ms_ctn_service p-3 my-3">
                        <h4>Select services:</h4>
                        <div class="ms_ctn_check">
                            <div v-for="service in services">
                                <input type="checkbox" :value="service.id" name=services v-model="modelServices">
                                <label for="services">{{ service.name }}</label>
                            </div>
                        </div>
                    </div>
                    <button @click="deleteText" class="ms_btn_delete me-3 principal ms_btn_search">Reset</button>
                    <button @click="getCoordinates" class="ms_btn_search">Search</button>
                </form>
                <div class="container text-center">
                    <h4 class="ms_error_messagge">{{ error }}</h4>
                </div>
            </div>
        </div>

        <!-- container delle card -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6 align-items-stretch g-2 g-lg-3 mt-5 ms_ctn_card_home"
            v-if="!searching">
            <div class="col ms_slot_card" v-for="apartment in apartmentsSponsored">
                <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }" class="router">
                    <div class="card rounded ms_card_efct border-0">
                        <div class="ms_slot_card_img">
                            <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                                class="rounded-5 fluid card-img-top">
                        </div>
                        <div class="ms_card_sponsored">Sponsored</div>
                        <div class="card-body h-35 text-start ps-2">
                            <h5 class="card-title ms_aps_text">{{ apartment.title }}</h5>
                            <div class=" small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                            <div class=" "><strong>{{ apartment.price }}€</strong>/notte</div>
                        </div>

                    </div>
                </router-link>
            </div>

            <div class="col ms_slot_card" v-for="apartment in apartments">
                <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }" class="router">
                    <div class="card rounded ms_card_efct border-0">
                        <div class="ms_slot_card_img">
                            <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                                class="rounded-5 fluid card-img-top">
                        </div>
                        <div class="card-body h-35 text-start ps-2">
                            <h5 class="card-title ms_aps_text">{{ apartment.title }}</h5>
                            <div class="small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                            <div class=""><strong>{{ apartment.price }}€</strong>/notte</div>
                        </div>

                    </div>
                </router-link>
            </div>
        </div>
        <div v-else>
            <SearchLoader />
        </div>
    </div>

    <!-- bottone per ritornare in cima nella pagina -->
    <div class="ms_btn_page_up">
        <a href="#msTitlePage">
            <font-awesome-icon icon="fa-solid fa-circle-chevron-up" />
        </a>
    </div>
    <!-- ========================================== -->
</template>

<script>
import axios from 'axios'
import SearchLoader from '../SearchLoader.vue';
export default {
    components: {
        SearchLoader
    },

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
            modelServices: [],
            searching: false
        }
    },
    methods: {
        getCoordinates(e) {
            e.preventDefault();
            if (!this.apartmentSearch) return;
            this.searching = true;

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
                    this.searching = false;

                    if (this.apartments.length == 0) {
                        this.error = "we didn't find any apartments";
                    }
                    else {
                        this.error = null
                    }
                })
                .catch(err => {
                    this.searching = false;

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
        deleteText(e) {
            e.preventDefault();
            this.apartmentSearch = "";
            this.error = null;
            this.roomsNum = 0;
            this.bedsNum = 0;
            this.radius = 1;
            this.modelServices = [];
            this.apartments = [];
            this.apartmentsSponsored = [];
        }


    },
    mounted() {
        this.reloadPage();
        this.getData();

    }
}
</script>

<style lang="scss" scoped>
@use '/resources/sass/variables' as *;

.ms_home_title {
    color: $thirdColor;
}

// grafica form
.ms_ctn_form {
    width: 90%;
    max-width: 600px;
    margin: 0 auto;

    .ms_number_bar {
        margin: 0 auto;
        width: 80px;
    }

    .ms_search_bar,
    .ms_number_bar {
        color: $thirdColor;
        font-weight: 600;
        padding: 5px 10px;
        border: solid 2px $thirdColor;
        border-radius: 30px;
    }

    .ms_search_bar:focus,
    .ms_number_bar:focus {
        color: $principalColor;
        border: solid 2px $principalColor;
        box-shadow: none;
    }
}

.ms_btn_search {
    color: $thirdColor;
    background-color: $body-bg;
    border: solid 2px $thirdColor;
    border-radius: 30px;
    font-weight: 600;
    padding: 5px 10px;

    &:hover {
        color: $secondColor;
        background-color: $principalColor;
        border: none;
    }
}

.ms_radius,
.ms_label_ni {
    color: $thirdColor;
    font-weight: 600;
}

// =======================

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
    background: $thirdColor;
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

// grafica container servizi del form
.ms_ctn_service {
    border: solid 2px $thirdColor;
    border-radius: 30px;

    h4 {
        color: $thirdColor;
        font-size: 20px;
        font-weight: 600;
    }

    .ms_ctn_check {
        height: 200px;
        text-align: start;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;

        label {
            color: $principalColor;
            font-weight: 600;
            margin-left: 3px;
        }

        input[type="checkbox"] {
            accent-color: $principalColor;
        }
    }
}

// ==========================================

// grafica container card
.router {
    text-decoration: none;
    color: black;
}

.ms_error_messagge {
    margin-top: 100px;
    color: $thirdColor;
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
    color: $principalColor;
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

    .ms_slot_card_img {

        img {
            object-fit: cover;
            height: 260px;
        }
    }
}

// ===========================================

// grafica bottone per ritornare in cima nella pagina
.ms_btn_page_up {
    font-size: 40px;
    position: fixed;
    bottom: 150px;
    right: 30px;

    a {
        color: $principalColor;
        opacity: 0.5;

        &:hover {
            opacity: 1;
        }
    }
}

// ====================================

// responsive
@media screen and (max-width: 992px) {
    .ms_ctn_card_home {
        padding: 0 20px;
    }

    .ms_ctn_form {
        .ms_ctn_search {
            width: 90%;
        }
    }

}


@media screen and (max-width: 600px) {
    .ms_ctn_service {

        .ms_ctn_check {
            height: fit-content;
            text-align: center;
            gap: 5px;
        }
    }
}

// =====================================
</style>