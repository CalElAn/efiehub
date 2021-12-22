<template>
    <nav ref="mobileNavBar" 
        class="fixed bottom-0 z-20 w-full bg-white text-gray-600 text-xs flex-row gap-3 justify-evenly border-t p-2 sm:hidden"
        :class="[isScrollDown ? 'hidden' : 'flex']">
        <a href="#" @click="$emit('showMobileSearchBar')">
            <div class="flex flex-col items-center">
                <SearchIcon class="w-5 h-5"/>
                <p>
                    Search
                </p>
            </div>
        </a>
        <a href="/add-property">
            <div class="flex flex-col items-center">
                <HomeIcon class="w-5 h-5"/>
                <p>
                    Add property
                </p>
            </div>
        </a>
        <a href="#" @click="$emit('showSignUpModal')">
            <div class="flex flex-col items-center">
                <UserAddIcon class="w-5 h-5"/>
                <p>
                    Sign up
                </p>
            </div>
        </a>
        <a href="#" @click="$emit('showLogInModal')">
            <div class="flex flex-col items-center">
                <UserCircleIcon class="w-5 h-5"/>
                <p>
                    Log in
                </p>
            </div>
        </a>
    </nav>
</template>

<script>
import { HomeIcon, UserAddIcon, UserCircleIcon } from '@heroicons/vue/solid'
import { HeartIcon } from '@heroicons/vue/outline'

export default {
    components: {
        HomeIcon,
        UserCircleIcon,
        UserAddIcon,
        HeartIcon,
        // Menu,
        // MenuButton,
        // MenuItems,
        // MenuItem,
        // ChevronDownIcon,
    },

    props: [
        'authenticatedUser', 
        'isUserAuthenticated', 
    ],

    data () {
        return {
            csrfToken: csrfToken,
            isScrollDown: false,
        }
    }, 
    
    mounted() {

        var thisVar = this;

        window.addEventListener(
            'scroll',
            function () {
                if (this.oldScroll < this.scrollY) {
                    thisVar.isScrollDown = true
                } else {
                    thisVar.isScrollDown = false
                }
                
                this.oldScroll = this.scrollY;
            }
        );
    }
}
</script>