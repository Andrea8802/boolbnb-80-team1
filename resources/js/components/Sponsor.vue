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
                            :value="sponsor.id"> <span class="text">{{ sponsor.name }} {{
                                sponsor.price }}&euro;</span> <br> <br>
                    </div>


                </div>


            </div>
            <div class="cont-btn">
                <button v-if="getApartment.id !== undefined && modelSponsor !== undefined"
                    class="btn btn-outline-danger btn-lg"><router-link
                        :to="{ name: 'payment', params: { id: getApartment.id, sponsor: modelSponsor } }">Pay</router-link></button>
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
        }
    },
    methods: {
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