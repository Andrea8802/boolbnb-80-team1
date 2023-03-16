<template>
    <div class="container">
        <div class="row">
            <div>
                <h1>Your Apartments</h1>
                <button> <router-link :to="{ name: 'createApartment' }">Create apartment</router-link></button>
            </div>

            <!-- Colonna con appartamenti e pulsanti -->
            <div class="col my-5">
                <div class="accordion">
                    <div class="accordion-item ms_main_item" v-for="apartment in apartments">
                        <div class="accordion-header d-flex justify-content-around ms_active_show">
                            <div class="ms_aps_title h-100">
                                <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                                    class="rounded fluid img-thumbnail">
                                <h2 class="text-capitalize">{{ apartment.title }}</h2>
                            </div>
                            <div class="ms_aps_buttons h-100">
                                <button type="button" class="btn btn-danger" @click="deleteApartment(apartment.id)">
                                    Delete
                                </button>
                                <button type="button" class="btn btn-warning">
                                    <router-link :to="{ name: 'editApartment', params: { id: apartment.id } }"
                                        class="link-dark">
                                        <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                                        Edit
                                    </router-link>
                                </button>
                                <button type="button" class="btn btn-success">
                                    <router-link :to="{ name: 'sponsor', params: { id: apartment.id } }" class="link-light">
                                        <font-awesome-icon icon="fa-solid fa-certificate" />
                                        Sponsor
                                    </router-link>
                                </button>
                                <router-link :to="{ name: 'viewMessages', params: { id: apartment.id } }"
                                    class="ms_hover_show">
                                    <font-awesome-icon icon="fa-regular fa-envelope" />
                                </router-link>
                                <div class="ms_hide">
                                    You have "X" messages for this apartment
                                </div>
                            </div>

                        </div>
                        <div class="accordion-collapse collapse show ms_active_hide">
                            <div class="accordion-body">
                                <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                                    class="rounded fluid img-thumbnail h-50">

                                <p>
                                    {{ apartment.description }}
                                    <span>{{ apartment.address }}</span>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- <div class="container-fluid p-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 g-4">
            <div class="col" v-for="apartment in apartments">
                <div class="card rounded ms_card_efct">

                    <div class="card-body h-35">
                        <h5 class="card-title text-center ms_aps_text">{{ apartment.title }}</h5>
                        <div class="text-center small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                        <div class="text-center "><strong>{{ apartment.price }}€</strong>/notte</div>
                    </div>
                    <div class="card-body h-35">

                    </div>

                </div>
            </div>

        </div>
    </div> -->
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {

            apartments: [],
            getapartment: [],

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

        getUserApartments() {
            axios.get("/api/userApartments")
                .then(res => {
                    this.apartments = res.data.response;
                    console.log(this.apartments);
                }).catch((errors) => {
                    console.log(errors);
                });
        },
        deleteApartment(apartmentId) {

            axios.get("/api/delete/" + apartmentId)
                .then(res => {
                    this.getUserApartments();
                    const success = res.data.success
                    console.log(success);

                }).catch((errors) => {
                    console.log(errors);
                });
        },

    },

    mounted() {
        this.reloadPage()
        this.getUserApartments()
    }
}
</script>
<style lang="scss" scoped>
/* hide show messaggi */
.ms_hide {
    display: none;
}

.ms_hover_show:hover+.ms_hide {
    display: block;
}

/* temporaneo hide-show items */


.ms_active_hide {
    display: none;
}

.ms_active_show:active+.ms_active_hide {
    display: block;
}



/* main items */


/* componenti show di main items */
.ms_active_show {
    height: 100px;

    :hover {
        cursor: pointer;
    }
}

.ms_aps_title {
    width: 45%;
    padding: 1% 0;
}

.ms_aps_buttons {
    width: 30%;
    padding: 2.5% 0;

    button {
        margin: auto 1rem;
    }
}
</style>