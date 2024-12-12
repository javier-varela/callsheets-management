<script>
    import { router } from "@inertiajs/svelte";
    export let project_participants;
    export let callsheet_id;
    export let project_id;
    let callsheetCast = []; // Lista de participantes seleccionados
    let selectedParticipant = null; // Participante seleccionado en el select

    // Función para agregar un participante a la lista de callsheet_cast
    const addParticipant = () => {
        if (selectedParticipant) {
            const participant = project_participants.find(
                (p) => p.pra_id === +selectedParticipant,
            );
            if (participant) {
                callsheetCast.push(participant);
                project_participants = project_participants.filter(
                    (p) => p.pra_id !== +selectedParticipant,
                );
                selectedParticipant = null; // Limpiar selección
                callsheetCast = [...callsheetCast]; // Forzar reactividad
            }
        }
    };

    // Función para eliminar un participante de callsheet_cast y devolverlo a project_participants
    const removeParticipant = (pra_id) => {
        const participant = callsheetCast.find((p) => p.pra_id === pra_id);
        if (participant) {
            project_participants.push(participant);
            callsheetCast = callsheetCast.filter((p) => p.pra_id !== pra_id);
            project_participants = [...project_participants]; // Forzar reactividad
        }
    };

    const handleSubmit = () => {
        router.post(
            "/dashboard/projects/admin/callsheets/addCast",
            {
                callsheet_cast: JSON.stringify(callsheetCast),
                callsheet_id: callsheet_id,
                project_id: project_id,
            },
            {
                onSuccess: () => {
                    callsheetCast = [];
                },
            },
        );
    };
</script>

<!-- Botón para abrir el modal -->
<label for="add-cast-modal" class="btn btn-primary">Agregar Cast</label>

<!-- Modal -->
<input type="checkbox" id="add-cast-modal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Add Callsheet Cast</h3>
        <form on:submit|preventDefault={handleSubmit} class="space-y-4">
            <div class="form-control flex flex-row items-center gap-4">
                <!-- Select para elegir participantes -->
                <select
                    bind:value={selectedParticipant}
                    class="select select-bordered flex-grow"
                >
                    <option value="" disabled selected>
                        Choose a participant
                    </option>
                    {#each project_participants as participant}
                        <option value={participant.pra_id}>
                            {participant.user_name} ({participant.role_name})
                        </option>
                    {/each}
                </select>

                <!-- Botón para agregar a callsheet_cast -->
                <button
                    type="button"
                    on:click|preventDefault={addParticipant}
                    class="btn btn-secondary"
                >
                    Add
                </button>
            </div>

            <!-- Lista de participantes seleccionados -->
            <ul class="space-y-2">
                {#each callsheetCast as participant}
                    <li
                        class="flex justify-between items-center p-2 bg-gray-100 rounded"
                    >
                        <span>
                            {participant.user_name} ({participant.role_name})
                        </span>
                        <button
                            type="button"
                            on:click={() =>
                                removeParticipant(participant.pra_id)}
                            class="btn btn-error btn-xs"
                        >
                            Remove
                        </button>
                    </li>
                {/each}
            </ul>

            <!-- Botón de enviar -->
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Submit</button>
                <label for="add-cast-modal" class="btn">Close</label>
            </div>
        </form>
    </div>
</div>
