<template>
    <h1>DETAILS APARTMENT </h1> <br>
    <ul>
        <li>
            {{ apartment.title }}

        </li>
        <li>
            {{ apartment.description }}
        </li>

    </ul>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {

            apartment: "",

        }
    },
    methods: {

        getData() {
            axios.get("/api/getData")
                .then(res => {
                    this.services = res.data.response.services;
                    this.sponsors = res.data.response.sponsors;
                    console.log(this.services);
                }).catch((errors) => {
                    console.log(errors);
                });
        },

        getApartment() {

            axios.get("/api/Apartment/" + this.$route.params.id)
                .then(res => {
                    this.apartment = res.data.response;
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