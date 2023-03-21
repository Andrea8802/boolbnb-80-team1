<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;

.ms_title_page_message {
    font-weight: 900;
    color: $thirdColor;
}

.ms_label_bg {
    background-color: $thirdColor;
    color: $secondColor;
    border-color: $thirdColor;
    font-weight: 600;
}

.ms_input_focus_color:focus {
    color: $principalColor;
    border-color: $principalColor;
    box-shadow: 0 0 10px $principalColor;
}

.ms_input_submit {
    color: $thirdColor;
    background-color: $body-bg;

    border: solid 2px $thirdColor;
    border-radius: 30px;
    font-weight: 600;
    padding: 7px 15px;
}

.ms_input_submit:hover {
    color: $secondColor;
    background-color: $principalColor;
    border-color: $principalColor;
}

.ms_ctn_input {
    width: 90%;
    max-width: 600px;
    margin: 0 auto;
}

.ms_input_focus_color:focus {
    color: $principalColor;
    border-color: $principalColor;
    box-shadow: 0 0 10px $principalColor;
}

.ms_label_text_area {
    color: $principalColor;
    font-weight: 500;
}

.ms_label_smartphone {
    color: $thirdColor;
    font-size: 16px;
    font-weight: 600;
}

.ms_message_sent {
    color: $confirmedColor;
}

.ms_ctn_errors {
    width: 600px;
    margin: 0 auto;
    text-align: start;
}
</style>

<template>
    <!-- container principale della pagina -->
    <div class="container text-center py-3">
        <h1 class="ms_title_page_message mb-3">Create a message</h1>

        <!-- messaggio di conferma d'invio -->
        <h3 class="mb-3 ms_message_sent" v-if="messageConfirm">Message sent, you will be redirect to the Homepage...</h3>

        <!-- messaggi di errore per l'utente -->
        <div class="text-danger ms_ctn_errors" v-if="errors.length">
            <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors">{{ error }};</li>
            </ul>
        </div>

        <!-- container del form per creare un appartemento -->
        <div class="mb-3">
            <form action="" enctype="multipart/form-data" @submit.prevent="sendMessage" method="post">

                <!-- input nome -->
                <label for="name" class="ms_label_smartphone d-block d-md-none">Name:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="name">Name :
                    </label>
                    <input type="text" name="name" v-model="modelName" class="form-control ms_input_focus_color"
                        placeholder="Enter a name..." aria-describedby="basic-addon1">
                </div>

                <!-- input Cognome -->
                <label for="surname" class="ms_label_smartphone d-block d-md-none">Surname:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="surname">Surname :
                    </label>
                    <input type="text" name="surname" v-model="modelSurname" class="form-control ms_input_focus_color"
                        placeholder="Enter a surname..." aria-describedby="basic-addon1">
                </div>

                <!-- input email -->
                <label for="surname" class="ms_label_smartphone d-block d-md-none">Email:</label>
                <!-- label che compare nei piccoli schermi -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text d-none d-md-block" id="basic-addon1" for="email">Email :
                    </label>
                    <input type="email" name="email" v-model="modelEmail" class="form-control ms_input_focus_color"
                        placeholder="Enter a email..." aria-describedby="basic-addon1">
                </div>

                <!-- input per inserire il messaggio del testo -->
                <div class="ms_ctn_input form-floating mb-3">
                    <textarea type="text" class="form-control ms_input_focus_color" placeholder="Leave a comment here"
                        id="floatingTextarea2" style="height: 150px" name="text" v-model="modelText"></textarea>
                    <label for="floatingTextarea2 text" class="ms_label_text_area">Enter your message...</label>
                </div>

                <input type="submit" value="Send" class="ms_input_submit">
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios"
export default {
    data() {
        return {
            modelName: '',
            modelSurname: '',
            modelEmail: '',
            modelText: '',
            messageConfirm: false,
            user: [],
            errors: [],
            logged: false
        }
    },
    methods: {
        getUserLogged() {
            axios.get('/api/message/' + this.$route.params.id,)
                .then(res => {
                    this.user = res.data.response

                    if (this.user = res.data.response) {
                        this.logged = true;

                        this.user.name ? this.modelName = this.user.name : this.modelName = '';
                        this.user.surname ? this.modelSurname = this.user.surname : this.modelSurname = '';
                        this.user.email ? this.modelEmail = this.user.email : this.modelEmail = '';

                    }

                })
        },


        sendMessage() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data"
                }
            }

            let formData = new FormData();
            formData.append("name", this.modelName);
            formData.append("surname", this.modelSurname);
            formData.append("email", this.modelEmail);
            formData.append("text", this.modelText);

            axios.post("/api/sendMessage/" + this.$route.params.id, formData, config)
                .then(res => {
                    this.messageConfirm = true;
                    setTimeout(() => this.$router.push({ name: "Home" }), 1000);

                    this.clearMessage();
                    this.errors = [];

                }).catch((errors) => {
                    this.messageConfirm = false;
                    if (this.modelName === '') {
                        this.errors.push("Name required")
                    }
                    if (this.modelSurname === '') {
                        this.errors.push("Surname required")
                    }
                    if (this.modelEmail === '') {
                        this.errors.push("Email required")
                    }
                    if (!this.modelText) {
                        this.errors.push("Text message required")
                    }

                });
        },

        clearMessage() {
            this.modelName = '';
            this.modelSurname = '';
            this.modelEmail = '';
            this.modelText = '';
            this.messageConfirm = true;
        }
    },
    mounted() {
        this.getUserLogged();

    }
}
</script>