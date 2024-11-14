<script>
    import { createEventDispatcher } from "svelte";
    import { router } from "@inertiajs/svelte";

    // Lista de usuarios disponibles
    export let users = [];
    export let project_id;

    // Lista de invitados seleccionados
    let invitedUsers = [];

    let selectedUserId;

    const dispatch = createEventDispatcher();

    // Función para agregar un usuario a la lista de invitaciones
    function addUser(userId) {
        const user = users.find((u) => u.id === userId);
        if (user) {
            invitedUsers = [...invitedUsers, user];
            users = users.filter((u) => u.id !== userId); // Elimina del select
        }
    }

    // Función para enviar las invitaciones
    async function sendInvitations() {
        let data = {
            user_ids: invitedUsers.map((user) => user.id),
            project_id: project_id,
        };
        console.log(data);
        router.post("/dashboard/projects/invite", data, {
            onSuccess: () => {
                dispatch("invitationsSent", { success: true });
            },
            onError: (errors) => {
                dispatch("invitationsSent", {
                    false: true,
                    errors: errors,
                });
            },
        });
    }
</script>

<button class="btn" onclick="my_modal_2.showModal()">Invitar Usuarios</button>

<!-- Modal con formulario de invitaciones -->
<dialog id="my_modal_2" class="modal">
    <div class="modal-box text-white">
        <h3 class="text-lg font-bold">Invitar Usuarios</h3>

        <!-- Select para elegir usuarios -->
        <div class="form-control my-4">
            <label class="label">Selecciona un usuario para invitar</label>
            <div class="flex gap-2">
                <select
                    bind:value={selectedUserId}
                    class="select select-bordered w-full"
                >
                    <option value="">Selecciona un usuario</option>
                    {#each users as user}
                        <option value={user.id}
                            >{user.name} - {user.email}</option
                        >
                    {/each}
                </select>
                <button
                    type="button"
                    class="btn btn-primary"
                    on:click={() => addUser(parseInt(selectedUserId))}
                    disabled={!selectedUserId}
                >
                    Agregar
                </button>
            </div>
        </div>

        <!-- Lista de invitados -->
        <div class="my-4">
            <h4 class="font-semibold">Lista de Invitados</h4>
            {#if invitedUsers.length === 0}
                <p class="">
                    No has agregado usuarios a la lista de invitaciones.
                </p>
            {:else}
                <div class="space-y-2">
                    {#each invitedUsers as invited}
                        <div class="card bg-base-200 p-4 shadow-md">
                            <p class="font-medium">{invited.name}</p>
                            <p class="text-sm">{invited.email}</p>
                        </div>
                    {/each}
                </div>
            {/if}
        </div>

        <!-- Botón para enviar las invitaciones -->
        <form on:submit|preventDefault={sendInvitations}>
            <button class="btn btn-success w-full mt-4" type="submit">
                Enviar Invitaciones
            </button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button></button>
    </form>
</dialog>
