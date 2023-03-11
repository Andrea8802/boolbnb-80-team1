<template>
    <!-- <div class="flex flex-wrap w-full justify-center items-center pt-56">
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
    </div> -->
    <div class="container top-mrg">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8 col-sm-8">
                <div class="card border-danger">
                    <div class="card-header text-center display-6 bg-white border-white my-3">Register</div>

                    <div class="card-body text-center">
                        <form action=""
                            @submit.prevent="saveForm"
                            enctype="multipart/form-data">

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end text-sm-center">Email <span
                                        class="text-danger lead">&#42;</span> </label>

                                <div class="col-md-6">
                                    <input id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        v-model="modelEmail"
                                        required
                                        autocomplete="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">Password <span
                                        class="text-danger lead">&#42;</span></label>

                                <div class="col-md-6">
                                    <input id="password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        v-model="modelPassword"
                                        required
                                        autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">Confirm Password <span
                                        class="text-danger lead">&#42;</span></label>

                                <div class="col-md-6">
                                    <input id="password-confirm"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password_confirmation"
                                        v-model="modelPasswordConf"
                                        required
                                        autocomplete="new-password">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">Name <span
                                        class="text-danger lead">&#42;</span></label>

                                <div class="col-md-6">
                                    <input id="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        v-model="modelName"
                                        required
                                        autocomplete="name"
                                        autofocus>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="surname"
                                    class="col-md-4 col-form-label text-md-end">Surname</label>

                                <div class="col-md-6">
                                    <input id="surname"
                                        type="text"
                                        class="form-control @error('surname') is-invalid @enderror"
                                        name="surname"
                                        v-model="modelSurname"
                                        autocomplete="surname"
                                        autofocus>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="date_of_birth"
                                    class="col-md-4 col-form-label text-md-end">Date of birth <span
                                        class="text-danger lead">&#42;</span></label>

                                <div class="col-md-6">
                                    <input id="date_of_birth"
                                        type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth"
                                        v-model="modelDate"
                                        required
                                        autocomplete="date_of_birth"
                                        autofocus>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">Description</label>

                                <div class="col-md-6">
                                    <input id="description"
                                        type="text"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description"
                                        v-model="modelDescription"
                                        autocomplete="description"
                                        autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="avatar"
                                    class="col-md-4 col-form-label text-md-end">Avatar image</label>

                                <div class="col-md-6">
                                    <input id="avatar"
                                        type="file"
                                        class="form-control @error('avatar') is-invalid @enderror"
                                        name="avatar"
                                        v-on:change="onImageChange"
                                        autocomplete="avatar"
                                        autofocus>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-md-12 my-4">
                                    <button type="submit"
                                        class="btn btn-outline-danger btn-lg">
                                        Register
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
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
<style scoped>
.top-mrg {
    padding-top: 80px;
}
</style>