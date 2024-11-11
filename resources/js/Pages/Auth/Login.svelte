<script>
    import { router } from "@inertiajs/svelte";

    export let errors;

    // Definir los valores iniciales del formulario
    let values = {
        email: "",
        password: "",
        remember: false,
    };

    let submitErrors = {};

    // Manejo del submit del formulario
    function handleSubmit() {
        router.post("/login", values, {
            onError: (error) => {
                submitErrors = error; // Manejo de los errores devueltos por el servidor
            },
        });
    }
</script>

<svelte:head>
    <title>Login</title>
</svelte:head>

<slot default={"value"} />

<form on:submit|preventDefault={handleSubmit}>
    <!-- Dirección de correo -->
    <div>
        <label for="email">Email:</label>
        <input id="email" type="email" bind:value={values.email} required />
        {#if submitErrors.email}
            <div class="text-red-600 mt-2">{submitErrors.email}</div>
        {/if}
    </div>

    <!-- Contraseña -->
    <div class="mt-4">
        <label for="password">Password:</label>
        <input
            id="password"
            type="password"
            bind:value={values.password}
            required
        />
        {#if submitErrors.password}
            <div class="text-red-600 mt-2">{submitErrors.password}</div>
        {/if}
    </div>

    <!-- Recordar sesión -->
    <div class="block mt-4">
        <label for="remember_me">
            <input
                id="remember_me"
                type="checkbox"
                bind:checked={values.remember}
            />
            <span class="ms-2">Remember me</span>
        </label>
    </div>

    <!-- Acciones -->
    <div class="flex items-center justify-end mt-4">
        <a
            href="/password/request"
            class="underline text-sm text-gray-600 hover:text-gray-900"
        >
            Forgot your password?
        </a>
        <button type="submit" class="ms-3 btn-primary"> Log in </button>
    </div>
</form>
