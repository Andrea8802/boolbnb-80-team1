<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;

body {
    margin-top: 20px;
    background: #eee;
}

/* ========================================================================
 * MESSAGES
 * ======================================================================== */
.active {
    display: block;
}

.none {
    display: none;
}

.my-margin-mx {
    margin-left: 10px;
    margin-top: 10px;
}

//  .my-padding-chatsx{
//     // padding-left: 5px !important;
//     // padding-right: 5px !important;
//  }
.selected-message,
.selected-message>* {
    background-color: $body-bg;
    color: $principalColor !important;
}


.message form {
    padding: 6px 15px;
    background-color: #FAFAFA;
    border-bottom: 1px solid #E6EBED;
}

.message form .has-icon .form-control-icon {
    position: absolute;
    z-index: 5;
    top: 0;
    right: 0;
    width: 34px;
    line-height: 33px;
    text-align: center;
    color: #777;
}

.message>a {
    position: relative;
}

.message .indicator {
    text-align: center;
}

.message .indicator .spinner {
    left: 26%;
    width: 200px;
    font-size: 13px;
    line-height: 17px;
    color: #999;
}

.message-wrapper {
    position: relative;
    padding: 0px;
    background-color: #ffffff;
    margin: 0px;
}

.message-wrapper .message-sideleft {
    vertical-align: top !important;
}

.message-wrapper .message-sideleft[class*="col-"] {
    padding-right: 0px;
    padding-left: 0px;
}

.message-wrapper .message-sideright {
    background-color: #f8f8f8;
}

.message-wrapper .message-sideright[class*="col-"] {
    padding: 30px;
}

.message-wrapper .message-sideright .panel {
    border-top: 1px dotted #DDD;
    padding-top: 20px;
}

.message-wrapper .message-sideright .panel:first-child {
    border-top: none;
    padding-top: 0px;
}

.message-wrapper .message-sideright .panel .panel-heading {
    border-bottom: none;
}

.message-wrapper .panel {
    background-color: transparent !important;
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
}

.message-wrapper .panel .panel-heading,
.message-wrapper .panel .panel-body {
    background-color: transparent !important;
}

.message-wrapper .media .media-body {
    font-weight: 300;
}

.message-wrapper .media .media-heading {
    margin-bottom: 0px;
}

.message-wrapper .media small {
    color: #999999;
    font-weight: 400;
}

.list-message .list-group-item {
    padding: 15px;
    color: black;
    //   border-right: 3px solid #8CC152 !important;
}

.list-message .list-group-item.active {
    background-color: #EEEEEE;
    border-bottom: 1px solid #DDD !important;
}

.list-message .list-group-item.active p {
    color: black;
}

.list-message .list-group-item.active:hover,
.list-message .list-group-item.active:focus,
.list-message .list-group-item.active:active {
    background-color: #EEEEEE;
}

.list-message .list-group-item small {
    font-size: 12px;
}

.list-message .list-group-item .list-group-item-heading {
    color: black;
}

.list-message .list-group-item .list-group-item-text {
    margin-bottom: 10px;
}

.list-message .list-group-item:last-child {
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
    border-radius: 0px;
    border-bottom: 1px solid #DDD !important;
}

.avatar {
    width: 50px;
    height: 50px;
}
</style>

