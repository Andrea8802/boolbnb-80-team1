<template>
    <div class="container p-0">
        <div class="row">
            <div>
                <h1>Your Apartments</h1>
                <router-link :to="{ name: 'createApartment' }"><button class="ms_btn_create">Create
                        apartment</button></router-link>
            </div>

            <!-- Colonna con appartamenti e pulsanti -->
            <div class="col my-5">
                <div class="accordion">
                    <div class="accordion-item ms_main_item" v-for="(apartment, index) in this.apartments">
                        <div class="accordion-header d-flex justify-content-between md-flex-column ms_active_show ">
                            <div class="ms_aps_title h-100 d-flex justify-content-between"
                                @click="this.toggleShow(apartment.id)">
                                <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                                    class="img-thumbnail ms_icon">
                                <div>
                                    <div class="text-capitalize ms_title">{{ apartment.title }}</div>
                                    <div class="fs-5">Visibility:
                                        <span class="text-info">
                                            {{ apartment.visibility ? "Public" : "Private" }}
                                        </span>
                                    </div>
                                    <div class="list-group-item fs-6 text-primary">
                                        <font-awesome-icon icon="fa-regular fa-eye" />
                                        Views: <span class="fw-bold"> {{ numViews[index] }}</span>
                                    </div>
                                </div>


                            </div>
                            <div class="ms_aps_sponsor" v-show="this.sponsors_count[index] > 0">
                                <div class="btn disabled btn-sm btn-danger mx-auto my-2 text-capitalize">
                                    <font-awesome-icon icon="fa-solid fa-certificate" class="ms_sponsor_icon" />
                                    sponsored
                                </div>
                                <div v-if="apartment.end_date && apartment.end_date[index]">
                                    <strong>Your sponsorship ends:</strong>
                                    {{ apartment.end_date[index].end_date }}
                                </div>
                                <div>
                                    <!-- <em>You have {{ this.time_left[index][0] }} days and {{ this.time_left[index][1] }}
                                        hours of
                                        sponsorship</em> -->
                                </div>

                            </div>
                            <div class="ms_aps_buttons flex-shrink ms_menu ">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="btn btn-danger h-100 mx-auto" @click="deleteApartment(apartment.id)">
                                            Delete
                                        </div>
                                    </li>
                                    <li class="list-group-item"><router-link
                                            :to="{ name: 'editApartment', params: { id: apartment.id } }"
                                            class="link-dark btn btn-warning h-100 mx-auto ms_router">
                                            <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                                            Edit
                                        </router-link></li>
                                    <li class="list-group-item"><router-link
                                            :to="{ name: 'sponsor', params: { id: apartment.id } }"
                                            class="link-light btn btn-success h-100 mx-auto ms_router">
                                            <font-awesome-icon icon="fa-solid fa-certificate" />
                                            Sponsor
                                        </router-link></li>
                                    <li class="list-group-item"><button class="btn btn-light ms_hover_show h-100 mx-auto"
                                            v-if="this.messages_count[index] > 0" @click="this.toggleShow(index)"
                                            :class="this.messages_count[index] > 0 ? 'ms_msg_present' : ''">
                                            <font-awesome-icon icon="fa-regular fa-envelope"
                                                :class="this.messages_count[index] > 0 ? 'ms_font_icon' : ''" />
                                        </button>

                                        <button v-else class="btn btn-light ms_hover_show mx-auto"
                                            @click="this.toggleShow(index)">
                                            <font-awesome-icon icon="fa-solid fa-comment-slash" />
                                            Messages
                                        </button>
                                    </li>

                                    <li class="list-group-item" v-if="apartment.visibility">
                                        <button class="btn btn-light ms_hover_show h-100 mx-auto"
                                            @click="changeVisibility(apartment)">
                                            <font-awesome-icon icon="fa-solid fa-eye-slash" />
                                            Set Private
                                        </button>
                                    </li>
                                    <li class="list-group-item" v-else>
                                        <button class="btn btn-light ms_hover_show h-100 mx-auto"
                                            @click="changeVisibility(apartment)">
                                            <font-awesome-icon icon="fa-solid fa-eye" />
                                            Set Public
                                        </button>
                                    </li>

                                </ul>



                                <div class="ms_msg ms_active_hide text-center" :id="index">
                                    You have {{ this.messages_count[index] }} messages for this apartment
                                    <router-link v-if="this.messages_count[index] > 0"
                                        :to="{ name: 'viewMessages', params: { id: apartment.id } }"
                                        class="btn btn-primary btn-sm d-inline ms_msg_link">
                                        Read
                                    </router-link>
                                    <div v-else></div>
                                </div>

                            </div>

                        </div>
                        <div class="accordion-collapse collapse show ms_active_hide" :id="apartment.id">
                            <div class="accordion-body ms_hide_body d-flex justify-content-between">
                                <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                                    class="rounded fluid img-thumbnail ms_body_img">

                                <div class="text-center d-flex flex-column justify-content-around ms_info">
                                    <p class="text-capitalize lead">
                                        {{ apartment.description }}
                                    </p>
                                    <sub class="">{{ apartment.address }}</sub>
                                    <div>Prezzo: {{ apartment.price }}</div>
                                </div>

                            </div>
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



                    /* end_date + tempo rimasto */

                    /* this.apartments.forEach((apartment) => {
                        this.sponsors_end.push(apartment.end_date);
                        console.log(this.sponsors_end);


                        const end = apartment.end_date.end_date;
                        

                        const date = new Date();
                        const remaining = Date.parse(end) - date.getTime();

                        const seconds = Math.floor(remaining / 1000);
                        const minutes = Math.floor(seconds / 60);
                        const hours = Math.floor(minutes / 60);
                        const days = Math.floor(hours / 24);

                        const hours_remaining = hours - (days * 24);
                        console.log(days, hours_remaining);
                        this.time_left.push([days, hours_remaining]);
                    }); */




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
<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;


/* alert messaggi */
.ms_msg {
    width: 100%;
    height: 50px;

    .ms_msg_link {
        width: 50%;
    }

}

/* classe hide */
.ms_active_hide {
    display: none;
}





/* main items */
.ms_aps_title {
    width: calc(100% / 2);
    padding: 1% 0;

    :hover {
        cursor: pointer;
    }

    .ms_icon {
        width: 90px;
        height: 90px;
        margin-left: 2rem;
    }

    .ms_hide_body {

        .ms_title {
            width: 75%;

        }
    }

    .ms_title {
        width: calc(100% - 80px);
        font-size: 1.5rem;
        font-weight: 500;
    }

}

.ms_aps_sponsor {
    width: calc(100% / 3);

    .ms_sponsor_box {
        width: 30%;
        background-color: $principalColor;
        padding: 0.25rem 0.5rem;
        border-radius: 25px;

        .ms_sponsor_icon {
            color: yellow;
        }
    }
}

.ms_menu {
    width: 160px;
    text-align: center;
}

.ms_aps_buttons {
    padding: 2.5% 0;
    margin-right: 1.5rem;

    button {
        margin: auto 0.5rem;
    }

    .ms_router {
        margin: auto 0.5rem;

    }

}


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


/* componenti show di main items */






.ms_body_img {
    height: 200px;
    width: 200px;
}

.ms_info {
    width: 70%;
}

.ms_button_msg {
    height: 50px;
    width: 50px;
}

.ms_msg_present {


    .ms_font_icon {
        color: $principalColor;
    }


}
</style>