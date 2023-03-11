<template>
    <div class="flex flex-wrap w-full justify-center items-center pt-56">
        <div class="flex flex-wrap max-w-xl">
            <div class="p-2 text-2xl text-gray-800 font-semibold">
                <h1>Register an account</h1>
            </div>
            <form action=""
                @submit.prevent="saveForm">
                <div class="p-2 w-full">
                    <label class="w-full"
                        for="name">Name</label>

                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                        placeholder="Name"
                        type="text"
                        v-model="modelName">
                </div>
                <div class="p-2 w-full">
                    <label class="w-full"
                        for="surname">Surname</label>

                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                        placeholder="Name"
                        type="text"
                        v-model="modelSurname">
                </div>
                <div class="p-2 w-full">
                    <label class="w-full"
                        for="date">date of birth</label>

                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                        placeholder="Date"
                        type="date"
                        v-model="modelDate">
                </div>
                <div class="p-2 w-full">
                    <label class="w-full"
                        for="description">Description</label>

                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                        placeholder="Description"
                        type="text"
                        v-model="modelDescription">
                </div>
                <div class="p-2 w-full">
                    <label class="w-full"
                        for="description">Avatar</label>

                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                        placeholder="Description"
                        type="file"
                        v-on:change="onImageChange">
                </div>

                <div class="p-2 w-full">
                    <label for="email">Your e-mail</label>
                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                        placeholder="Email"
                        type="email"
                        v-model="modelEmail">
                </div>
                <div class="p-2 w-full">
                    <label for="password">Password</label>
                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                        placeholder="Password"
                        type="password"
                        v-model="modelPassword"
                        name="password">
                </div>
                <div class="p-2 w-full">
                    <label for="confirm_password">Confirm Password</label>
                    <input
                        class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                        placeholder="Confirm Password"
                        type="password"
                        v-model="modelPasswordConf"
                        name="password_confirmation">
                </div>
                <div class="p-2 w-full mt-4">
                    <button type="submit"
                        class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Register</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {

    data() {
        return {
            modelName: '',
            modelSurname: '',
            modelEmail: '',
            modelDescription: '',
            modelPassword: '',
            modelPasswordConf: '',
            avatar: '',
            modelDate: '',
            form: {
                name: '',
                email: '',
                surname: '',
                password: '',
                description: '',
                date_of_birth: '',
                password_confirmation: '',
                imageBool: false,
            },
            errors: []
        }
    },
    methods: {
        onImageChange(e) {
            this.imageBool = true
            console.log(e)
            this.avatar = e.target.files[0];

        },
        saveForm() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data"
                }
            }
            let formData = new FormData();
            formData.append("name", this.modelName);
            formData.append("email", this.modelEmail);
            formData.append("surname", this.modelSurname);
            formData.append("password", this.modelPassword);
            formData.append("description", this.modelDescription);
            formData.append("date_of_birth", this.modelDate);
            formData.append("password_confirmation", this.modelPasswordConf);
            if (this.imageBool) {
                formData.append('avatar', this.avatar);
            }
            axios.post('/api/register', formData, config).then(() => {

                this.$router.push({ name: "Home" });

            }).catch((errors) => {
                console.log(errors);
            });
        }
    }
}
</script>