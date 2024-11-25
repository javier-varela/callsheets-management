<script>
    import CardProject from "./Components/CardProject.svelte";
    import Pagination from "../../Layouts/Pagination.svelte";
    import { inertia } from "@inertiajs/svelte";
    export let data;
    $: projects = data.data;
    $: links = data.links;
</script>

<h1>Mis Proyectos</h1>
<a href="/dashboard/projects/create" use:inertia class="btn mt-4">
    Crear Proyecto
</a>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2 w-full mt-4">
    {#each data.data as project}
        <CardProject {project} />
    {/each}
</div>

<Pagination {links} />
