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
                        <ChevronUpIcon class="w-5 h-5 ml-2 -mr-1 text-white hover:text-indigo-100"
                            aria-hidden="true" />
                    </MenuButton>
                </div>

                <transition enter-active-class="transition duration-100 ease-out"
                    enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0">
                    <!-- when move to one component remember deal with bottom-11 and chevron up icon on sm+ screens -->
                    <MenuItems
                        class="absolute bottom-11 right-0 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
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
        <a v-if="!isUserAuthenticated" href="#" @click="$emit('showSignUpModal')">
            <div class="flex flex-col items-center">
                <UserAddIcon class="w-5 h-5"/>
                <p>
                    Sign up
                </p>
            </div>
        </a>
        <a v-if="!isUserAuthenticated" href="#" @click="$emit('showLogInModal')">
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

import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ChevronUpIcon } from '@heroicons/vue/solid'

export default {
    components: {
        HomeIcon,
        UserCircleIcon,
        UserAddIcon,
        HeartIcon,
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        ChevronUpIcon,
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