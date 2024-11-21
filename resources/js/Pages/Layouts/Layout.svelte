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

<div class="flex flex-col px-10 pt-6 sm:pt-0 bg-slate-50 font-sans antialiased">
    <div>
        <a href="/">
            <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
        </a>
    </div>

    <div
        class="w-full mt-6 px-6 py-4 bg-white shadow-md h-full overflow-hidden"
    >
        <slot><!-- optional fallback --></slot>
    </div>
</div>
