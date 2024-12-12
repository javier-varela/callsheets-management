<script>
    import { inertia } from "@inertiajs/svelte";
    export let participant;
    export let href = "";
</script>

<a use:inertia {href} class="card shadow-md w-full max-w-sm">
    <div class="card-body">
        <!-- Mostrar información del participante -->
        {#if participant.user_name}
            <h3 class="card-title text-lg font-bold">
                {participant.user_name}
            </h3>
        {/if}
        {#if participant.nick_name}
            <span class="text-sm text-gray-500"> {participant.nick_name}</span>
        {/if}
        <!-- <span class="block text-sm">Rol: {participant.role_name}</span> -->

        <!-- Botones de acciones -->
        <div class="mt-4 flex gap-2">
            <button class="btn btn-warning btn-sm"> Eliminar </button>
        </div>
    </div>
</a>
