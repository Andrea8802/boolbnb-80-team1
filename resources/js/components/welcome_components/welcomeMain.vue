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
        <div class="row">
            <div v-for="apartment in apartments" class="col-sm-4 mb-4 mb-sm-0">
                <div class="card mb-3" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-title">
                            <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title" class="ms_aps_img">
                            <h5>{{ apartment.title }}</h5>
                        </div>
                        <p class="card-text">{{ apartment.description }}</p>
                        <button>Manda un messaggio al proprietario</button>
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