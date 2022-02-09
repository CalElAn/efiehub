<template>
    <div class="text-sm md:text-base">
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
                <div class="flex sm:hidden items-center gap-1">
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
                        class="flex items-center gap-1 sm:gap-2 p-1 sm:p-2 rounded-xl hover:border hover:shadow-md"
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
                <div class="flex flex-col gap-4 shadow sm:shadow-lg rounded-lg p-3 py-7 border">
                    <div>
                        <span class="font-semibold text-base lg:text-lg">GH&#8373; {{property.price}}</span> / month
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <div class="bg-contain bg-center bg-no-repeat h-8 w-8 rounded-full"
                            :style="{'background-image': 'url('+(property.user.profile_picture_path ? 'https://ui-avatars.com/api/?size=50&rounded=true&bold=true&name='+property.user.name : 'https://ui-avatars.com/api/?size=50&rounded=true&name='+property.user.name)+')'}" alt="profile picture">
                        </div>
                        <p>{{property.user.name}}</p>
                    </div>
                    <button class="flex items-center justify-center gap-2 bg-main-orange bg-opacity-95 hover:bg-white text-white hover:text-main-orange hover:border hover:border-main-orange p-2 rounded-lg">
                        <PhoneIcon class="h-5 w-5 md:h-4 md:w-4"/> Show contact
                    </button>
                    <button class="flex items-center justify-center gap-2 border border-main-orange text-main-orange hover:text-white bg-white hover:bg-main-orange bg-opacity-95 p-1 rounded-lg">
                        <ChatAltIcon class="h-5 w-5 md:h-4 md:w-4"/> Chat
                    </button>
                    <button
                        v-show="!requestCallBackToggle"
                        :disabled="authenticatedUser?.id === property.user_id"
                        @click="requestCallBackToggle = true"
                        style="text-decoration-color: #4568ED;"
                        class="rounded-xl underline hover:border hover:shadow-md p-2 md:p-1">
                        Request call back
                    </button>
                    <div 
                        v-show="requestCallBackToggle"
                        class="flex text-xs">
                        <form
                            @submit.prevent="requestCallBack"
                            class="w-full flex flex-col xl:flex-row gap-1">
                            <input
                                required
                                v-model="phoneNumberForRequestCallback"
                                type="text"
                                placeholder="enter phone number"
                                class="text-xs block w-full xl:w-3/5 rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            <div class="flex gap-1 xl:w-2/5">
                                <button
                                    type="submit"
                                    class="flex w-1/2 xl:w-1/2 py-1 xl:py-0 justify-center items-center border border-transparent shadow-sm rounded-md xl:rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    request
                                </button>
                                <button
                                    @click="requestCallBackToggle = false"
                                    type="button"
                                    class="flex w-1/2 xl:w-1/2 py-1 xl:py-0 justify-center items-center border border-transparent shadow-sm rounded-md xl:rounded-lg text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    cancel
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="flex justify-center items-center gap-1 text-xs">
                        <StarIcon class="h-4 lg:h-5 w-4 lg:w-5 text-main-orange"/>
                        {{'0'}}<span>({{'0'}} agent reviews)</span>
                    </div>
                </div>
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
            <div class="flex flex-col sm:flex-row gap-3">
                <p class="flex gap-1 items-center font-semibold text-lg sm:text-xl">
                    <StarIcon class="h-6 sm:h-6 w-6 sm:w-6 text-main-orange"/>
                    {{propertyReviews.average}}
                    <span>({{propertyReviews.count}} {{(propertyReviews.count > 1 || propertyReviews.count === 0) ? 'reviews' : 'review'}})</span>
                </p>
                <button
                    v-if="!property.is_property_reviewed_by_the_authenticated_user"
                    @click="reviewProperty"
                    class="flex items-center justify-center gap-0.5 w-1/2 sm:w-auto mx-auto sm:mx-0 text-indigo-600 hover:bg-indigo-600 hover:text-white border border-indigo-600 rounded-full py-1 px-2">
                    <PlusCircleIcon class="h-5 w-5"/>
                    Add review
                </button>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 mt-6">
                <div 
                    v-for="(item, index) in reviewsToDisplay"
                    :key="index"
                    class="flex flex-col gap-2 h-44 overflow-auto">
                    <div class="flex flex-col justify-center gap-2 h-2/5">
                        <div class="flex items-center gap-2">
                            <div
                                class="bg-contain bg-center bg-no-repeat rounded-full h-8 w-8"
                                :style="{'background-image': 'url('+ item.user.profile_picture_path +')'}"
                                alt="profile picture">
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="font-medium">
                                    {{item.user.name}}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{item.updated_at}}
                                </p>
                            </div>
                        </div>
                        <star-rating
                            v-model:rating="item.rating"
                            :round-start-rating="true"
                            :clearable="true"
                            :inline="true"
                            :read-only="true"
                            :increment="0.5"
                            :star-size="15"
                            :padding="2"
                            active-color="#FF5B1A"
                            :show-rating="false"
                        >
                        </star-rating>
                    </div>
                    <p class="overflow-auto">
                        {{item.review}}
                    </p>
                </div>
            </div>
            <button
                v-if="reviewsWithReview.length > 5" 
                @click="showAllReviews = !showAllReviews"
                class="border border-black p-2 rounded-md hover:underline hover:bg-gray-100">
                Show {{showAllReviews ? 'less' : 'more reviews'}}
            </button>
        </section>
    </div>
    <report-or-review-modal 
        :slug="property.slug"
        @reviewedProperty="onReviewedProperty"
    >
    </report-or-review-modal>
