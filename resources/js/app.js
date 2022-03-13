require('./bootstrap');

import app_mixin from './app_mixin';

import { createApp, h } from 'vue';

import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

import * as Sentry from "@sentry/vue";
import { BrowserTracing } from "@sentry/tracing";
import VueFinalModal from 'vue-final-modal'
import VueSocialSharing from 'vue-social-sharing'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { SearchIcon } from '@heroicons/vue/outline'
import { XIcon } from '@heroicons/vue/solid'

import Layout from './Shared/Layout.vue';
import PaginatedProperties from './components/Property/PaginatedProperties.vue'

import '../css/swal_styles.css';

createInertiaApp({
    resolve: name => {
        const page = require(`./Pages/${name}`).default
        page.layout = page.layout || Layout
        return page
    },
    setup({ el, App, props, plugin }) {
      const app = createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(VueFinalModal())
        .use(VueSocialSharing)
        .use(VueSweetalert2)

        app.component('SearchIcon', SearchIcon);
        app.component('XIcon', XIcon);
        app.component('PaginatedProperties', PaginatedProperties);
        app.component('Link', Link);
        app.component('Head', Head);
        app.mixin(app_mixin)
        app.mixin({ methods: { route } })

        app.mount(el)
    },
})

InertiaProgress.init({
    // showSpinner: true,
    color: '#4568ED',
})

if (process.env.MIX_APP_ENV === 'production') {

    Sentry.init({
        app,
        dsn: "https://012dbc3113ca4d708f43f2aec3f8dfb0@o1135206.ingest.sentry.io/6187882",
        integrations: [
          new BrowserTracing({
            tracingOrigins: ["localhost", "efiehub.com", /^\//],
          }),
        ],
        // Set tracesSampleRate to 1.0 to capture 100%
        // of transactions for performance monitoring.
        // We recommend adjusting this value in production
        tracesSampleRate: 0.1,
        logErrors: true,
    });
}