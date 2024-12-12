<script>
    import { router } from "@inertiajs/svelte";
    export let project_id;

    let modalOpen = false;
    let values = {
        title: null,
        instructions: null,
        start_date: null,
        project_id,
    };

    function handleSubmit() {
        router.post("callsheets/store", values, {
            onSuccess: () => {
                modalOpen = false;
                values = {
                    title: null,
                    instructions: null,
                    start_date: null,
                    project_id,
                };
            },
        });
    }
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

            <button class="btn" type="submit">Enviar</button>
        </form>
    </div>
    <label class="modal-backdrop" for="create_callsheet_modal">Close</label>
</div>
