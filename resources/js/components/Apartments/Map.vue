<script>
import { onMounted, ref } from 'vue'
import { toTypeString } from '@vue/shared';

export default {
    props: {
        long: Number,
        lat: Number,
    },
    data() {
        return {
        }

    },
    methods: {

        setup() {
            const mapRef = ref(map);
            onMounted(() => {

                const tt = window.tt;
                var map = tt.map({
                    key: 'swejiAPoK6AzgYl7GjX1ulBL66FrtgGi',
                    container: mapRef.value,
                    style: 'tomtom://vector/1/basic-main',
                });
                map.addControl(new tt.FullscreenControl());
                map.addControl(new tt.NavigationControl());
                addMarker(map);
            })
            function addMarker(map) {
                const tt = window.tt;
                var location = [this.long, this.lat];
                var popupOffset = 25;

                var marker = new tt.Marker().setLngLat(location).addTo(map);
                var popup = new tt.Popup({ offset: popupOffset }).setHTML("Your address!");
                marker.setPopup(popup).togglePopup();
            }

            return {
                mapRef,
            };
        },







    },
}

</script>
<template>
    <div id='map'></div>
</template>
<style lang="scss" scoped>
#map {
    height: 50vh;
    width: 50vw;
}
</style>