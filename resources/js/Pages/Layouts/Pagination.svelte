<script>
    import { inertia } from "@inertiajs/svelte";
    export let links;
</script>

<div class="join mt-4">
    {#each links as link}
        <button
            use:inertia={{ href: link.url, method: "get" }}
            class="join-item btn {link.active ? 'btn-primary' : ''} {link.url
                ? ''
                : 'btn-disabled'}"
            type="button"
            disabled={!link.url}
        >
            {@html link.label}
        </button>
    {/each}
</div>
