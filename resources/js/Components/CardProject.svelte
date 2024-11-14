<script>
    import { inertia } from "@inertiajs/svelte";
    export let project;
</script>

<a
    use:inertia
    href="/dashboard/projects/{project.id}"
    class="card w-full bg-white shadow-lg p-4 rounded-lg"
>
    <div class="card-body">
        <h2 class="card-title text-xl font-semibold text-gray-800">
            {project.title}
        </h2>
        <p class="text-sm text-gray-600">
            Creado el: {new Date(project.created_at).toLocaleDateString()}
            <br />
            Última actualización: {new Date(
                project.updated_at,
            ).toLocaleDateString()}
        </p>
    </div>
</a>
