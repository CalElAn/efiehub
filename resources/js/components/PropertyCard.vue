<template>
<div
    class="cursor-pointer rounded-3xl sm:rounded-main-card shadow-2xl transform hover:scale-105 relative flex flex-col bg-main-blue h-96 w-64 sm:w-96">
    <div class="absolute top-3 right-6 z-10 text-white flex flex-col gap-3">
        <button @click="favouriteProperty">
            <HeartIcon class="h-6 w-6" :class="{'text-main-orange': isPropertyFavouritedByUser}"/>
        </button>
        <button @click="shareProperty">
            <ShareIcon class="h-6 w-6"/>
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
        :navigation="true" 
        :pagination='{
            "clickable": true,
            "dynamicBullets": true}' 
        :grabCursor="true"
        :spaceBetween="15" 
        :loop="true"
        :lazy="true"
        class="w-full h-2/3">
        <swiper-slide v-for="(item, index) in property?.media" :key="index"
            class="bg-cover bg-center bg-no-repeat rounded-t-3xl sm:rounded-t-main-card swiper-lazy" :data-background="'/storage/'+item.path" alt="property image">
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </swiper-slide>
    </swiper>

    <div class="h-1/3 flex flex-col text-white text-xs sm:text-sm justify-around gap-2 p-4">
        <div>
            <a :href="'/show-property/' + property.slug">
                <p class="font-medium text-sm sm:text-base tracking-wide hover:underline">
                    {{property?.title}}
                </p>
            </a>
        </div>
        <div class="flex flex-col justify-between">
            <div 
                v-if="numberOfBedroomsAndBathrooms.exists"
                class="flex flex-row justify-center items-center gap-2">
                <p> {{numberOfBedroomsAndBathrooms.numberOfBedrooms}} bedrooms </p>
                <svg  width="5" height="5" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="2.5" cy="2.5" r="2.5" fill="white"/>
                </svg>
                <p> {{numberOfBedroomsAndBathrooms.numberOfBathrooms}} bathrooms </p>
            </div>
            <div class="flex flex-row justify-center items-center gap-2">
                <p> {{property?.features?.find(obj => obj.input_type == 'radio')?.feature}} </p>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <div v-if="property?.reviews[0]" class="flex items-center gap-1">
                <StarIcon class="h-4 sm:h-5 w-4 sm:w-5 text-white"/> 
                {{propertyReviews.average}} <span class="hidden sm:inline">({{propertyReviews.count}} reviews)</span>
            </div>
            <div v-else></div>
            <p> GH&#8373; {{property?.rent}} / month </p>
        </div>
    </div>
</div>
</template>

<script>
import propertyMixin from "./property_mixin.js";

export default {

    mixins: [propertyMixin],

}
</script>

<style>
@import "./property_styles.css";
</style>