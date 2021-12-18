<template>
<div class="relative w-full">
    <nav ref="navBar"
        :class="[isScrollYPastNavBar ? 'bg-white p-3 z-20 rounded-b-md shadow-xl sm:fixed left-0' : 'pt-5 sm:absolute']"
        class="hidden top-0 w-full sm:flex justify-center sm:justify-between sm:px-10 3xl:px-20">
        <a href="/">
            <div class="bg-contain bg-left bg-no-repeat h-8 w-32" style="background-image: url('images/logo.png');" alt="logo"></div>
        </a>
        <div class="sm:flex gap-3 text-sm sm:text-base">
            <a href="/add-property"
                class="px-5 py-1 flex items-center border rounded-full hover:text-opacity-75"
                :class="[isScrollYPastNavBar ? 'border-main-blue bg-white text-main-blue' : 'border-white bg-main-blue text-white']">
                Add a property
            </a>
            <div v-if="isUserAuthenticated"
                class="text-right">
                <Menu as="div" class="relative text-left">
                    <div class="flex">
                        <MenuButton
                            :class="'shadow-2xl'"
                            class="inline-flex items-center justify-center w-max px-4 py-1 text-white font-semibold bg-main-orange rounded-full hover:bg-opacity-75 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                            <div class="bg-contain bg-center bg-no-repeat h-8 w-8 -ml-2 rounded-full" 
                                :style="{'background-image': 'url('+(authenticatedUser.profile_picture_path ? 'https://ui-avatars.com/api/?size=25&rounded=true&bold=true&name='+authenticatedUser.name : 'https://ui-avatars.com/api/?size=50&rounded=true&name='+authenticatedUser.name)+')'}" alt="logo">

                            </div>
                            <!-- <img 
                                :src="authenticatedUser.profile_picture_path ? 'https://ui-avatars.com/api/?size=25&rounded=true&bold=true&name='+authenticatedUser.name : 'https://ui-avatars.com/api/?size=50&rounded=true&name='+authenticatedUser.name"
                                alt="Avatar" 
                                class="rounded-full h-7 mr-2 -ml-2"> -->
                                <!-- Realized no need to display name since every sites doesnt -->
                                <!-- {{authenticatedUser.name}} --> 
                            <ChevronDownIcon class="w-5 h-5 ml-2 -mr-1 text-white hover:text-indigo-100"
                                aria-hidden="true" />
                        </MenuButton>
                    </div>
    
                    <transition enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
                        leave-to-class="transform scale-95 opacity-0">
                        <MenuItems
                            class="absolute right-0 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <button :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                                    'group flex rounded-md items-center w-full px-2 py-2 text-sm',]">
                                    Edit
                                </button>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <button :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                                    'group flex rounded-md items-center w-full px-2 py-2 text-sm',]">
                                    Duplicate
                                </button>
                                </MenuItem>
                            </div>
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <button :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                                    'group flex rounded-md items-center w-full px-2 py-2 text-sm',]">
                                    Archive
                                </button>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <button :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                                    'group flex rounded-md items-center w-full px-2 py-2 text-sm',]">
                                    Move
                                </button>
                                </MenuItem>
                            </div>
    
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <form method="POST" action="/logout">
                                    <input type="hidden" name="_token" :value="csrfToken" />
                                    <button :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                                            'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
                                        Log Out
                                    </button>
                                </form>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>    
            <div v-else class="flex gap-2">
                <button
                    @click="$emit('showSignUpModal')"
                    class="px-4 py-1 rounded-full hover:bg-opacity-75"
                    :class="[isScrollYPastNavBar ? 'bg-main-blue text-white' : 'bg-white text-main-blue']">
                    Sign up
                </button>
                <button
                    @click="$emit('showLogInModal')"
                    class="px-4 py-1 bg-main-orange text-white rounded-full hover:bg-opacity-75">
                    Log in
                </button>
            </div>
        </div>
    </nav>
</div>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/solid'

export default {
    components: {
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        ChevronDownIcon,
    },

    props: [
        'authenticatedUser', 
        'isUserAuthenticated', 
    ],

    data () {
        return {
            csrfToken: csrfToken,
            isScrollYPastNavBar: false,
        }
    }, 
    
    mounted() {

        var navBarOffsetTop = this.$refs.navBar?.offsetTop;
        var navBarOffsetWidth = this.$refs.navBar?.offsetWidth;
        var mainHeaderBgOffsetWidth = this.$refs.mainHeaderBg?.offsetWidth;
        var thisVar = this;

        window.addEventListener(
            'scroll',
            function () {
                if (window.scrollY >= navBarOffsetTop + 10 ) {
                    thisVar.isScrollYPastNavBar = true
                    // thisVar.$refs.navBar.style.width = mainHeaderBgOffsetWidth + 'px'
                } else {
                    thisVar.isScrollYPastNavBar = false
                }
            }
        );
    }
}
</script>