<script>
    import { router } from "@inertiajs/svelte";
    export let errors;

    // Definir los valores iniciales del formulario
    let values = {
        title: "",
    };

    let users = [];

    // Manejo del submit del formulario
    function handleSubmit() {
        router.post("/dashboard/projects", values, {
            onError: (error) => {
                console.log(error);
            },
        });
    }
</script>

<div class=" mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Crear Proyecto</h2>

    <form on:submit|preventDefault={handleSubmit}>
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium">Título</label>
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

        <button type="submit" class="btn w-full btn-active">
            Crear Proyecto
        </button>
    </form>
</div>
