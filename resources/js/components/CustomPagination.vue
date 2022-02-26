<template>
    <div class='VuePagination'>
        <nav class="flex items-center ">

            <div class="flex flex-1 items-center justify-between sm:hidden px-3 relative z-0 shadow-sm rounded-md">
                    <button
                        type="button"
                        @click="props.setPrevPage"
                        v-bind="props.prevProps"
                        :class="[props.page === 1 ? 'text-gray-500' : 'text-gray-700 hover:text-gray-500 focus:ring ring-blue-300 focus:border-blue-300']"
                        class="relative inline-flex items-center rounded-l-lg px-4 py-2 -ml-px text-sm font-medium bg-white border border-gray-300 leading-5 focus:z-10 focus:outline-none focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                    >
                        {{props.texts.prevPage}} Previous
                    </button>

                    {{props.page}}/{{props.totalPages}}

                    <button
                        type="button"
                        @click="props.setNextPage"
                        v-bind="props.nextProps"
                        :class="[props.page === props.totalPages ? 'text-gray-500' : 'text-gray-700 hover:text-gray-500 focus:ring ring-blue-300 focus:border-blue-300']"
                        class="relative inline-flex items-center rounded-r-lg px-4 py-2 -ml-px text-sm font-medium  bg-white border border-gray-300 leading-5  focus:z-10 focus:outline-none  active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                    >
                        Next {{props.texts.nextPage}}
                    </button>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">

                <!-- <p v-show="props.hasRecords" class="text-sm text-gray-700 leading-5">{{props.count}}</p> -->

                <ul 
                    v-show="props.showPagination" 
                    class="relative z-0 inline-flex shadow-sm rounded-md">
                    <li 
                        v-if="props.hasEdgeNav" 
                        @click="props.setFirstPage">
                        <button 
                            type="button" 
                            v-bind="props.firstPageProps"
                            class="relative inline-flex gap-1 items-center justify-between px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" 
                        >
                            <ArrowNarrowLeftIcon class="w-5 h-5 text-gray-700 hover:text-gray-500"/>
                            {{props.texts.first}}
                        </button>
                    </li>
                    <li 
                        v-if="props.hasChunksNav" 
                        @click="props.setPrevChunk">
                        <button 
                            type="button" 
                            v-bind="props.prevChunkProps"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                        >{{props.texts.prevChunk}}</button>
                    </li>
                    <li>
                        <button 
                        type="button" 
                        @click="props.setPrevPage"
                        v-bind="props.prevProps"
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                        >{{props.texts.prevPage}}</button>
                    </li>
                    <li 
                        v-for="page in props.pages" 
                        :key="page">
                        <button 
                        type="button"
                        v-on="props.pageEvents(page)"
                        v-bind="props.aProps"
                        :class="[page === props.page ? 'bg-main-blue border-main-blue text-white' : 'border-gray-300 bg-white text-gray-700']"
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium border leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-blue-300 focus:border-main-blue transition ease-in-out duration-150"
                        >{{page}}</button>
                    </li>
                    <li @click="props.setNextPage">
                        <button 
                            type="button" 
                            v-bind="props.nextProps"
                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                        >
                            {{props.texts.nextPage}}
                        </button>
                    </li>
                    <li v-if="props.hasChunksNav">
                        <button 
                            type="button" 
                            @click="props.setNextChunk" 
                            v-bind="props.nextChunkProps"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" 
                        >
                            {{props.texts.nextChunk}}
                        </button>
                    </li>
                    <li 
                        v-if="props.hasEdgeNav">
                        <button 
                            type="button" 
                            @click="props.setLastPage" 
                            v-bind="props.lastPageProps"
                            class="relative inline-flex gap-1 items-center justify-between px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"  
                        >
                            {{props.texts.last}}
                            <ArrowNarrowRightIcon class="w-5 h-5 text-gray-700 hover:text-gray-500"/>
                        </button>
                    </li>
                </ul>
            </div>

        </nav>
    </div>

</template>

<script>

import { ArrowNarrowRightIcon, ArrowNarrowLeftIcon } from '@heroicons/vue/solid'

export default {
    name: 'CustomPagination',

    components: {
        ArrowNarrowRightIcon,
        ArrowNarrowLeftIcon
    },

    props: ['props'],
}

</script>