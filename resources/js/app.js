require('./bootstrap');

import Vue from 'vue';

import { App, plugin } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import { InertiaProgress } from '@inertiajs/progress';
import VueMeta from 'vue-meta';

Vue.mixin({ methods: { route } });
Vue.use(plugin);
Vue.use(InertiaForm);
Vue.use(PortalVue);

Vue.use(VueMeta);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(App, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => import( /* webpackChunkName: "[request]_[index]" */ `@/Pages/${name}`).then(module => module.default),
            },
        }),
}).$mount(app);

InertiaProgress.init({
    showSpinner: true,
});
