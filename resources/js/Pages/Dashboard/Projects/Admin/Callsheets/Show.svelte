<script>
    import CardEvent from "./Components/CardEvent.svelte";
    import AddCallsheetCastFormModal from "./Components/AddCallsheetCastFormModal.svelte";
    import AddEventsFormModal from "./Components/AddEventsFormModal.svelte";
    import Map from "./Components/Map.svelte";
    export let events;
    export let project_participants;
    export let callsheet_id;
    export let project_id;
    export let callsheet_cast;
    export let callsheet;
    console.log(callsheet);
</script>

<h1>{callsheet.title}</h1>
<p>{callsheet.instructions}</p>
<Map latitud={callsheet.latitud} longitud={callsheet.longitud} zoom={17} />

<div class="divider">Participantes</div>
<AddCallsheetCastFormModal {project_id} {callsheet_id} {project_participants} />
<div>
    {#each callsheet_cast as cast}
        <div class="card w-96 bg-base-100 shadow-xl mb-4">
            <div class="card-body">
                <h2 class="card-title">Callsheet ID: {cast.callsheet_id}</h2>
                <p><strong>ID:</strong> {cast.id}</p>
                <p><strong>Instructions:</strong> {cast.instructions}</p>
                <p>
                    <strong>Usuario: </strong>
                    {cast.user_name}
                </p>
                <p>
                    <strong>Project Role: </strong>
                    {cast.project_role_name}
                </p>
            </div>
        </div>
    {/each}
</div>
<div class="divider">Eventos</div>
<AddEventsFormModal {project_id} {callsheet_id} {callsheet_cast} />
{#each events as event}
    <CardEvent {event} />
{/each}
