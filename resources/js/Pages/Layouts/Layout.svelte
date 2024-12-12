<script>
    import { inertia } from "@inertiajs/svelte";
    import Nav from "./Nav.svelte";
    import FlashMessages from "./FlashMessages.svelte";

    export let auth;
    export let flash;

    $: user = auth.user;
</script>

<FlashMessages {flash} />

<Nav {user} />

<div class="flex flex-col pt-6 sm:pt-0 bg-slate-50 font-sans">
    <aside>
        <nav>
            <ul>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </nav>
    </aside>
    <div
        class="w-full mt-6 px-6 py-4 bg-white shadow-md h-full overflow-hidden"
    >
        <slot><!-- optional fallback --></slot>
    </div>
</div>
