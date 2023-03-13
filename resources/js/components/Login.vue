<template>
    <!-- <div class="flex flex-wrap w-full justify-center items-center pt-56">
        <div class="flex flex-wrap max-w-xl">
            <div class="p-2 text-2xl text-gray-800 font-semibold">
                <h1>Login to your account</h1>
            </div>
            <h5>{{ error }}</h5>
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
            <div class="p-2 w-full mt-4">
                <button @click.prevent="loginUser"
                    type="submit"
                    class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Login</button>
            </div>
        </div>
    </div> -->

    <div class="container top-mrg">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-danger">
                    <div class="card-header text-center display-6 bg-white border-white my-3">Login to your account</div>

                    <div class="card-body">
                        <form action="">


                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        v-model="form.email"
                                        required
                                        autocomplete="email"
                                        autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">Password</label>

                                <div class="col-md-6">
                                    <input id="password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        required
                                        v-model="form.password"
                                        autocomplete="current-password">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 my-4 text-center">
                                    <button type="submit"
                                        class="btn btn-outline-danger btn-lg"
                                        @click.prevent="loginUser">
                                        Login
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
            error: "",
            form: {
                email: '',
                password: ''
            },

        }
    },
    methods: {
        loginUser() {
            axios.post('/api/login', this.form).then(() => {
                this.$router.push({ name: "userApartments" });

            }).catch((errors) => {
                console.log(errors);
                this.error = 'invalid email or password! Try again';
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