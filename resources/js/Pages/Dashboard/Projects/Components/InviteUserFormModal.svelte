<script>
    import { createEventDispatcher } from "svelte";
    import { router } from "@inertiajs/svelte";

    let users = [];
    export let project_id;
    let invitedUsers = [];
    let selectedUserId;
    const dispatch = createEventDispatcher();
    let modalOpen = false;

    async function getUsers() {
        try {
            const response = await fetch(`/api/users_to_invite/${project_id}`);
            if (!response.ok) throw new Error("Error al obtener usuarios");
            users = await response.json();
        } catch (error) {
            console.error("Error al obtener usuarios:", error);
        }
    }

    function addUser(userId) {
        const user = users.find((u) => u.id === userId);
        if (user) {
            invitedUsers = [...invitedUsers, user];
            users = users.filter((u) => u.id !== userId);
        }
    }

    async function sendInvitations() {
        const data = {
            user_ids: invitedUsers.map((user) => user.id),
            project_id: project_id,
        };
        router.post("/dashboard/projects/invite", data, {
            onSuccess: () => {
                dispatch("invitationsSent", { success: true });
                modalOpen = false; // Cerrar modal al éxito
            },
            onError: (errors) => {
                dispatch("invitationsSent", { success: false, errors: errors });
            },
        });
    }
</script>

<!-- Botón para abrir el modal -->
<label for="invite_modal" class="btn">Invitar Usuarios</label>

<!-- Modal controlado por checkbox -->
<input
    type="checkbox"
    id="invite_modal"
    class="modal-toggle"
    bind:checked={modalOpen}
/>

<!-- Modal -->
<div class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Invitar Usuarios</h3>

        <div class="form-control my-4">
            <label class="label">Selecciona un usuario para invitar</label>
            <div class="flex gap-2">
                {#await getUsers()}
                    <p>...cargando usuarios</p>
                {:then}
                    <select
                        bind:value={selectedUserId}
                        class="select select-bordered w-full"
                    >
                        <option selected disabled value=""
                            >Selecciona un usuario</option
                        >
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
                {/await}
            </div>
        </div>

        <div class="my-4">
            <h4 class="font-semibold">Lista de Invitados</h4>
            {#if invitedUsers.length === 0}
                <p>No has agregado usuarios a la lista de invitaciones.</p>
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
        <div class="modal-action">
            <form on:submit|preventDefault={sendInvitations}>
                <button class="btn btn-success" type="submit">
                    Enviar Invitaciones
                </button>
            </form>
            <label for="invite_modal" class="btn btn-warning">Close!</label>
        </div>
    </div>

    <!-- Botón para cerrar el modal -->
    <label class="modal-backdrop" for="invite_modal">Close</label>
</div>
