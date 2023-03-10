<template>
    <div class="flex flex-wrap w-full justify-center items-center pt-56">
        <div class="flex flex-wrap max-w-xl">
            <div class="p-2 text-2xl text-gray-800 font-semibold">
                <h1>Register an account</h1>
            </div>
            <div class="p-2 w-full">
                <label class="w-full"
                    for="name">Name</label>

                <input
                    class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                    placeholder="Name"
                    type="text"
                    v-model="form.name">
            </div>
            <div class="p-2 w-full">
                <label class="w-full"
                    for="surname">Surname</label>

                <input
                    class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                    placeholder="Name"
                    type="text"
                    v-model="form.surname">
            </div>
            <div class="p-2 w-full">
                <label class="w-full"
                    for="date">date of birth</label>

                <input
                    class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                    placeholder="Date"
                    type="date"
                    v-model="form.date_of_birth">
            </div>
            <div class="p-2 w-full">
                <label class="w-full"
                    for="description">Description</label>

                <input
                    class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                    placeholder="Description"
                    type="text"
                    v-model="form.description">
            </div>

            <div class="p-2 w-full">
                <label for="email">Your e-mail</label>
                <input
                    class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                    placeholder="Email"
                    type="email"
                    v-model="form.email">
            </div>
            <div class="p-2 w-full">
                <label for="password">Password</label>
                <input
                    class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                    placeholder="Password"
                    type="password"
                    v-model="form.password"
                    name="password">
            </div>
            <div class="p-2 w-full">
                <label for="confirm_password">Confirm Password</label>
                <input
                    class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2"
                    placeholder="Confirm Password"
                    type="password"
                    v-model="form.password_confirmation"
                    name="password_confirmation">
            </div>
            <div class="p-2 w-full mt-4">
                <button @click.prevent="saveForm"
                    type="submit"
                    class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Register</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {

    data() {
        return {
            form: {
                name: '',
                email: '',
                surname: '',
                password: '',
                description: '',
                date_of_birth: '',
                password_confirmation: ''
            },
            errors: []
        }
    },
    methods: {
        saveForm() {
            axios.post('/api/register', this.form).then(() => {
                console.log('saved');
            }).catch((errors) => {
                console.log(errors);
            });
        }
    }
}
</script>