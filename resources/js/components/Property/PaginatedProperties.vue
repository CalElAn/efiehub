<template>
    <div class="flex flex-col items-center mt-12 mb-10 gap-16 lg:grid lg:grid-cols-2 xl:grid-cols-3 xl:gap-20">

        <PropertyCard
            v-for="(item, index) in paginatedProperties.data"
            :key="index"
            :property="item"
        />

    </div>

    <pagination 
        v-model="page" 
        :records="paginatedProperties.total" 
        :per-page="paginatedProperties.per_page" 
        @paginate="getPaginatedProperties"    
        :options="paginationOptions"   
    />    
</template>

<script>
import { markRaw, } from 'vue';

import PropertyCard from './Card.vue'
import CustomPagination from '../CustomPagination.vue'

export default {
    components: {
        PropertyCard,
    },

    data() {
        return {
            page: 1,
            paginationOptions: {
                template: markRaw(CustomPagination),
                chunk: 5,
                edgeNavigation: true,
            },
        }
    },

    props: ['initialPaginatedProperties'],  
    
    computed: {
        paginatedProperties() {
            return this.initialPaginatedProperties
        }
    },

    methods: {
        getPaginatedProperties(page) {

            let axiosPathSeparator = '?' 

            if (this.initialPaginatedProperties.path.includes('?')) {
                axiosPathSeparator = '&'
            }

            axios.get(`${this.initialPaginatedProperties.path}${axiosPathSeparator}page=${page}`)
            .then(
                response => {
                    this.paginatedProperties = response.data.paginatedProperties;
                }   
            )
        }
    }
}
</script>