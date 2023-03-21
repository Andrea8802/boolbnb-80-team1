<template>
    <div class="container pt-4">
        <div class="row justify-content-between align-items-baseline">
            <div class="col-12 col-lg-10 lg-w-50 md-w-80 mx-auto">
                <h4 class="ms_title mb-3">{{ apartment.title }}</h4>
                <span class="ms_address_ap me-2">{{ apartment.address }}</span>
            </div>

            <div class="col-12 col-lg-2 text-start text-lg-end mt-3 mt-lg-0">
                <router-link :to="{ name: 'editApartment', params: { id: apartment.id } }" v-if="owner">
                    <button class="ms_btn_message">
                        <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                        Edit
                    </button>
                </router-link>
            </div>
        </div>

        <div class="row d-flex mt-3">
            <div class="col-lg-6 col-md-12">

                <div class="w-100 my-3">
                    <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                        class="w-100 ms_image_ap_detail">
                </div>



                <!-- Card detail aps -->

                <div class="card-lg-6 col-md-12 ms_card_detail shadow rounded-3">
                    <div class="card-header ms_color ms_header_fix sticky-top">
                        <div class="nav-tabs card-header-tabs d-flex h-100 ms_color ms_card_header_fix">
                            <div class="nav-item ms_pointer ms_nav_item_fix text-center py-2"
                                :class="this.description ? 'ms_active' : ''">
                                <a class="nav-link object-fit-contain h-100 d-block border-0 text-truncate"
                                    @click="this.descriptionActive()">Description</a>

                            </div>
                            <div class="nav-item ms_pointer ms_nav_item_fix text-center py-2"
                                :class="this.services ? 'ms_active' : ''">
                                <a class="nav-link object-fit-contain h-100 d-block border-0 text-truncate"
                                    @click="this.servicesActive()">Services</a>
                            </div>
                            <div class="nav-item ms_pointer ms_nav_item_fix text-center py-2"
                                :class="this.rooms ? 'ms_active' : ''">
                                <a class="nav-link object-fit-contain h-100 d-block border-0 text-truncate"
                                    @click="this.roomsActive()">Rooms</a>
                            </div>
                        </div>
                    </div>
                    <div v-if="description" class="card-body p-3" id="description">
                        <h5 class="card-title mb-2">Your special place</h5>
                        <p>{{ apartment.description }}</p>
                    </div>
                    <div v-else-if="services" class="card-body p-3" id="services">
                        <h5 class="card-title">Our services:</h5>
                        <p>We offert the following services for a true relaxing experience:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" v-for="service in apartment.services">
                                {{ service.name }}
                                <font-awesome-icon :icon="icons[service.name]" />
                            </li>
                        </ul>
                    </div>
                    <div v-else-if="rooms" class="card-body ms_card_body_fix p-3" id="rooms">
                        <h5 class="card-title my-3">Our rooms:</h5>
                        <p>We offer {{ apartment.rooms_num }} rooms in total, for a comfy space of {{ apartment.size }} sq m
                        </p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Beds: {{ apartment.beds_num }}
                                <font-awesome-icon icon="fa-solid fa-bed" />
                            </li>
                            <li class="list-group-item">Bathrooms: {{ apartment.baths_num }}
                                <font-awesome-icon icon="fa-solid fa-bath" />
                            </li>
                        </ul>
                    </div>
                    <div v-else class="card-body"></div>
                    <div v-else class="card-body"></div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 d-flex flex-column">

                <!--  carousel  -->
                <div id="carouselExampleIndicators" class="carousel slide my-3 order-2 order-lg-1">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">

                        <div class="carousel-item" v-for="(image, index) in this.apartment.added_images"
                            :class="index === activeItem ? 'active' : ''">
                            <img v-if="this.carousel_var" :src=image.image class="d-block ms_carousel_img">
                            <img v-else :src="'/storage/' + image.image" :alt="image.name" class="d-block ms_carousel_img">
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                        data-slide="prev" @click="this.prevImg()">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                        data-slide="next" @click="this.nextImg()">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>

                <!-- Prezzo -->
                <div class="w-100 my-2 order-1 order-lg-2 rounded-3 shadow p-3">
                    <h3 class="text-center">Our best price for you:</h3>
                    <div class="text-center">
                        <span class="ms_highprice">{{ this.highprice }}&euro;/night</span>
                        <span class="ms_bestprice">{{ apartment.price }}&euro;/night</span>
                    </div>
                </div>

                <!-- Message -->
                <div class="d-grid gap-2 col-6 mx-auto my-2 order-3 order-lg-3 rounded-3 shadow p-3 w-100">
                    <h3 class="text-center">Want to know more?</h3>
                    <router-link :to="{ name: 'message' }" class="link-light mx-auto"><button class="ms_btn_message">Write
                            to {{ user.name }}</button></router-link>
                </div>

            </div>

            <hr class="my-5">

            <div class="col-12">
                <!-- mappa indirizzo -->
                <h3 class="my-3 ps-5">Where are we?</h3>
                <div class="ms_address_ap ps-5">{{ apartment.address }}</div>
                <div id="map" class="mx-auto shadow"></div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {



    data() {

        return {

            apartment: [],

            user: [],

            /* variabili carousel */
            activeItem: 0,
            meter: '',

            /* variabili dettagli aps */
            icons: {
                'Pool': "fa-solid fa-person-swimming",
                'Kitchen': "fa-solid fa-utensils",
                'Parking': "fa-solid fa-square-parking",
                'Shampoo': "fa-solid fa-shower",
                'Freezer': "fa-solid fa-snowflake",
                'Balcony': "fa-solid fa-mountain-sun",
                'Hammock': "fa-solid fa-mattress-pillow",
                'Tv': "fa-solid fa-tv",
                'Air conditioning': "fa-solid fa-wind",
                'Lockbox': "fa-solid fa-vault",
                'Private sauna': "fa-solid fa-spa",
                'BBQ grill': "fa-solid fa-burger",
                'Coffee': "fa-solid fa-mug-hot",
                'Stove': "fa-solid fa-fire-burner",
                'Refrigerator': "fa-solid fa-fish",
                'Smoke alarm': "fa-solid fa-fire-extinguisher",
                'Lake view': "fa-solid fa-water",
                'Sea view': "fa-solid fa-ship",
                'Ocean view': "fa-solid fa-person-swimming",
                'Hangers': "fa-solid fa-vest",
            },
            description: true,
            services: false,
            rooms: false,
            highprice: 0,
            carousel_var: true,
            owner: false
        }
    },
    methods: {

        getData() {
            axios.get("/api/getData")
                .then(res => {

                    this.services = res.data.response.services;
                    this.sponsors = res.data.response.sponsors;

                })
        },
        getMap() {
            let center = [parseFloat(this.apartment.long), parseFloat(this.apartment.lat)];
            let map = tt.map({
                key: "HrIT0rDPsDPsPzHGmbsIRCwnxIakKjwM",
                container: "map",
                center: center,
                zoom: 15,
            });

            new tt.Marker({ color: "#ff385c", height: "40px", width: "30px" }).setLngLat(center).addTo(map);
        },
        getApartment() {

            axios.get("/api/getApartmentDetail/" + this.$route.params.id)
                .then(res => {

                    this.apartment = res.data.apartment;
                    this.user = res.data.user;
                    this.visitator = res.data.visitator;

                    if (this.visitator) {
                        if (this.apartment.user_id === this.visitator.id) {
                            this.owner = true;
                        }
                    }
                    this.getMap();
                    this.meter = this.apartment.added_images.length;
                    this.highprice = parseInt((this.apartment.price) * 1.5);
                    const img_image = this.apartment.added_images[0].image;
                    const controller = img_image.substring(0, 5);

                    if (controller == 'https') {
                        this.carousel_var = true;
                    } else {
                        this.carousel_var = false;
                    }
                })
        },
        nextImg() {
            this.activeItem++;
            if (this.activeItem > this.meter - 1) {
                return this.activeItem = 0;
            }
            return this.activeItem;
        },
        prevImg() {
            this.activeItem--;
            if (this.activeItem === -1) {
                return this.activeItem = this.meter - 1;
            }
            return this.activeItem;
        },
        descriptionActive() {
            this.description = true;
            this.services = false;
            this.rooms = false;
        },
        servicesActive() {
            this.description = false;
            this.services = true;
            this.rooms = false;
        },
        roomsActive() {
            this.description = false;
            this.services = false;
            this.rooms = true;
        },



    },
    mounted() {
        this.getData()
        this.getApartment()
        /* this.getMap() */
    }
}
</script>

