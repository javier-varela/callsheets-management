<script>
    import { router } from "@inertiajs/svelte";
    export let callsheet_id;

    let modalOpen = false;
    let values = {
        start_hour: null,
        stimated_hours: null,
        description: null,
        callsheet_id,
    };

    function handleSubmit() {
        router.post("events/store", values, {
            onSuccess: () => {
                modalOpen = false;
                values = {
                    start_hour: null,
                    stimated_hours: null,
                    description: null,
                    callsheet_id,
                };
            },
        });
    }
</script>

<label for="create_callsheet_modal" class="btn">Crear Evento</label>
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
            on:submit={handleSubmit}
            class="max-w-lg mx-auto p-4 border rounded shadow-md bg-white space-y-4"
        >
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Start Hour</span>
                </label>
                <input
                    type="number"
                    step="0.1"
                    bind:value={values.start_hour}
                    placeholder="Enter start hour"
                    class="input input-bordered w-full"
                    required
                />
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Stimated Hours</span>
                </label>
                <input
                    type="number"
                    step="0.1"
                    bind:value={values.stimated_hours}
                    placeholder="Enter estimated hours"
                    class="input input-bordered w-full"
                    required
                />
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Description</span>
                </label>
                <textarea
                    bind:value={values.description}
                    placeholder="Enter description"
                    class="textarea textarea-bordered w-full"
                    required
                />
            </div>

            <div class="form-control">
                <button type="submit" class="btn btn-primary w-full"
                    >Enviar</button
                >
            </div>
        </form>
    </div>
    <label class="modal-backdrop" for="create_callsheet_modal">Close</label>
</div>
