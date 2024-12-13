<script>
    import InviteUserFormModal from "../Components/InviteUserFormModal.svelte";
    import CardInvitation from "../Components/CardInvitation.svelte";
    import CardParticipant from "../Components/CardParticipant.svelte";
    import { inertia } from "@inertiajs/svelte";
    export let project;
    export let invitations;
    export let participants;
</script>

<div class="my-4">
    <a
        use:inertia
        class="btn"
        href="/dashboard/projects/admin/{project.id}/callsheets">callsheets</a
    >
    <a
        use:inertia
        class="btn"
        href="/dashboard/projects/admin/stats/{project.id}">Stats</a
    >
    <a
        use:inertia
        class="btn"
        href="/dashboard/projects/admin/report/{project.id}">Report</a
    >
    <div class="divider">Participantes</div>
    {#if participants && participants.length > 0}
        <div class="grid gap-4">
            {#each participants as participant}
                <!-- Card para cada invitación -->
                <CardParticipant
                    href={`/dashboard/projects/admin/participant/${participant.project_assigment_id}`}
                    {participant}
                />
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
<InviteUserFormModal project_id={project.id} />
