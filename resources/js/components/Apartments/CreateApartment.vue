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
            margin-left: 3px;
        }

        input[type="checkbox"] {
            accent-color: $principalColor;
        }
    }
}

.ms_ctn_radio {
    width: 90%;
    max-width: 600px;
    margin: 25px auto;
    height: fit-content;
    text-align: start;

    label {
        color: $principalColor;
        font-weight: 600;
        margin-left: 3px;
    }

    input[type="radio"] {
        accent-color: $principalColor;
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
    <!-- container principale della pagina -->
    <div class="container text-center">
        <h1 class="ms_title_page mb-5 pt-3">Create Your Space</h1>

        <!-- container del form per creare un appartemento -->
        <div class="mb-3">
            <form action="" enctype="multipart/form-data" @submit.prevent="createApartment()" method="post" novalidate>
                <p v-if="errors.length">
                    <b class="red">Please correct the following error(s):</b>

                <div class="red" v-for="error in errors">{{ error }}</div>

                </p>

                <!-- input titolo -->
                <label for="title" class="ms_label_smartphone d-block d-md-none">Title:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="title">Title :
                    </label>
                    <input type="text" name="title" v-model="modelTitle" class="form-control ms_input_focus_color"
                        placeholder="Enter a title..." aria-describedby="basic-addon1">
                </div>

                <!-- input descrizione -->
                <label for="description" class="ms_label_smartphone d-block d-md-none">Description:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1"
                        for="description">Description : </label>
                    <input type="text" name="description" v-model="modelDescription"
                        class="form-control ms_input_focus_color" placeholder="Enter a description..."
                        aria-describedby="basic-addon1">
                </div>

                <!-- input prezzo -->
                <label for="price" class="ms_label_smartphone d-block d-md-none">Price:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="price">Price :
                    </label>
                    <input type="number" name="price" v-model="modelPrice" class="form-control ms_input_focus_color"
                        placeholder="Enter a price..." aria-describedby="basic-addon1" step="0.01">
                </div>

                <!-- input numero di letti -->
                <label for="beds_num" class="ms_label_smartphone d-block d-md-none">Beds Number:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="beds_num">Beds
                        Number : </label>
                    <input type="number" name="beds_num" v-model="modelBedsNum" class="form-control ms_input_focus_color"
                        placeholder="Enter a beds number..." aria-describedby="basic-addon1">
                </div>

                <!-- input numero di stanze -->
                <label for="rooms_num" class="ms_label_smartphone d-block d-md-none">Rooms Number:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="rooms_num">Rooms
                        Number : </label>
                    <input type="number" name="rooms_num" v-model="modelRoomsNum" class="form-control ms_input_focus_color"
                        placeholder="Enter a rooms number..." aria-describedby="basic-addon1">
                </div>

                <!-- input numero di bagni  -->
                <label for="baths_rum" class="ms_label_smartphone d-block d-md-none">Baths Number:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="baths_num">Baths
                        Number : </label>
                    <input type="number" name="baths_num" v-model="modelBathsNum" class="form-control ms_input_focus_color"
                        placeholder="Enter a baths number..." aria-describedby="basic-addon1">
                </div>

                <!-- input grandezza appartamento -->
                <label for="size" class="ms_label_smartphone d-block d-md-none">Size:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="size">Size :
                    </label>
                    <input type="number" name="size" v-model="modelSize" class="form-control ms_input_focus_color"
                        placeholder="Enter a size..." aria-describedby="basic-addon1">
                </div>

                <!-- input per inserire l'indirizzo dell'appartamento -->
                <label for="address" class="ms_label_smartphone d-block d-md-none">Address:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="address">Address :
                    </label>
                    <input type="text" name="address" v-model="modelAddressSearch" class="form-control ms_input_focus_color"
                        placeholder="Enter a address..." aria-describedby="basic-addon1" @input="getCoordinates">
                    <!-- <input type="submit" value="Search" class="ms_input_submit" @click.prevent="getCoordinates"> -->


                </div>
                <div class="ms_ctn_radio" v-if="view">
                    <div v-for="apartment in arrayApartments"> <input type="radio" name="address" id=""
                            :value=apartment.address.freeformAddress v-model="modelAddress" @click="address(apartment)">
                        <label for="">{{
                            apartment.address.freeformAddress
                        }}</label>
                    </div>

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
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="addedImage">Other
                        images : </label>
                    <input type="file" ref="file" multiple="multiple" name="addedImage[]" v-on:change="onAddedImagesChange"
                        class="form-control ms_input_focus_color" aria-describedby="basic-addon1">

                </div>

                <div class="ms_ctn_service p-3 my-3">
                    <h4>Select services:</h4>
                    <div class="ms_ctn_check">
                        <div v-for="service in services">
                            <input type="checkbox" :value="service.id" name=services :id="service.id"
                                v-model="modelServices">
                            <label :for="service.id">{{ service.name }}</label>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Create" class="ms_input_submit">
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            modelAddressSearch: "",
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
            services: [],
            imageApartment: '',
            imageBool: false,
            errors: [],
            arrayApartments: [],
            view: false,
            arrayAp: ['jpg', 'png', 'jpeg', 'gif', 'svg'],
            waitTime: true,

            /* variabili added images */
            addedImages: [],
            addImgBool: false,


        }
    },
    methods: {
        address(addressObj) {
            this.modelAddressSearch = addressObj.address.freeformAddress
            this.modelLat = parseFloat(addressObj.position.lat)
            console.log(this.modelLat);
            this.modelLong = parseFloat(addressObj.position.lon)
            console.log(this.modelAddress);
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
                    console.log(this.services,);
                }).catch((errors) => {
                    console.log(errors);
                });
        },
        createApartment() {

            this.getCoordinates()
            this.errors.length = 0;
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
            this.modelServices.forEach((value) => formData.append("services[]", value));
            this.addedImages.forEach((value) => formData.append("added_images[]", value));
            console.log(this.modelServices);
            console.log(this.addedImages);

            if (this.imageBool) {
                formData.append('imageApartment', this.imageApartment);
            }
            console.log(this.modelServices);

            axios.post("/api/apartments", formData, config)
                .then(res => {
                    const success = res.data.success;
                    console.log(res.data.apartment);
                    console.log(formData);
                    console.log(res.data.added_images);
                    this.$router.push({ name: "userApartments" })
                }).catch((errors) => {
                    if (!this.modelTitle) {
                        this.errors.push("Title required")
                    }
                    if (this.modelTitle.length < 10) {
                        this.errors.push("The title must be at least 10 characters")
                    }
                    if (!this.modelDescription) {
                        this.errors.push("Description required")
                    }
                    if (this.modelDescription.length < 20) {
                        this.errors.push("The description must be at least 20 characters")
                    }
                    if (!this.modelPrice) {
                        this.errors.push("Price required")
                    }
                    if (!this.modelRoomsNum) {
                        this.errors.push("Rooms number required")
                    }
                    if (!this.modelBedsNum) {
                        this.errors.push("Beds number required")
                    }
                    if (!this.modelBathsNum) {
                        this.errors.push("Baths number required")
                    }
                    if (!this.modelSize) {
                        this.errors.push("Size required")
                    }
                    if (!this.modelAddress) {
                        this.errors.push("Address required")
                    }
                    if (!this.imageApartment) {
                        this.errors.push("Apartment image required")
                    }
                    // if (!this.getApartment.imageApartment) {
                    //     this.errors.push("Apartment image required")
                    // } else if (!['jpg', 'png', 'jpeg', 'gif', 'svg'].some(ext => this.getApartment.imageApartment.toLowerCase().endsWith(ext))) {
                    //     this.errors.push("Apartment image must be jpg, png, jpeg, gif, or svg")
                    // }
                    // if (!['jpg', 'png', 'jpeg', 'gif', 'svg'].some(ext => this.imageApartment.toLowerCase().endsWith(ext))) {
                    //     this.errors.push("Apartment image must be jpg, png, jpeg, gif, or svg")
                    // }
                    if (this.addedImages.length === 0) {
                        this.errors.push("You need to insert at least one image")
                    }

                    if (this.modelServices.length === 0) {
                        this.errors.push("Insert at least 1 service")
                    }

                    console.log(errors);
                });
        },
        getCoordinates() {

            if (!this.waitTime) return;
            this.waitTime = false;

            setTimeout(() => this.waitTime = true, 500)

            // if (this.modelAddress.length > 14) {
            var theUrl = `https://api.tomtom.com/search/2/geocode/${this.modelAddressSearch}.json?key=7WvQPGS4KEheGe1NqjeIiLoLFdGWHmbO&limit=5`;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("GET", theUrl, false);
            xmlHttp.send(null);
            var json = JSON.parse(xmlHttp.responseText);

            // this.modelLat = parseFloat(json.results);
            // this.modelLong = parseFloat(json.results);
            this.arrayApartments = json.results
            this.view = true;

            console.log(this.arrayApartments);
            // }

            // this.createApartment();
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
        }


    },

    mounted() {
        this.getData()

    }
}

</script>