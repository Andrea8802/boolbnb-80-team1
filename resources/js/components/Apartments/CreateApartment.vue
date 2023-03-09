<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;

.ms_title_page {
    font-weight: 900;
    color: $principalColor;
}

.ms_label_bg {
    background-color: $principalColor;
    color: #ffffff;
    border-color: $principalColor;
    font-weight: 600;
}

.ms_ctn_input {
    width: 400px;
    margin: 0 auto;
}

.ms_input_focus_color:focus {
    color: $principalColor;
    border-color: $principalColor;
    box-shadow: 0 0 10px $principalColor;
}
</style>

<template>
    <div class="container text-center">
        <h1 class="ms_title_page mb-5">Crea il tuo Spazio</h1>

        <!-- container del form per creare un appartamento -->
        <div>
            <form action="" enctype="multipart/form-data" @submit.prevent="createApartment" method="post">

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="title">Titolo : </label>
                    <input type="text" name="title" v-model="modelTitle" class="form-control ms_input_focus_color"
                        placeholder="Inserisci un titolo..." aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="description">Descrizione : </label>
                    <input type="text" name="description" v-model="modelDescription"
                        class="form-control ms_input_focus_color" placeholder="Inserisci una descrizione..."
                        aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="price">Prezzo : </label>
                    <input type="number" name="price" v-model="modelPrice" class="form-control ms_input_focus_color"
                        placeholder="Inserisci un prezzo..." aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div>

                </div>

                <label for="beds_num">Numero di letti : </label>
                <input type="number" name="beds_num" v-model="modelBedsNum"> <br> <br>
                <label for="rooms_num">Numero di Stanze : </label>
                <input type="number" name="rooms_num" v-model="modelRoomsNum"> <br> <br>
                <label for="baths_num">Numero di bagni : </label>
                <input type="number" name="baths_num" v-model="modelBathsNum"> <br> <br>
                <label for="size">Grandezza(mq) : </label>
                <input type="number" name="size" v-model="modelSize"> <br> <br>
                <label for="address">Indirizzo : </label>
                <input type="text" name="address" v-model="modelAddress"> <br> <br>
                <label for="lat">Latitudine : </label>
                <input type="number" name="lat" v-model="modelLat"> <br> <br>
                <label for="long">Longitudine : </label>
                <input type="number" name="long" v-model="modelLong"> <br> <br>
                <label for="long">Immagine di Copertina : </label>
                <input type="file" name="long" v-on:change="onImageChange"> <br> <br>
                <label for="sponsors">Seleziona il tipo di Sponsor : </label>
                <select name="imageApartment" v-model="modelSponsor">
                    <option v-for="sponsor in sponsors" :value="sponsor.id" :key="sponsor.id">
                        {{ sponsor.name }}
                    </option>


                </select> <br> <br>

                <label for="">Servizi : </label> <br>

                <div v-for="service in services">
                    <input type="checkbox" :value="service.id" name=services v-model="modelServices">
                    <label for="services">{{ service.name }}</label>
                </div> <br>

                <input type="submit" value="Crea">
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            modelTitle: "",
            modelDescription: "",
            modelPrice: "",
            modelRoomsNum: "",
            modelBathsNum: "",
            modelBedsNum: "",
            modelSize: "",
            modelAddress: "",
            modelLat: "",
            modelLong: "",
            modelServices: [],
            modelSponsor: [],
            services: [],
            sponsors: [],
            imageApartment: '',
            imageBool: false,

        }
    },
    methods: {
        onImageChange(e) {
            this.imageBool = true
            console.log(e)
            this.imageApartment = e.target.files[0];

        },
        getData() {
            axios.get("getData")
                .then(res => {
                    this.services = res.data.response.services;
                    this.sponsors = res.data.response.sponsors;
                    console.log(this.services);
                }).catch((errors) => {
                    console.log(errors);
                });
        },
        createApartment(e) {
            const config = {
                headers: {
                    "content-type": "multipart/form-data"
                }
            }
            let formData = new FormData();
            formData.append("title", this.modelTitle);
            formData.append("description", this.modelDescription);
            formData.append("price", this.modelPrice);
            formData.append("rooms_num", this.modelRoomsNum);
            formData.append("baths_num", this.modelBathsNum);
            formData.append("beds_num", this.modelBedsNum);
            formData.append("size", this.modelSize);
            formData.append("address", this.modelAddress);
            formData.append("lat", this.modelLat);
            formData.append("long", this.modelLong);
            formData.append("sponsors", this.modelSponsor);
            formData.append("services", this.modelServices);
            if (this.imageBool) {
                formData.append('imageApartment', this.imageApartment);
            }
            console.log(this.modelServices);

            axios.post("apartments", formData, config)
                .then(res => {
                    const success = res.data.success;
                    console.log(res);
                }).catch((errors) => {
                    console.log(errors);
                });

            e.preventDefault()


        },


    },
    mounted() {
        this.getData()
    }
}
</script>