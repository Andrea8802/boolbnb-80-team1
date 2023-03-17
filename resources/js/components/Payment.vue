<template>
    <div class="form-container py-5">

        <header>
            <h1 class="mb-2"
                @click="log">Checkout</h1>
        </header>

        <form id="my-sample-form"
            method="post"
            class="scale-down"
            autocomplete="off">

            <div class="cardinfo-card-number">
                <label class="cardinfo-label"
                    for="card-number">Card Number</label>
                <div class='input-wrapper'
                    id="card-number"></div>
                <div id="card-image"></div>
            </div>

            <div class="cardinfo-wrapper">
                <div class="cardinfo-exp-date">
                    <label class="cardinfo-label"
                        for="expiration-date">Valid Thru</label>
                    <div class='input-wrapper'
                        id="expiration-date"></div>
                </div>

                <div class="cardinfo-cvv">
                    <label class="cardinfo-label"
                        for="cvv">CVV</label>
                    <div class='input-wrapper'
                        id="cvv"></div>
                </div>
            </div>

        </form>
        <div v-if="payed"
            class="green">Payment Successful, You will be redirect to your apartments page...
        </div>
        <div v-if="error"
            class="red">Invalid Card Number, Try Again
        </div>
        <input type="submit"
            value="Pay"
            class="px-12 py-3 bg-blue-600 border border-transparent  " />


    </div>
</template>
<script>
import axios from "axios"
export default {

    name: "Payment",
    data() {
        return {
            error: false,
            payed: false
        };
    },
    methods: {
        log() {
            console.log(this.$route.params.sponsor);
        }
    },
    mounted() {
        var submit = document.querySelector('input[type="submit"]');
        var form = document.querySelector('#my-sample-form');
        braintree.client.create(
            {
                authorization: "sandbox_csdswdwm_4vzxvdhwmxsz2ggq",
            }, (clientErr, clientInstance) => {
                if (clientErr) {
                    console.error(clientErr);
                    return;
                }
                // Create input fields and add text styles
                braintree.hostedFields.create(
                    {
                        client: clientInstance,
                        styles: {
                            'input': {
                                'color': '#282c37',
                                'font-size': '16px',
                                'transition': 'color 0.1s',
                                'line-height': '3'
                            },
                            // Style the text of an invalid input
                            'input.invalid': {
                                'color': '#E53A40'
                            },
                            // placeholder styles need to be individually adjusted
                            '::-webkit-input-placeholder': {
                                'color': 'rgba(0,0,0,0.6)'
                            },
                            ':-moz-placeholder': {
                                'color': 'rgba(0,0,0,0.6)'
                            },
                            '::-moz-placeholder': {
                                'color': 'rgba(0,0,0,0.6)'
                            },
                            ':-ms-input-placeholder': {
                                'color': 'rgba(0,0,0,0.6)'
                            },
                            // prevent IE 11 and Edge from
                            // displaying the clear button
                            // over the card brand icon
                            'input::-ms-clear': {
                                opacity: '0'
                            }
                        },
                        // Add information for individual fields
                        fields: {
                            number: {
                                selector: '#card-number',
                                placeholder: '4111 1111 1111 1111'
                            },
                            cvv: {
                                selector: '#cvv',
                                placeholder: '123'
                            },
                            expirationDate: {
                                selector: '#expiration-date',
                                placeholder: '10 / 2019'
                            }
                        }
                    }, (hostedFieldsErr, hostedFieldsInstance) => {
                        if (hostedFieldsErr) {

                            console.error(hostedFieldsErr);
                            return;
                        }
                        hostedFieldsInstance.on('validityChange', (event) => {
                            // Check if all fields are valid, then show submit button
                            var formValid = Object.keys(event.fields).every(function (key) {
                                return event.fields[key].isValid;
                            });
                            if (formValid) {
                                $('#button-pay').addClass('show-button');
                            } else {
                                $('#button-pay').removeClass('show-button');
                            }
                        });
                        hostedFieldsInstance.on('empty', (event) => {
                            $('header').removeClass('header-slide');
                            $('#card-image').removeClass();
                            $(form).removeClass();
                        });
                        hostedFieldsInstance.on('cardTypeChange', (event) => {
                            // Change card bg depending on card type
                            if (event.cards.length === 1) {
                                $(form).removeClass().addClass(event.cards[0].type);
                                $('#card-image').removeClass().addClass(event.cards[0].type);
                                $('header').addClass('header-slide');
                                // Change the CVV length for AmericanExpress cards
                                if (event.cards[0].code.size === 4) {
                                    hostedFieldsInstance.setAttribute({
                                        field: 'cvv',
                                        attribute: 'placeholder',
                                        value: '1234'
                                    });
                                }
                            } else {
                                hostedFieldsInstance.setAttribute({
                                    field: 'cvv',
                                    attribute: 'placeholder',
                                    value: '123'
                                });
                            }
                        });
                        submit.addEventListener('click', (event) => {
                            event.preventDefault();
                            hostedFieldsInstance.tokenize((tokenizeErr) => {
                                if (tokenizeErr) {
                                    this.error = true;
                                    console.error(tokenizeErr);
                                    return;
                                }
                                else {
                                    let formData = new FormData();
                                    formData.append("sponsors", this.$route.params.sponsor);
                                    formData.append("apartmentId", this.$route.params.id);
                                    axios.post('/api/sponsorPayment', formData).then(() => {
                                        this.error = false;
                                        this.payed = true;
                                        setTimeout(() => this.$router.push({ name: "userApartments" }), 2000);



                                    }).catch((errors) => {

                                        console.log(errors);

                                    });
                                }
                                // router.post(
                                //     route("dashboard.transaction"),
                                //     {
                                //         payload: payload,
                                //         target: store.target,
                                //     }
                                // );
                                // store.isProcessing = true;
                            });
                        }, false);
                    }
                );
            });
    },
};
</script>
<style lang="scss" scoped>
.green {
    font-size: 18px;
    color: green;
}

