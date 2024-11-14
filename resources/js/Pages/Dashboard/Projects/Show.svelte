<script>
    import InviteUserFormModal from "../Components/InviteUserFormModal.svelte";
    export let project;
    export let users;
    export let invitations;

    console.log(invitations);
</script>

<div class="my-4">
    <h2 class="text-2xl font-bold mb-4">
        Invitaciones del Proyecto: {project.name}
    </h2>

    {#if invitations && invitations.length > 0}
        <div class="grid gap-4 text-white">
            {#each invitations as invitation}
                <!-- Card para cada invitación -->
                <div class="card bg-base-200 p-4 shadow-md">
                    <div class="card-body">
                        <h3 class="card-title">{invitation.invited_name}</h3>
                        <p>Email: {invitation.invited_email}</p>
                        <p>
                            Status: <span class="badge"
                                >{invitation.status}</span
                            >
                        </p>
                        <p>Enviado por: {invitation.sender_id}</p>
                    </div>
                </div>
            {/each}
        </div>
    {:else}
        <p class="text-gray-500">No hay invitaciones para este proyecto.</p>
    {/if}
</div>
<InviteUserFormModal
    on:invitationsSent={(e) => console.log(e)}
    project_id={project.id}
    {users}
/>
