<template>
    <form action="/properties/search" method="GET">
    <!-- <transition name="fade"> -->
    <div
        ref="searchBar"
        v-show="!isScrollYPastSearchBar || placeSearchBarInNavBar"
        :class="[isSearchBarFocused ? 'xl:grid-cols-9' : '', placeSearchBarInNavBar ? 'fixed top-16 left-0.1 z-20 shadow-2xl border text-main-blue' : 'absolute left-0 bottom-14 z-10 backdrop-blur-2xl backdrop-filter backdrop-opacity-90 bg-opacity-30']"
        class="grid-cols-8 bg-white gap-1 h-16 hidden items-center rounded-full sm:grid text-center text-white text-base lg:text-lg xl:text-xl w-searchbar-max md:w-searchbar-md xl:w-searchbar-max 3xl:w-searchbar-2x">

        <!-- Types Popover -->
        <Popover v-slot="{ open }" class="col-span-2 h-full relative hover:bg-opacity-75">
            <PopoverButton 
                @click="isSearchBarFocused=true" 
                :class="open ? 'bg-white text-main-blue hover:bg-opacity-75 shadow-2xl' : 'hover:bg-white hover:text-main-blue'"
                class="w-full inline-flex items-center px-3 h-full rounded-full group hover:shadow-lg">
                <span class="w-3/4">Type</span>
                <ChevronDownIcon 
                    :class="open ? 'rotate-180' : 'text-opacity-70'"
                    class="w-1/4 h-6 transform transition-transform" aria-hidden="true" />
            </PopoverButton>
            <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
                enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
                leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                <PopoverPanel
                    @click="isSearchBarFocused=true"
                    class="absolute z-10 w-max px-4 mt-5 md:ml-14 lg:ml-0 transform -translate-x-1/2 left-full">
                    <div class="overflow-hidden rounded-3xl shadow-lg ring-1 ring-black ring-opacity-5">
                        <div class="relative text-sm grid gap-4 bg-white p-7 grid-cols-2">
                            <div class="col-span-1 flex items-center">
                                <input
                                    v-model="selectAllPropertyTypes"
                                    type="checkbox"
                                    class="rounded border-gray-600 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" />
                                <span class="ml-2 font-semibold text-gray-700">-- Select {{selectAllPropertyTypes ? 'none' : 'all'}} --</span>
                            </div>
                            <div class="col-span-1"></div>
                            <div v-for="(item, index) in propertyTypes" :key="index" class="col-span-1 flex items-center">
                                <input type="checkbox"
                                    v-model="form.types"
                                    :value="item['type']"
                                    class="rounded border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" />
                                <span class="ml-2 text-gray-700">{{ item['type'] }}</span>
                            </div>
                        </div>
                    </div>
                </PopoverPanel>
            </transition>
        </Popover>

        <!-- Location Input box -->
        <!-- <div 
            :class="[isInputFocused ? 'bg-white text-main-blue hover:bg-opacity-75 shadow-2xl' : 'hover:bg-white hover:text-main-blue']"
            class="col-span-3 rounded-full flex items-center h-full group focus-within:shadow-2xl">
            <div style="height:32px; width:1px; background: #ddd; display:inline;"></div>
            <input
                @focus="isInputFocused=true, isSearchBarFocused=true"
                @blur="isInputFocused=false"
                :class="[placeSearchBarInNavBar ? ' placeholder-main-blue' : ' placeholder-white']"
                class="text-base lg:text-lg xl:text-xl text-left border-0 h-full pl-3 pr-0 w-full rounded-full focus:ring-0 focus:outline-none bg-transparent mx-2 focus:placeholder-main-blue group-hover:placeholder-main-blue "
                type="text"
                placeholder="Enter a location">
            <LocationMarkerIcon class="h-6 pl-1 pr-3"/>
            <div style="height:32px; width:1px; background: #ddd; display:inline;"></div>
        </div> -->
        <!-- Location Multiselect -->
        <Multiselect
            :class="[placeSearchBarInNavBar ? 'place-search-bar-in-nav-bar' : '']"
            class="col-span-3 px-4 rounded-full relative text-base lg:text-lg xl:text-xl text-main-blue flex items-center justify-end h-full group focus-within:shadow-2xl hover:shadow-lg"
            name="regions"
            v-model="form.regions"
            mode="multiple"
            valueProp="name"
            trackBy="name"
            label="name"
            placeholder="Region"
            :close-on-select="false"
            :searchable="false"
            :options="regions" 
            :classes="{
                container: 'focus:bg-white focus:text-main-blue hover:bg-white relative mx-auto w-full flex items-center box-border cursor-pointer rounded-full border-0 border-l border-r bg-transparent text-xs sm:text-sm leading-snug outline-none',
                caret: 'multiselect-caret bg-multiselect-caret bg-center bg-no-repeat w-2.5 h-4 py-px box-content mr-3.5 relative z-10 flex-shrink-0 flex-grow-0 transition-transform transform pointer-events-none group-hover:color-main-blue group-focus:color-main-blue',
                clearIcon: 'multiselect-clear-icon bg-multiselect-remove bg-center bg-no-repeat w-2.5 h-4 py-px box-content inline-block group-hover:color-main-blue group-focus:color-main-blue',
            }">
            <template v-slot:placeholder>
                <div 
                    :class="[placeSearchBarInNavBar ? 'text-main-blue' : 'text-white']"
                    class="text-white text-base lg:text-lg xl:text-xl flex items-center justify-center w-full h-full group-hover:text-main-blue group-focus:text-main-blue">
                    Region
                </div>
            </template>
            <template v-slot:multiplelabel="{ values }">
                <div class="multiselect-multiple-label">
                    {{ values.length }} {{values.length > 1 ? 'regions' : 'region'}} selected
                </div>
            </template>
        </Multiselect>


        <!-- Price Range Popover -->
        <Popover v-slot="{ open }" class="col-span-2 relative h-full">
            <PopoverButton 
                @click="isSearchBarFocused=true" 
                :class="open ? 'bg-white text-main-blue hover:bg-opacity-75 shadow-2xl' : 'hover:bg-white hover:text-main-blue'"
                class="w-full flex items-center pl-1 h-full rounded-full group hover:shadow-lg">
                <span class="w-3/4">Price range</span>
                <ChevronDownIcon
                    :class="open ? 'rotate-180' : 'text-opacity-70'"
                    class="w-1/4 h-6 transform transition-transform" aria-hidden="true" />
            </PopoverButton>
            <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
                enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
                leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                <PopoverPanel
                    class="absolute z-10 w-max px-4 mt-5 transform -translate-x-1/2 left-1/2">
                    <div class="overflow-hidden rounded-3xl shadow-lg ring-1 ring-black ring-opacity-5">
                        <div class="bg-white pb-7 pt-14 px-12 w-80 relative">
                            <Slider 
                                :min="form.priceRange?.[0]"
                                :max="form.priceRange?.[1]"
                                :format="sliderFormat"
                                v-model="form.priceRange" 
                            />
                        </div>
                    </div>
                </PopoverPanel>
            </transition>
        </Popover>

        <!-- Search Button -->
        <div 
            :class="[isSearchBarFocused ? 'xl:col-span-2' : '']"
            class="col-span-1 p-2 h-full">
            <button 
                type="submit"
                class="rounded-full focus:outline-none w-full h-full bg-main-orange hover:bg-opacity-75 flex items-center justify-evenly">
                <search-icon 
                    :class="[isSearchBarFocused ? '' : '']"
                    class="text-white w-6"/>
                <span
                    :class="[isSearchBarFocused ? 'xl:inline' : '']" 
                    class="hidden font-semibold mr-6 text-lg text-white tracking-wide">Search</span>
            </button>
        </div>
    </div>
        <SearchBarFormInputs :form="form"/>
    </form>
    <!-- </transition> -->
