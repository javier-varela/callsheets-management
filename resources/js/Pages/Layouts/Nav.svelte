<script>
    import { inertia } from "@inertiajs/svelte";

    export let user = null; // Usuario autenticado (puedes enlazarlo a tus props)
</script>

<div class="navbar px-6 lg:px-10 bg-slate-200">
    <div class="flex-1">
        <a class="btn btn-ghost text-xl">daisyUI</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li>
                <a href="/" use:inertia>Inicio</a>
            </li>
            {#if user}
                <li>
                    <details class="relative">
                        <summary>Dashboard</summary>
                        <ul
                            class="menu w-56 absolute rounded-none right-0 z-50"
                        >
                            <li>
                                <details>
                                    <summary>Proyectos</summary>
                                    <ul class="menu">
                                        <li>
                                            <a
                                                class=" whitespace-nowrap"
                                                href="/dashboard/projects/my-projects"
                                                use:inertia>Mis proyectos</a
                                            >
                                        </li>
                                        <li>
                                            <a
                                                href="/dashboard/projects/other-projects"
                                                use:inertia>Otros proyectos</a
                                            >
                                        </li>
                                    </ul>
                                </details>
                            </li>
                            <li>
                                <a href="/dashboard/invitations" use:inertia
                                    >Invitaciones</a
                                >
                            </li>
                        </ul>
                    </details>
                </li>
                <li>
                    <button use:inertia={{ href: "/logout", method: "post" }}
                        >Logout</button
                    >
                </li>
            {:else}
                <li>
                    <a href="/login" use:inertia>Login</a>
                </li>
                <li>
                    <a href="/register" use:inertia>Register</a>
                </li>
            {/if}
        </ul>
    </div>
</div>
<!-- 
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
                                >Proyectos</a
                            >
                        </li>
                        <li>
                            <a href="/dashboard/invitations" use:inertia
                                >Invitaciones</a
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
</nav> -->
