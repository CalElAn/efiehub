<template>
<div class="rounded-main-card flex flex-col bg-main-blue h-96 w-64 sm:w-96">
    <!-- <div class="bg-cover bg-no-repeat h-2/3" style="background-image: url('images/accra.png');" alt="accra home"></div> -->
    <swiper 
        :style="{
            '--swiper-navigation-color': '#fff',
            '--swiper-pagination-color': '#FF5B1A',
            '--swiper-pagination-bullet-inactive-color': '#fff',
            '--swiper-pagination-bullet-inactive-opacity': 1,
            '--swiper-navigation-size': '70px',
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
        <swiper-slide class="bg-cover bg-no-repeat swiper-lazy" data-background="images/accra.png">
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </swiper-slide>
        <swiper-slide class="bg-cover bg-no-repeat swiper-lazy" data-background="images/kumasi.png" alt="kumasi home">
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </swiper-slide>
        <swiper-slide class="bg-cover bg-no-repeat swiper-lazy" data-background="images/tamale.png" alt="tamale home">
            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </swiper-slide>
    </swiper>

    <div class="h-1/3 flex flex-col text-white text-base justify-around gap-2 p-5">
        <div>
            <p class="font-medium text-lg">
                Vue Apartment Apartment in Okponglo
            </p>
        </div>
        <div class="flex justify-between text-sm">
            <div class="flex flex-col">
                <p>
                    Self contained
                </p>
                <p>
                    Porch
                </p>
            </div>
            <div>
                <p>
                    $200
                </p>
                <p class="text-xs">
                    per month
                </p>
            </div>
        </div>
    </div>
</div>
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

export default {
    components: {
        Swiper,
        SwiperSlide,
    },

    data() {
        return {

        }
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