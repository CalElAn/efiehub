<template>
<Menu as="div" class="relative text-left">
    <div class="flex">
        <MenuButton
            v-slot="{ open }"
            :class="[isInHomepage && isScrollYPastNavBar ? 'border-main-orange text-main-orange' : '', isInMobileNavBar ? 'border-main-orange text-main-orange py-1' : 'h-9', isInHomepage && !isInMobileNavBar ? 'border-white text-white' : 'border-main-orange text-main-orange']"
            class="inline-flex items-center justify-center w-max px-4 font-semibold border rounded-full focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 hover:shadow-lg">
            <div 
                :class="[isInMobileNavBar ? 'h-8 w-8' : 'h-7 w-7']"
                class="bg-contain bg-center bg-no-repeat -ml-2 rounded-full" 
                :style="{'background-image': 'url(' + getProfilePictureUrl($page.props.authenticatedUser)+ ')'}" alt="profile picture">
            </div> 
            <XIcon
                v-if="open" 
                class="w-5 h-5 ml-2 -mr-1"
                aria-hidden="true" />
            <MenuIcon 
                v-else
                class="w-5 h-5 ml-2 -mr-1"
                aria-hidden="true" />
        </MenuButton>
    </div>

    <transition enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0">
        <!-- when move to one component remember deal with bottom-11 and chevron up icon on sm+ screens -->
        <MenuItems
            :class="[isInMobileNavBar ? 'bottom-12' : '']"
            class="absolute right-0 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
            <div class="px-1 py-1">
                <MenuItem v-slot="{ active }">
                    <Link :href="`/users/${$page.props.authenticatedUser.id}#UploadedProperties`" :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex rounded-md items-center w-full px-2 py-2 text-sm',]">
                        Profile
                    </Link>
                </MenuItem>
            </div>
            <div class="px-1 py-1">
                <MenuItem v-slot="{ active }">
                    <Link 
                        :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex rounded-md items-center w-full px-2 py-2 text-sm',]"
                        :href="`/users/${$page.props.authenticatedUser.id}#UploadedProperties`"
                    >
                        Uploaded properties
                    </Link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                    <Link 
                        :href="`/users/${$page.props.authenticatedUser.id}#Reviews`" 
                        :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex rounded-md items-center w-full px-2 py-2 text-sm',]">
                        Reviews
                    </Link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                    <Link 
                        :href="`/users/${$page.props.authenticatedUser.id}#Favourites`" 
                        :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex rounded-md items-center w-full px-2 py-2 text-sm',]">
                        Favourites
                    </Link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                    <Link 
                        :href="`/users/${$page.props.authenticatedUser.id}#Notifications`" 
                        :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                        'group flex rounded-md items-center w-full px-2 py-2 text-sm',]">
                        Notifications
                    </Link>
                </MenuItem>
            </div>
            <div class="px-1 py-1">
                <MenuItem v-slot="{ active }">
                <button :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900',
                    'group flex rounded-md items-center w-full px-2 py-2 text-sm',]">
                    Advertise on efiehub
                </button>
                </MenuItem>
            </div>

            <div class="px-1 py-1">
                <MenuItem v-slot="{ active }">
                    <Link 
                        href="/logout" 
                        method="post" 
                        as="button" 
                        type="button" 
                        :class="[active ? 'bg-indigo-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']"
                    >
                        Log Out
                    </Link>
                </MenuItem>
            </div>
        </MenuItems>
    </transition>
</Menu>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'

import { MenuIcon } from '@heroicons/vue/solid'

export default {
    components: {
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        MenuIcon,
    },

    props: ['isInMobileNavBar', 'isScrollYPastNavBar'],
}
</script>