<script>
    import { router } from "@inertiajs/svelte";
    import { onMount } from "svelte";
    export let errors;

    export let project;
    export let users;
    console.log(users);

    // Definir los valores iniciales del formulario
    let values = {
        title: "",
    };

    // Manejo del submit del formulario
    function handleSubmit() {
        router.post("/dashboard/projects", values, {
            onError: (error) => {
                console.log(error);
            },
        });
    }
</script>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Editar Proyecto</h2>

    <form on:submit|preventDefault={handleSubmit}>
        <div class="mb-4">
            <h3 for="title" class="block text-sm font-medium">Título</h3>
            <input
                id="title"
                type="text"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                bind:value={values.title}
                placeholder="Título del proyecto"
                required
            />
            {#if errors?.title}
                <p class="text-red-500 text-xs mt-1">{errors.title}</p>
            {/if}
        </div>

        <button
            type="submit"
            class="w-full py-2 px-4 bg-blue-500 rounded-md hover:bg-blue-600"
        >
            Crear Proyecto
        </button>
    </form>
</div>
