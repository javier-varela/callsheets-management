<script>
    import { inertia } from "@inertiajs/svelte";
    export let invitation;
    // Definimos los estilos del badge según el estado
    const statusClasses = {
        none: "bg-gray-400", // Estado "pendiente"
        accepted: "bg-green-500", // Estado "aceptado"
        declined: "bg-red-500", // Estado "rechazado"
    };
</script>

<div class="card p-4 shadow hover:shadow-md border-gray-50">
    <h3 class="text-lg font-semibold">{invitation.project_title}</h3>
    <p class="text-sm">Fecha de invitación: {invitation.created_at}</p>

    <!-- Badge de estado -->
    <span
        class={`badge ${statusClasses[invitation.status]} py-1 px-2 rounded-md text-sm`}
    >
        {invitation.status.charAt(0).toUpperCase() + invitation.status.slice(1)}
    </span>

    <!-- Botones de acción para aceptar o rechazar -->
    <div class="mt-4 flex gap-4">
        <button
            use:inertia={{
                href: `/dashboard/invitations/accept`,
                method: "post",
                data: {
                    project_id: invitation.project_id,
                    invitation_id: invitation.id,
                    invited_id: invitation.invited_id,
                },
            }}
            class="btn btn-success"
        >
            Aceptar
        </button>
        <button
            use:inertia={{
                href: `/dashboard/invitations/decline/${invitation.id}`,
                method: "post",
                data: {
                    invitation_id: invitation.id,
                },
            }}
            class="btn btn-error">Rechazar</button
        >
    </div>
</div>
