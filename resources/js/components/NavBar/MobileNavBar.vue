<template>
    <nav ref="mobileNavBar" 
        class="fixed bottom-0 z-20 w-full tracking-wide bg-gray-100 text-gray-700 text-xs flex flex-row gap-3 justify-evenly border-t px-1 py-1.5 sm:hidden"
    >
        <button 
            class="rounded-md focus:outline-none focus:text-main-blue focus:ring-2 focus:ring-offset-2 focus:ring-main-blue"
            href="#" @click="$emit('showMobileSearchBar')">
            <div class="flex flex-col items-center">
                <SearchIcon class="w-5 h-5"/>
                <p>
                    Search
                </p>
            </div>
        </button>
        <a
            class="rounded-md focus:outline-none focus:text-main-blue focus:ring-2 focus:ring-offset-2 focus:ring-main-blue"
            href="/properties/create">
            <div 
                :class="{ 'text-main-blue font-semibold p-1 px-2': $page.component === 'Property/CreateOrEdit' }"
                class="flex flex-col items-center rounded-lg">
                <HomeIcon class="w-5 h-5"/>
                <p>
                    Add property
                </p>
            </div>
        </a>
        <div v-if="$page.props.isUserAuthenticated"
            class="text-right">
            <AuthUserMenuButton
                :isInMobileNavBar="true"
                :isScrollYPastNavBar="false"
            ></AuthUserMenuButton>
        </div>    
        <button
            class="rounded-md focus:outline-none focus:text-main-blue focus:ring-2 focus:ring-offset-2 focus:ring-main-blue"
            v-if="!$page.props.isUserAuthenticated" @click="$vfm.show('SignUpModal')"> 
            <div class="flex flex-col items-center">
                <UserAddIcon class="w-5 h-5"/>
                <p>
                    Sign up
                </p>
            </div>
        </button>
        <button 
            class="rounded-md focus:outline-none focus:text-main-blue focus:ring-2 focus:ring-offset-2 focus:ring-main-blue"
            v-if="!$page.props.isUserAuthenticated" @click="$vfm.show('LogInModal')">
            <div class="flex flex-col items-center">
                <UserCircleIcon class="w-5 h-5"/>
                <p>
                    Log in
                </p>
            </div>
        </button>
    </nav>
</template>

<script>
import AuthUserMenuButton from './AuthUserMenuButton.vue'
import { HomeIcon, UserAddIcon, UserCircleIcon, HeartIcon } from '@heroicons/vue/outline'

export default {
    components: {
        HomeIcon,
        UserCircleIcon,
        UserAddIcon,
        HeartIcon,
        AuthUserMenuButton
    },
}
</script>