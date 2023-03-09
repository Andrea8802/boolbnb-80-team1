<template>
    <h1>Apartments List</h1> <br>
    <ul>
        <li v-for="apartment in apartments">
            {{ apartment.title }}
            <span @click="deleteApartment(apartment.id)">DELETE</span>
        </li>
    </ul>
</template>

<script>
export default {
    data() {
        return {

            apartments: []

        }
    },
    methods: {

        getUserApartments() {
            axios.get("userApartments")
                .then(res => {
                    this.apartments = res.data.response;
                    console.log(this.apartments);
                }).catch((errors) => {
                    console.log(errors);
                });
        },
        deleteApartment(apartmentId) {
            axios.get("delete/" + apartmentId)
                .then(res => {
                    const success = res.data.success

                }).catch((errors) => {
                    console.log(errors);
                });
        },
    },

    mounted() {
        this.getUserApartments()
    }
}
</script>
<style lang="scss" scoped></style>