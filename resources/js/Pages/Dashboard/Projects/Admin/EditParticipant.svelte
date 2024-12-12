<script>
    import { page } from "@inertiajs/svelte";
    import AsignRoleFormModal from "./Components/AsignRoleFormModal.svelte";
    export let avaliables_roles;
    export let roles_assignments;
    export let assignment_id;

    console.log(roles_assignments);
</script>

<div class="card">
    <span>roles asignados: </span>
    {#each roles_assignments as role}
        {role.name}
    {/each}
</div>

<AsignRoleFormModal {assignment_id} roles={avaliables_roles} />
