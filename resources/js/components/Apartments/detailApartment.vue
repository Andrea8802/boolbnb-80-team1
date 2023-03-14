<template>
    <div class="container-fluid">
        <div class="row d-flex">
            <div class="col">
                <h1>DETAILS APARTMENT </h1>
                <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title">



                <h3>{{ apartment.title }}</h3>
                <div>{{ apartment.description }}</div>
                <div>{{ apartment.address }}</div>
                <div>
                    <h1>{{ apartment.price }}&euro;/night</h1>
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
                <!-- carousel added images -->
                <div id="added_images">
                    <ul v-for="image in apartment.addedImage">
                        <li>
                            <div>
                                <img :src="image.image" :alt="image.name">
                            </div>

                        </li>
                    </ul>
                </div>
                <button>
                    <router-link :to="{ name: 'message' }">Write to {{ user.name }}</router-link>
                </button>
                <div id="map"></div>
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
                    console.log(this.apartment.long);
                    console.log(this.apartment);


                }).catch((errors) => {
                    console.log(errors);
                });
        },

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

.added_images {
    height: 200px;
}
</style>