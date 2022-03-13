<template>
<div class="mt-10 sm:mt-32">
    <Head title="Search Property"></Head>
    <div id="div-to-scroll-to"></div>
    <div class="grid grid-cols-4 grid-rows-2 grid-flow-col sm:grid-rows-1 sm:grid-cols-9 gap-3 h-28 sm:h-16 w-full py-1 px-2 sm:px-3 pb-2 border-b items-center text-center bg-white text-main-blue text-sm sm:text-base lg:text-lg xl:text-xl">
        <Popover v-slot="{ open }" class="h-full relative rounded-full hover:shadow-lg">
            <PopoverButton 
                :class="open ? 'hover:bg-opacity-75 shadow-2xl focus:outline-none focus:ring-2 focus:ring-offset-4 focus:ring-main-orange' : ''"
                class="w-full inline-flex items-center border border-main-blue px-1 h-full rounded-full group">
                <span class="w-3/4">Type</span>
                <ChevronDownIcon :class="open ? 'rotate-180' : 'text-opacity-70'"
                    class="w-1/4 h-6 transform transition-transform" aria-hidden="true" />
            </PopoverButton>
            <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
                enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
                leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                <PopoverPanel
                    class="absolute z-10 w-max mt-5 transform">
                    <div class="overflow-hidden rounded-xl sm:rounded-3xl shadow-lg ring-1 ring-black ring-opacity-5">
                        <div class="relative text-xs sm:text-sm grid gap-2 sm:gap-4 bg-white p-3 sm:p-7 grid-cols-2">
                            <div class="col-span-1 flex items-center">
                                <input
                                    v-model="selectAllPropertyTypes"
                                    @change="searchProperty"
                                    type="checkbox"
                                    class="rounded border-gray-600 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" />
                                <span class="ml-2 font-semibold text-gray-700"> -- Select {{selectAllPropertyTypes ? 'none' : 'all'}} -- </span>
                            </div>
                            <div class="col-span-1"></div>
                            <div v-for="(item, index) in propertyTypes" :key="index" class="col-span-1 flex items-center">
                                <input 
                                    @change="searchProperty"
                                    type="checkbox"
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

        <Multiselect
            class="search-page col-start-2 col-span-2 pl-3 rounded-full flex items-center border border-main-blue h-full group focus-within:shadow-xl hover:shadow-lg focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-4 focus-within:ring-main-orange"
            v-model="form.regions"
            @change="searchProperty"
            mode="multiple"
            valueProp="name"
            trackBy="name"
            label="name"
            placeholder="All regions"
            :close-on-select="false"
            :searchable="false"
            :options="regions" 
            :classes="{
                container: 'relative mx-auto w-full flex items-center justify-end box-border cursor-pointer border rounded-full border-main-blue bg-white text-xs sm:text-sm leading-snug outline-none',
                placeholder: 'multiselect-placeholder min-w-max'
            }">
            <template v-slot:multiplelabel="{ values }">
                <div class="multiselect-multiple-label">
                    {{ values.length }} {{values.length > 1 ? 'regions' : 'region'}} selected
                </div>
        </template>
        </Multiselect>

        <Popover v-slot="{ open }" class="col-start-4 relative h-full rounded-full hover:shadow-lg">
            <PopoverButton 
                :class="open ? 'hover:bg-opacity-75 shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-4 focus:ring-main-orange' : ''"
                class="w-full flex items-center px-2 h-full rounded-full group border border-main-blue">
                <span class="w-3/4">Price</span>
                <ChevronDownIcon :class="open ? 'rotate-180' : 'text-opacity-70'"
                    class="w-1/4 h-6 transform transition-transform" aria-hidden="true" />
            </PopoverButton>
            <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
                enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
                leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                <PopoverPanel
                    class="absolute z-10 w-max sm:px-4 mt-5 transform sm:-translate-x-1/2 right-0 sm:left-1/2">
                    <div class="overflow-hidden rounded-3xl shadow-lg ring-1 ring-black ring-opacity-5">
                        <div class="bg-white pb-7 pt-14 px-12 w-72 sm:w-80 relative">
                            <Slider 
                                :min="0"
                                :max="500"
                                :format="sliderFormat"
                                v-model="form.priceRange" 
                                @change="searchProperty"
                                @select="searchProperty"
                                @deselect="searchProperty"
                                @clear="searchProperty"
                            />
                        </div>
                    </div>
                </PopoverPanel>
            </transition>
        </Popover>

        <!-- hidden for now till developed -->
        <!-- <button
            class="row-start-2 sm:row-start-1 w-full h-full flex items-center px-1 rounded-full hover:bg-opacity-75 text-main-orange border border-main-orange hover:shadow-lg">
            <AdjustmentsIcon class="w-1/4 h-6"/>
            <span class="w-3/4">Filters</span>
        </button> -->

        <!-- in case would change colour later consider changing tailwind forms config to not affect select elements -->
        <select 
            v-model="form.orderBy"
            @change="searchProperty"
            class="row-start-2 col-start-3 col-span-2 sm:row-start-1 sm:col-start-8 w-full h-full border-none text-center text-xs sm:text-sm font-medium text-gray-500 pl-0 pr-8 focus:ring-0">
            <option value="latest">Newest</option>
            <option value="priceLowToHigh">Price: low to high</option>
            <option  value="priceHighToLow">Price: high to low</option>
        </select>
    </div>

    <div class="flex justify-end px-6 pt-1 text-xs sm:text-sm font-medium">
        {{paginatedProperties.total}} properties found
    </div>
    <p 
        v-if="paginatedProperties.total === 0"
        class="mt-24 text-center text-xl"
    >
        Your search did not match any available properties. Please try again sometime soon.
    </p>

    <PaginatedProperties
        :paginatedProperties="paginatedProperties"
    >
    </PaginatedProperties>
</div>
</template>

<script>
import searchBarMixin from "../../components/SearchBar/search_bar_mixin.js"

import { AdjustmentsIcon } from '@heroicons/vue/solid'

export default {
    components: {
        AdjustmentsIcon,
    },

    props: {
        paginatedProperties: Object,
        searchQuery: Object
    },

    mixins: [searchBarMixin],
}
</script>

<style>
    @import "../../components/SearchBar/search_bar_styles.css";

    .search-page .multiselect-clear-icon {
        --ms-clear-color: #4568ED !important;
    }

    .search-page .multiselect-caret {
        --ms-caret-color: #4568ED !important;
    }
</style>