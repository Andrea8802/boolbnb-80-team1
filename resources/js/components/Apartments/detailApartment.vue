<template>
    <div class="container-fluid">
        <h1 class="text-center text-uppercase">apartment details</h1>
        <div class="row d-flex">
            <div class="col">

                <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title" class="img-thumbnail">



                <h3 class="text-center">{{ apartment.title }}</h3>
                <div class="text-center">{{ apartment.description }}</div>
                <div>
                    <h3>{{ apartment.price }}&euro;/night</h3>
                </div>
                <div>
                    <h3>Our services:</h3>
                    <ul v-for="service in apartment.services">
                        <li>
                            {{ service.name }}
                        </li>
                    </ul>
                </div>


                <div>
                    <h3>Our {{ apartment.rooms_num }} rooms ({{ apartment.size }} sq m):</h3>
                    <ul>
                        <li>Beds: {{ apartment.beds_num }}</li>
                        <li>Bathrooms: {{ apartment.baths_num }}</li>
                    </ul>
                </div>


            </div>
            <div class="col">
                <h3 class="text-center">Where are we?</h3>
                <div class="text-center">{{ apartment.address }}</div>
                <div id="map"></div>

                <!-- carousel -->


                <div id="carouselExampleIndicators" class="carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item" v-for="(image, index) in this.apartment.added_images"
                            :class="index === activeItem ? 'active' : ''">
                            <img :src=image.image :alt="image.name" class="d-block w-100">
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



                <button>Write to {{ user.name }}</button>

                <!-- <div v-for="image in apartment.added_images" class="carousel-item active">
                    <img :src=image.image :alt="image.name" class="d-block w-100">
                </div> -->




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

            icons: {
                'Pool': "fa-solid fa-person-swimming",
                'Kitchen': "fa-solid fa-utensils",
                'Parking': "fa-solid fa-square-parking",
                'Shampoo': "fa-solid fa-shower",
                'Freezer': "fa-solid fa-snowflake",
                'Balcony': "fa-solid fa-mountain-sun",
                'Hammock': "fa-solid fa-bed",
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

            user: "",
            activeItem: 0,
            meter: '',

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
        }


    },
    mounted() {
        this.getData()
        this.getApartment()



    }
}
</script>

<style lang="scss" scoped>
#map {
    height: 400px;
    width: 700px;
}
</style>