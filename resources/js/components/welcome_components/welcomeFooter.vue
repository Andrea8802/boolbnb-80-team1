<script>

</script>

<template>
    <section>
        <div class="ms_ctn_footer container-fluid">
            <div class="h-100 d-flex justify-content-between align-items-center ms_ctn_footer_responsive768">
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
                <div class="ms_slot_link_footer_right">
                    <a href="#">
                        <font-awesome-icon icon="fa-solid fa-globe" />
                        English(US)
                    </a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">&euro; EUR</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">
                        <span>
                            Support & resources
                        </span>
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
    height: 50px;
    padding: 0 100px;

    a {
        color: $secondColor;
    }

    .ms_slot_link_footer_left {
        width: 55%;
    }

    .ms_slot_link_footer_right {
        width: 40%;
        text-align: end;

        a {
            font-weight: 500;
        }
    }
}

// responsive footer sotto i 992px
@media screen and (max-width: 992px) {
    .ms_ctn_footer {
        height: 80px;
        padding: 0 10px;
    }
}

// ========================================

// responsive footer sotto i 768px
@media screen and (max-width: 768px) {
    .ms_ctn_footer {
        height: fit-content;

        .ms_ctn_footer_responsive768 {
            padding: 10px 10px;
            align-items: start;
            flex-direction: column !important;
            gap: 10px;

            .ms_slot_link_footer_left {
                border-bottom: solid 1px $secondColor;
            }

            .ms_slot_link_footer_right {
                text-align: start;
            }

            .ms_slot_link_footer_left,
            .ms_slot_link_footer_right {
                width: 100%;
            }
        }
    }
}

// ========================================
</style>