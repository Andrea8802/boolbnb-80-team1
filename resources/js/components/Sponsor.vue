<template>
    <div class="cont">
        <div class="inner-cont">
            <div class="title">
                <h1>Add a Sponsor to your Apartment</h1>
            </div>
            <div class="sponsor">
                <div class="cont-sponsor">
                    <div v-for="sponsor in sponsors">
                        <input type="radio"
                            v-model="modelSponsor"
                            name="profileImg"
                            :value="sponsor.id"
                            :id="sponsor.id">
                        <label :class="`text` + sponsor.id"
                            :for="sponsor.id"
                            :id=sponsor.price>{{ sponsor.name }} {{
                                sponsor.price }}&euro;</label> <br> <br>
                    </div>


                </div>


            </div>

            <div class="cont-btn">

                <button @click="push"
                    class="btn btn-outline-danger btn-lg">Pay</button> <br>

            </div> <br>
            <div class="cont-btn">
                <div class="red">
                    {{ error }}
                </div>
            </div>

        </div>


    </div>
</template>
<script>
import axios from "axios"
export default {
    data() {
        return {
            sponsors: [],
            modelSponsor: "sponsor",
            getApartment: "",
            error: "",
        }
    },
    methods: {
        push() {
            if (this.modelSponsor == "sponsor") {
                this.error = "You need to insert one type of sponsor"

            }
            else {
                this.$router.push({
                    name: 'payment',
                    params: { id: this.getApartment.id, sponsor: this.modelSponsor }
                });
            }

        },
        log() {
            console.log(this.modelSponsor);
        },
        getSponsors() {
            axios.get("/api/sponsors")
                .then(res => {
                    this.sponsors = res.data.response;

                }).catch((errors) => {
                    console.log(errors);
                });
        },
        getApartmentId() {
            let formData = new FormData();
            formData.append("apartmentId", this.$route.params.id);
            axios.post('/api/sponsorApartmentId', formData).then(() => {
                const success = res.data.success;
            }).catch((errors) => {
                if (errors.response.status = 403) {
                    this.$router.push({ name: "Login" });
                }

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
        this.geteditApartment();
        this.getSponsors();
        this.getApartmentId()
    }
}
</script>
<style scoped lang="scss">
.red {
    font-size: 18px;
    color: red;
}

.cont {
    width: 100%;
    height: calc(100vh - 120px);
    display: flex;
    justify-content: center;
    align-items: center;

    .inner-cont {
        width: 50%;
        height: 50%;
        // background-color: red;

        .title {
            text-align: center;

        }

        .sponsor {
            // height: 200px;
            width: 100%;
            // background-color: blue;
            margin: 30px 0px;
            display: flex;
            justify-content: center;
            align-items: center;

            .cont-sponsor {
                height: 100%;
                width: 70%;
                // background-color: blue;
                display: flex;
                justify-content: space-between;
                align-items: center;

                .text1 {
                    background-color: #A37E49;
                }

                .text2 {
                    background-color: #FFD700;
                }

                .text3 {
                    background-color: #b9f2ff;
                }

                input[type="radio"] {
                    visibility: hidden;
                    height: 0;
                    width: 0;
                }

                label {
                    font-size: 23px;
                    display: table-cell;
                    vertical-align: middle;
                    text-align: center;
                    cursor: pointer;
                    // background-color: #454545;
                    color: white;
                    padding: 10px 15px;
                    border-radius: 3px;

                }

                input[type="radio"]:checked+label {
                    // background-color: #58ba83;
                    background-color: #dc3545;
                }

                .text {
                    font-size: 18px;
                }
            }
        }

        .cont-btn {
            // height: 200px;
            width: 100%;
            // background-color: blue;

            display: flex;
            justify-content: center;
            align-items: center;

            button {
                a {
                    color: black;
                }
            }
        }
    }


}
</style>