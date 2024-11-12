import { createInertiaApp } from "@inertiajs/svelte";
import Layout from "./Pages/Layouts/Layout.svelte";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.svelte", { eager: true });
        console.log("Page name: ", name);
        let page = pages[`./Pages/${name}.svelte`];

        // Asigna el layout global si no está definido en la página
        return { default: page.default, layout: page.layout || Layout };
    },
    setup({ el, App, props }) {
        new App({ target: el, props });
    },
});
