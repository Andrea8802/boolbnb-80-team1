<script>
export default {
    name: "Loader"
}
</script>

<template>
    <div class="ms_continer d-flex justify-content-center align-items-center flex-column gap-2">
        <img src="../../../public/images/searchLoader.svg">
        <div class="ms_text">
            Looking for the best place for you...
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use '/resources/sass/variables' as *;

.ms_container {
    height: 100vh;
    width: 100%;
}

.ms_text {
    color: $thirdColor;
    font-size: 22px;
    font-weight: bold;
}
</style>