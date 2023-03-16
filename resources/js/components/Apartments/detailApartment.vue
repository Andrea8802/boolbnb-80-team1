<template>
    <div class="container-fluid">
        <h1 class="text-center text-capitalise">{{ apartment.title }}</h1>
        <div class="row d-flex">
            <div class="col">

                <img :src="'/storage/' + apartment.imageApartment"
                    :alt="apartment.title"
                    class="img-thumbnail">




                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item ms_pointer"
                                :class="description ? 'active ms_active' : ''">
                                <a class="nav-link"
                                    @click="this.descriptionActive()">Description</a>
                            </li>
                            <li class="nav-item ms_pointer"
                                :class="services ? 'active ms_active' : ''">
                                <a class="nav-link"
                                    @click="this.servicesActive()">Services</a>
                            </li>
                            <li class="nav-item ms_pointer"
                                :class="rooms ? 'active ms_active' : ''">
                                <a class="nav-link"
                                    @click="this.roomsActive()">Rooms</a>
                            </li>
                        </ul>
                    </div>
                    <div v-if="description"
                        class="card-body"
                        id="description">
                        <h5 class="card-title">Your special place</h5>
                        <div class="text-center">{{ apartment.description }}</div>
                    </div>
                    <div v-else-if="services"
                        class="card-body"
                        id="services">
                        <h5 class="card-title">Our services:</h5>
                        <p>We offert the following services for a true relaxing experience:</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"
                                v-for="service in apartment.services">
                                {{ service.name }}
                                <font-awesome-icon :icon="icons[service.name]" />
                            </li>
                        </ul>
                    </div>
                    <div v-else-if="rooms"
                        class="card-body"
                        id="rooms">
                        <h5 class="card-title">Our rooms:</h5>
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
                    <div v-else
                        class="card-body"></div>
                </div>



                <div>
                    <h3>{{ apartment.price }}&euro;/night</h3>
                </div>


            </div>
            <div class="col">
                <h3 class="text-center">Where are we?</h3>
                <div class="text-center">{{ apartment.address }}</div>
                <div id="map"></div>

                <!-- carousel -->

                <h3 class="text-center">More about us:</h3>

                <div id="carouselExampleIndicators"
                    class="carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators"
                            data-slide-to="0"
                            class="active"></li>
                        <li data-target="#carouselExampleIndicators"
                            data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators"
                            data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item"
                            v-for="(image, index) in this.apartment.added_images"
                            :class="index === activeItem ? 'active' : ''">
                            <img :src=image.image
                                class="d-block w-100">
                        </div>
                    </div>
                    <button class="carousel-control-prev"
                        type="button"
                        data-target="#carouselExampleIndicators"
                        data-slide="prev"
                        @click="this.prevImg()">
                        <span class="carousel-control-prev-icon"
                            aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next"
                        type="button"
                        data-target="#carouselExampleIndicators"
                        data-slide="next"
                        @click="this.nextImg()">
                        <span class="carousel-control-next-icon"
                            aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>


                <div class="d-grid gap-2 col-6 mx-auto my-5">
                    <h3 class="text-center">Want to know more?</h3>
                    <router-link :to="{ name: 'message' }"
                        class="link-light btn-route">
                        <button class="btn btn-danger rounded-5">Write to {{ user.name }}</button>
                    </router-link>
                    <!-- <button class="btn btn-danger rounded-5">
                        <router-link :to="{ name: 'message' }" class="link-light">Write to {{ user.name }}</router-link>
                    </button> -->
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
        }
    },
    methods: {

        getData() {
            axios.get("/api/getData")
                .then(res => {
                    this.services = res.data.response.services;
                    this.sponsors = res.data.response.sponsors;
                    /* console.log(this.services); */
                }).catch((errors) => {
                    console.log(errors);
                });
        },
        getMap() {
            let center = [this.apartment.long, this.apartment.lat];
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
                    this.apartment = res.data.response[0];
                    this.user = res.data.response[1];
                    this.getMap()
                    this.meter = this.apartment.added_images.length
                    console.log(this.apartment.long);
                    console.log(this.apartment);
                    console.log(this.apartment.added_images)
                    console.log(this.meter)
                    console.log(res.data.ip);

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
        }



    },
    mounted() {
        this.getData()
        this.getApartment()
        /* this.descriptionActive() */
        /* this.servicesActive() */
        /* this.roomsActive() */



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

.icon {
    height: 50px;
}

.ms_pointer:hover {
    cursor: pointer;

}

.ms_pointer {
    background-color: $principalColor;

    a {
        color: $secondColor;
    }

}

.ms_pointer.ms_active {
    background-color: $secondColor;

    a {
        color: $principalColor;
    }
}
</style>