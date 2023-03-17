<template>
    <div class="container-fluid">
        <div class="lg-w-50 md-w-80 mx-auto">
            <h1 class="text-center text-capitalise ms_title">{{ apartment.title }}</h1>
        </div>
        <div class="row d-flex">
            <div class="col">

                <div class="img-thumbnail mb-5 mt-5 ms_main_image">
                    <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title" class="img-thumbnail">
                </div>



                <!-- Card detail aps -->

                <div class="card-lg-6 col-md-12 ms_card_detail">
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
                    <div v-if="description" class="card-body" id="description">
                        <h5 class="card-title">Your special place</h5>
                        <div class="text-center">{{ apartment.description }}</div>
                    </div>
                    <div v-else-if="services" class="card-body" id="services">
                        <h5 class="card-title">Our services:</h5>
                        <p>We offert the following services for a true relaxing experience:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" v-for="service in apartment.services">
                                {{ service.name }}
                                <font-awesome-icon :icon="icons[service.name]" />
                            </li>
                        </ul>
                    </div>
                    <div v-else-if="rooms" class="card-body ms_card_body_fix" id="rooms">
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

                <!-- Prezzo -->
                <div class="w-100 my-5">
                    <h3 class="text-center">Our best price for you:</h3>
                    <div class="text-center">
                        <span class="ms_highprice">{{ this.highprice }}&euro;/night</span>
                        <span class="ms_bestprice">{{ apartment.price }}&euro;/night</span>
                    </div>
                </div>

                <!-- Message -->
                <div class="d-grid gap-2 col-6 mx-auto my-5">
                    <h3 class="text-center">Want to know more?</h3>
                    <button class="btn btn-danger rounded-5">
                        <router-link :to="{ name: 'message' }" class="link-light">Write to {{ user.name }}</router-link>
                    </button>
                </div>


            </div>
            <div class="col-lg-6 col-md-12">
                <h3 class="text-center my-5">Where are we?</h3>
                <div class="text-center">{{ apartment.address }}</div>
                <div id="map" class="mx-auto"></div>

                <!-- carousel -->

                <h3 class="text-center my-5">More about us:</h3>

                <div id="carouselExampleIndicators" class="carousel slide my-3">
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
                            <img v-if="this.carousel_var" :src=image.image class="d-block w-100 img-thumbnail">
                            <img v-else :src="'/storage/' + image.image" :alt="image.name"
                                class="d-block w-100 img-thumbnail">
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



            </div>


        </div>



    </div>
</template>

<script>
import axios from 'axios'

export default {



    data() {

        return {

            apartment: "",

            user: "",

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
            ip_user: '',
        }
    },
    methods: {

        getData() {
            axios.get("/api/getData")
                .then(res => {
                    console.log(res);
                    this.services = res.data.response.services;
                    this.sponsors = res.data.response.sponsors;
                    /* console.log(this.services); */
                }).catch((errors) => {
                    console.log(errors);
                });
        },
        getMap() {
            let center = [parseInt(this.apartment.long), parseInt(this.apartment.lat)];
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
                    console.log(res.data.response);
                    this.apartment = res.data.response[0];
                    this.user = res.data.response[1];
                    this.ip_user = res.data.response[2];


                    /* console.log(this.apartment);
                    console.log(this.user);
                    console.log(this.ip_user); */
                    console.log(this.apartment);
                    this.getMap();
                    console.log(this.apartment.added_images);


                    this.meter = this.apartment.added_images.length;
                    this.highprice = parseInt((this.apartment.price) * 1.5);



                    const img_image = this.apartment.added_images[0].image;
                    const controller = img_image.substring(0, 5);


                    console.log(controller);


                    if (controller == 'https') {
                        this.carousel_var = true;
                    } else {
                        this.carousel_var = false;
                    }

                    console.log(this.highprice);
                    console.log(this.apartment.long);
                    console.log(this.apartment);
                    console.log(this.apartment.added_images)
                    console.log(this.meter)


                }).catch((errors) => {
                    console.log(errors);
                });

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
    height: 500px;
    width: 100%;
    max-width: 700px;
}

.ms_title {
    font-size: 3em;
}

.ms_text {
    font-size: 0.5em;
}

.ms_main_image {
    background-color: $principalColor;
}


.icon {
    height: 50px;
}

.ms_pointer {
    background-color: $principalColor;

    :hover {
        cursor: pointer;
    }

    a {
        color: $secondColor;
    }

}

.ms_active {
    background-color: $secondColor;

    a {
        color: $principalColor;
    }
}

.ms_color {
    background-color: $principalColor;
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
</style>