<template>
    <h1>Sponsor</h1>
    <div v-for="sponsor in sponsors">
        <input type="radio"
            v-model="modelSponsor"
            name="profileImg"
            :value="sponsor.id"> {{ sponsor.name }} {{ sponsor.price }}&euro;
    </div>

    <button v-if="getApartment.id !== undefined && modelSponsor !== undefined"><router-link
            :to="{ name: 'payment', params: { id: getApartment.id, sponsor: modelSponsor } }">Pay</router-link></button>
</template>
<script>
import axios from "axios"
export default {
    data() {
        return {
            sponsors: [],
            modelSponsor: "sponsor",
            getApartment: "",
        }
    },
    methods: {
        log() {
            console.log(this.modelSponsor);
        },
        getSponsors() {
            axios.get("/api/sponsors")
                .then(res => {
                    this.sponsors = res.data.response;

                }).catch((errors) => {
                    console.log(errors);
                });
        },
        getApartmentId() {
            let formData = new FormData();
            formData.append("apartmentId", this.$route.params.id);
            axios.post('/api/sponsorApartmentId', formData).then(() => {
                const success = res.data.success;
            }).catch((errors) => {
                if (errors.response.status = 403) {
                    this.$router.push({ name: "Login" });
                }

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
        this.getApartmentId()
    }
}
</script>