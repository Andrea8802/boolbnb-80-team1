<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;


.ms_alert {
    height: 100vh;
    width: 100vw;
    background-color: tomato;
}

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
    width: 90%;
    max-width: 600px;
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
    padding: 7px 25px;
    border-color: $principalColor;
    border-radius: 30px;
}

.ms_label_smartphone {
    color: $principalColor;
    font-size: 16px;
    font-weight: 600;
}

.red {
    color: red;
}

// responsive
@media screen and (max-width: 600px) {
    .ms_ctn_service {
        .ms_ctn_check {
            height: fit-content;
            text-align: center;
            gap: 5px;
        }
    }
}
</style>

<template>
    <div v-if="!this.permission" class="container">

        <div class="alert alert-danger d-flex-col align-items-center ms_alert" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div class="col-6 mx-auto">
                <h1 class="text-center">VOLEVIIIII!!!</h1>
                <h2 class="text-center my-6">Non hai i permessi per accedere a questa pagina</h2>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-lg btn-danger my-6"> <router-link :to="{ name: 'userApartments' }"> Torna ai tuoi
                        appartamenti</router-link></button>
            </div>
        </div>



    </div>
    <!-- container principale della pagina -->
    <div v-else class="container text-center">
        <h1 class="ms_title_page mb-5 pt-3">Edit Your Space</h1>

        <!-- container del form per modificare un appartamento -->
        <div class="mb-3">
            <form action="" enctype="multipart/form-data" method="post" @submit.prevent="getCoordinates">
                <p v-if="errors.length">
                    <b class="red">Please correct the following error(s):</b>

                <div class="red" v-for="error in errors">{{ error }}</div>

                </p>

                <!-- input del titolo -->
                <label for="title" class="ms_label_smartphone d-block d-md-none">Title:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="title">Title :
                    </label>
                    <input type="text" name="title" v-model="getApartment.title" class="form-control ms_input_focus_color"
                        placeholder="Enter a title..." aria-describedby="basic-addon1">
                </div>

                <!-- input descrizione -->
                <label for="description" class="ms_label_smartphone d-block d-md-none">Description:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1"
                        for="description">Description : </label>
                    <input type="text" name="description" v-model="getApartment.description"
                        class="form-control ms_input_focus_color" placeholder="Enter a description..."
                        aria-describedby="basic-addon1">
                </div>

                <!-- input prezzo -->
                <label for="price" class="ms_label_smartphone d-block d-md-none">Price:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="price">Price :
                    </label>
                    <input type="number" name="price" v-model="getApartment.price" class="form-control ms_input_focus_color"
                        placeholder="Enter a price..." aria-describedby="basic-addon1">
                </div>

                <!-- input numero di letti -->
                <label for="beds_num" class="ms_label_smartphone d-block d-md-none">Beds Number:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="beds_num">Beds
                        Number : </label>
                    <input type="number" name="beds_num" v-model="getApartment.beds_num"
                        class="form-control ms_input_focus_color" placeholder="Enter a beds number..."
                        aria-describedby="basic-addon1">
                </div>

                <!-- input numero di stanze -->
                <label for="rooms_num" class="ms_label_smartphone d-block d-md-none">Rooms Number:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="rooms_num">Rooms
                        Number : </label>
                    <input type="number" name="rooms_num" v-model="getApartment.rooms_num"
                        class="form-control ms_input_focus_color" placeholder="Enter a rooms number..."
                        aria-describedby="basic-addon1">
                </div>

                <!-- input numero di bagni -->
                <label for="baths_rum" class="ms_label_smartphone d-block d-md-none">Baths Number:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="baths_num">Baths
                        Number : </label>
                    <input type="number" name="baths_num" v-model="getApartment.baths_num"
                        class="form-control ms_input_focus_color" placeholder="Enter a baths number..."
                        aria-describedby="basic-addon1">
                </div>

                <!-- input grandezza appartamento -->
                <label for="size" class="ms_label_smartphone d-block d-md-none">Size:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="size">Size :
                    </label>
                    <input type="number" name="size" v-model="getApartment.size" class="form-control ms_input_focus_color"
                        placeholder="Enter a size..." aria-describedby="basic-addon1">
                </div>

                <!-- input per inserire l'indirizzo dell'appartamento -->
                <label for="address" class="ms_label_smartphone d-block d-md-none">Address:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="address">Address :
                    </label>
                    <input type="text" name="address" v-model="getApartment.address"
                        class="form-control ms_input_focus_color" placeholder="Enter a address..."
                        aria-describedby="basic-addon1">
                </div>

                <!-- input per inserire l'immagine di copertina dell'appartamento -->
                <label for="imageApartment" class="ms_label_smartphone d-block d-md-none">Apartment Image:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1"
                        for="imageApartment">Apartment
                        Image : </label>
                    <input type="file" name="imageApartment" v-on:change="onImageChange"
                        class="form-control ms_input_focus_color" aria-describedby="basic-addon1">
                </div>

                <!-- added images form -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1"
                        for="addedImage">Overwrite other images : </label>
                    <input type="file" ref="file" multiple="multiple" name="images[]" v-on:change="onAddedImagesChange"
                        class="form-control ms_input_focus_color" aria-describedby="basic-addon1">

                </div>
                <!-- <input type="submit" value="Add More Images" formaction="/createAddedImages/" class="ms_input_submit"> -->


                <div class="services-cont ms_ctn_service p-3 my-3"
                    v-if="getApartment.services != undefined && getApartment.services.length > 0">
                    <h4>Select services:</h4>

                    <div class="ms_ctn_check">
                        <div v-for="service in services">
                            <input type="checkbox" :value="service.id" name=services class="input"
                                :checked="apServices(service)" :id="service.id">
                            <label :for="service.id">{{ service.name }}</label>
                        </div>
                    </div>
                </div>

                <input type="submit" value="update" class="ms_input_submit">
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            permission: true,
            services: [],
            imageApartment: '',
            imageBool: false,
            getApartment: [],
            user: [],
            selectedCheck: [],
            errors: [],


            /* variabili immagini aggiuntive */
            addedImages: [],
            addImgBool: false,



        }
    },
    methods: {

        apServices(service) {
            for (let index = 0; index < this.getApartment.services.length; index++) {
                const element = this.getApartment.services[index];
                if (element.id == service.id) {

                    return true;

                }

            }
            return false;
        },
        checkboxs() {
            let check = document.getElementsByClassName("input");
            for (let index = 0; index < check.length; index++) {
                const element = check[index];
                for (let index = 0; index < this.getApartment.services.length; index++) {
                    const el = this.getApartment.tags[index];
                    if (el.id !== element.value && element.checked) {
                        console.log(this.getApartment.tags);
                        this.selectedCheck.push(element.value);

                    }
                }


            }
            console.log(this.selectedCheck);
            return this.selectedCheck;
        },
        onImageChange(e) {
            this.imageBool = true
            console.log(e)
            this.imageApartment = e.target.files[0];

        },
        getData() {
            axios.get("/api/getData")
                .then(res => {
                    this.services = res.data.response.services;
                    this.sponsors = res.data.response.sponsors;
                    console.log(this.services);
                }).catch((errors) => {
                    console.log(errors);
                });
        },
        updateApartment() {
            this.errors.length = 0;
            const config = {
                headers: {
                    "content-type": "multipart/form-data"
                }
            }
            let formData = new FormData();
            formData.append("title", this.getApartment.title);
            formData.append("description", this.getApartment.description);
            formData.append("price", this.getApartment.price);
            formData.append("rooms_num", this.getApartment.rooms_num);
            formData.append("baths_num", this.getApartment.baths_num);
            formData.append("beds_num", this.getApartment.beds_num);
            formData.append("size", this.getApartment.size);
            formData.append("address", this.getApartment.address);
            formData.append("lat", this.getApartment.lat);
            formData.append("long", this.getApartment.long);
            let check = document.getElementsByClassName("input");
            for (let index = 0; index < check.length; index++) {
                const element = check[index];
                for (let index = 0; index < this.getApartment.services.length; index++) {
                    const el = this.getApartment.services[index];
                    if (el.id !== element.value && element.checked) {
                        this.selectedCheck.push(element.value);

                    }
                }


            }
            this.selectedCheck.forEach(function (value) {
                console.log(value);
                formData.append("services[]", value)
            })
            this.addedImages.forEach((value) => formData.append("added_images[]", value));
            console.log(this.selectedCheck);
            if (this.imageBool) {
                formData.append('imageApartment', this.imageApartment);
            }

            axios.post("/api/updateApartment/" + this.$route.params.id, formData, config)
                .then(res => {
                    const success = res.data.success;
                    console.log(res);
                    this.$router.push({ name: 'userApartments' })
                }).catch((errors) => {
                    if (!this.getApartment.title) {
                        this.errors.push("Title required")
                    }
                    if (this.getApartment.title.length < 10) {
                        this.errors.push("The title must be at least 10 characters")
                    }
                    if (!this.getApartment.description) {
                        this.errors.push("Description required")
                    }
                    if (this.getApartment.description.length < 20) {
                        this.errors.push("The description must be at least 20 characters")
                    }
                    if (!this.getApartment.price) {
                        this.errors.push("Price required")
                    }
                    if (!this.getApartment.rooms_num) {
                        this.errors.push("Rooms number required")
                    }
                    if (!this.getApartment.beds_num) {
                        this.errors.push("Beds number required")
                    }
                    if (!this.getApartment.baths_num) {
                        this.errors.push("Baths number required")
                    }
                    if (!this.getApartment.size) {
                        this.errors.push("Size required")
                    }
                    if (!this.getApartment.address) {
                        this.errors.push("Address required")
                    }
                    if (!this.getApartment.imageApartment) {
                        this.errors.push("Apartment image required")
                    }
                    if (this.addedImages.length === 0) {
                        this.errors.push("You need to insert at least one image")
                    }
                    if (this.selectedCheck.length === 0) {
                        this.errors.push("Insert at least 1 service")
                    }
                    console.log(errors);
                });



        },
        getEditApartment() {

            axios.get("/api/apartment-edit/" + this.$route.params.id)
                .then(res => {
                    this.getApartment = res.data.response[0];
                    this.user = res.data.response[1]
                    console.log(this.getApartment);
                    console.log(this.user)
                    /* if (this.getApartment.user_id !== this.user.id) {
                        console.log(this.permission, this.getApartment.user_id, this.user.id);
                        this.permission = false;
                        return this.permission;
                    } else {
                        console.log(this.permission, this.getApartment.user_id, this.user.id);
                        this.permission = true;
                        return (this.permission, this.getApartment, this.user)
                    } */


                }).catch((errors) => {
                    console.log(errors);
                    if (errors.response.status = 403) {
                        this.$router.push({ name: "Login" });
                    }
                });


        },
        getCoordinates(e) {

            e.preventDefault();
            var theUrl = `https://api.tomtom.com/search/2/geocode/${this.
                getApartment.address}.json?key=7WvQPGS4KEheGe1NqjeIiLoLFdGWHmbO`;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", theUrl, false);
            xmlHttp.send(null);
            var json = JSON.parse(xmlHttp.responseText);
            console.log("json", json);
            this.getApartment.lat = parseFloat(json.results[0].position.lat);
            this.getApartment.long = parseFloat(json.results[0].position.lon);

            this.updateApartment();

        },
        onAddedImagesChange(e) {
            this.addImgBool = true;
            console.log(e);
            let selectedImages = e.target.files;
            if (!selectedImages.length) {
                return false;
            }

            for (let i = 0; i < selectedImages.length; i++) {
                this.addedImages.push(e.target.files[i]);
            }


            console.log(this.addedImages);
        },

    },
    mounted() {
        this.getData()
        this.getEditApartment()

    }
}
</script>