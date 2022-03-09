<template>
    <div class="text-sm md:text-base">
        <div
            v-if="property.user_id === authenticatedUser?.id" 
            class="class mb-2 gap-4 flex justify-end">
            <a 
                 class="flex gap-1 items-center border border-main-blue text-main-blue p-2 rounded-lg hover:underline hover:bg-gray-100"
                :href="`/properties/${property.slug}/edit`">
                <PencilAltIcon class="w-5 h-5 text-main-orange"/>
                Edit
            </a>
            <button 
                @click="archiveProperty"
                class="flex gap-1 items-center border border-main-blue text-main-blue p-2 rounded-lg hover:underline hover:bg-gray-100">
                <ArchiveIcon class="w-5 h-5 text-main-orange"/>
                {{property.is_property_archived ? 'Un-archive' : 'Archive'}}
            </button>
        </div>
        <swiper
            :style="{
                '--swiper-navigation-color': '#fff',
                '--swiper-pagination-color': '#FF5B1A',
                '--swiper-pagination-bullet-inactive-color': '#fff',
                '--swiper-pagination-bullet-inactive-opacity': 1,
                '--swiper-navigation-size': '60px',
            }"
            :spaceBetween="5"
            :slidesPerView="1"
            :breakpoints='{
                "768": {
                    "slidesPerView": 2,
                    "spaceBetween": 5
                },
                "1280": {
                    "slidesPerView": 3,
                    "spaceBetween": 7
                },
                "2560": {
                    "slidesPerView": 4,
                    "spaceBetween": 9
                },
            }'
            :navigation="true"
            :pagination='{
                "clickable": true,
                "dynamicBullets": false}'
            :grabCursor="true"
            :loop="true"
            :lazy="true"
            :thumbs="{ swiper: thumbsSwiper }"
            class="w-full h-96 mt-12 rounded-t-3xl">
            <!-- if you make grid >1, make loop false and define height "height: calc((100% - 30px) / 2) !important;" in css with .swiper-slide class -->
            <swiper-slide v-for="(item, index) in property?.media" :key="index"
                class="bg-cover bg-center bg-no-repeat swiper-lazy" :data-background="'/storage/'+item.path" alt="property image">
                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
            </swiper-slide>
        </swiper>
        <swiper
            @swiper="setThumbsSwiper"
            :loop="true"
            :spaceBetween="5"
            :slidesPerView="4"
            :breakpoints='{
                "768": {
                    "slidesPerView": 6,
                    "spaceBetween": 5
                },
                "1280": {
                    "slidesPerView": 10,
                    "spaceBetween": 7
                },
                "2560": {
                    "slidesPerView": 14,
                    "spaceBetween": 9
                },
            }'
            :watchSlidesProgress="true"
            :freeMode="true"
            :scrollbar='{
                "hide": false,
                "draggable": true,
            }'
            class="h-20 sm:h-28 mt-3 rounded-b-3xl">
            <swiper-slide v-for="(item, index) in property?.media" :key="index">
                <div class="bg-cover bg-center bg-no-repeat h-full" :style="'background-image: url(/storage/'+item.path+')'"  alt="property image"></div>
            </swiper-slide>
        </swiper>
        <div class="mt-12 flex flex-col sm:flex-row gap-3 sm:gap-0 justify-between">
            <p class="font-semibold text-xl sm:text-2xl">
                {{property.title}}
            </p>
            <div class="flex justify-between sm:justify-start">
                <div class="flex sm:hidden text-xs sm:text-sm md:text-base items-center gap-1">
                    <StarIcon class="h-4 sm:h-5 w-4 sm:w-5 text-main-orange"/>
                    {{propertyReviews.average}} <span>({{propertyReviews.count}} reviews)</span>
                </div>
                <div class="flex gap-2 sm:gap-4">
                    <button
                        class="flex items-center gap-1 sm:gap-2 p-1 sm:p-2 rounded-xl underline hover:border hover:shadow-md"
                        @click="shareProperty">
                        <ShareIcon class="h-4 w-4 sm:h-6 sm:w-6 text-main-blue"/>
                        Share
                    </button>
                    <button
                        :class="[isPropertyFavouritedByUser ? 'bg-main-orange text-white' : 'underline']"
                        class="flex items-center gap-0.5 text-xs sm:text-sm md:text-base sm:gap-2 p-1 sm:p-2 rounded-xl hover:border hover:shadow-md"
                        @click="favouriteProperty">
                        <HeartIcon
                            :class="[isPropertyFavouritedByUser ? '' : 'text-main-blue']"
                            class="h-4 w-4 sm:h-6 sm:w-6"/>
                        {{isPropertyFavouritedByUser ? 'Saved' : 'Save'}}
                    </button>
                </div>
            </div>
        </div>
        <section class="mt-4 pb-6 sm:mt-8 w-full flex flex-col sm:flex-row gap-5 sm:gap-4 border-b">
            <div class="w-full sm:w-3/4">
                <div class="flex flex-col sm:flex-row gap-4 justify-between">
                    <div class="hidden sm:flex items-center gap-2">
                        <StarIcon class="h-4 sm:h-5 w-4 sm:w-5 text-main-orange"/>
                        {{propertyReviews.average}} <span>({{propertyReviews.count}} reviews)</span>
                    </div>
                    <div class="flex items-center justify-center">
                        <a 
                            style="text-decoration-color: #4568ED;"
                            class="underline" 
                            :href="searchPropertyUrl()" 
                            target="_blank">
                            {{ property.region }},</a> &nbsp; {{`${property.city}, ${property.town}` }}
                    </div>
                </div>
                <div class="mt-4 sm:mt-6 flex justify-center pb-4 border-b">
                    <div class="flex items-center gap-2 text-xs md:text-sm lg:text-base">
                        <LocationMarkerIcon class="h-4 w-4 text-main-orange"/>
                        {{ property.address }}
                    </div>
                </div>
                <div class="flex flex-col gap-2 justify-between  pt-3">
                    <div 
                        v-if="numberOfBedroomsAndBathrooms.exists"
                        class="flex flex-row justify-center items-center gap-4">
                        <p> {{numberOfBedroomsAndBathrooms.numberOfBedrooms}} bedrooms </p>
                        <svg  width="5" height="5" class="bg-main-blue rounded-full" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2.5" cy="2.5" r="2.5" fill="none"/>
                        </svg>
                        <p> {{numberOfBedroomsAndBathrooms.numberOfBathrooms}} bathrooms </p>
                    </div>
                    <div class="flex flex-row justify-center items-center gap-2 pb-3 border-b">
                        <svg  width="5" height="5" class="bg-main-blue rounded-full" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2.5" cy="2.5" r="2.5" fill="none"/>
                        </svg>
                        <p> {{property?.features?.find(obj => obj.input_type == 'radio')?.feature}} </p>
                    </div>
                    <ul class="flex flex-col gap-2 list-disc mx-auto mt-3">
                        <li
                            class="text-main-blue"
                            v-for="(item, index) in property?.features?.filter(obj => obj.input_type == 'checkbox')" 
                            :key="index">
                            <span class="text-black">{{item.feature}}</span> 
                        </li>
                    </ul>
                    <hr class="mt-3">
                    <ul class="flex flex-col gap-2 list-disc mx-auto mt-3">
                        <li
                            class="text-main-blue"
                            v-for="(item, index) in property?.other_features" 
                            :key="index">
                            <span class="text-black">{{item}}</span> 
                        </li>
                    </ul>

                </div>          
            </div>
            <div class="w-full h-full sm:w-1/4 text-sm lg:text-base">
                <UserCard
                    :user="property.user"
                    :property="property"
                    :showFullCard="false"
                />
                <button 
                    @click="reportProperty"
                    class="flex underline gap-2 mt-6 text-gray-600">
                    <FlagIcon  class="h-4 lg:h-5 w-4 lg:w-5"/>
                    Report this property
                </button>
            </div>
        </section> 
        <section class="mt-12">
            <p class="flex gap-1 items-center mb-3 font-semibold text-lg sm:text-xl">
                Map location
            </p>
            <GoogleMap
                v-if="gpsLocationArray"
                api-key="AIzaSyDirkNzKT8JLB1mus3DdxkdE4hySmMGGMI"
                style="width: 100%; height: 500px"
                :center="mapCenter"
                :zoom="18"
            >
                <Marker :options="{ position: mapCenter }" />
            </GoogleMap>
            <p v-else >
                Map location is currently not available for this property
            </p>
        </section> 
        <section class="mt-12">
            <Reviews
                :initialReviewsData="property.reviews"
                :hasAuthUserReviewed="property.is_property_reviewed_by_the_authenticated_user"
                :model="'Property'"
                :slug="property.slug"
            />
        </section>
    </div>
