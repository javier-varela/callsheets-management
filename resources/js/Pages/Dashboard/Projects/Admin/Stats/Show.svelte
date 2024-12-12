<script>
    import { router, page } from "@inertiajs/svelte";
    import ResolveEventModal from "./Components/ResolveEventModal.svelte";
    export let participants;
    export let project_roles;
    export let callsheets;
    export let project_id;
    export let project_efectivity;
    let user_id;

    let selected_roles = project_roles.map((role) => role.id);
    console.log(callsheets);

    const handleSelectUsersChange = async () => {
        await reloadProjectRoles();
        reloadCallsheets();
    };

    const toggleRoles = (role) => {
        if (selected_roles.includes(role.id))
            selected_roles = selected_roles.filter((i) => i !== role.id); // Eliminar de la lista si está seleccionado
        else selected_roles = [...selected_roles, role.id]; // Añadir a la lista si no está seleccionado

        if (selected_roles.length > 0) reloadCallsheets();
        else {
            callsheets = [];
        }
    };

    const reloadProjectRoles = async () => {
        return new Promise((resolve) => {
            router.reload({
                only: ["project_roles"],
                data: {
                    request_roles: JSON.stringify(selected_roles),
                    user_id: user_id,
                },
                onFinish: () => {
                    selected_roles = project_roles.map((role) => role.id);
                    console.log(selected_roles);
                    resolve();
                },
            });
        });
    };

    const reloadCallsheets = () => {
        router.reload({
            only: ["callsheets", "project_efectivity"],
            data: {
                request_roles: JSON.stringify(selected_roles),
                user_id: user_id,
            },
            onFinish: () => {
                console.log(callsheets);
            },
        });
    };
</script>

<h1>Efectividad total : {project_efectivity} %</h1>

<select
    bind:value={user_id}
    on:change={handleSelectUsersChange}
    name="select_usuarios"
    id="select_usuarios"
>
    <option value={null} selected>todos los usuarios</option>
    {#each participants as participant}
        <option value={participant.user_id}>{participant.user_name}</option>
    {/each}
</select>
{#if selected_roles}
    {#each project_roles as role}
        <div>
            <label>
                <input
                    type="checkbox"
                    checked={selected_roles.includes(role.id)}
                    on:change={() => toggleRoles(role)}
                />
                {role.name}
            </label>
        </div>
    {/each}
{/if}

{#each callsheets as callsheet, index}
    <div class="collapse collapse-arrow bg-base-200 mt-2">
        <input class="" type="radio" name="my-accordion-{index}" />
        <div class="collapse-title text-xl">
            {callsheet.title}
            <span class="block text-base"
                >Fecha Incio: {callsheet.start_date}</span
            >
        </div>

        <div class="collapse-content">
            {#each callsheet.events as event}
                <div class="divider"></div>
                <div class={`flex flex-col bg-white`}>
                    <span>event id: {event.id}</span>
                    <span>status: {event.status}</span>
                    <span>hora inicio: {event.start_hour}</span>
                    <span>tiempo estimado: {event.stimated_hours}</span>
                    {#if event.status === "resolved"}
                        <span>
                            tiempo usado: {event.taked_time}
                        </span>
                        <span>
                            efectividad: {event.efectivity}
                        </span>
                    {:else}
                        <ResolveEventModal {project_id} {event} />
                    {/if}
                </div>
            {/each}
        </div>
    </div>
{:else}
    <!-- empty list -->
{/each}
