<template>
<header>
    <div ref="mainHeaderBg" class="w-full h-header-bg-min sm:h-header-bg flex flex-col sm:px-10 3xl:px-20 pt-7 sm:mt-3 bg-main-blue rounded-b-header-bg-min sm:rounded-3xl">
        <div class="flex flex-col flex-grow sm:grid sm:grid-cols-2 sm:mt-5 md:pt-6">
            <div class="flex flex-col justify-start gap-5 3xl:gap-10 sm:relative">
                <p class="text-4xl sm:text-5xl xl:text-6xl 3xl:text-7xl font-bold text-white text-center sm:text-left mt-3 mx-7 sm:mx-0">
                    Rent that meets your lifestyle
                </p>
                <p class="text-white sm:text-2xl 3xl:text-3xl text-center sm:text-left my-2">
                    Rent the easy way
                </p>
                <LargeSearchBar></LargeSearchBar>
            </div>
            <div class="relative flex flex-grow">
                <div class="mx-auto flex-grow bg-contain bg-bottom bg-no-repeat sm:absolute right-0 md:bg-center lg:bg-top 3xl:bg-left sm:w-header-img sm:h-header-img" alt="surprised man" style="background-image: url('images/surprised-man-2x.png');">
                </div>
                <button 
                    @click="$vfm.show('MobileSearchBarModal')"
                    class="absolute bottom-9 left-0 right-0 mx-auto h-14 w-44 justify-evenly text-white flex items-center rounded-full backdrop-filter backdrop-blur-2xl backdrop-opacity-90 bg-opacity-30 bg-white sm:hidden">
                    Find a home
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
<section class="flex justify-center mt-4 lg:mt-10 sm:justify-start sm:mx-10 xl:text-lg">
    <!-- <button class="bg-main-orange text-white rounded-full hover:bg-opacity-75 w-44 h-12 sm:w-52 sm:h-16">
        Book an agent
    </button>  -->
</section>
<section class="mt-12 sm:mt-20 mx-5 sm:mx-10">
    <p class="font-semibold text-xl sm:text-2xl">
        Explore other locations
    </p>
    <div class="flex flex-col sm:grid sm:grid-cols-2 lg:grid-cols-3 3xl:grid-cols-5 mt-5 gap-8">
        <Link href="/properties/search?region='Greater Accra'" class="flex gap-2.5">
            <img src="images/accra.png" alt="accra" class="rounded-3xl w-16 h-16">
            <div class="flex flex-col justify-center gap-1">
                <p class="font-medium text-base sm:text-lg">
                    Greater Accra Region
                </p>
                 <!-- <p class="text-gray-700 text-sm sm:text-base">
                    Greater Accra Region
                </p>  -->
            </div>
        </Link>
        <Link href="/properties/search?region='Ashanti'" class="flex gap-2.5">
            <img src="images/kumasi.png" alt="accra" class="rounded-3xl w-16 h-16">
            <div class="flex flex-col justify-center gap-1">
                <p class="font-medium text-base sm:text-lg">
                    Ashanti Region
                </p>
                <!-- <p class="text-gray-700 text-sm sm:text-base">
                    Ashanti Region
                </p> -->
            </div>
        </Link>
        <Link href="/properties/search?region='Northern'" class="flex gap-2.5">
            <img src="images/tamale.png" alt="accra" class="rounded-3xl w-16 h-16">
            <div class="flex flex-col justify-center gap-1">
                <p class="font-medium text-base sm:text-lg">
                    Northern Region 
                </p>
                <!-- <p class="text-gray-700 text-sm sm:text-base">
                    Northern Region
                </p>  -->
            </div>
        </Link>
        <div class="flex gap-2.5">
            <img src="images/accra.png" alt="accra" class="rounded-3xl w-16 h-16">
            <div class="flex flex-col justify-center gap-1">
                <p class="font-medium text-base sm:text-lg">
                    Volta Region
                </p>
                <!-- <p class="text-gray-700 text-sm sm:text-base">
                    Ashanti Region
                </p>  -->
            </div>
        </div>
    </div>
</section>
<div id="div-to-scroll-to"></div>
<section class="mt-20 mx-5 sm:mx-10">
    <p class="font-semibold text-xl sm:text-2xl">
        Uploaded properties
    </p>
    <PaginatedProperties
        :paginatedProperties="paginatedProperties"
    >
    </PaginatedProperties>
</section>
<!-- <section class="mt-16 mx-5 sm:mx-10">
    <p class="font-semibold text-xl sm:text-2xl mx-5 text-center">
        Not sure where to rent?
    </p>
    <div class="flex justify-center mt-4">
         <button class="bg-main-orange text-white rounded-full h-12 w-44 sm:w-52 sm:h-16">
            Book an agent
        </button> 
    </div>
</section> -->
<section class="flex items-center mt-20 mx-2 sm:mx-10 rounded-3xl sm:rounded-main-card bg-cover bg-no-repeat bg-become-an-agent lg:bg-become-an-agent-2x h-96 sm:h-become-an-agent-card-max">
    <div class="flex flex-col gap-5 px-1.5 sm:px-0 sm:mx-24">
        <p class="text-white text-center text-4xl font-semibold sm:text-5xl">
            Become an agent
        </p>
        <p class="text-white text-center font-medium sm:text-2xl">
            Earn extra income and unlock new opportunities
        </p>
        <div class="flex justify-center">
            <button class="bg-main-orange text-white rounded-full h-12 w-44 sm:w-52 sm:h-16 sm:text-lg">
                Learn more
            </button>
        </div>
    </div>
</section>
<section class="mt-16 mx-5 sm:mx-10 flex flex-col gap-20 lg:grid lg:grid-cols-3 text-justify">
    <div class="flex flex-col gap-6">
        <p class="text-center font-semibold text-xl sm:text-2xl text-main-blue">
            Rent the easy way
        </p>
        <p>
            Discover thousands of apartments and homes for rent
        </p>
    </div>
    <div class="flex flex-col gap-6">
        <p class="text-center font-semibold text-xl sm:text-2xl text-main-blue">
            Add a property
        </p>
        <p>
            Boost your rental business. Reach thousands of tenants through our website and other partner websites with just one click
        </p>
    </div>
    <div class="flex flex-col gap-6">
        <p class="text-center font-semibold text-xl sm:text-2xl text-main-blue">
            Earn income
        </p>
        <p>
            Upload properties and earn money as an agent
        </p>
    </div>
</section>
   
</template>

<script>
import LargeSearchBar from '../components/SearchBar/LargeSearchBar.vue'

export default {
    components: {
        LargeSearchBar,
    },

    props: {
        paginatedProperties: Object,
    }
}

</script>