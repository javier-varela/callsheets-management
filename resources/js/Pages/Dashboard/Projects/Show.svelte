<script>
    import InviteUserFormModal from "./Components/InviteUserFormModal.svelte";
    import CardInvitation from "./Components/CardInvitation.svelte";
    export let project;
    export let invitations;
</script>

<div class="my-4">
    <h2 class="text-2xl font-bold mb-4">Invitaciones</h2>

    {#if invitations && invitations.length > 0}
        <div class="grid gap-4 text-white">
            {#each invitations as invitation}
                <!-- Card para cada invitación -->
                <CardInvitation {invitation} />
            {/each}
        </div>
    {:else}
        <p class="text-gray-500">No hay invitaciones para este proyecto.</p>
    {/if}
</div>
<InviteUserFormModal
    on:invitationsSent={(e) => console.log(e)}
    project_id={project.id}
/>
