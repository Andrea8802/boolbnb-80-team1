<template>
    <h1>Sponsor</h1>
    <div v-for="sponsor in sponsors">
        <input type="radio"
            v-model="modelSponsor"
            name="profileImg"
            :value="sponsor.id"> {{ sponsor.name }} {{ sponsor.price }}&euro;
    </div>
    <h4>Payment</h4>
    <button>Pay</button>
</template>
<script>
import axios from "axios"
export default {
    data() {
        return {
            sponsors: [],
            modelSponsor: "",
        }
    },
    methods: {
        getSponsors() {
            axios.get("/api/sponsors")
                .then(res => {
                    this.sponsors = res.data.response;

                }).catch((errors) => {
                    console.log(errors);
                });
        }
    },
    mounted() {
        this.getSponsors();
    }
}
</script>