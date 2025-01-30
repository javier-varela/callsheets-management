<script>
    import CreateCallsheetFormModal from "./Components/CreateCallsheetFormModal.svelte";
    import { AccordionItem, Accordion } from "flowbite-svelte";
    import Card from "./Components/Card.svelte";
    import Map from "./Components/Map.svelte";
    export let callsheets;
    export let project_id;
    console.log(callsheets);
</script>

<CreateCallsheetFormModal {project_id} />

<h1>callsheets</h1>

{#each callsheets as callsheet}
    <Card
        href="/dashboard/projects/admin/{project_id}/callsheets/{callsheet.id}"
        {callsheet}
    />
{/each}
