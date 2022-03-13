<template>
<div class="mt-10 mx-3 sm:mt-32">
    <Head title="User Profile"></Head>
    <p class="mb-6 font-semibold text-xl sm:text-2xl">
        User profile
    </p>
    <div 
        v-if="user.is_user_the_authenticated_user"
        class="mb-2 flex justify-end">
        <Link 
            :href="`/users/${user.id}/edit`"
            class="flex gap-1 items-center border border-main-blue text-main-blue p-2 rounded-lg hover:underline hover:bg-gray-100"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-main-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
        </Link>
    </div>
    <UserCard
        class="md:mx-5 lg:mx-36 xl:mx-96"
        :user="user"
        :property="null"
        :show-full-card="true"
    >
    </UserCard>
    <div id="div-to-scroll-to"></div>
    <ul class="flex flex-col sm:flex-row list-disc sm:list-none px-5 sm:px-0 justify-center mt-16 sm:gap-4 mx-auto text-lg text-gray-600 font-medium border-gray-200 border-b">
        <li>
            <button 
                @click="selectedTab = 1"
                :class="[selectedTab === 1 ? 'text-main-blue bg-gray-100 font-semibold' : 'hover:bg-gray-50']"
                class="tracking-wide p-4 rounded-t-xl">
                Uploaded properties ({{numberOfUploadedProperties}})
            </button>
        </li>
        <li>
            <button 
                @click="selectedTab = 2"
                :class="[selectedTab === 2 ? 'text-main-blue bg-gray-100 font-semibold' : 'hover:bg-gray-50']"
                class="tracking-wide p-4 rounded-t-xl">
                Reviews
            </button>
        </li>
        <li>
            <button 
                @click="selectedTab = 3"
                :class="[selectedTab === 3 ? 'text-main-blue bg-gray-100 font-semibold' : 'hover:bg-gray-50']"
                class="tracking-wide p-4 rounded-t-xl">
                Favourites
            </button>
        </li>
        <li>
            <button 
                v-if="user.is_user_the_authenticated_user"
                @click="selectedTab = 4"
                :class="[selectedTab === 4 ? 'text-main-blue bg-gray-100 font-semibold' : 'hover:bg-gray-50']"
                class="tracking-wide p-4 rounded-t-xl">
                Notifications
            </button>
        </li>
        <li>
            <button 
                v-if="user.is_user_the_authenticated_user"
                @click="selectedTab = 5"
                :class="[selectedTab === 5 ? 'text-main-blue bg-gray-100 font-semibold' : 'hover:bg-gray-50']"
                class="tracking-wide p-4 rounded-t-xl">
                Chats
            </button>
        </li>
    </ul>
    <section>
        <PaginatedProperties
            v-if="selectedTab === 1"
            :paginatedProperties="paginatedProperties"
        />

        <Reviews
            class="mt-12 flex flex-col justify-center"
            v-if="selectedTab === 2"
            :initialReviewsData="user.reviews"
            :hasAuthUserReviewed="user.is_user_reviewed_by_the_authenticated_user"
            :model="'User'"
            :slug="user.id"
        />

        <PaginatedProperties
            v-if="selectedTab === 3"
            :paginatedProperties="paginatedFavouritedProperties"
        />

        <!-- Notifications -->
        <div 
            v-if="selectedTab === 4"
            class="mt-12 flex flex-col gap-5 items-center mx-auto"
        >
            <p class="font-medium text-sm sm:text-lg">
                People have requested that you call them back on these numbers:
            </p>
            <ol class="md:ml-6 relative border-l border-gray-200 dark:border-gray-700">                  
                <li 
                    v-for="(item, index) in notifications"
                    :key="index"
                    class="mb-10 ml-4 flex flex-col gap-3"
                >
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full -left-1.5 border border-white"></div>
                    <div class="flex justify-between gap-10">
                        <div class="flex flex-col gap-2">
                            <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                {{item.diffForHumans}}
                            </time>
                            <h3 class="text-sm font-semibold text-main-blue">
                                <a
                                    class="underline"
                                    :href="'tel:'+item.data.phone_number">
                                    {{item.data.phone_number}}
                                </a>
                            </h3>
                        </div>
                        <!-- <button class="flex gap-1 p-1 text-xs sm:text-sm underline hover:opacity-80 hover:shadow-md items-center rounded-lg text-gray-700">
                            <CheckCircleIcon class="w-4 h-4"/>
                            Mark as read
                        </button> -->
                    </div>
                    <p 
                        v-if="item.data.details"
                        class="mb-4 border border-main-orange p-2 rounded-md text-base font-normal text-gray-600">
                            {{item.data.details}}
                    </p>
                </li>
            </ol>
        </div>

        <div
            v-if="selectedTab === 5"
            class="mt-12 flex flex-col gap-5 items-center mx-auto"
        >
            <button                    
                v-for="(item, index) in usersWithChat"
                :key="index"
                @click="openChatBox(item)"
                class="border-b bg-gray-50 p-2 rounded-lg"
            >
                <div class="flex gap-2 items-center h-14 w-60">
                    <div
                        class="place-self-center bg-contain bg-center bg-no-repeat h-12 w-12 rounded-full"
                        :style="{'background-image': 'url('+ getProfilePictureUrl(item) +')'}"
                        alt="profile picture">
                    </div>
                    <div>
                        {{item.name}}
                    </div>
                </div>
            </button>
            <ChatBox
                v-if="showChatBoxToggle"
                :messagedUser="messagedUser"
                @closeChatBox="showChatBoxToggle = false"
            />
        </div>
    </section>  
</div>

</template>

<script>
import UserCard from '../../components/User/Card.vue'
import Reviews from '../../components/Reviews.vue'
import ChatBox from '../../components/ChatBox.vue'

import { CheckCircleIcon } from '@heroicons/vue/outline'

export default {
    components: {
        UserCard,
        Reviews,
        ChatBox,

        CheckCircleIcon,
    },

    props: {
        user: Object,
        paginatedProperties: Object,
        numberOfUploadedProperties: Number,
        reviews: Array,
        paginatedFavouritedProperties: Object,
        notifications: Array,
        usersWithChat: Array,
    },

    data() {
        return {
            selectedTab: 1,

            selectedTabMappedToLocationHash: {
                1:'#UploadedProperties',
                2:'#Reviews',
                3:'#Favourites',
                4:'#Notifications',
                5:'#Chats',
            },

            messagedUser: '',
            showChatBoxToggle: false,
        }
    },

    props: [
        'user',
        'paginatedProperties',
        'paginatedFavouritedProperties',
        'reviews',
        'notifications',
        'usersWithChat',
        'numberOfUploadedProperties',
    ],

    watch: {
        selectedTab(newSelectedTab, oldSelectedTab) {
            location.hash = this.selectedTabMappedToLocationHash[newSelectedTab]
        },
    },

    methods: {
        getSelectedTabFromLocationHash() { 
            //this is a method instead of computed to avoid caching of results
            return parseInt(
                    Object.keys(this.selectedTabMappedToLocationHash)
                        .find(
                            item => this.selectedTabMappedToLocationHash[item] == location.hash)
                    ?? 1
                )
        },

        openChatBox(user) {
            this.messagedUser = user
            this.showChatBoxToggle = true
        }
    },

    mounted() {
        this.selectedTab = this.getSelectedTabFromLocationHash() 

        window.addEventListener('hashchange', () => this.selectedTab = this.getSelectedTabFromLocationHash() )
    }
}
</script>