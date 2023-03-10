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

.ms_ctn_input,
.ms_ctn_service {
    width: 600px;
    margin: 0 auto;
}

.ms_input_focus_color:focus {
    color: $principalColor;
    border-color: $principalColor;
    box-shadow: 0 0 10px $principalColor;
}

.ms_ctn_service {
    border: solid 2px $principalColor;
    border-radius: 30px;

    h4 {
        color: $principalColor;
        font-size: 20px;
        font-weight: 600;
    }

    .ms_ctn_check {
        height: 200px;
        text-align: start;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;

        label {
            color: $principalColor;
            font-weight: 600;
            margin-left: 10px;
        }

        input[type="checkbox"] {
            accent-color: $principalColor;
        }
    }
}

.ms_input_submit {
    background-color: $principalColor;
    color: #ffffff;
    font-size: 16px;
    font-weight: 600;
    padding: 10px 40px;
    border-color: $principalColor;
    border-radius: 30px;
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
                        placeholder="Inserisci un titolo..." aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="description">Descrizione : </label>
                    <input type="text" name="description" v-model="modelDescription"
                        class="form-control ms_input_focus_color" placeholder="Inserisci una descrizione..."
                        aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="price">Prezzo : </label>
                    <input type="number" name="price" v-model="modelPrice" class="form-control ms_input_focus_color"
                        placeholder="Inserisci un prezzo..." aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="beds_num">Numero di letti : </label>
                    <input type="number" name="beds_num" v-model="modelBedsNum" class="form-control ms_input_focus_color"
                        placeholder="Inserisci il numero dei letti..." aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="rooms_num">Numero di Stanze :
                    </label>
                    <input type="number" name="rooms_num" v-model="modelRoomsNum" class="form-control ms_input_focus_color"
                        placeholder="Inserisci il numero dei letti..." aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="baths_num">Numero di bagni : </label>
                    <input type="number" name="baths_num" v-model="modelBathsNum" class="form-control ms_input_focus_color"
                        placeholder="Inserisci il numero dei bagni..." aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="size">Grandezza(mq) : </label>
                    <input type="number" name="size" v-model="modelSize" class="form-control ms_input_focus_color"
                        placeholder="Inserisci il numero dei letti..." aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="address">Indirizzo : </label>
                    <input type="text" name="address" v-model="modelAddress" class="form-control ms_input_focus_color"
                        placeholder="Inserisci l'indirizzo..." aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="lat">Latitudine : </label>
                    <input type="number" name="lat" v-model="modelLat" class="form-control ms_input_focus_color"
                        placeholder="Inserisci la latitudine..." aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="long">Longitudine : </label>
                    <input type="number" name="long" v-model="modelLong" class="form-control ms_input_focus_color"
                        placeholder="Inserisci la longitudine..." aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="imageApartment">
                        Immagine di Copertina :
                    </label>
                    <input type="file" name="imageApartment" v-on:change="onImageChange"
                        class="form-control ms_input_focus_color" aria-describedby="basic-addon1">
                </div>

                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="sponsors">
                        Seleziona il tipo di Sponsor :
                    </label>
                    <select name="sponsors" v-model="modelSponsor" class="form-select form-select-sm ms_input_focus_color"
                        aria-label=".form-select-sm example">
                        <option v-for="sponsor in sponsors" :value="sponsor.id" :key="sponsor.id">
                            {{ sponsor.name }}
                        </option>
                    </select>
                </div>

                <div class="ms_ctn_service p-3 my-3">
                    <h4>Seleziona dei servizi:</h4>
                    <div class="ms_ctn_check">
                        <div v-for="service in services">
                            <input type="checkbox" :value="service.id" name=services v-model="modelServices">
                            <label for="services">{{ service.name }}</label>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Crea" class="ms_input_submit">
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
            formData.append("sponsors", this.modelSponsor.id);
            formData.append("services", this.modelServices.id);
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