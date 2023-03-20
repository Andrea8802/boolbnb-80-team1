<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;

// bottone create apartment
.ms_btn_create {
    color: $thirdColor;
    background-color: $body-bg;

    border: solid 2px $thirdColor;
    border-radius: 30px;
    font-weight: 600;
    padding: 5px 10px;
}

.ms_btn_create:hover {
    color: $secondColor;
    background-color: $principalColor;
    border-color: $principalColor;
}

// ==================================

// grafica card
.ms_description_ap {
    font-size: 1.1rem;
    font-weight: 600;
}

.ms_msg_present {

    .ms_font_icon {
        color: $principalColor;
    }

}

.ms_slot_img {
    img {
        object-fit: cover;
        height: 250px;
    }
}

// =====================


/* alert messaggi */
.ms_msg {
    width: 100%;
    height: 50px;

    .ms_msg_link {
        width: 50%;
    }

}

// ====================

/* classe hide */
.ms_active_hide {
    display: none;
}

.marg {
    padding-top: 35px !important;
}
</style>

<template>
    <div class="container">
        <div>
            <div class="marg">
                <h1>Your Apartments</h1>
                <router-link :to="{ name: 'createApartment' }"><button class="ms_btn_create">Create
                        apartment</button></router-link>
            </div>


            <!-- container delle card degli appartamenti -->
            <div class="ms_ctn_card_ap_us my-3">
                <!-- card dell'apartamento -->
                <div class="card text-center mb-3"
                    v-for="(apartment, index) in this.apartments">
                    <div class="card-header">
                        <h4>{{ apartment.title }}</h4>
                    </div>
                    <div class="card-body row row-cols-1 row-cols-lg-3">
                        <div class="col ms_slot_img">
                            <img :src="'/storage/' + apartment.imageApartment"
                                :alt="apartment.title"
                                class="w-100 rounded-5">
                        </div>
                        <div class="col">
                            <span class="ms_description_ap">Description:</span>
                            <p class="card-text">
                                {{ apartment.description }}
                            </p>

                            <span class="ms_description_ap">Address:</span>
                            <p class="card-text">
                                {{ apartment.address }}
                            </p>

                            <span class="ms_description_ap">Price:</span>
                            <p class="card-text">
                                {{ apartment.price }} €
                            </p>
                        </div>

                        <!-- bottoni -->
                        <div class="col d-flex flex-row flex-lg-column flex-wrap flex-lg-nowrap justify-content-center">
                            <!-- bottone per cancellare l'appartamento -->
                            <div>
                                <button class="btn btn-danger me-2 my-2"
                                    @click="deleteApartment(apartment.id)">
                                    Delete
                                </button>
                            </div>

                            <!-- bottone per modificare l'appartamento -->
                            <router-link :to="{ name: 'editApartment', params: { id: apartment.id } }">
                                <button class="link-dark btn btn-warning me-2 my-2">
                                    <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                                    Edit
                                </button>
                            </router-link>

                            <!-- bottone per sponsorizzare l'appartamento -->
                            <router-link :to="{ name: 'sponsor', params: { id: apartment.id } }">
                                <button class="link-light btn btn-success me-2 my-2">
                                    <font-awesome-icon icon="fa-solid fa-certificate" />
                                    Sponsor
                                </button>
                            </router-link>

                            <!-- bottone messaggi ricevuti -->
                            <div v-if="this.messages_count[index] > 0">
                                <button class="btn btn-light me-2 my-2 border-dark"
                                    @click="this.toggleShow(index)"
                                    :class="this.messages_count[index] > 0 ? 'ms_msg_present' : ''">
                                    <font-awesome-icon icon="fa-regular fa-envelope"
                                        :class="this.messages_count[index] > 0 ? 'ms_font_icon' : ''" />
                                </button>
                            </div>

                            <!-- bottone per andare alla pagina messagi -->
                            <div v-else>
                                <button class="btn btn-light me-2 my-2 border-dark"
                                    @click="this.toggleShow(index)">
                                    <font-awesome-icon icon="fa-solid fa-comment-slash" />
                                    Messages
                                </button>
                            </div>

                            <div class="ms_msg ms_active_hide text-center"
                                :id="index">
                                You have {{ this.messages_count[index] }} messages for this apartment
                                <router-link v-if="this.messages_count[index] > 0"
                                    :to="{ name: 'viewMessages', params: { id: apartment.id } }"
                                    class="btn btn-primary btn-sm">
                                    Read
                                </router-link>
                                <div v-else></div>
                            </div>

                            <!-- bottini per la visibilità dell'apartamento -->
                            <div v-if="apartment.visibility">
                                <button class="btn btn-light me-2 my-2 border-dark"
                                    @click="changeVisibility(apartment)">
                                    <font-awesome-icon icon="fa-solid fa-eye-slash" />
                                    Set Private
                                </button>
                            </div>

                            <div v-else>
                                <button class="btn btn-light me-2 my-2 border-dark"
                                    @click="changeVisibility(apartment)">
                                    <font-awesome-icon icon="fa-solid fa-eye" />
                                    Set Public
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <!-- sponsorizzazione appartamento -->
                        <div class="ms_aps_sponsor"
                            v-show="this.sponsors_count[index] > 0">
                            <div class="btn disabled btn-sm btn-danger mx-auto my-2 text-capitalize">
                                <font-awesome-icon icon="fa-solid fa-certificate"
                                    class="ms_sponsor_icon" />
                                sponsored
                            </div>
                            <div v-if="apartment.end_date && apartment.end_date[index]">
                                <strong>Your sponsorship ends:</strong>
                                {{ apartment.end_date[index].end_date }}
                            </div>
                        </div>

                        <!-- visibilità appartamento -->
                        <div class="fs-5">Visibility:
                            <span class="text-danger">
                                {{ apartment.visibility ? "Public" : "Private" }}
                            </span>
                        </div>
                        <div class="list-group-item fs-6 text-primary">
                            <font-awesome-icon icon="fa-regular fa-eye" />
                            Views: <span class="fw-bold"> {{ numViews[index] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { resolveComponent } from 'vue';
export default {
    data() {
        return {
            apartments: [],
            getapartment: [],
            numViews: 0,
            idApartments: [],
            messages_count: [],
            sponsors_count: [],
            time_left: [],
            sponsors_end: [],
            waitTime: true
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
                    this.getNumViews();

                    console.log(this.idApartments);


                    console.log(this.apartments);
                    console.log(this.apartments.length);


                    /* variabili count per show */
                    for (let i = 0; i < this.apartments.length; i++) {

                        /* messaggi */
                        const count_msg = this.apartments[i].messages.length;
                        console.log(count_msg);
                        this.messages_count.push(count_msg);

                        /* sponsor */
                        const count_spons = this.apartments[i].sponsors.length;
                        this.sponsors_count.push(count_spons);


                        /* end date */

                        this.sponsors_end.push(this.apartments[i].end_date);
                        console.log(this.sponsors_end);
                    };
                }).catch((errors) => {
                    console.log(errors);
                });
        },

        getNumViews() {
            let formData = new FormData();
            formData.append("apartment_id", this.idApartments);
            this.apartments.forEach(apartment => formData.append("apartmentsId[]", apartment.id));

            axios.post('/api/getNumViews', formData)
                .then(res => {
                    console.log(res);
                    this.numViews = res.data.response
                })
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
        toggleShow(x) {
            document.getElementById(x).classList.toggle('ms_active_hide');
        },
        addCountdown() {
            this.getUserApartments().then({

            })
        },
        changeVisibility(apartment) {

            // Filtro antispam
            if (!this.waitTime) return;
            this.waitTime = false;

            setTimeout(() => this.waitTime = true, 1500);

            apartment.visibility = !apartment.visibility;

            let formData = new FormData();
            formData.append("apartment_id", apartment.id);
            axios.post('/api/changeVisibility', formData)
                .then(res => {
                    console.log(res);
                    this.getUserApartments();
                })
        }

    },

    mounted() {
        this.reloadPage();
        this.getUserApartments();
    }
}
</script>
