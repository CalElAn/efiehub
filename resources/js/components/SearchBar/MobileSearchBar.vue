<template>
<vue-final-modal
    v-model="showMobileSearchBar"
    name = 'MobileSearchBarModal'
    @closed = "this.$emit('closedMobileSearchBar')"
    :transition="{
        'enter-active-class': 'transition duration-200 ease-in-out transform',
        'enter-from-class': 'translate-y-full',
        'enter-to-class': 'translate-y-0',
        'leave-active-class': 'transition duration-200 ease-in-out transform',
        'leave-to-class': 'translate-y-full',
        'leave-from-class': 'translate-y-0'
    }"
    classes="flex justify-center items-center"
    content-class="backdrop-blur-2xl backdrop-filter backdrop-opacity-90 bg-opacity-30 bg-white w-4/5 sm:max-w-md px-6 pb-6 pt-8 rounded-3xl relative flex flex-col max-h-full border"
>
    <button class="absolute top-0 right-0 mt-2 mr-4" @click="showMobileSearchBar=false">
      <XIcon  class="h-5 w-5 text-white"/>
    </button>

    <form action="/properties/search" method="GET">
    <div ref="searchBar" class="grid grid-rows-3 gap-4 h-52 mt-2 text-white text-base">
        <!-- Types Popover -->
        <Popover v-slot="{ open }" class="h-full relative hover:bg-opacity-75">
        <PopoverButton
            @click="isSearchBarFocused=true"
            :class="open ? 'bg-opacity-75 shadow-2xl' : ''"
            class="w-full inline-flex items-center text-center h-full rounded-full group bg-white text-main-blue">
            <span class="w-3/4">Type</span>
            <ChevronDownIcon :class="open ? 'rotate-180' : 'text-opacity-70'"
                class="w-1/4 h-6 transform transition-transform" aria-hidden="true" />
        </PopoverButton>
        <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
            enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
            leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
            <PopoverPanel
                @click="isSearchBarFocused=true"
                class="absolute z-20 w-max px-4 mt-3">
                <div class="overflow-hidden rounded-3xl shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="relative grid gap-4 text-xs text-gray-700 bg-white p-7 grid-cols-1">
                        <div class="col-span-1 flex items-center">
                            <input
                                v-model="selectAllPropertyTypes"
                                type="checkbox"
                                class="rounded border-gray-600 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" />
                            <span class="ml-2 font-semibold">-- Select {{selectAllPropertyTypes ? 'none' : 'all'}} --</span>
                        </div>
                        <!-- <div class="col-span-1"></div> -->
                        <div v-for="(item, index) in propertyTypes" :key="index" class="col-span-1 flex items-center">
                            <input type="checkbox"
                                v-model="form.types"
                                :value="item['type']"
                                class="rounded border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" />
                            <span class="ml-2">{{ item['type'] }}</span>
                        </div>
                    </div>
                </div>
            </PopoverPanel>
        </transition>
        </Popover>

        <!-- Location Input box -->
        <!-- <div 
            :class="[isInputFocused ? ' focus:bg-opacity-75 shadow-2xl' : 'group']"
            class="rounded-full flex items-center h-full focus-within:shadow-2xl bg-white text-main-blue">
            <input
                @focus="isInputFocused=true, isSearchBarFocused=true"
                @blur="isInputFocused=false"
                class="text-base lg:text-lg xl:text-xl text-center border-0 h-full pl-3 pr-0 w-full rounded-full focus:ring-0 focus:outline-none bg-transparent placeholder-opacity-70 placeholder-main-blue"
                type="text"
                placeholder="Enter a location">
            <LocationMarkerIcon class="h-6 pl-1 pr-3"/>
        </div> -->
        <Multiselect
            class="pr-2.5 sm:pr-7 rounded-full flex items-center h-full group focus-within:shadow-xl hover:shadow-lg focus-within:outline-none mobile-multiselect"
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
                container: 'relative mx-auto w-full flex items-center justify-end box-border cursor-pointer rounded-full text-base text-center border-0 bg-white text-main-blue leading-snug outline-none',
                placeholder: 'flex items-center justify-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug w-3/4 text-main-blue'
            }">
            <template v-slot:multiplelabel="{ values }">
                <div class="multiselect-multiple-label text-sm">
                    {{ values.length }} {{values.length > 1 ? 'regions' : 'region'}} selected
                </div>
            </template>
        </Multiselect>


        <!-- Price Range Popover -->
        <Popover v-slot="{ open }" class="relative h-full">
            <PopoverButton 
                @click="isSearchBarFocused=true" 
                :class="open ? 'focus:bg-opacity-75 shadow-2xl' : ''"
                class="w-full flex items-center h-full rounded-full group bg-white text-main-blue">
                <span class="w-3/4">Price range</span>
                <ChevronDownIcon :class="open ? 'rotate-180' : 'text-opacity-70'"
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
            :class="[isSearchBarFocused ? '' : '']"
            class="h-full">
            <button
                type="submit"
                class="p-1 rounded-full focus:outline-none w-full h-full bg-main-orange hover:bg-opacity-75 flex items-center justify-center gap-0.5">
                <!-- Search -->
                <search-icon 
                    :class="[isSearchBarFocused ? '' : '']"
                    class="text-white w-6"/>
                <span
                    :class="[isSearchBarFocused ? 'xl:inline' : '']" 
                    class="font-medium text-lg text-white tracking-wide">Search</span>
            </button>
        </div>
    </div>
        <SearchBarFormInputs :form="form"/>
    </form>

</vue-final-modal>
</template>

<script>
import searchBarMixin from "./search_bar_mixin.js"

import { XIcon } from '@heroicons/vue/solid'

export default {

    data () {
        return {
            showMobileSearchBar: false,
        }
    },

    components: {
        XIcon
    },

    mixins: [searchBarMixin],

    emits: ['closedMobileSearchBar']
   
}
</script>

<style>
    @import "./search_bar_styles.css";

    .mobile-multiselect .multiselect-clear-icon {
        --ms-clear-color: #4568ED;
    }

    .mobile-multiselect .multiselect-caret {
        --ms-caret-color: #4568ED;
    }
</style>
