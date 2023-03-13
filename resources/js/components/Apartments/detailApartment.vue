<template>
    <div class="container-fluid">
        <h1>DETAILS APARTMENT </h1>
        <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title">

        <!-- carousel added images -->
        <div>
            <ul v-for="image in apartment.addedImage">
                <li><img :src="'/storage/' + image"></li>
            </ul>
        </div>



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

        <button>Write to {{ user.name }}</button>

        <Map :lat=parseInt(apartment.lat) :long=parseInt(apartment.long) />

    </div>
</template>

<script>
import axios from 'axios'
import Map from './Map.vue'

export default {

    components: {
        Map
    },


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

        getApartment() {

            axios.get("/api/Apartment/" + this.$route.params.id)
                .then(res => {
                    this.apartment = res.data.response[0];
                    this.user = res.data.response[1];
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

<style lang="scss" scoped></style>