</template>

<script>

import StarRating from 'vue-star-rating'
import { GoogleMap, Marker } from 'vue3-google-map'

import propertyMixin from "./property_mixin.js";
import ReportOrReviewModal from './Modals/ReportOrReviewModal.vue'

import { PhoneIcon, FlagIcon } from '@heroicons/vue/solid'
import { ChatAltIcon, PlusCircleIcon } from '@heroicons/vue/outline'

export default {

    components: {
        StarRating,
        PhoneIcon,
        ChatAltIcon,
        FlagIcon,
        ReportOrReviewModal,
        PlusCircleIcon,
        GoogleMap, 
        Marker,
    },

    data() {
        return {
            thumbsSwiper: null,
            propertyReviewsData: this.property.reviews,
            phoneNumberForRequestCallback: this.authenticatedUser?.phone_number,
            requestCallBackToggle: false,
            gpsLocationArray: this.property.gps_location?.split(','), 
            showAllReviews: false,
        }
    },

    mixins: [propertyMixin],

    computed: {
        reviewsWithReview() {
            return this.propertyReviewsData.filter(obj => obj.review !== null)
        },

        reviewsToDisplay() {
            return this.showAllReviews ? this.reviewsWithReview : this.reviewsWithReview.slice(0, 5)
        },

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

                this.$emit('showLogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to report this property, or'})
                return
            }

            this.$vfm.show('ReportOrReviewModal', {mode: 'report'})
        },

        requestCallBack() {
            
            if (!this.isUserAuthenticated) {

                this.$emit('showLogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to request a call back, or'})
                return
            }  

            if (!this.phoneNumberForRequestCallback) return

            axios.post(`/users/${this.property.user_id}/request-call-back`, {phoneNumber: this.phoneNumberForRequestCallback})
                .then( (response) => {
                    if( response.status === 200 ) { 

                        this.$notify({ type: "success", text: "Callback requested!" });

                        this.requestCallBackToggle = false;
                    }
                })
                .catch( (error) => {
                    console.log(error)
            })  
        },

        reviewProperty() {

            if (!this.isUserAuthenticated) {

                this.$emit('showLogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to review this property, or'})
                return
            }

            this.$vfm.show('ReportOrReviewModal', {mode: 'review'})
        },

        onReviewedProperty(reviewData) {

            this.propertyReviewsData.unshift(reviewData)
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