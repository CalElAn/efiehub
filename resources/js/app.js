require('./bootstrap');

import app_mixin from './app_mixin';

import { createApp, defineAsyncComponent, markRaw, computed } from 'vue';

import * as Sentry from "@sentry/vue";
import { BrowserTracing } from "@sentry/tracing";
import VueFinalModal from 'vue-final-modal'
import Notifications from '@kyvg/vue3-notification' //types are success, warn, error
import VueProgressBar from "@aacassandra/vue3-progressbar";
import VueSocialSharing from 'vue-social-sharing'
import Pagination from 'v-pagination-3';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { SearchIcon } from '@heroicons/vue/outline'
import { XIcon } from '@heroicons/vue/solid'

import NavBar from './components/NavBar/NavBar.vue';
import MobileNavBar from './components/NavBar/MobileNavBar.vue';
import LogInModal from './components/Modals/LogInModal.vue';
import SignUpModal from './components/Modals/SignUpModal.vue';
import SharePropertyModal from './components/Modals/SharePropertyModal.vue';

window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content') //move to mixin

import '../css/swal_styles.css';

const app = 
    createApp({
        components: {
            NavBar,
            MobileNavBar,
            LogInModal,
            SignUpModal,
            SharePropertyModal,

            LargeSearchBar: defineAsyncComponent( () =>
                import('./components/SearchBar/LargeSearchBar.vue') ),
            MobileSearchBar: defineAsyncComponent( () =>
                import('./components/SearchBar/MobileSearchBar.vue') ),
            PropertyCard: defineAsyncComponent( () =>
                import('./components/Property/Card.vue') ),
            CreateOrEditProperty: defineAsyncComponent( () =>
                import('./components/Property/CreateOrEdit.vue') ),
            SearchProperty: defineAsyncComponent( () =>
                import('./components/Property/Search.vue') ),
            ShowProperty: defineAsyncComponent( () =>
                import('./components/Property/Show.vue') ),
            PaginatedProperties: defineAsyncComponent( () =>
                import('./components/Property/PaginatedProperties.vue') ),
            UserCard: defineAsyncComponent( () =>
                import('./components/User/Card.vue') ),
            UserProfileNavBar: defineAsyncComponent( () =>
                import('./components/User/ProfileNavBar.vue') ),
            ProfilePictureUpload: defineAsyncComponent( () =>
                import('./components/User/ProfilePictureUpload.vue') ),
        },

        data() {
            return {
                isScrollYPastSearchBar: false,
                isScrollYPastMainHeader: false,
                placeSearchBarInNavBar: false,

                paginatedProperties: typeof paginatedProperties === 'undefined' ? [] : paginatedProperties,
                searchQuery: typeof searchQuery === 'undefined' ? {} : searchQuery,

                isUserAuthenticated: isUserAuthenticatedVar,
                authenticatedUser: authenticatedUserVar,
            }
        },

        provide() {
            return {
                isUserAuthenticated: computed(() => this.isUserAuthenticated),
                authenticatedUser: computed(() => this.authenticatedUser)
            }
        },

        methods: {
            showMobileSearchBarModal() {
                this.$vfm.show('MobileSearchBarModal')
            },

            onUserHasBeenAuthenticated(user) {
                this.isUserAuthenticated = true
                this.authenticatedUser = user
            },

            updatePropertiesAndSearchQuery(data) {
                this.paginatedProperties = data?.paginatedProperties
                this.searchQuery = data?.searchQuery
            },
        },

        mounted() {
            // console.log(process.env.MIX_APP_ENV)
        }
    });

app.component('SearchIcon', SearchIcon);
app.component('XIcon', XIcon);
app.component('pagination', Pagination);
app.mixin(app_mixin)

app.config.unwrapInjectedRef = true  //remove after updating to vue3.3

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
        tracesSampleRate: 0.0,
        logErrors: true,
    });
}

app.use(VueFinalModal())
    .use(Notifications)
    .use(VueProgressBar, {
        color: "rgb(143, 255, 199)",
        thickness: "5px",
        position: "fixed",
        location: "top",
    })
    .use(VueSocialSharing)
    .use(VueSweetalert2);

app.mount('#app');

