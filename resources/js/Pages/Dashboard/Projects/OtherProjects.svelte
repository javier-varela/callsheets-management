<script>
    import CardColaborateProject from "./Components/CardColaborateProject.svelte";
    import Pagination from "../../Layouts/Pagination.svelte";
    import { inertia } from "@inertiajs/svelte";

    export let data;

    $: projects = data.data;
    $: links = data.links;
</script>

<h1 class=" text-2xl">Otros Proyectos</h1>

{#if projects}
    <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full mt-3"
    >
        {#each projects as project}
            <CardColaborateProject {project} />
        {/each}
    </div>
{/if}
<Pagination {links} />
