require('./bootstrap');

// require('alpinejs');

import { createApp, defineAsyncComponent } from 'vue';

import VueFinalModal from 'vue-final-modal'
import { SearchIcon } from '@heroicons/vue/outline'

import LoginModal from './components/LogInModal.vue';
import SignUpModal from './components/SignUpModal.vue';

window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

const app = 
    createApp({
        components: {
            LoginModal,
            SignUpModal,

            LargeSearchBar: defineAsyncComponent( () =>
                import('./components/SearchBar/LargeSearchBar.vue') ),
            MobileSearchBar: defineAsyncComponent( () =>
                import('./components/SearchBar/MobileSearchBar.vue') ),
        },

        data() {
            return {
                isUserAuthenticated: isUserAuthenticatedVar,
                authenticatedUser: authenticatedUserVar,

                isScrollYPastSearchBar: false,
                isScrollYPastMainHeader: false,

                showWelcomeText: false,
            }
        },

        methods: {

            showLoginModal(event) {
                event?.showWelcomeText ? this.showWelcomeText = true : ''
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
        },

        mounted() {
            if (this.$refs.mainHeader && document.getElementById('nav-bar'))
            {
                var mainHeaderOffsetHeight = this.$refs.mainHeader.offsetHeight;
                var mainHeaderOffsetTop = this.$refs.mainHeader.offsetTop;
                var navBarHeight = document.getElementById('nav-bar').offsetHeight;
                var thisVar = this;

                window.addEventListener(
                    'scroll',
                    _.throttle(function () {
                        if (window.scrollY >= mainHeaderOffsetTop + navBarHeight - (window.scrollY + mainHeaderOffsetHeight) ) {
                            thisVar.isScrollYPastMainHeader = true
                        } else {
                            thisVar.isScrollYPastMainHeader = false
                        }
                    }, 600)
                );
            }
        }
    });

app.component('SearchIcon', SearchIcon);

app.use(VueFinalModal());

app.mount('#app');