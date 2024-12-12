<script>
    import { router } from "@inertiajs/svelte";
    export let callsheet_cast; // Lista de miembros del elenco
    export let callsheet_id; // ID del callsheet
    export let project_id;

    let event_cast = []; // Lista de miembros seleccionados
    let start_hour = "08:00"; // Hora inicial por defecto en formato HH:mm
    let stimated_hours = "01:30"; // Duración estimada por defecto en formato HH:mm
    let description = ""; // Descripción inicial vacía
    let selected_cast = ""; // Cast seleccionado en el <select>

    async function handleSubmit() {
        // Convertir las horas al formato float
        const startHourFloat = timeToFloat(start_hour);
        const stimatedHoursFloat = timeToFloat(stimated_hours);

        const data = {
            start_hour: startHourFloat,
            stimated_hours: stimatedHoursFloat - startHourFloat,
            description,
            callsheet_id,
            project_id,
            event_cast: JSON.stringify(event_cast),
        };

        // Simulación de la petición (router.post es específico de tu configuración)
        router.post("/dashboard/projects/admin/callsheets/addEvent", data, {
            onSuccess: () => {},
        });
    }

    function timeToFloat(time) {
        const [hours, minutes] = time.split(":").map(Number);
        return hours + minutes / 60;
    }

    function addCast() {
        if (selected_cast) {
            const cast = callsheet_cast.find(
                (cast) => cast.id == selected_cast,
            );
            if (cast && !event_cast.some((e) => e.id === cast.id)) {
                event_cast = [...event_cast, cast];
            }
        }
    }

    function removeCast(castId) {
        event_cast = event_cast.filter((cast) => cast.id !== castId);
    }
</script>

<!-- The button to open modal -->
<label for="eventform_modal" class="btn">Agregar Evento</label>

<!-- Modal -->
<input type="checkbox" id="eventform_modal" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box">
        <form
            on:submit|preventDefault={handleSubmit}
            class="p-4 space-y-4 bg-base-200 rounded-lg shadow-md"
        >
            <!-- Selector de Hora de Inicio -->
            <div>
                <label for="start_hour" class="label">
                    <span class="label-text">Start Hour</span>
                </label>
                <input
                    id="start_hour"
                    type="time"
                    bind:value={start_hour}
                    class="input input-bordered w-full"
                />
            </div>

            <!-- Selector de Duración Estimada -->
            <div>
                <label for="stimated_hours" class="label">
                    <span class="label-text">Estimated Hours</span>
                </label>
                <input
                    id="stimated_hours"
                    type="time"
                    bind:value={stimated_hours}
                    class="input input-bordered w-full"
                />
            </div>

            <!-- Campo de Texto para la Descripción -->
            <div>
                <label for="description" class="label">
                    <span class="label-text">Description</span>
                </label>
                <textarea
                    id="description"
                    bind:value={description}
                    class="textarea textarea-bordered w-full"
                    placeholder="Enter event description"
                ></textarea>
            </div>

            <!-- Cast Selector -->
            <div class="divider">Event Cast</div>

            <div class="flex items-center space-x-2">
                <select
                    bind:value={selected_cast}
                    class="select select-bordered w-full"
                >
                    <option value="" disabled selected
                        >Select a cast member</option
                    >
                    {#each callsheet_cast as cast}
                        <option value={cast.id}
                            >{cast.user_name} ({cast.project_role_name})</option
                        >
                    {/each}
                </select>
                <button
                    type="button"
                    class="btn btn-secondary"
                    on:click={addCast}
                >
                    Add
                </button>
            </div>

            <!-- Miembros Seleccionados -->
            {#each event_cast as cast (cast.id)}
                <div
                    class="flex items-center justify-between p-2 bg-gray-100 rounded"
                >
                    <span>{cast.user_name}</span>
                    <button
                        type="button"
                        class="btn btn-xs btn-error"
                        on:click={() => removeCast(cast.id)}
                    >
                        Remove
                    </button>
                </div>
            {/each}

            <!-- Botón para Enviar -->
            <button type="submit" class="btn btn-primary w-full">Submit</button>
        </form>
        <div class="modal-action">
            <label for="eventform_modal" class="btn">Close!</label>
        </div>
    </div>
</div>
