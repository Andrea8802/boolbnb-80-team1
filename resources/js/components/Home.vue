<template>
    <div class="container text-center">
        <!-- titolo della pagina -->
        <h1 id="msTitlePage marg-home"
            class="ms_home_title  text-black">Hi! Where do you want to go today?</h1>

        <!-- sottotitolo della pagina -->
        <h4 class="ms_home_subtitle mb-3 text-capitalize">your destination awaits: discover new and amazing experiences</h4>
    </div>

    <!-- container della barra di ricerca e pulsante ricerca avanzata -->
    <div class="container text-center">
        <div class="ms_ctn_search input-group">
            <input type="text"
                name="apartmentSearch"
                v-model="apartmentSearch"
                @keydown.enter="getCoordinates"
                @keyup.delete="checkSearchBar"
                placeholder="Enter your destination..."
                class="ms_search_bar form-control border-end-0">
            <button @click="getCoordinates"
                class="input-group-text ms_btn_search border-start-0">
                <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
            </button>
        </div>
        <div class="my-3">
            <button @click="deleteText"
                class="ms_btn_delete me-3 principal">Reset</button>
            <router-link :to="{ name: 'advancedSearch' }">
                <button class="ms_btn_advanced principal">
                    Advanced Search
                </button>
            </router-link>
        </div>
    </div>
    <!-- =============================================================== -->

    <!-- container principale di tutte le card degli appartamenti -->
    <div class="container-fluid mt-5 ms_ctn_card_home"
        v-if="!searching">
        <div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6 align-items-stretch g-2 g-lg-3"
                v-if="!onSearch">
                <div class="col ms_slot_card"
                    v-for="apartment in apartmentsSponsored">
                    <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }"
                        class="router">
                        <div class="card rounded ms_card_efct border-0">
                            <div class="ms_slot_card_img">
                                <img :src="'/storage/' + apartment.imageApartment"
                                    :alt="apartment.title"
                                    class="rounded-5 fluid card-img-top">
                            </div>
                            <div class="ms_card_sponsored">Sponsored</div>
                            <div class="card-body h-35 text-start ps-2">
                                <h5 class="card-title  ms_aps_text">{{ apartment.title }}</h5>
                                <div class=" small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                                <div class=" "><strong>{{ apartment.price }}€</strong>/night</div>
                            </div>
                        </div>
                    </router-link>
                </div>

                <div class="col ms_slot_card"
                    v-for="apartment in apartments">
                    <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }"
                        class="router">
                        <div class="card rounded ms_card_efct border-0">
                            <div class="ms_slot_card_img">
                                <img :src="'/storage/' + apartment.imageApartment"
                                    :alt="apartment.title"
                                    class="rounded-5 fluid card-img-top">
                            </div>
                            <div class="card-body h-35 text-start ps-2">
                                <h5 class="card-title  ms_aps_text">{{ apartment.title }}</h5>
                                <div class=" small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                                <div class=" "><strong>{{ apartment.price }}€</strong>/night</div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-6 align-items-stretch g-2 g-lg-3"
                v-else>
                <div class="col ms_slot_card"
                    v-for="apartment in apartmentsGeoSponsored">
                    <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }"
                        class="router">
                        <div class="card rounded ms_card_efct border-0 text-start">
                            <div class="ms_slot_card_img">
                                <img :src="'/storage/' + apartment.imageApartment"
                                    :alt="apartment.title"
                                    class="rounded-5 fluid card-img-top">
                                <div class="ms_card_sponsored">Sponsored</div>
                            </div>
                            <div class="card-body h-35 text-start ps-2">
                                <h5 class="card-title  ms_aps_text">{{ apartment.title }}</h5>
                                <div class=" small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                                <div class=" "><strong>{{ apartment.price }}€</strong>/night</div>
                            </div>
                        </div>
                    </router-link>
                </div>

                <div class="col ms_slot_card"
                    v-for="apartment in apartmentsGeo">
                    <router-link :to="{ name: 'detailApartment', params: { id: apartment.id } }"
                        class="router">
                        <div class="card rounded ms_card_efct border-0">
                            <div class="ms_slot_card_img">
                                <img :src="'/storage/' + apartment.imageApartment"
                                    :alt="apartment.title"
                                    class="rounded-5 fluid card-img-top">
                            </div>
                            <div class="card-body h-35 text-start ps-2">
                                <h5 class="card-title  ms_aps_text">{{ apartment.title }}</h5>
                                <div class=" small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                                <div class=" "><strong>{{ apartment.price }}€</strong>/night</div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <SearchLoader />
    </div>
    <!-- ================================================================ -->

    <!-- bottone per ritornare in cima nella pagina -->
    <div class="ms_btn_page_up">
        <a href="#msTitlePage marg-home">
            <font-awesome-icon icon="fa-solid fa-circle-chevron-up" />
        </a>
    </div>
    <!-- ========================================== -->

    <!-- messaggio di errore nel caso in cui la search bar non da alcun risultato -->
    <div class="container text-center">
        <h4 class="ms_error_messagge">{{ error }}</h4>
    </div>
