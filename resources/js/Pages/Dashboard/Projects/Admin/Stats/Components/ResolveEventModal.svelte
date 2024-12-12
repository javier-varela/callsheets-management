<script>
    import { router } from "@inertiajs/svelte";
    export let event;
    export let project_id;
    let taked_time = event.stimated_hours;

    function handleSubmit() {
        router.post(
            "/dashboard/projects/admin/stats/resolveEvent",
            {
                event_id: event.id,
                taked_time,
                project_id,
            },
            {
                onSuccess: () => {},
            },
        );
    }
</script>

<label for="my_modal_6" class="btn btn-primary">Resolver Evento</label>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="my_modal_6" class="modal-toggle" />
<div class="modal" role="dialog">
    <div class="modal-box">
        <form on:submit|preventDefault={handleSubmit} class="flex flex-col">
            {project_id}
            <label for=""
                >Horas estimadas:
                <input
                    step="0.01"
                    bind:value={event.stimated_hours}
                    type="number"
                />
            </label>
            <label for=""
                >Horas empleadas:
                <input step="0.01" bind:value={taked_time} type="number" />
            </label>
            <button class="btn" type="submit">Enviar</button>
        </form>
        <div class="modal-action">
            <label for="my_modal_6" class="btn">Close!</label>
        </div>
    </div>
</div>
