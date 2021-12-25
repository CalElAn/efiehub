<template>
<div class="rounded-3xl sm:rounded-main-card relative flex flex-col bg-main-blue h-96 w-64 sm:w-96">
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
            class="bg-cover bg-center bg-no-repeat rounded-t-3xl sm:rounded-t-main-card swiper-lazy" :data-background="'storage/'+item.path" alt="property image">
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </swiper-slide>
    </swiper>

    <div class="h-1/3 flex flex-col text-white text-xs sm:text-sm justify-around gap-2 p-4">
        <div>
            <p class="font-medium text-sm sm:text-base tracking-wide">
                {{property?.property_type?.type}} in {{property?.town}}
            </p>
        </div>
        <div class="flex flex-col justify-between">
            <div class="flex flex-row justify-center items-center gap-2">
                <p> {{property?.features.find(obj => obj.feature == 'Number of bedrooms')?.pivot?.number}} bedrooms </p>
                <svg  width="5" height="5" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="2.5" cy="2.5" r="2.5" fill="white"/>
                </svg>
                <p> {{property?.features.find(obj => obj.feature == 'Number of washrooms')?.pivot?.number}} washrooms </p>
            </div>
            <div class="flex flex-row justify-center items-center gap-2">
                <p> {{property?.features.find(obj => obj.input_type == 'radio')?.feature}} </p>
            </div>
        </div>
        <div class="flex justify-between items-center">
            <div v-if="Object.keys(property?.reviews).length" class="flex items-center gap-1">
                <StarIcon class="h-4 sm:h-5 w-4 sm:w-5 text-white"/> 
                {{Math.round((Object.values(property?.reviews).reduce((a, b) => a + parseFloat(b.rating), 0) / Object.keys(property?.reviews).length)*100)/100}} <span class="hidden sm:inline">({{Object.keys(property?.reviews).length}} reviews)</span>
            </div>
            <div v-else></div>
            <p> GH&#8373; {{property?.rent}} / month </p>
        </div>
    </div>
</div>
<notifications position="bottom right" />
</template>

<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/lazy'

// import Swiper core and required modules
import SwiperCore, { Navigation, Pagination, Mousewheel, Lazy } from 'swiper';

// install Swiper modules
SwiperCore.use([Navigation, Pagination, Mousewheel, Lazy]);

import { StarIcon, HeartIcon, ShareIcon } from '@heroicons/vue/solid'

export default {
    components: {
        Swiper,
        SwiperSlide,
        StarIcon,
        HeartIcon,
        ShareIcon
    },

    data() {
        return {
        }
    },

    props: ['property', 'isUserAuthenticated', 'authenticatedUser'],

    emits: ['showLogInModal', 'unfavouriteProperty', 'favouriteProperty'],

    methods: {
        favouriteProperty() {

            if (!this.isUserAuthenticated) {

                this.$emit('showLogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to add to favourites, or'})
                return
            }

            axios.post('/favourite-property', { 'propertyId': this.property.property_id,})
            .then( (response) => {
                if( response.status === 200 ) { 

                    this.$emit('unfavouriteProperty', this.property.property_id)
                }

                if( response.status === 201 ) { 

                    this.$notify({ type: "success", text: "Added to favourites!" });
                    this.$emit('favouriteProperty', response.data)
                }
            })
            .catch( (error) => {
                console.log(error)
            })  
        },

        shareProperty() {

        }
    },

    computed: {
        isPropertyFavouritedByUser() {
            return !!( this.authenticatedUser?.favourite_properties?.find( obj => obj.property_id === this.property.property_id) )
        },
    }
}
</script>

<style>
    .swiper-button-prev {
        /**svg size: 100 */
        background-image: url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20width%3D%22500%22%20height%3D%22500%22%20preserveAspectRatio%3D%22xMidYMid%20meet%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cg%20fill%3D%22none%22%3E%3Ccircle%20cx%3D%2212%22%20cy%3D%2212%22%20r%3D%2210%22%20stroke%3D%22white%22%20stroke-width%3D%222%22%2F%3E%3Cpath%20d%3D%22M13.5%208l-4%204l4%204%22%20stroke%3D%22white%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E') !important;

        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
    }

    .swiper-button-prev::after {
        display: none;
    }

    .swiper-button-next {
        background-image: url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20width%3D%22500%22%20height%3D%22500%22%20preserveAspectRatio%3D%22xMidYMid%20meet%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cg%20transform%3D%22translate(24%200)%20scale(-1%201)%22%3E%3Cg%20fill%3D%22none%22%3E%3Ccircle%20cx%3D%2212%22%20cy%3D%2212%22%20r%3D%2210%22%20stroke%3D%22white%22%20stroke-width%3D%222%22%2F%3E%3Cpath%20d%3D%22M13.5%208l-4%204l4%204%22%20stroke%3D%22white%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E') !important;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
    }

    .swiper-button-next::after {
        display: none;
    }


</style>