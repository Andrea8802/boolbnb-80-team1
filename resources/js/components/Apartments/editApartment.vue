<template>
    <h1>EDIT </h1> <br>
    <form action=""
        enctype="multipart/form-data"
        method="post"
        @submit.prevent="updateApartment">
        <label for="title">Title : </label>
        <input type="text"
            name="title"
            v-model="getApartment.title"> <br> <br>
        <label for="description">Description : </label>
        <input type="text"
            name="description"
            v-model="getApartment.description"> <br> <br>
        <label for="price">Price : </label>
        <input type="number"
            name="price"
            v-model="getApartment.price"> <br> <br>
        <label for="beds_num">Beds Number : </label>
        <input type="number"
            name="beds_num"
            v-model="getApartment.beds_num"> <br> <br>
        <label for="rooms_num">Rooms Number : </label>
        <input type="number"
            name="rooms_num"
            v-model="getApartment.rooms_num"> <br> <br>
        <label for="baths_num">Baths Number : </label>
        <input type="number"
            name="baths_num"
            v-model="getApartment.baths_num"> <br> <br>
        <label for="size">Size : </label>
        <input type="number"
            name="size"
            v-model="getApartment.size"> <br> <br>
        <label for="address">Address : </label>
        <input type="text"
            name="address"
            v-model="getApartment.address"> <br> <br>

        <label for="long">Apartment Image : </label>
        <input type="file"
            name="long"
            v-on:change="onImageChange"> <br> <br>

        <div class="services-cont"
            v-if="getApartment.services != undefined && getApartment.services.length > 0">
            <label for="">Services : </label> <br>

            <div v-for="service in services">
                <input type="checkbox"
                    :value="service.id"
                    name=services
                    class="input"
                    :checked="apServices(service)">
                <label for="services">{{ service.name }}</label>
            </div> <br>
        </div>

        <input type="submit"
            value="update">
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
            modelServices: [],
            services: [],
            imageApartment: '',
            imageBool: false,
            getApartment: "",
            selectedCheck: [],


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
        updateApartment(e) {
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
            if (this.imageBool) {
                formData.append('imageApartment', this.imageApartment);
            }
            console.log(this.modelServices);

            axios.post("/api/updateApartment/" + this.$route.params.id, formData, config)
                .then(res => {
                    const success = res.data.success;
                    console.log(res);
                    this.$router.push({ name: 'userApartments' })
                }).catch((errors) => {
                    console.log(errors);
                });

            e.preventDefault()


        },
        geteditApartment() {

            axios.get("/api/Apartment/" + this.$route.params.id)
                .then(res => {
                    this.getApartment = res.data.response;
                    console.log(this.getApartment);


                }).catch((errors) => {
                    console.log(errors);
                });
        },
        log() {
            console.log(this.$route.params.id);
        }


    },
    mounted() {
        this.getData()
        this.geteditApartment()
        this.log()

    }
}
</script>