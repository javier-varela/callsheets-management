<script>
    import { inertia } from "@inertiajs/svelte";

    export let user = null; // Usuario autenticado (puedes enlazarlo a tus props)
</script>

<nav class="nav">
    {#if user}
        <a href="/dashboard" class="nav-link" use:inertia>Dashboard</a>
        <button use:inertia={{ href: "/logout", method: "post" }} type="button"
            >Logout</button
        >
    {:else}
        <a href="/login" class="nav-link" use:inertia>Login</a>

        <a href="/register" class="nav-link" use:inertia>Register</a>
    {/if}
</nav>
