<template>
    <button @click.prevent="logout">Logout</button>
    <h1>Apartments List</h1> <br>
    <button> <router-link :to="{ name: 'createApartment' }">Create apartment</router-link></button>
    <ul>
        <li v-for="apartment in apartments">
            {{ apartment.title }}
            <span @click="deleteApartment(apartment.id)">DELETE</span>
            <button> <router-link :to="{ name: 'editApartment', params: { id: apartment.id } }">Edit</router-link> </button>

        </li>
    </ul>
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
        logout() {
            axios.post('/api/logout').then(() => {
                this.$router.push({ name: "Home" })
            }).catch((errors) => {
                console.log(errors);
            });
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
        // editApartment(apartmentId) {
        //     axios.get("editApartment/" + apartmentId)
        //         .then(res => {
        //             const success = res.data.success
        //             console.log(success);
        //             this.getapartment = res.data.response


        //         }).catch((errors) => {
        //             console.log(errors);
        //         });

        // }
    },

    mounted() {
        this.getUserApartments()
    }
}
</script>
<style lang="scss" scoped></style>