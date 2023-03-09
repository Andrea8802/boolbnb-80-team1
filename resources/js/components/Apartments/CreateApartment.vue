<template>
    <!-- <h1 @click="log">CIAO</h1>
    <ul>
        <li v-for="service in services">
            {{ service.name }}
        </li>
    </ul> -->
    <h1>Create a New Apartment</h1> <br>
    <form action="">
        <label for="title">Title : </label>
        <input type="text" name="title" v-model="modelTitle"> <br> <br>
        <label for="description">Description : </label>
        <input type="text" name="description" v-model="modelDescription"> <br> <br>
        <label for="price">Price : </label>
        <input type="number" name="price" v-model="modelPrice"> <br> <br>
        <label for="beds_num">Beds Number : </label>
        <input type="number" name="beds_num" v-model="modelBedsNum"> <br> <br>
        <label for="rooms_num">Rooms Number : </label>
        <input type="number" name="rooms_num" v-model="modelRoomsNum"> <br> <br>
        <label for="baths_num">Baths Number : </label>
        <input type="number" name="baths_num" v-model="modelBathsNum"> <br> <br>
        <label for="size">Size : </label>
        <input type="number" name="size" v-model="modelSize"> <br> <br>
        <label for="address">Address : </label>
        <input type="text" name="address" v-model="modelAddress"> <br> <br>
        <label for="lat">Lat : </label>
        <input type="number" name="lat" v-model="modelLat"> <br> <br>
        <label for="long">Long : </label>
        <input type="number" name="long" v-model="modelLong"> <br> <br>

        <input type="submit" @click="createApartment" value="create">
    </form>
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
            services: []

        }
    },
    methods: {
        log() {
            console.log("prova");
        },
        createApartment(e) {
            const apartment = {
                "title": this.modelTitle,
                "description": this.modelDescription,
                "price": this.modelPrice,
                "rooms_num": this.modelRoomsNum,
                "baths_num": this.modelBathsNum,
                "beds_num": this.modelBedsNum,
                "size": this.modelSize,
                "address": this.modelAddress,
                "lat": this.modelLat,
                "long": this.modelLong,
            };
            console.log("create/apartment", apartment);
            axios.post("apartments", apartment)
                .then(res => {
                    const success = res.data.success;
                    console.log(res);
                }).catch((errors) => {
                    console.log(errors);
                });

            e.preventDefault()


        },
        // getData() {
        //     axios.get("apartments")
        //         .then(res => {
        //             this.services = res.data.response;
        //             console.log(this.services);
        //         }).catch((errors) => {
        //             console.log(errors);
        //         });
        // }

    },
    // mounted() {
    //     this.getData()
    // }
}
</script>