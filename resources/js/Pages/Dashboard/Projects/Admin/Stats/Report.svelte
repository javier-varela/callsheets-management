<script>
    import { router } from "@inertiajs/svelte";

    export let date_start;
    export let date_end;
    export let report;

    console.log(report);

    // Extraer solo la parte de la fecha en formato YYYY-MM-DD
    function formatDate(isoDate) {
        return isoDate.split("T")[0];
    }

    // Función para manejar cambios en el date picker
    // Función para manejar cambios en el date picker
    function handleDateChange(event, type) {
        if (type === "start") {
            date_start = event.target.value + "T00:00"; // Mantén formato ISO con tiempo fijo
        } else if (type === "end") {
            date_end = event.target.value + "T00:00"; // Mantén formato ISO con tiempo fijo
        }
    }

    const reloadData = () => {
        router.reload({
            data: {
                date_start,
                date_end,
            },
            onFinish: () => {
                console.log(report);
            },
        });
    };
</script>

<!-- Selector de Fecha Inicial -->
<div>
    <label for="date_start" class="label">
        <span class="label-text">Start Date</span>
    </label>
    <input
        id="date_start"
        type="date"
        value={formatDate(date_start)}
        on:change={(e) => {
            handleDateChange(e, "start");
            reloadData();
        }}
        class="input input-bordered w-full"
    />
</div>

<!-- Selector de Fecha Final -->
<div>
    <label for="date_end" class="label">
        <span class="label-text">End Date</span>
    </label>
    <input
        id="date_end"
        type="date"
        value={formatDate(date_end)}
        on:change={(e) => handleDateChange(e, "end")}
        class="input input-bordered w-full"
    />
</div>

<div class="divider">Reporte</div>

<div class="flex flex-col gap-3">
    {#each report as item}
        <div class="flex flex-col gap-1">
            <span>usuario: {item.user_id}</span>
            <span>efectividad promedio: {item.average_effectivity}</span>
        </div>

        {#each item.events as event}
            <div class="border">
                <span>event id: {event.event_id}</span>
                <span>efectividad: {event.effectivity}</span>
                <span>start date: {event.start_date}</span>
            </div>
        {/each}
    {/each}
</div>
