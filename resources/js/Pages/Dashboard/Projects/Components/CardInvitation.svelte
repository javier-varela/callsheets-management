<script>
    export let invitation;
    const statusClasses = {
        none: "bg-gray-400 text-white", // Estado "pendiente"
        accepted: "bg-green-500 text-white", // Estado "aceptado"
        declined: "bg-red-500 text-white", // Estado "rechazado"
    };
</script>

<div class="card bg-base-200 p-4 shadow-md">
    <div class="card-body">
        <h3 class="card-title">{invitation.invited_name}</h3>
        <p>Email: {invitation.invited_email}</p>
        <span
            class={`badge ${statusClasses[invitation.status]} py-1 px-2 rounded-md text-sm`}
        >
            {invitation.status.charAt(0).toUpperCase() +
                invitation.status.slice(1)}
        </span>
        <p>Enviado por: {invitation.sender_id}</p>
    </div>
</div>