<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;

#map {
    height: 400px;
    width: 90%;
    // max-width: 700px;
    margin-top: 20px;
    margin-bottom: 50px;
    border-radius: 20px;
}

.ms_title {
    font-size: 2em;
}

.ms_address_ap {
    color: $thirdColor;
    font-size: 1.1rem;
    font-weight: 400;
}

.ms_image_ap_detail {
    height: 300px;
    border-bottom-left-radius: 30px;
    border-top-left-radius: 30px;
    object-fit: cover;
}

.ms_carousel_img {
    width: 100%;
    height: 300px;
    border-top-right-radius: 30px;
    border-bottom-right-radius: 30px;
    object-fit: cover;
}



.ms_text {
    font-size: 0.5em;
}

.icon {
    height: 50px;
}

.ms_pointer {
    background-color: $thirdColor;
    font-weight: 600;

    :hover {
        cursor: pointer;
        color: $secondColor;
    }

    a {
        color: $secondColor;
    }

}

.ms_active {
    background-color: $principalColor;
}

.ms_color {
    background-color: $thirdColor;
}

.ms_highprice {
    text-decoration: line-through;
    color: red;
    font-size: 1rem;
}

.ms_bestprice {
    color: green;
    font-size: 1.5rem;
}

.ms_card_detail {
    height: 250px;
    overflow-y: scroll;
    -ms-overflow-style: none;
    scrollbar-width: none;

    ::-webkit-scrollbar {
        display: none;
    }

}

.ms_header_fix {
    padding: 0;
    border-bottom: 0;
    height: 50px;

    .ms_card_header_fix {
        margin-right: 0;
        margin-left: 0;


        .ms_nav_item_fix {
            width: calc(100% / 3);
        }
    }
}

.ms_card_body_fix {
    height: calc(100% - 50px);
}

.ms_btn_message {
    color: $thirdColor;
    background-color: $body-bg;

    border: solid 2px $thirdColor;
    border-radius: 30px;
    font-weight: 600;
    padding: 5px 10px;
}

.ms_btn_message:hover {
    color: $secondColor;
    background-color: $principalColor;
    border-color: $principalColor;
}

// responsive
@media screen and (max-width: 1180px) {

    .ms_image_ap_detail,
    .ms_carousel_img {
        border-radius: 30px;
    }
}

// ====================
</style>