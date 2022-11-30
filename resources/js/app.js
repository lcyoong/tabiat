import './bootstrap';

import route from 'ziggy';
import { ZiggyVue, Ziggy } from 'ziggy';
import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import Layout from "./Shared/Layout";
import ValidationError from "@/Shared/ValidationError";

// Start - Inertia
createInertiaApp({
    // title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = require(`./Pages/${name}.vue`)
        page.layout = page.layout || Layout
        return page
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
        .use(plugin)
        .use(ZiggyVue, Ziggy)
        .component('Link', Link)
        .component('ValidationError', ValidationError)
        .mount(el);    
    },
})
  
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init({
    color: 'red',
})
// End - Inertia
  