<style lang="scss" scoped>
@use '../../sass/variables.scss' as *;

.dropdown-content {
    a {
        color: $thirdColor !important;
        border: none !important;
        border-radius: 0px !important;

        &:hover {
            background-color: $principalColor !important;
            color: $secondColor !important;
        }
    }
}
</style>

<template>
    <div>
    <!-- <div class="dropdown ms_dropdown">
            <div class="ms_profile d-flex justify-content-evenly align-items-center gap-2 border-dark border-2"
                @click="myFunction()">
                                                                                            <img :src="'/storage/' + user.avatar"
                                                                                                class="img" />
                                                                                            <div class="fw-bold">{{ user.name }}</div>
                                                                                        </div>
                                                                                        <div id="myDropdown"
                                                                                            class="dropdown-content">
                                                                                            <router-link to='/userApartments'
                                                                                                class="d-block d-md-none">Your Apartments
                                                                                            </router-link>
                                                                                            <router-link :to="{ name: 'createApartment' }">Create
                                                                                                apartment</router-link>
                                                                                            <a href=""
                                                                                                @click.prevent="logout">Logout</a>
                                                                                        </div>
                                                                                    </div> -->
        <!-- class="btn btn-secondary dropdown-toggle" -->
        <div class="dropdown">
            <a class="btn btn-secondary text-black dropdown-toggle ms_profile d-flex justify-content-evenly align-items-center gap-2 border-dark border-2"
                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img :src="'/storage/' + user.avatar" class="img" />
                <div class="fw-bold text-black">{{ user.name }}</div>
            </a>

            <ul class="dropdown-menu">
                <li @click="yourApartment" class="cursor mb-2 px-2 d-block d-md-none">
                    Your Apartments
                </li>
                <li @click="create" class="cursor mb-2 px-2">
                    Create Apartment </li>
                <li @click="logout" class="cursor px-2 ">Logout</li>

            </ul>
        </div>
        <br>

    </div>
</template>
<script>
import axios from "axios"
export default {
    data() {
        return {
            user: ""
        }
    },
    methods: {
        yourApartment() {
            this.$router.push({ name: "userApartments" })
        },

        create() {
            this.$router.push({ name: "createApartment" })
        },
        myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        },
        logout() {
            axios.get('/api/logout').then(() => {
                this.$router.push({ name: "Login" })
                location.reload()

            })
        },
        getuserlogged() {
            axios.get("/api/getUserLogged")
                .then(res => {
                    this.user = res.data.response;
                    console.log(this.user);

                }).catch((errors) => {
                    console.log(errors);
                });
        }
    },
    mounted() {
        this.getuserlogged()
    }
}
</script>
<style scoped lang=scss>
@use '/resources/sass/variables.scss' as *;

.cursor {
    cursor: pointer;
}

.cursor:hover {
    background-color: $principalColor;
}

.ms_profile {
    margin-top: 2px;
    cursor: pointer;
    border: 2px solid black;
    border-radius: 20px;
    background-color: white;
    padding: 2px 10px;
    font-size: 14px;

    &:hover {
        border-color: $principalColor !important;
        color: $secondColor;
        background-color: $principalColor;
    }
}

.img {
    height: 30px;
    border-radius: 100%;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid black;
}

/* Dropdown Button */
.dropbtn {
    background-color: #3498DB;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover,
.dropbtn:focus {
    background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    right: 2px;
    background-color: #f1f1f1;
    width: 150px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #ddd;
}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {
    display: block;
}
</style>