<script>
    import { tick } from "svelte";
    import { onMount, onDestroy } from "svelte";

    import "leaflet/dist/leaflet.css";
    let mapElement;
    let map;
    export let latitud = -0.354435;
    export let longitud = -78.48;
    export let zoom = 6;
    onMount(async () => {
        await tick();
        const leaflet = await import("leaflet");

        map = leaflet.map(mapElement).setView([latitud, longitud], zoom);

        leaflet
            .tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            })
            .addTo(map);

        leaflet.marker([latitud, longitud]).addTo(map);
    });

    onDestroy(async () => {
        if (map) {
            map.remove();
        }
    });
</script>

<div
    class="w-full h-72 mt-5 z-0 sm:h-96 xl:h-[450px] 2xl:h-[500px]"
    bind:this={mapElement}
/>