.red {
    font-size: 18px;
    color: red;
}

/*--------------------
    Shared Variables
    --------------------*/
$small-screen: 476px;
$grey: #111;
$blue: #5db6e8;
$darkBlue: #282c37;
$red: #E53A40;
$green: #8CD790;
$white: #fff;
$radius: 4px;
$bouncy: cubic-bezier(.20, 1.3, .7, 1);

/*--------------------
    General
    --------------------*/
header {
    z-index: 2;
    transform: translate(0, 5.5em);
    transition: all .5s ease;

    &.header-slide {
        transform: translate(0, 0);
    }
}

h1 {
    font-weight: bold;
    font-size: 1.4em;
    display: block;
}

.form-container {
    height: calc(100vh - 120px);
    width: 100%;
    background-color: #f3f4f6;
    display: flex;
    background-color: #f3f4f6;
    justify-content: center;
    align-items: center;
    // height: 100%;
    flex-direction: column;
    // border: 1em solid #fff;
    box-sizing: border-box;
    position: relative;

    @media (max-width: $small-screen) {
        border: none;
    }
}

.cardinfo-wrapper {
    display: flex;
    justify-content: space-around;
}

.bg-illustration {
    position: absolute;
    bottom: 0;
    left: 0;
    z-index: 0;

    svg {
        width: 100%;
    }
}

.card-shape {
    border-radius: 6px;
    padding: 2em 2em 1em;

    @media (max-width: $small-screen) {
        padding: 2em 1.5em 1em;
    }
}

// Form wrapper styling
#my-sample-form {
    background-color: #FFF;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12);
    padding: 8em 3em 2em;
    width: 20em;
    margin-bottom: 2em;
    transition: all 600ms $bouncy;
    animation: cardIntro 500ms $bouncy;
    z-index: 1;

    &:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.06);
    }

    @media (max-width: $small-screen) {
        box-sizing: border-box;
        padding: 7em 2em 2em;
        width: 100%;
    }

    // Change background color based on the card type
    &.visa {
        @extend .card-shape;
        color: $white;
        background-color: #0D4AA2;
    }

    &.master-card {
        @extend .card-shape;
        color: $white;
        background-color: #363636;
        background: linear-gradient(115deg, #d82332, #d82332 50%, #f1ad3d 50%, #f1ad3d);
    }

    &.maestro {
        @extend .card-shape;
        color: $white;
        background-color: #363636;
        background: linear-gradient(115deg, #009ddd, #009ddd 50%, #ed1c2e 50%, #ed1c2e);
    }

    &.american-express {
        @extend .card-shape;
        color: $white;
        background-color: #007CC3;
    }

    &.discover {
        @extend .card-shape;
        color: $white;
        background-color: #ff6000;
        background: linear-gradient(#d14310, #f7961e);
    }

    &.unionpay,
    &.jcb,
    &.diners-club {
        @extend .card-shape;
        color: $white;
        background-color: #363636;
    }
}

.cardinfo-label {
    display: block;
    font-size: 11px;
    margin-bottom: 0.5em;
    text-transform: uppercase;
}

.cardinfo-exp-date {
    margin-right: 1em;
    width: 100%;
}

.cardinfo-cvv {
    width: 100%;
}

#button-pay {
    cursor: pointer;
    // width: 16em;
    // font-size: 15px;
    // border: 0;
    // padding: 1.2em 1em;
    // color: #fff;
    // background: #282c37;
    // border-radius: $radius;
    z-index: 0;
    transform: translateY(-100px);
    transition: all 500ms $bouncy;
    opacity: 0;

    // &:hover {
    //     background: lighten(#282c37, 20%);
    // }
    &:active {
        animation: cardIntro 200ms $bouncy;
    }

    &.show-button {
        transform: translateY(0);
        opacity: 1;
    }
}

// Card type image styles
.cardinfo-card-number {
    position: relative;
}

#card-image {
    position: absolute;
    top: 2em;
    right: 1em;
    width: 44px;
    height: 28px;
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/346994/card_sprite.png);
    background-size: 86px 458px;
    border-radius: $radius;
    background-position: -100px 0;
    background-repeat: no-repeat;
    margin-bottom: 1em;

    &.visa {
        background-position: 0 -398px;
    }

    &.master-card {
        background-position: 0 -281px;
    }

    &.american-express {
        background-position: 0 -370px;
    }

    &.discover {
        background-position: 0 -163px;
    }

    &.maestro {
        background-position: 0 -251px;
    }

    &.jcb {
        background-position: 0 -221px;
    }

    &.diners-club {
        background-position: 0 -133px;
    }
}

