<script>
    import InviteUserFormModal from "./Components/InviteUserFormModal.svelte";
    import CardInvitation from "./Components/CardInvitation.svelte";
    import CardParticipant from "./Components/CardParticipant.svelte";
    export let project;
    export let invitations;
    export let participants;
    console.log(participants);
</script>

<div class="my-4">
    <div class="divider">Participantes</div>
    {#if participants && participants.length > 0}
        <div class="grid gap-4">
            {#each participants as participant}
                <!-- Card para cada invitación -->
                <CardParticipant {participant} />
            {/each}
        </div>
    {:else}
        <p class="">No hay participantes para este proyecto.</p>
    {/if}
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
