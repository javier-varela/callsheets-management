<script>
    import { inertia } from "@inertiajs/svelte";
    export let event;
    export let href;
    function floatToTime(floatValue) {
        const hours = Math.floor(floatValue); // Parte entera como horas
        const minutes = Math.round((floatValue - hours) * 60); // Parte decimal como minutos
        // Formatear con ceros iniciales si es necesario
        return `${hours.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}`;
    }
</script>

<a
    use:inertia
    {href}
    class="card w-full bg-white shadow rounded-lg border-gray-50 border hover:shadow-md"
>
    <div class="card-body">
        <h2 class="card-title text-xl font-semibold text-gray-800">
            Event id: {event.id}
        </h2>
        <span class="text-sm text-gray-600">
            Instrucciones: {event.description}
        </span>
        <span class="text-sm text-gray-600">
            Hora Inicio: {floatToTime(event.start_hour)}
        </span>
        <span class="text-sm text-gray-600">
            Horas Estimadas: {event.stimated_hours}
        </span>
        <span class="text-sm text-gray-600">
            status: {event.status}
        </span>
    </div>
</a>
