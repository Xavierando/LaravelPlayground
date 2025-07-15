import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';
//import '@mdi/font/css/materialdesignicons.css';
//import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import { createMemoryHistory, createRouter } from 'vue-router';
import { it, enUS } from 'date-fns/locale';
import DateFnsAdapter from '@date-io/date-fns'

import HomeView from '@/layouts/route/index.vue';
import BookingView from '@/layouts/route/booking.vue';
import Login from './pages/auth/Login.vue';

const vuetify = createVuetify({
    date: {
        adapter: DateFnsAdapter,
        locale: {
            en: enUS,
            it: it,
        },
    },
    treeShake: true
})

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const routes = [
    // existing routes
    {
        path: '/',
        component: HomeView,
    },
    {
        path: '/booking/:service',
        component: BookingView,
    },
    {
        path: '/login',
        component: Login,
    },
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
})

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(router)
            .use(vuetify)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
