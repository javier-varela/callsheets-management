<script>
    import { inertia } from "@inertiajs/svelte";
    export let project;
</script>

<a
    use:inertia
    href="/dashboard/projects/admin/{project.id}"
    class="card w-full bg-white shadow rounded-lg border-gray-50 border hover:shadow-md"
>
    <div class="card-body">
        <h2 class="card-title text-xl font-semibold text-gray-800">
            {project.title}
        </h2>
        <span class="text-sm text-gray-600">
            Creado el: {new Date(project.created_at).toLocaleDateString()}
        </span>
        <span class="text-sm text-gray-600">
            Última actualización: {new Date(
                project.updated_at,
            ).toLocaleDateString()}
        </span>
    </div>
</a>