</template>

<script>
import searchBarMixin from "./search_bar_mixin.js"

export default {
    mixins: [searchBarMixin],

    data() {
        return {
            isScrollYPastSearchBar: false,
        }
    },

    props: ['placeSearchBarInNavBar'],

    emits: ['scrollYIsPastSearchBar', 'scrollYIsNotPastSearchBar'],

    mounted() {

        let searchBarOffsetTop = this.$refs.searchBar.offsetTop;
        let searchBarOffsetHeight = this.$refs.searchBar.offsetHeight;
        let navBarHeight = document.getElementById('nav-bar').offsetHeight;
        let thisVar = this;

        window.addEventListener(
            'scroll', 
                function() {
                if (window.scrollY + 30 - navBarHeight >= searchBarOffsetTop ) {
                    thisVar.isScrollYPastSearchBar = true
                    thisVar.$emit('scrollYIsPastSearchBar')
                } else {
                    thisVar.isScrollYPastSearchBar = false
                    thisVar.$emit('scrollYIsNotPastSearchBar')
                }
            }
        );  
    }   
}
</script>

<style lang="css">
    @import "./search_bar_styles.css";

    .multiselect-clear-icon {
        --ms-clear-color: #fff;
    }

    .place-search-bar-in-nav-bar .multiselect-clear-icon {
        --ms-clear-color: #4568ED;
    }

    .multiselect-clear-icon:hover {
        --ms-clear-color: #4568ED;
    }

    .multiselect-caret {
        --ms-caret-color: #fff;
    }

    .place-search-bar-in-nav-bar .multiselect-caret {
        --ms-caret-color: #4568ED;
    }

    .multiselect-caret:hover {
        --ms-caret-color: #4568ED;
    }

    .group:hover .group-hover\:color-main-blue {
        --ms-clear-color: #4568ED;
        --ms-caret-color: #4568ED;
    }

    .group:focus .group-focus\:color-main-blue {
        --ms-clear-color: #4568ED;
        --ms-caret-color: #4568ED;
    }

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.1s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }
</style>
