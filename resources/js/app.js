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
import {
    createStore
} from 'vuex';

import {
    track
} from './store/track.js';


const store = createStore({
    modules: {
        track
    }
})

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({
        el,
        App,
        props,
        plugin
    }) {
        const clickOutside = {
            beforeMount: (el, binding) => {
                el.clickOutsideEvent = event => {
                    // here I check that click was outside the el and his children
                    if (!(el == event.target || el.contains(event.target))) {
                        // and if it did, call method provided in attribute value
                        binding.value();
                    }
                };
                document.addEventListener("click", el.clickOutsideEvent);
            },
            unmounted: el => {
                document.removeEventListener("click", el.clickOutsideEvent);
            },
        };

        const app = createApp({
            render: () => h(App, props)
        });

        app.directive("click-outside", clickOutside);

        app.config.globalProperties.$route = route

        app.use(plugin)
            .component("Link", Link)
            .use(store)
            .mount(el)


    },
})
