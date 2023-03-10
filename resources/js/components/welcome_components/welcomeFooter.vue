<script>

</script>

<template>
    <section>
        <div class="container-fluid ms_ctn_footer">
            <div class="container">
                <!-- slot dei link privacy, termini, mappa sito, dettagli azienda e destinazioni -->
                <div class="ms_slot_link_footer_left">

                </div>

                <!-- slot dei link lingua, tipo moneta, supporto e risorse -->
                <div class="ms_slot_link_footer_right">

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
    height: 40px;
}
</style>