<template>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
        rel="stylesheet">

    <!-- componente diplay grandi -->
    <div class="container mt-5 mb-5 d-none d-md-block">
        <div class="row message-wrapper my-padding-chatsx rounded shadow mb-20">
            <div class="col-md-4 message-sideleft ">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="panel-title my-margin-mx">NEW MESSAGES </h3>
                        </div>

                        <div class="clearfix"></div>
                    </div><!-- /.panel-heading -->
                    <div class="panel-body no-padding "
                        @click="selectChat(message.id)"
                        v-for="message in messages"
                        :key="message.id">
                        <div class="list-group no-margin list-message">
                            <a href="#"
                                :class="activeChat === message.id ? 'list-group-item mb-1 mx-2 rounded selected-message' : 'list-group-item mb-1 mx-2 rounded '">
                                <h4 class="list-group-item-heading">{{ message.name }} </h4>
                                <p class="list-group-item-text">
                                    <strong>You have a new message </strong>
                                </p>
                                <span class="label label-success pull-right">NEW</span>
                                <div class="clearfix"></div>
                            </a>

                        </div><!-- /.list-group    -->
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->
            </div><!-- /.message-sideleft -->
            <div class="col-md-8 message-sideright">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="media">

                            <a class="pull-left"
                                href="#"></a>

                            <div :class="activeChat === message.id ? 'active' : 'none'"
                                v-for="message in messages">
                                <div class="d-flex ">
                                    <img src="/storage/avatar5.png"
                                        class="img-circle avatar rounded-circle me-3">
                                    <div>
                                        <h4 class="media-heading"> {{ message.name }} </h4>
                                        <p class="lead">
                                            {{ message.email }}
                                        </p>
                                    </div>
                                </div>
                                <p>
                                    {{ message.text }}
                                </p>
                                <p>
                                    Thanks! <br>
                                    {{ message.name }}
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div><!-- /.panel-heading -->
                </div><!-- /.panel -->
            </div><!-- /.message-sideright -->
        </div>
    </div>

    <!-- responsive components -->
    <div class="container mt-5 mb-5 d-block d-md-none">
        <div class="accordion accordion-flush"
            id="accordionFlushExample">
            <h1>NEW MESSAGES</h1>
            <div class="accordion-item"
                v-for="(message, index) in messages">
                <h2 class="accordion-header"
                    :id="'flush-heading-' + index">
                    <button class="accordion-button collapsed"
                        type="button"
                        :data-bs-toggle="'collapse'"
                        :data-bs-target="'#flush-collapse-' + index"
                        aria-expanded="false"
                        :aria-controls="'flush-collapse-' + index">
                        <strong>{{ message.name }} </strong> <i style="margin-left: 12px;"> (You have a new message)</i>
                    </button>
                </h2>
                <div :id="'flush-collapse-' + index"
                    class="accordion-collapse collapse"
                    :aria-labelledby="'flush-heading-' + index"
                    data-bs-parent="accordionFlushExample">
                    <div class="accordion-body">
                        <div class="d-flex ">
                            <img src="/storage/img-user-prifle.jpeg"
                                class="img-circle avatar rounded-circle me-3">
                            <div>
                                <h4 class="media-heading"> {{ message.name }} </h4>
                                <p class="lead">
                                    {{ message.email }}
                                </p>
                            </div>
                        </div>
                        <p>
                            {{ message.text }}
                        </p>
                        <p>
                            Thanks! <br>
                            {{ message.name }}
                        </p>
                        <hr>
                    </div>
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
            messages: [],
            message: "",
            users: [],
            apartment: [],
            activeChat: 0,
        }
    },
    methods: {
        selectChat(index) {
            let k = index;
            this.activeChat = k;
        },
        getMessages() {
            let formData = new FormData();
            formData.append("apartmentId", this.$route.params.id);

            axios.post("/api/getMessages", formData)
                .then(res => {
                    this.messages = res.data.response
                    console.log(this.messages);

                }).catch((errors) => {
                    if (errors.response.status = 403) {
                        this.$router.push({ name: "Login" });
                    }

                    console.log(errors);
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
        getInfo() {
            axios.get("/api/getInfo")
                .then(res => {
                    this.users = res.data.user;
                    this.apartment = res.data.apartment;
                    console.log(this.users);
                }).catch((errors) => {
                    console.log(errors);
                });
        },
    },


    mounted() {
        this.geteditApartment()
        this.getMessages()
        this.getInfo()
    }
}
</script>

