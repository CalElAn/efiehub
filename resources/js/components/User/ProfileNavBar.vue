<template>
    <ul class="flex flex-col sm:flex-row list-disc sm:list-none px-5 sm:px-0 justify-center mt-16 sm:gap-4 mx-auto text-lg text-gray-600 font-medium border-gray-200 border-b">
        <li>
            <button 
                @click="selectedTab = 1"
                :class="[selectedTab === 1 ? 'text-main-blue bg-gray-100 font-semibold' : 'hover:bg-gray-50']"
                class="tracking-wide p-4 rounded-t-xl">
                Uploaded properties
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
                @click="selectedTab = 4"
                :class="[selectedTab === 4 ? 'text-main-blue bg-gray-100 font-semibold' : 'hover:bg-gray-50']"
                class="tracking-wide p-4 rounded-t-xl">
                Notifications
            </button>
        </li>
    </ul>
    <section>
        <PaginatedProperties
            v-if="selectedTab === 1"
            :initialPaginatedProperties="paginatedProperties"
        />

        <Reviews
            class="mt-12"
            v-if="selectedTab === 2"
            :initialReviewsData="user.reviews"
            :hasAuthUserReviewed="user.is_user_reviewed_by_the_authenticated_user"
            :model="'User'"
            :slug="user.id"
        />

        <PaginatedProperties
            v-if="selectedTab === 3"
            :initialPaginatedProperties="paginatedFavouritedProperties"
        />

        <div 
            class="mt-12"
             v-if="selectedTab === 4"
        >
            <p class="mb-10 font-medium text-sm sm:text-lg">
                People have requested that you call them back on these numbers:
            </p>
            <ol class="md:ml-6 relative border-l border-gray-200 dark:border-gray-700">                  
                <li 
                    v-for="(item, index) in notifications"
                    :key="index"
                    class="mb-10 ml-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                        {{item.diffForHumans}}
                    </time>
                    <h3 class="text-sm font-semibold text-gray-600 ">
                        <a 
                            class="underline"
                            :href="'tel:'+item.data.phone_number">
                            {{item.data.phone_number}}
                        </a>
                    </h3>
                    <!-- <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">Get access to over 20+ pages including a dashboard layout, charts, kanban board, calendar, and pre-order E-commerce & Marketing pages.</p>
                    <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn more <svg class="ml-2 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a> -->
                </li>
            </ol>
        </div>
        <!-- People have requested that you call them back on these numbers -->
    </section>
</template>

<script>
import PaginatedProperties from '../Property/PaginatedProperties.vue'
import Reviews from '../Reviews.vue'

export default {
    components: {
        PaginatedProperties,
        Reviews,
    },

    data() {
        return {
            selectedTab: 1,
        }
    },

    props: [
        'user',
        'paginatedProperties',
        'paginatedFavouritedProperties',
        'reviews',
        'notifications',
    ],
}
</script>