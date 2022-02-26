<template>
<div class="relative w-full">
    <nav ref="navBar"
        id="nav-bar"
        :class="[isScrollYPastNavBar ? 'bg-white p-3 z-20 rounded-b-md shadow sm:fixed left-0' : 'pt-3 sm:absolute sm:mt-3', {'h-36': isSearchBarInNavBar}, isInHomepage ? '' : 'border-b pb-2']"
        class="hidden top-0 w-full sm:flex justify-center sm:justify-between sm:px-10 3xl:px-20">
        <a href="/" :class="{'flex items-center': isInHomepage && !isScrollYPastNavBar}">
            <div v-if="isInHomepage && !isScrollYPastNavBar" class="bg-contain bg-left bg-no-repeat h-7 w-32 bg-logo" alt="logo"></div>
            <div v-else class="bg-contain bg-left bg-no-repeat h-8 w-32 bg-logo-blue" alt="logo"></div>
        </a>
        <!-- Mini Search Bar -->
        <transition name="fade">
        <div
            v-show="shouldShowMiniSearchBar()"
            class="bg-white rounded-full shadow hover:shadow-lg">
            <button 
                @click="onClickMiniSearchBar"
                class="rounded-full gap-2 px-3 xl:pl-6 py-1 border border-main-blue bg-white text-main-blue focus:outline-none w-full h-full flex items-center justify-between">
                <div
                    class="text-xs lg:text-base flex-grow text-center tracking-wide">Begin your search</div>
                <search-icon
                    class="text-white p-1 rounded-full w-7 h-7 bg-main-orange hover:bg-opacity-75"/>
            </button>
        </div>
        </transition>

        <div class="sm:flex gap-3 text-sm sm:text-base">
            <a href="/properties/create"
                class="px-5 h-9 flex items-center border rounded-full hover:text-opacity-75 hover:shadow-lg"
                :class="[isScrollYPastNavBar ? 'border-main-blue bg-white text-main-blue' : 'border-white bg-main-blue text-white']">
                Add a property
            </a>
            <div v-if="isUserAuthenticated"
                class="text-right">
                <AuthUserMenuButton
                    :isInMobileNavBar="false"
                    :isScrollYPastNavBar="isScrollYPastNavBar"
                ></AuthUserMenuButton>
            </div>    
            <div v-else class="flex gap-2">
                <button
                    @click="$vfm.show('SignUpModal')"
                    class="px-4 h-9 rounded-full hover:bg-opacity-75 hover:shadow-lg"
                    :class="[isScrollYPastNavBar ? 'bg-main-blue text-white' : 'bg-white text-main-blue']">
                    Sign up
                </button>
                <button
                    @click="$vfm.show('LogInModal')"
                    class="px-4 h-9 bg-main-orange text-white rounded-full hover:bg-opacity-75 hover:shadow-lg">
                    Log in
                </button>
            </div>
        </div>
    </nav>
</div>
</template>

<script>
import AuthUserMenuButton from './AuthUserMenuButton.vue'

export default {
    components: {
        AuthUserMenuButton
    },

    inject: ['isUserAuthenticated', 'authenticatedUser'],

    data () {
        return {
            csrfToken: csrfToken,
            isScrollYPastNavBar: false,
            showMiniSearchBar: true,
            isSearchBarInNavBar: false,
        }
    }, 

    watch: {
        showMiniSearchBar(newValue, oldValue) {

            if(newValue === false) {

                this.$emit('placeSearchBarInNavBar')
                this.isSearchBarInNavBar = true
                window.addEventListener('scroll', this.scrollEventListener);

            } else {

                window.removeEventListener('scroll', this.scrollEventListener);
            }
        }
    },
    
    props: [ 
        'isScrollYPastSearchBar',
    ],

    emits: ['placeSearchBarInNavBar'],

    methods: {
        onClickMiniSearchBar() {

            if (window.location.pathname !== '/' && window.location.pathname !== '/properties/search') {

                this.$vfm.show('MobileSearchBarModal')
                return
            }

            this.showMiniSearchBar=false
        },

        shouldShowMiniSearchBar() {

            if (window.location.pathname !== '/' && window.location.pathname !== '/properties/search') {
                return true
            }

            return (this.isScrollYPastSearchBar && this.showMiniSearchBar)
        },

        scrollEventListener() { 
            this.showMiniSearchBar = true 
            this.$emit('removeSearchBarFromNavBar')
            this.isSearchBarInNavBar = false
        }
    },

    mounted() {

        var navBarOffsetTop = this.$refs.navBar?.offsetTop;
        var thisVar = this;

        window.addEventListener(
            'scroll',
            function () {

                if (window.scrollY >= navBarOffsetTop + 10 ) {

                    thisVar.isScrollYPastNavBar = true
                } else {

                    thisVar.isScrollYPastNavBar = false
                }
            }
        );
    }
}
</script>

<style scoped>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.3s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }
</style>