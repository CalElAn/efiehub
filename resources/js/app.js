require('./bootstrap');

import { createApp, defineAsyncComponent } from 'vue';

import VueFinalModal from 'vue-final-modal'
import Notifications from '@kyvg/vue3-notification'

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
        },

        data() {
            return {
                isUserAuthenticated: isUserAuthenticatedVar,
                authenticatedUser: authenticatedUserVar,

                isScrollYPastSearchBar: false,
                isScrollYPastMainHeader: false,

                showWelcomeText: false,
                welcomeText: '',
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
        },

        mounted() {
            // if (this.$refs.mainHeader && document.getElementById('nav-bar'))
            // {
            //     var mainHeaderOffsetHeight = this.$refs.mainHeader.offsetHeight;
            //     var mainHeaderOffsetTop = this.$refs.mainHeader.offsetTop;
            //     var navBarHeight = document.getElementById('nav-bar').offsetHeight;
            //     var thisVar = this;

            //     window.addEventListener(
            //         'scroll',
            //         _.throttle(function () {
            //             if (window.scrollY >= mainHeaderOffsetTop + navBarHeight - (window.scrollY + mainHeaderOffsetHeight) ) {
            //                 thisVar.isScrollYPastMainHeader = true
            //             } else {
            //                 thisVar.isScrollYPastMainHeader = false
            //             }
            //         }, 600)
            //     );
            // }
        }
    });

app.component('SearchIcon', SearchIcon);

app.use(VueFinalModal());
app.use(Notifications)

app.mount('#app');