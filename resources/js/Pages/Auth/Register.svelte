<script>
    import { router } from "@inertiajs/svelte";

    // Definir los valores iniciales del formulario
    let values = {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    };

    let errors = {};

    // Manejo del submit del formulario
    function handleSubmit() {
        router.post("/register", values, {
            onError: (error) => {
                errors = error; // Capturar y mostrar los errores
            },
            onSuccess: () => {},
        });
    }
</script>

<form on:submit|preventDefault={handleSubmit}>
    <!-- Nombre -->
    <div>
        <label for="name">Name</label>
        <input
            id="name"
            type="text"
            bind:value={values.name}
            required
            autocomplete="name"
        />
        {#if errors.name}
            <div class="text-red-600 mt-2">{errors.name}</div>
        {/if}
    </div>

    <!-- Dirección de correo -->
    <div class="mt-4">
        <label for="email">Email</label>
        <input
            id="email"
            type="email"
            bind:value={values.email}
            required
            autocomplete="username"
        />
        {#if errors.email}
            <div class="text-red-600 mt-2">{errors.email}</div>
        {/if}
    </div>

    <!-- Contraseña -->
    <div class="mt-4">
        <label for="password">Password</label>
        <input
            id="password"
            type="password"
            bind:value={values.password}
            required
            autocomplete="new-password"
        />
        {#if errors.password}
            <div class="text-red-600 mt-2">{errors.password}</div>
        {/if}
    </div>

    <!-- Confirmar Contraseña -->
    <div class="mt-4">
        <label for="password_confirmation">Confirm Password</label>
        <input
            id="password_confirmation"
            type="password"
            bind:value={values.password_confirmation}
            required
            autocomplete="new-password"
        />
        {#if errors.password_confirmation}
            <div class="text-red-600 mt-2">
                {errors.password_confirmation}
            </div>
        {/if}
    </div>

    <!-- Acciones -->
    <div class="flex items-center justify-end mt-4">
        <a
            href="/login"
            class="underline text-sm text-gray-600 hover:text-gray-900"
        >
            Already registered?
        </a>
        <button type="submit" class="ms-4 btn-primary"> Register </button>
    </div>
</form>