</template>

<script>

import { GoogleMap, Marker } from 'vue3-google-map'

import propertyMixin from "./property_mixin.js";
import UserCard from '../User/Card.vue'
import Reviews from '../Reviews.vue'

import { FlagIcon, EyeOffIcon } from '@heroicons/vue/solid'
import { PencilAltIcon, ArchiveIcon } from '@heroicons/vue/outline'

export default {

    components: {
        GoogleMap, 
        Marker,

        UserCard,
        Reviews,

        FlagIcon,
        EyeOffIcon,
        PencilAltIcon,
        ArchiveIcon,
    },

    data() {
        return {
            thumbsSwiper: null,
            propertyReviewsData: this.property.reviews,
            gpsLocationArray: this.property.gps_location?.split(','), 
            showAllReviews: false,
        }
    },

    mixins: [propertyMixin],

    computed: {
        mapCenter() {
            return { lat: parseFloat(this.gpsLocationArray?.[0]), lng: parseFloat(this.gpsLocationArray?.[1]) }
        }
    },

    methods: {
        setThumbsSwiper(swiper) {
            this.thumbsSwiper = swiper;
        },

        searchPropertyUrl() {
            return '/properties/search?' + this.serialize({regions: [this.property.region]})
        },

        reportProperty() {

            if (!this.isUserAuthenticated) {

                this.$vfm.show('LogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to report this property, or'})
                return
            }

            this.$vfm.show('ReportOrReviewModal', {mode: 'report'})
        },

        archiveProperty() {
            this.$swal.fire({
                title: (this.property.is_property_archived ? 'Un-archive' : 'Archive') + ' property?',
                html: this.property.is_property_archived 
                    ? 'This will allow it to show up on the homepage and in any relevant searches' 
                    : "This will prevent it from showing up on the homepage and in any searches.<br><br>This can be changed later.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4568ED',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    axios.patch(`/properties/${this.property.slug}/archive`)
                        .then( (response) => {
                            if( response.status === 200 ) {
                                location.reload()
                            }
                        })
                        .catch( (axiosError) => {
                            console.log(axiosError)
                        })  
                }
            })

        }
    },
}
</script>

<style>
@import "./property_styles.css";

.swiper-scrollbar-drag {
    background-color: rgb(255 255 255 / 70%);
    /* background-color: rgb(255 91 26 / 60%); */
}

.swiper-scrollbar {
    background-color: rgb(0 0 0 / 30%);
    /* background-color: rgb(255 255 255 / 30%); */
}
</style>