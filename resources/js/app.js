require('./bootstrap');

import { Helpers } from './helpers';
window.Helpers = Helpers

import { createApp, defineAsyncComponent } from 'vue';

import VueFinalModal from 'vue-final-modal'
import Notifications from '@kyvg/vue3-notification'
import VueProgressBar from "@aacassandra/vue3-progressbar";

import { SearchIcon } from '@heroicons/vue/outline'

import NavBar from './components/NavBar/NavBar.vue';
import MobileNavBar from './components/NavBar/MobileNavBar.vue';
import LogInModal from './components/LogInModal.vue';
import SignUpModal from './components/SignUpModal.vue';

window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

const app = 
    createApp({
        components: {
            NavBar,
            MobileNavBar,
            LogInModal,
            SignUpModal,

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
                isUserAuthenticated: isUserAuthenticatedVar,
                authenticatedUser: authenticatedUserVar,

                isScrollYPastSearchBar: false,
                isScrollYPastMainHeader: false,
                placeSearchBarInNavBar: false,

                showWelcomeText: false,
                welcomeText: '',

                properties: typeof properties === 'undefined' ? [] : properties,
                searchQuery: typeof searchQuery === 'undefined' ? {} : searchQuery,
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

            onUnfavouriteProperty(property_id) { 
                this.authenticatedUser.favourite_properties.forEach((element, index) => {

                    if ( element.property_id === property_id) {
                        this.authenticatedUser.favourite_properties.splice(index, 1)
                    }
                });    
            },

            onFavouriteProperty(favourite_data) {console.log(favourite_data)
                this.authenticatedUser.favourite_properties.unshift(favourite_data)
            },

            updatePropertiesAndSearchQuery(data) {
                this.properties = data?.properties
                this.searchQuery = data?.searchQuery
            }
        },

        mounted() {

        }
    });

app.component('SearchIcon', SearchIcon);

app.use(VueFinalModal())
    .use(Notifications)
    .use(VueProgressBar, {
        color: "rgb(143, 255, 199)",
        thickness: "3px",
        position: "relative",
        location: "top",
    })

app.mount('#app');

