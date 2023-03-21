<template>
    <div class="container top-mrg">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8 col-sm-8">
                <div class="card border-0 shadow">
                    <div class="card-header text-center display-6 bg-white border-white my-3">Register</div>

                    <div class="card-body text-center">
                        <form action=""
                            @submit.prevent="saveForm"
                            enctype="multipart/form-data"
                            novalidate>
                            <p v-if="errors.length">
                                <b class="red">{{ errors.length > 1
                                    ? 'Please correct the following errors'
                                    : 'Please correct this error' }}</b>

                            <div class="red"
                                v-for="error in errors">-> {{ error }}</div>

                            </p>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end text-sm-center">Email <span
                                        class="text-danger lead">&#42;</span> </label>

                                <div class="col-md-6">
                                    <input id="email"
                                        type="email"
                                        class="form-control "
                                        name="email"
                                        v-model="modelEmail"
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
                                        class="form-control"
                                        name="password"
                                        v-model="modelPassword"
                                        autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">Confirm Password
                                    <span class="text-danger lead">&#42;</span></label>

                                <div class="col-md-6">
                                    <input id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        v-model="modelPasswordConf"
                                        autocomplete="new-password">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">Name </label>

                                <div class="col-md-6">
                                    <input id="name"
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        v-model="modelName"
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
                                        class="form-control"
                                        name="surname"
                                        v-model="modelSurname"
                                        autocomplete="surname"
                                        autofocus>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="date_of_birth"
                                    class="col-md-4 col-form-label text-md-end">Date of birth</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth"
                                        type="date"
                                        class="form-control"
                                        name="date_of_birth"
                                        v-model="modelDate"
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
                                        class="form-control"
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
                                        class="form-control"
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
            errors: [],
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
            this.avatar = e.target.files[0];

        },
        saveForm() {
            this.errors.length = 0
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

                if (this.modelPassword.length < 8) {
                    this.errors.push("The password must be at least 8 characters")
                }
                if (this.modelPassword !== this.modelPasswordConf) {
                    this.errors.push("The confirmed password does not match with the password")
                }
                if (!this.modelEmail) {
                    this.errors.push("Email required")
                }
                if (errors.response.data.errors.email && this.modelEmail !== '') {
                    this.errors.push("The email has already been taken")
                }
                if (!this.modelPassword) {
                    this.errors.push("Password required")
                }
                if (!this.modelPasswordConf) {
                    this.errors.push("Password confirmed required")
                }
            });
        }
    }
}
</script>
<style scoped>
.top-mrg {
    padding-top: 50px;
}

.req {
    color: red;
}

.red {
    color: red;
}
</style>