/*--------------------
    Inputs
    --------------------*/
// Styling for input wrappers, internal font styles are handled in javascript
.input-wrapper {
    border-radius: 2px;
    background: rgba(255, 255, 255, 0.86);
    height: 2.75em;
    border: 1px solid #eee;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.06);
    padding: 5px 10px;
    margin-bottom: 1em;
}

.cardinfo-card-number,
.cardinfo-exp-date,
.cardinfo-cvv {
    transition: transform 0.3s;
}

// Change styles of the input wrappers using Braintree's provided classes.
// Styles the wrapper of the focused input
.braintree-hosted-fields-focused {
    border-color: $blue;
}

// Styles the wrapper of the invalid input
.braintree-hosted-fields-invalid {
    border-color: $red;
    animation: shake 500ms $bouncy both;
    transform: translate3d(0, 0, 0);
    backface-visibility: hidden;
    perspective: 1000px;
}

/*--------------------
    Animations
    --------------------*/
@keyframes cardIntro {
    0% {
        transform: scale(0.8) translate(0, 0);
        opacity: 0;
    }

    100% {
        transform: scale(1) translate(0, 0);
        opacity: 1;
    }
}

@keyframes shake {

    10%,
    90% {
        transform: translate3d(-1px, 0, 0);
    }

    20%,
    80% {
        transform: translate3d(1px, 0, 0);
    }

    30%,
    50%,
    70% {
        transform: translate3d(-3px, 0, 0);
    }

    40%,
    60% {
        transform: translate3d(3px, 0, 0);
    }
}

// Loading
.lds-roller {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}

.lds-roller div {
    animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    transform-origin: 40px 40px;
}

.lds-roller div:after {
    content: " ";
    display: block;
    position: absolute;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #000;
    margin: -4px 0 0 -4px;
}

.lds-roller div:nth-child(1) {
    animation-delay: -0.036s;
}

.lds-roller div:nth-child(1):after {
    top: 63px;
    left: 63px;
}

.lds-roller div:nth-child(2) {
    animation-delay: -0.072s;
}

.lds-roller div:nth-child(2):after {
    top: 68px;
    left: 56px;
}

.lds-roller div:nth-child(3) {
    animation-delay: -0.108s;
}

.lds-roller div:nth-child(3):after {
    top: 71px;
    left: 48px;
}

.lds-roller div:nth-child(4) {
    animation-delay: -0.144s;
}

.lds-roller div:nth-child(4):after {
    top: 72px;
    left: 40px;
}

.lds-roller div:nth-child(5) {
    animation-delay: -0.18s;
}

.lds-roller div:nth-child(5):after {
    top: 71px;
    left: 32px;
}

.lds-roller div:nth-child(6) {
    animation-delay: -0.216s;
}

.lds-roller div:nth-child(6):after {
    top: 68px;
    left: 24px;
}

.lds-roller div:nth-child(7) {
    animation-delay: -0.252s;
}

.lds-roller div:nth-child(7):after {
    top: 63px;
    left: 17px;
}

.lds-roller div:nth-child(8) {
    animation-delay: -0.288s;
}

.lds-roller div:nth-child(8):after {
    top: 56px;
    left: 12px;
}

@keyframes lds-roller {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>