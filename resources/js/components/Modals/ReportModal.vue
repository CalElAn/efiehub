<template>
<vue-final-modal
    v-model="showReportModal"
    name = 'ReportModal'
    :transition="{
        'enter-active-class': 'transition duration-200 ease-in-out transform',
        'enter-from-class': 'translate-y-full',
        'enter-to-class': 'translate-y-0',
        'leave-active-class': 'transition duration-200 ease-in-out transform',
        'leave-to-class': 'translate-y-full',
        'leave-from-class': 'translate-y-0'
    }"
    classes="text-sm sm:text-base flex justify-center items-center"
    content-class="sm:w-full sm:max-w-md px-6 pb-6 pt-8 bg-white overflow-hidden sm:rounded-lg rounded-2xl relative flex flex-col max-h-full border"
>
    <button class="absolute top-0 right-0 mt-2 mr-2" @click="showReportModal=false">
      <XIcon  class="h-5 w-5 text-black"/>
    </button>

    <form @submit.prevent="onSubmit" method="POST" action="/report-property">
        <div>
            <label for="loginEmail" class="block font-medium text-gray-700">Enter report details</label>

            <textarea
                v-model="form.body"
                id="body" 
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-2 w-full" 
                name="body"  
                required 
                autofocus>
            </textarea>
        </div>
        <div class="flex justify-end mt-3">
            <button
                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </div>
    </form>
</vue-final-modal>
</template>

<script>

import { XIcon } from '@heroicons/vue/solid'

export default {

    data: () => ({
        showReportModal: false,
        form: {
                body: '',
            }
    }),

    components: {
        XIcon
    },

    props: ['slug'],

    methods: {

        onSubmit() {
            axios.post('/report-property/'+this.slug, this.form)
            .then( (response) => {
                if( response.status === 201 ) {  

                    this.showReportModal = false; 
                    this.$notify({ type: "success", text: "Property reported!" });
               }
            })
            .catch( (error) => {})
        },
    },
}
</script>