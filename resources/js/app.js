require('./bootstrap');

import {
    createApp,
    h
} from 'vue';
import {
    createInertiaApp,
    Link
} from '@inertiajs/inertia-vue3'
import Toggle from "./Shared/Toggle";

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({
        el,
        App,
        props,
        plugin
    }) {
        createApp({
                render: () => h(App, props)
            })
            .use(plugin)
            .component("Link", Link)
            .mount(el)
    },
})
