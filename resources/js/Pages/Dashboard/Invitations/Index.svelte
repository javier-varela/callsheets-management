<script>
    import CardInvitationForm from "./Components/CardInvitationForm.svelte";
    export let invitations;

    console.log(invitations);
</script>

<!-- Lista de tarjetas de invitación -->
<div class="space-y-4">
    {#each invitations as invitation}
        <CardInvitationForm {invitation} />
    {/each}
</div>
