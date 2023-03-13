<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;

.ms_title_page_message {
    font-weight: 900;
    color: $principalColor;
}

.ms_label_bg {
    background-color: $principalColor;
    color: #ffffff;
    border-color: $principalColor;
    font-weight: 600;
}

.ms_input_focus_color:focus {
    color: $principalColor;
    border-color: $principalColor;
    box-shadow: 0 0 10px $principalColor;
}

.ms_input_submit {
    background-color: $principalColor;
    color: #ffffff;
    font-size: 16px;
    font-weight: 600;
    padding: 7px 25px;
    border-color: $principalColor;
    border-radius: 30px;
}

.ms_ctn_input {
    width: 600px;
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
</style>

<template>
    <!-- container principale della pagina -->
    <div class="container text-center py-3">
        <h1 class="ms_title_page_message mb-3">Create a message</h1>

        <!-- container del form per creare un appartemento -->
        <div class="mb-3">
            <form action="" enctype="multipart/form-data" @submit.prevent="sendMessage" method="post">

                <!-- input nome -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="name">Name : </label>
                    <input type="text" name="name" v-model="modelName" class="form-control ms_input_focus_color"
                        placeholder="Enter a name..." aria-describedby="basic-addon1">
                </div>

                <!-- input Cognome -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="surname">Surname : </label>
                    <input type="text" name="surname" v-model="modelSurname" class="form-control ms_input_focus_color"
                        placeholder="Enter a surname..." aria-describedby="basic-addon1">
                </div>

                <!-- input email -->
                <div class="ms_ctn_input input-group mb-3">
                    <label class="ms_label_bg input-group-text" id="basic-addon1" for="email">Email : </label>
                    <input type="text" name="email" v-model="modelEmail" class="form-control ms_input_focus_color"
                        placeholder="Enter a email..." aria-describedby="basic-addon1">
                </div>

                <!-- input per inserire il messaggio del testo -->
                <div class="ms_ctn_input form-floating mb-3">
                    <textarea type="text" class="form-control ms_input_focus_color" placeholder="Leave a comment here"
                        id="floatingTextarea2" style="height: 150px" name="text" v-model="modelText">
                                        </textarea>
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
        }
    },
    methods: {
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

            axios.post("/api/sendMessage", formData, config)
                .then(res => {
                    const success = res.data.succes;
                    console.log(res);
                    console.log(formData);
                }).catch((errors) => {
                    console.log(errors);
                });
        }
    }
}
</script>