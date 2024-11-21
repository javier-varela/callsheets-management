<script>
    import CardProject from "./Components/CardProject.svelte";
    import CardColaborateProject from "./Components/CardColaborateProject.svelte";
    import { inertia } from "@inertiajs/svelte";
    export let projects;
    export let colaborate_projects;
    console.log(colaborate_projects);
</script>

<h1 class="">Mis Proyectos</h1>
<a href="/dashboard/projects/create" use:inertia class="btn">Crear Proyecto</a>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 w-full">
    {#each projects as project}
        <CardProject {project} />
    {/each}
</div>
{#if colaborate_projects}
    <div class="divider">Otros Proyectos</div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 w-full">
        {#each colaborate_projects as project}
            <CardColaborateProject {project} />
        {/each}
    </div>
{/if}
