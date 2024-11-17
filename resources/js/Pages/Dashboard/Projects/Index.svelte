<script>
    import CardProject from "./Components/CardProject.svelte";
    import { inertia } from "@inertiajs/svelte";
    export let projects;
    console.log(projects);
</script>

<a href="/dashboard/projects/create" use:inertia class="btn">Crear Proyecto</a>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 w-full">
    {#each projects as project}
        <CardProject {project} />
    {/each}
</div>
