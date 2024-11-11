<script>
    import { inertia } from "@inertiajs/svelte";
    export let auth;
    export let errors;
    console.log(auth);
    console.log(errors);
</script>

<h1>Dashboard</h1>

<slot></slot>
