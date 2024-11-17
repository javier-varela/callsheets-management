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

<div
    class="min-h-screen flex flex-col sm:justify-center items-center px-10 pt-6 sm:pt-0 bg-gray-100 font-sans text-gray-900 antialiased"
>
    <div>
        <a href="/">
            <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
        </a>
    </div>

    <div
        class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
    >
        <slot><!-- optional fallback --></slot>
    </div>
</div>