</template>

<script>
import axios from 'axios';
import SearchLoader from './SearchLoader.vue';
export default {
    components: {
        SearchLoader
    },
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
            apiKey: "7WvQPGS4KEheGe1NqjeIiLoLFdGWHmbO",
            searching: false



        }
    },
    methods: {
        getCoordinates() {
            this.onSearch = false;
            if (!this.apartmentSearch) return;
            this.searching = true;
            var theUrl = `https://api.tomtom.com/search/2/geocode/${this.apartmentSearch}.json?key=${this.apiKey}`;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", theUrl, false);
            xmlHttp.send(null);
            var json = JSON.parse(xmlHttp.responseText);
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

                    this.onSearch = true;
                    this.searching = false;
                    this.apartmentsGeo = res.data.apartments;
                    this.apartmentsGeoSponsored = res.data.apartmentsSponsored;

                    if (this.apartmentsGeo.length == 0 && this.apartmentsGeoSponsored == 0) {
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

        // reloadPage() {
        //     var currentDocumentTimestamp = new Date(performance.timing.domsearching).getTime();
        //     // Current Time //
        //     var now = Date.now();
        //     // Total Process Lenght as Minutes //
        //     var tenSec = 10 * 1000;
        //     // End Time of Process //
        //     var plusTenSec = currentDocumentTimestamp + tenSec;
        //     if (now > plusTenSec) {
        //         location.reload();
        //     }
        // },
        allApartments() {
            axios.get("/api/allApartments")
                .then(res => {
                    this.apartments = res.data.apartments;

                    this.apartmentsSponsored = res.data.apartmentsSponsored



                }).catch((errors) => {

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
            this.error = null;
        }
    },

    mounted() {
        // this.reloadPage();
        this.allApartments()
        if (window.location.href.substr(-2) !== "?r") {
            window.location = window.location.href + "?r";
        }

    }
}
</script>
<style lang="scss" scoped>
@use '/resources/sass/variables' as *;

.ms_home_title {
    padding-top: 35px !important;
    color: $principalColor;
}



.ms_home_subtitle {
    font-size: 1rem;
    color: $thirdColor;
}

// grafica search bar
.ms_ctn_search {
    width: 500px;
    margin: 0 auto;

    .ms_search_bar {
        color: $thirdColor;
        font-weight: 600;
        padding: 5px 10px;
        border: solid 2px $thirdColor;
        border-top-left-radius: 30px;
        border-bottom-left-radius: 30px;
    }

    .ms_search_bar:focus {
        color: $principalColor;
        border: solid 2px $principalColor;
        box-shadow: none;
    }

    .ms_search_bar:focus+.ms_btn_search {
        color: $principalColor;
        border: solid 2px $principalColor;
    }

    .ms_btn_search {
        background-color: $body-bg;
        border: solid 2px $thirdColor;
        border-top-right-radius: 30px;
        border-bottom-right-radius: 30px;
    }
}

.ms_btn_delete,
.ms_btn_advanced {
    color: $thirdColor;
    background-color: $body-bg;

    border: solid 2px $thirdColor;
    border-radius: 30px;
    font-weight: 600;
    padding: 5px 10px;
}

.ms_btn_delete:hover,
.ms_btn_advanced:hover {
    color: $secondColor;
    background-color: $principalColor;
    border-color: $principalColor;
}

.ms_error_messagge {
    margin-top: 100px;
    color: $thirdColor;
}

// ===================================

// grafica main
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
    color: $principalColor;
    transition: all 0.2s ease;
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



// ==========================================================

// grafica bottone per ritornare in cima nella pagina
.ms_btn_page_up {
    font-size: 40px;
    position: fixed;
    bottom: 150px;
    right: 30px;


    a {
        color: $thirdColor;
        opacity: 0.5;

        &:hover {
            opacity: 1;
        }
    }
}

// ====================================

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