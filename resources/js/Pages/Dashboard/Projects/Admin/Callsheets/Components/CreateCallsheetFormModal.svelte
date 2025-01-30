<script>
    //@ts-nocheck
    import { Input, Label, Hr, Select, Button } from "flowbite-svelte";
    import { onMount, tick, onDestroy } from "svelte";
    import { router } from "@inertiajs/svelte";
    export let project_id;

    let modalOpen = false;
    let latitud = -1.831239;
    let longitud = -78.183406;
    let id_provincia;
    let id_canton;
    let id_parroquia;
    let map;
    let provincias = [];
    let selectProvincias = [];

    let cantones;
    let selectCantones = [];

    let parroquias;
    let selectParroquias = [];
    let values = {
        title: null,
        instructions: null,
        start_date: null,
        project_id,
        id_canton: null,
        id_provincia: null,
        id_parroquia: null,
        latitud: null,
        longitud: null,
    };

    function handleSubmit() {
        values.latitud = latitud;
        values.longitud = longitud;
        values.id_provincia = id_provincia;
        values.id_canton = id_canton;
        values.id_parroquia = id_parroquia;
        router.post("callsheets/store", values, {
            onSuccess: () => {
                modalOpen = false;
                values = {
                    project_id,
                };
            },
        });
    }

    const getProvincias = async () => {
        try {
            const response = await fetch(
                "http://callsheets-management.test/api/provincias/get-all",
            );
            const data = await response.json(); // Convertimos la respuesta a formato JSON

            if (!response.ok) {
                throw new Error("Error al obtener los datos");
            }

            provincias = data; // Asignamos los datos a la variable provincias
            selectProvincias = data.map((item) => {
                return { value: item.id, name: item.nombre }; // Transformamos los datos según sea necesario
            });
        } catch (error) {
            console.error("Hubo un problema con la solicitud:", error);
        }
    };

    const getCantones = async () => {
        try {
            const response = await fetch(
                `http://callsheets-management.test/api/cantones/get-all/${id_provincia}`,
            );
            const data = await response.json(); // Convertimos la respuesta a formato JSON

            if (!response.ok) {
                throw new Error("Error al obtener los datos");
            }

            cantones = data; // Asignamos los datos a la variable cantones
            selectCantones = data.map((item) => {
                return { value: item.id, name: item.nombre }; // Transformamos los datos según sea necesario
            });
        } catch (error) {
            console.error("Hubo un problema con la solicitud:", error);
        }
    };

    const getParroquias = async () => {
        try {
            const response = await fetch(
                `http://callsheets-management.test/api/parroquias/get-all/${id_canton}`,
            );
            const data = await response.json(); // Convertimos la respuesta a formato JSON

            if (!response.ok) {
                throw new Error("Error al obtener los datos");
            }

            parroquias = data; // Asignamos los datos a la variable parroquias
            selectParroquias = data.map((item) => {
                return { value: item.id, name: item.nombre }; // Transformamos los datos según sea necesario
            });
        } catch (error) {
            console.error("Hubo un problema con la solicitud:", error);
        }
    };

    onMount(async () => {
        await getProvincias();
        await tick();
        let zoom = 7;
        if (id_canton) {
            await getCantones();
            zoom = 10;
        }
        if (id_parroquia) {
            await getParroquias();
            zoom = 14;
        }
        const L = await import("leaflet");
        map = L.map("map").setView([latitud, longitud], zoom);
        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution:
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }).addTo(map);

        map.on("moveend", () => {
            const center = map.getCenter();
            latitud = center.lat;
            longitud = center.lng;
        });
    });

    onDestroy(async () => {
        if (map) {
            map.remove();
        }
    });
</script>

<label for="create_callsheet_modal" class="btn">Crear Callsheet</label>
<!-- Put this part before </body> tag -->
<input
    bind:checked={modalOpen}
    type="checkbox"
    id="create_callsheet_modal"
    class="modal-toggle"
/>
<div class="modal" role="dialog">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Crear Callsheet</h3>
        <form
            on:submit|preventDefault={handleSubmit}
            class="flex flex-col gap-3 mt-3"
        >
            <input
                type="text"
                placeholder="Titulo"
                class="input input-bordered w-full"
                bind:value={values.title}
            />
            <textarea
                class="textarea textarea-bordered w-full"
                placeholder="Instrucciones"
                bind:value={values.instructions}
            ></textarea>
            <input
                type="datetime-local"
                class="input input-bordered w-full"
                bind:value={values.start_date}
            />

            <div class=" w-full h-full relative">
                <div id="map" class="h-96 lg:h-[400px] w-full z-10" />

                <img
                    src="/imagenes/pinMap.png"
                    class="absolute w-14 h-14 z-20 left-2/4 top-2/4 -translate-x-2/4 -translate-y-2/4"
                    alt=""
                />
            </div>
            <Label>
                Provincia
                <Select
                    required
                    on:change={() => {
                        const handleProvincia = provincias.find(
                            (item) => item.id == id_provincia,
                        );
                        map.flyTo(
                            [handleProvincia.latitud, handleProvincia.longitud],
                            9,
                        );
                        getCantones();
                    }}
                    bind:value={id_provincia}
                    class="rounded-none cursor-pointer font-normal mt-1"
                    placeholder="Elige una provincia..."
                    items={selectProvincias}
                />
            </Label>

            <Label>
                Cantón
                <Select
                    on:change={() => {
                        const handleCanton = cantones.find(
                            (item) => item.id == id_canton,
                        );
                        map.flyTo(
                            [handleCanton.latitud, handleCanton.longitud],
                            13,
                        );
                        getParroquias();
                    }}
                    required
                    disabled={id_provincia ? false : true}
                    bind:value={id_canton}
                    class="rounded-none cursor-pointer font-normal mt-1"
                    placeholder="Elige un cantón..."
                    items={selectCantones}
                />
            </Label>
            <Label>
                Parroquia
                <Select
                    required
                    on:change={() => {
                        const handleParroquia = parroquias.find(
                            (item) => item.id == id_parroquia,
                        );
                        map.flyTo(
                            [handleParroquia.latitud, handleParroquia.longitud],
                            15,
                        );
                    }}
                    disabled={id_canton ? false : true}
                    bind:value={id_parroquia}
                    class="rounded-none cursor-pointer font-normal mt-1"
                    placeholder="Elige una parroquia..."
                    items={selectParroquias}
                />
            </Label>
            <Label class="block  w-full">
                Latitud
                <Input
                    disabled
                    bind:value={latitud}
                    class="rounded-none font-normal mt-1"
                />
            </Label>
            <Label class="block w-full">
                Longitud
                <Input
                    disabled
                    bind:value={longitud}
                    class="rounded-none font-normal mt-1"
                />
            </Label>
            <Hr hrClass="my-2" />

            <button class="btn" type="submit">Enviar</button>
        </form>
    </div>
    <label class="modal-backdrop" for="create_callsheet_modal">Close</label>
</div>
