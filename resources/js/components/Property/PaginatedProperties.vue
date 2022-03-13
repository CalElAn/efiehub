<template>
    <div class="flex flex-col items-center mt-12 mb-10 gap-16 lg:grid lg:grid-cols-2 xl:grid-cols-3 xl:gap-20">
        <PropertyCard
            v-for="(item, index) in paginatedProperties.data"
            :key="index"
            :property="item"
        />
    </div>
    <Pagination
        :links="paginatedProperties.links"
    />
</template>

<script>
import PropertyCard from './Card.vue'
import Pagination from '../Pagination.vue'

export default {
    components: {
        PropertyCard,
        Pagination,
    },

    props: {
        paginatedProperties: Object
    }, 

    mounted() {
        if (location.href.includes('page=')) this.scrollToLastMessage()
    },
}
</script>