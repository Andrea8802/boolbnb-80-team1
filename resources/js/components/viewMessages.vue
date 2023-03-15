<template>
    <div v-if="this.messages.length == 0">
        You have no messages to read
    </div>
    <ul>
        <li v-for="message in messages">
            Name : {{ message.name }} <br>
            Surname : {{ message.surname }} <br>
            Email : {{ message.email }} <br>
            Message text : {{ message.text }} <br>
        </li>
    </ul>
</template>
<script>
import axios from "axios"
export default {
    data() {
        return {
            messages: [],
        }
    },
    methods: {
        getMessages() {
            let formData = new FormData();
            formData.append("apartmentId", this.$route.params.id);

            axios.post("/api/getMessages", formData)
                .then(res => {
                    this.messages = res.data.response
                    console.log(this.messages);

                }).catch((errors) => {

                    console.log(errors);
                });
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
    },

    mounted() {
        this.geteditApartment()
        this.getMessages()
    }
}
</script>