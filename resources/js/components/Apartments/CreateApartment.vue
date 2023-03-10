<template>
    <!-- <h1 @click="log">CIAO</h1>
    <ul>
        <li v-for="service in services">
            {{ service.name }}
        </li>
    </ul> -->
    <h1>Create a New Apartment</h1> <br>
    <form action=""
        enctype="multipart/form-data"
        @submit.prevent="createApartment"
        method="post">
        <label for="title">Title : </label>
        <input type="text"
            name="title"
            v-model="modelTitle"> <br> <br>
        <label for="description">Description : </label>
        <input type="text"
            name="description"
            v-model="modelDescription"> <br> <br>
        <label for="price">Price : </label>
        <input type="number"
            name="price"
            v-model="modelPrice"> <br> <br>
        <label for="beds_num">Beds Number : </label>
        <input type="number"
            name="beds_num"
            v-model="modelBedsNum"> <br> <br>
        <label for="rooms_num">Rooms Number : </label>
        <input type="number"
            name="rooms_num"
            v-model="modelRoomsNum"> <br> <br>
        <label for="baths_num">Baths Number : </label>
        <input type="number"
            name="baths_num"
            v-model="modelBathsNum"> <br> <br>
        <label for="size">Size : </label>
        <input type="number"
            name="size"
            v-model="modelSize"> <br> <br>
        <label for="address">Address : </label>
        <input type="text"
            name="address"
            v-model="modelAddress"> <br> <br>
        <label for="lat">Lat : </label>
        <input type="number"
            name="lat"
            v-model="modelLat"> <br> <br>
        <label for="long">Long : </label>
        <input type="number"
            name="long"
            v-model="modelLong"> <br> <br>
        <label for="long">Apartment Image : </label>
        <input type="file"
            name="long"
            v-on:change="onImageChange"> <br> <br>
        <label for="sponsors">Select a Sponsor : </label>
        <select name="imageApartment"
            v-model="modelSponsor">
            <option v-for="sponsor in sponsors"
                :value="sponsor.id"
                :key="sponsor.id">
                {{ sponsor.name }}
            </option>


        </select> <br> <br>

        <label for="">Tags : </label> <br>

        <div v-for="service in services">
            <input type="checkbox"
                :value="service.id"
                name=services
                v-model="modelServices">
            <label for="services">{{ service.name }}</label>
        </div> <br>

        <input type="submit"
            value="create">
    </form>
</template>

<script>
import axios from 'axios'
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
            axios.get("/api/getData")
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

            axios.post("/api/apartments", formData, config)
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