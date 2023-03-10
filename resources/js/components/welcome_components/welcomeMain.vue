<script>
export default {
    data() {
        return {
            apartments: [],
        }
    },
    methods: {
        getApartments() {
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
        this.getApartments();
    }
}
</script>

<template>
    <div class="container-fluid ms_ctn_main p-3">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <div class="col" v-for="apartment in apartments">
                <div class="card rounded">
                    <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title" class="rounded fluid">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ apartment.title }}</h5>
                        <div class="card-text text-center">
                            <p>{{ apartment.description }}</p>
                            <strong>{{ apartment.price }}€</strong>/notte
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block mx-auto my-2">
                        <button class="btn btn-danger rounded">Scrivi al proprietario</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.ms_ctn_main {
    overflow-y: auto;
    height: calc(100vh - 110px);
}

.ms_aps_img {
    width: 100%;
    height: auto;
}
</style>