<template>
    <h1>Your Apartments</h1> <br>
    <button> <router-link :to="{ name: 'createApartment' }">Create apartment</router-link></button>
    <div class="container-fluid p-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 g-4">
            <div class="col" v-for="apartment in apartments">
                <div class="card rounded ms_card_efct">
                    <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                        class="rounded fluid card-img-top h-50">
                    <div class="card-body h-35">
                        <h5 class="card-title text-center ms_aps_text">{{ apartment.title }}</h5>
                        <div class="text-center small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                        <div class="text-center "><strong>{{ apartment.price }}€</strong>/notte</div>
                    </div>
                    <div class="card-body h-35">
                        <button @click="deleteApartment(apartment.id)">DELETE</button>
                        <button> <router-link
                                :to="{ name: 'editApartment', params: { id: apartment.id } }">Edit</router-link> </button>
                        <button><router-link
                                :to="{ name: 'sponsor', params: { id: apartment.id } }">Sponsor</router-link></button>
                        <button>
                            <router-link :to="{ name: 'viewMessages', params: { id: apartment.id } }">
                                Messages</router-link>

                        </button>
                    </div>

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

            apartments: [],
            getapartment: [],

        }
    },
    methods: {
        reloadPage() {
            var currentDocumentTimestamp = new Date(performance.timing.domLoading).getTime();
            // Current Time //
            var now = Date.now();
            // Total Process Lenght as Minutes //
            var tenSec = 10 * 1000;
            // End Time of Process //
            var plusTenSec = currentDocumentTimestamp + tenSec;
            if (now > plusTenSec) {
                location.reload();
            }
        },

        getUserApartments() {
            axios.get("/api/userApartments")
                .then(res => {
                    this.apartments = res.data.response;
                    console.log(this.apartments);
                }).catch((errors) => {
                    console.log(errors);
                });
        },
        deleteApartment(apartmentId) {

            axios.get("/api/delete/" + apartmentId)
                .then(res => {
                    this.getUserApartments();
                    const success = res.data.success
                    console.log(success);

                }).catch((errors) => {
                    console.log(errors);
                });
        },

    },

    mounted() {
        this.reloadPage()
        this.getUserApartments()
    }
}
</script>
<style lang="scss" scoped></style>