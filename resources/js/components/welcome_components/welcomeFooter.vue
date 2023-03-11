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
                    <a href="#">Termini</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">Mappa del sito</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">Dettagli dell'azienda</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">Destinazioni</a>
                </div>

                <!-- slot dei link lingua, tipo moneta, supporto e risorse -->
                <div class="ms_slot_link_footer_right">
                    <a href="#">Italiano</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">&euro; EUR</a>
                    <span class="mx-2">&#8226;</span>
                    <a href="#">Supporto e risorse</a>
                </div>
            </div>
        </div>
    </section>
</template>

<style lang="scss" scoped>
@use '/resources/sass/variables.scss' as *;

section {
    border-top: solid 2px $principalColor;
}

.ms_ctn_footer {
    color: $principalColor;
    font-size: 14px;
    height: 40px;

    a {
        color: $principalColor;
    }

    .ms_slot_link_footer_left {
        width: fit-content;
    }

    .ms_slot_link_footer_right {
        a {
            font-weight: 500;
        }
    }
}
</style>