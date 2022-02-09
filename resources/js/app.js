require('./bootstrap');

import app_mixin from './app_mixin';

import { createApp, defineAsyncComponent, markRaw } from 'vue';

import * as Sentry from "@sentry/vue";
import { BrowserTracing } from "@sentry/tracing";
import VueFinalModal from 'vue-final-modal'
import Notifications from '@kyvg/vue3-notification' //types are success, warn, error
import VueProgressBar from "@aacassandra/vue3-progressbar";
import VueSocialSharing from 'vue-social-sharing'
import Pagination from 'v-pagination-3';

import { SearchIcon } from '@heroicons/vue/outline'

import NavBar from './components/NavBar/NavBar.vue';
import MobileNavBar from './components/NavBar/MobileNavBar.vue';
import LogInModal from './components/Modals/LogInModal.vue';
import SignUpModal from './components/Modals/SignUpModal.vue';
import SharePropertyModal from './components/Modals/SharePropertyModal.vue';
import CustomPagination from './components/CustomPagination.vue'

window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content') //move to mixin

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
                import('./components/PropertyCard.vue') ),
            AddProperty: defineAsyncComponent( () =>
                import('./components/AddProperty.vue') ),
            SearchProperty: defineAsyncComponent( () =>
                import('./components/SearchProperty.vue') ),
            ShowProperty: defineAsyncComponent( () =>
                import('./components/ShowProperty.vue') ),
        },

        data() {
            return {
                isScrollYPastSearchBar: false,
                isScrollYPastMainHeader: false,
                placeSearchBarInNavBar: false,

                showWelcomeText: false,
                welcomeText: '',

                paginatedProperties: typeof paginatedProperties === 'undefined' ? [] : paginatedProperties,
                searchQuery: typeof searchQuery === 'undefined' ? {} : searchQuery,

                page: 1,
                paginationOptions: {
                    template: markRaw(CustomPagination),
                    chunk: 5,
                    edgeNavigation: true,
                },
            }
        },

        methods: {

            showLogInModal(event) {
                if(event?.showWelcomeText) {
                    this.showWelcomeText = true
                    this.welcomeText = event.welcomeText
                }
                
                this.$vfm.show('LogInModal')
            },

            showSignUpModal() {
                this.$vfm.show('SignUpModal')
            },

            showMobileSearchBarModal() {
                this.$vfm.show('MobileSearchBarModal')
            },

            onUserHasBeenAuthenticated(user) {
                this.isUserAuthenticated = true
                this.authenticatedUser = user
            },

            onUnfavouritedProperty(property_id) { 
                this.authenticatedUser.favourited_properties.forEach((element, index) => {

                    if ( element.property_id === property_id) {
                        this.authenticatedUser.favourited_properties.splice(index, 1)
                    }
                });    
            },

            onFavouritedProperty(favouriteData) {
                this.authenticatedUser.favourited_properties.unshift(favouriteData)
            },

            updatePropertiesAndSearchQuery(data) {
                this.paginatedProperties = data?.paginatedProperties
                this.searchQuery = data?.searchQuery
            },

            getPaginatedProperties(page) {
                axios.get(`${this.paginatedProperties.path}?page=${page}`)
                .then(
                    response => {
                        this.paginatedProperties = response.data.paginatedProperties;
                    }   
                )
            }
        },

        mounted() {
            // console.log(process.env.MIX_APP_ENV)
        }
    });

app.component('SearchIcon', SearchIcon);
app.component('pagination', Pagination);
app.mixin(app_mixin)

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

app.mount('#app');

