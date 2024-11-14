<script>
    import { inertia } from "@inertiajs/svelte";

    export let user = null; // Usuario autenticado (puedes enlazarlo a tus props)
</script>

<nav class="navbar bg-base-300">
    <div class="flex-1 px-2 lg:flex-none">
        <a href="/" use:inertia class="text-lg font-bold">Logo</a>
    </div>
    <div class="flex flex-1 justify-end px-2">
        <div class="flex items-stretch">
            {#if user}
                <a href="/" use:inertia class="btn btn-ghost rounded-btn"
                    >Inicio</a
                >

                <div class="dropdown dropdown-end">
                    <div
                        tabindex="0"
                        role="button"
                        class="btn btn-ghost rounded-btn"
                    >
                        Dashboard
                    </div>
                    <ul
                        tabindex="0"
                        class="menu dropdown-content bg-base-100 rounded-box z-[1] mt-4 w-52 p-2 shadow"
                    >
                        <li>
                            <a href="/dashboard/projects" use:inertia
                                >Projects</a
                            >
                        </li>
                    </ul>
                </div>
                <button
                    class="btn btn-ghost rounded-btn"
                    use:inertia={{ href: "/logout", method: "post" }}
                    >Logout</button
                >
            {:else}
                <a href="/login" class="btn btn-ghost rounded-btn" use:inertia
                    >Login</a
                >

                <a
                    href="/register"
                    class="btn btn-ghost rounded-btn"
                    use:inertia>Register</a
                >
            {/if}
        </div>
    </div>
</nav>
