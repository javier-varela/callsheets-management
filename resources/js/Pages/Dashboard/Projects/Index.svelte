<script>
    import CardProject from "../../../Components/CardProject.svelte";
    export let projects;
</script>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 w-full">
    {#each projects as project}
        <CardProject {project} />
    {/each}
</div>
