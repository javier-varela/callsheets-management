<script>
    import { router } from "@inertiajs/svelte";

    export let roles; // Lista de roles disponibles
    export let assignment_id; // ID de la asignación

    let selectedRoles = []; // Roles seleccionado para asignar
    let modalOpen = false;
    let assignedRoles = []; // Roles que se han asignado
    let selectedRole;
    function sendAssignments() {
        // Aquí puedes enviar los roles asignados a un servidor o hacer cualquier otra lógica
        let roles = assignedRoles.map((role) => role.id);
        console.log(roles);
        router.post(
            "assign_role",
            {
                assignment_id: assignment_id, // ID de la asignación
                roles_ids: JSON.stringify(roles), // Solo el ID de los roles asignados
            },
            {
                onSuccess: () => {
                    modalOpen = false;
                    assignedRoles = [];
                },
            },
        );
    }

    function addRole(roleId) {
        // Verifica si el rol ya está en la lista de roles asignados
        const role = roles.find((r) => r.id === roleId); // Busca el rol por su ID
        if (role && !assignedRoles.some((r) => r.id === roleId)) {
            // Si el rol no está en la lista, lo agrega
            assignedRoles = [...assignedRoles, role];
        }
    }
</script>

<!-- Botón para abrir el modal -->
<label for="role_modal" class="btn">Asignar Roles</label>

<!-- Modal controlado por checkbox -->
<input
    type="checkbox"
    id="role_modal"
    class="modal-toggle"
    bind:checked={modalOpen}
/>

<!-- Modal -->
<div class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Asignar Roles</h3>

        <div class="form-control my-4">
            <label class="label">Selecciona un rol para asignar</label>
            <div class="flex gap-2">
                <select
                    bind:value={selectedRole}
                    class="select select-bordered w-full"
                >
                    <option selected disabled value="">Selecciona un rol</option
                    >
                    {#each roles as role}
                        <option value={role.id}>{role.name}</option>
                    {/each}
                </select>
                <button
                    type="button"
                    class="btn btn-primary"
                    on:click={() => addRole(selectedRole)}
                    disabled={!selectedRole}
                >
                    Agregar
                </button>
            </div>
        </div>

        <div class="my-4">
            <h4 class="font-semibold">Roles Asignados</h4>
            {#if assignedRoles.length === 0}
                <p>No has asignado roles aún.</p>
            {:else}
                <div class="space-y-2">
                    {#each assignedRoles as role}
                        <div class="card bg-base-200 p-4 shadow-md">
                            <p class="font-medium">{role.name}</p>
                        </div>
                    {/each}
                </div>
            {/if}
        </div>

        <div class="modal-action">
            <form on:submit|preventDefault={sendAssignments}>
                <button class="btn btn-success" type="submit">
                    Enviar Asignaciones
                </button>
            </form>
            <label for="role_modal" class="btn btn-warning">Cerrar</label>
        </div>
    </div>

    <!-- Botón para cerrar el modal -->
    <label class="modal-backdrop" for="role_modal">Cerrar</label>
</div>
