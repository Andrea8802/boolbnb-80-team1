<template>
    <!-- Some test Card numbers
    4111 1111 1111 1111: Visa
    5555 5555 5555 4444: MasterCard
    3714 496353 98431: American Express
    invalid_card_number: 4000111111111115,
    -->

    <div class="form-container py-5">

        <header>
            <h1 class="mb-2">Checkout</h1>
        </header>

        <form id="my-sample-form"
            method="post"
            class="scale-down">

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

        <input id="button-pay"
            type="submit"
            value="Continue"
            class="px-12 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer disabled:opacity-25 disabled:cursor-not-allowed" />

    </div>

    <div class="form-container py-10">
        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <p class="mt-4">Please wait... your payment is currently being processed. Do <span class="font-bold">not</span>
            refresh or close your browser.</p>
    </div>
</template>
<script>
import axios from "axios"
export default {
    name: "Payment",
    data() {
        return {

        };
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
                            hostedFieldsInstance.tokenize((tokenizeErr, payload) => {
                                if (tokenizeErr) {
                                    console.error(tokenizeErr);
                                    return;
                                }
                                else {
                                    console.log("pagamento andato a buon fine");
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