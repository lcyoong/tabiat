import './bootstrap';

import route from 'ziggy';
import { ZiggyVue, Ziggy } from 'ziggy';
import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import Layout from "./Shared/Layout";
import ValidationError from "@/Shared/ValidationError";
import { SetupCalendar } from 'v-calendar';

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
        .use(SetupCalendar, {})
        .component('Link', Link)
        .component('ValidationError', ValidationError)
        .directive("click-outside", clickOutside)
        .mount(el);    
    },
})
  
import { InertiaProgress } from '@inertiajs/progress'
InertiaProgress.init({
    color: 'red',
})
// End - Inertia
  