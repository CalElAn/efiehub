<template>
    <input v-for="(item, index) in form.types" :key="index" type="hidden" name="types[]" :value="item"/>
    <input v-for="(item, index) in form.regions" :key="index" type="hidden" name="regions[]" :value="item"/>
    <input v-for="(item, index) in form.priceRange" :key="index" type="hidden" name="priceRange[]" :value="item"/>
</template>

<script>
export default {
    props: ['form'],
}
</script>