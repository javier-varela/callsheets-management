<script>
    import { inertia } from "@inertiajs/svelte";
    export let href;
    export let callsheet;
</script>

<a
    use:inertia
    {href}
    class="card w-full bg-white shadow rounded-lg border-gray-50 border hover:shadow-md"
>
    <div class="card-body">
        <h2 class="card-title text-xl font-semibold text-gray-800">
            {callsheet.title}
        </h2>
        <span class="text-sm text-gray-600">
            Instrucciones: {callsheet.instructions}
        </span>
        <span class="text-sm text-gray-600">
            fecha de inicio: {new Date(
                callsheet.start_date,
            ).toLocaleDateString()}
        </span>
    </div>
</a>
