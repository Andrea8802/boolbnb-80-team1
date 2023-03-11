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
            <div class="col align-items-stretch" v-for="apartment in apartments">
                <div class="card rounded ms_card_efct">
                    <img :src="'/storage/' + apartment.imageApartment" :alt="apartment.title"
                        class="rounded fluid card-img-top h-50">
                    <div class="card-body h-35">
                        <h5 class="card-title text-center ms_aps_text">{{ apartment.title }}</h5>
                        <div class="card-text text-center ms_aps_text">
                            <p>{{ apartment.description }}</p>
                        </div>
                        <div class="text-center small font-italic ms_aps_sm_text">{{ apartment.address }}</div>
                        <div class="text-center "><strong>{{ apartment.price }}€</strong>/notte</div>
                    </div>
                    <div class="d-grid gap-2 d-md-block mx-auto my-2 h-15">
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

.ms_ctn_main::-webkit-scrollbar-thumb {
    background-color: #ff385c;
    outline: 1px solid #ff385c;
}

.ms_ctn_main::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

.ms_ctn_main::-webkit-scrollbar {
    width: 0.5em;
    color: #ff385c;
}

.ms_aps_text {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.ms_aps_sm_text {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}

.ms_card_efct {
    border: none;
}

.ms_card_efct:hover {
    transform: scale(1.05);
}
</style>