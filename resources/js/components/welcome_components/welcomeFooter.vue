<script>

</script>

<template>
    <section>
        <div class="container-fluid ms_ctn_footer">
            <div class="container h-100 d-flex justify-content-between align-items-center">
                <!-- slot dei link privacy, termini, mappa sito, dettagli azienda e destinazioni -->
                <div class="ms_slot_link_footer_left">
                    <span>&#169; Boolbnb, Inc.</span>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">Privacy</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">Terms</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">Sitemap</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">Your Privacy Choices</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">Destinations</a>
                </div>

                <!-- slot dei link lingua, tipo moneta, supporto e risorse -->
                <div class="ms_slot_link_footer_right d-flex align-items-center">
                    <a href="#">
                        <font-awesome-icon icon="fa-solid fa-globe" />
                        English(US)
                    </a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">&euro; EUR</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#" class="d-flex align-items-center">
                        <div class="me-2">
                            Support & resources
                        </div>
                        <font-awesome-icon icon="fa-solid fa-angle-up" />
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;

.ms_ctn_footer {
    color: $secondColor;
    font-size: 14px;
    height: 40px;

    a {
        color: $secondColor;
    }

    .ms_slot_link_footer_left,
    .ms_slot_link_footer_right {
        width: fit-content;
    }

    .ms_slot_link_footer_right {

        a {
            font-weight: 500;
        }
    }
}
</style>