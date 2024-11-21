<script>
    import InviteUserFormModal from "./Components/InviteUserFormModal.svelte";
    import CardInvitation from "./Components/CardInvitation.svelte";
    export let project;
    export let invitations;
    export let assignments;
</script>

<div class="my-4">
    <div class="divider">Invitaciones</div>

    {#if invitations && invitations.length > 0}
        <div class="grid gap-4">
            {#each invitations as invitation}
                <!-- Card para cada invitación -->
                <CardInvitation {invitation} />
            {/each}
        </div>
    {:else}
        <p class="">No hay invitaciones para este proyecto.</p>
    {/if}
</div>
<InviteUserFormModal
    on:invitationsSent={(e) => console.log(e)}
    project_id={project.id}
/>
