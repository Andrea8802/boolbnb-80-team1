<script>
export default {
    data() {
        return {
            apartments: [],
        }
    },
    methods: {
        getAllApartments() {
            axios.get('getApartments')
                .then(res => {

                    this.apartments = res.data.response;

                    console.log(this.apartments)

                }).catch((errors) => {
                    console.log(errors);
                });
        }
    },
    mounted() {
        this.getAllApartments();
    }
}
</script>

<template>
    <div class="container-fluid">
        <ul v-for="apartment in apartments">
            <li>
                <ul>
                    <li>{{ apartment.title }}</li>
                    <li>{{ apartment.description }}</li>
                    <li>{{ apartment.price }}</li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<style lang="scss"></style>