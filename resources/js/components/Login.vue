<template>
    <div class="container top-mrg">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-danger">
                    <div class="card-header text-center display-6 bg-white border-white my-3">Login to your account</div>

                    <div class="card-body">
                        <form action=""
                            novalidation
                            @submit.prevent="loginUser">
                            <p class="center">
                            <div class="red">{{ error }}</div>

                            </p>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email"
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        v-model="form.email"
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
                                        class="form-control"
                                        name="password"
                                        v-model="form.password"
                                        autocomplete="current-password">

                                </div>
                            </div>

                            <div class="log-cont">
                                <!-- <div class="col-md-12 my-4"> -->
                                <button type="submit"
                                    class="btn btn-outline-danger btn-lg">
                                    Login
                                </button>
                                <!-- </div> -->
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
            let formData = new FormData();
            formData.append("password", this.form.password);
            formData.append("email", this.form.email);
            axios.post('/api/login', formData).then(() => {
                this.$router.push({ name: "userApartments" });


            }).catch((errors) => {
                console.log(errors);
                this.error = 'Invalid Email or Password! Try Again';
            });
        }
    }
}
</script>
<style lang="scss" scoped>
.top-mrg {
    padding-top: 50px;
}

.log-cont {
    width: 100%;
    // height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    // background-color: blue;
    margin: 50px 0px;
}

.center {
    width: 100%;
    // height: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    // background-color: blue;

    .red {
        color: red;
    }
}
</style>