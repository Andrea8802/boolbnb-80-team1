<template>
    <h1 @click="log">Sponsor</h1>
    <div v-for="sponsor in sponsors">
        <input type="radio"
            v-model="modelSponsor"
            name="profileImg"
            :value="sponsor.id"> {{ sponsor.name }} {{ sponsor.price }}&euro;
    </div>
    <button v-if="getApartment.id !== undefined"><router-link
            :to="{ name: 'payment', params: { id: getApartment.id } }">Pay</router-link></button>
</template>
<script>
import axios from "axios"
export default {
    data() {
        return {
            sponsors: [],
            modelSponsor: "",
            getApartment: "",
        }
    },
    methods: {
        log() {
            console.log(this.getApartment);
        },
        getSponsors() {
            axios.get("/api/sponsors")
                .then(res => {
                    this.sponsors = res.data.response;

                }).catch((errors) => {
                    console.log(errors);
                });
        },
        geteditApartment() {

            axios.get("/api/Apartment/" + this.$route.params.id)
                .then(res => {
                    this.getApartment = res.data.response;
                    console.log(this.getApartment);


                }).catch((errors) => {
                    console.log(errors);
                });
        },
    },

    mounted() {
        this.geteditApartment();
        this.getSponsors();
    }
}
</script>