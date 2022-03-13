<template>
<vue-final-modal
    v-model="showReportOrReviewModal"
    name = 'ReportOrReviewModal'
    @beforeOpen="event => beforeOpen(event)"
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
    <button class="absolute top-0 right-0 mt-2 mr-2" @click="showReportOrReviewModal=false">
        <XIcon  class="h-5 w-5 text-black"/>
    </button>

    <form @submit.prevent="onSubmit" method="POST" action="/">
        <div 
            v-if="mode === 'review'"
            class="flex gap-3 items-center mt-3">
            <star-rating 
                v-model:rating="form.review.rating"
                :round-start-rating="true"
                :clearable="true"
                :inline="true"
                :rounded-corners="true" 
                :border-width="2"
                :increment="0.5"
                :star-size="20"
                :padding="3"
                active-color="#FF5B1A"
                :show-rating="true"
            >
            </star-rating>
            <span class="text-red-600 text-sm"> (required) </span>
        </div>
        <div class="mt-5">
            <label class="block font-medium text-gray-700">{{mode}} details</label>

            <textarea
                v-model="form[mode].body"
                id="body" 
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-2 w-full" 
                name="body"  
                :required="mode === 'report'" 
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

import StarRating from 'vue-star-rating'

export default {
    components: {
        StarRating,
    },

    data: () => ({
        showReportOrReviewModal: false,
        mode: 'report', //initially set to 'report' so v-model on textarea works when initialized, its set by "beforeOpen" event
        form: {
            report: {
                body: '',
            },
            review: {
                rating: null,
                body: ''
            },
        },
        formError: '',
    }),

    props: ['slug', 'model'],

    emits: ['reviewedProperty'],

    computed: {
        getUrl() {
            return ({
                'Property': 'properties',
                'User': 'users',
            })
            [this.model]
        }
    },

    methods: {
        beforeOpen(event) {
            this.mode = event.ref.params.value.mode
        },

        onSubmit() {
            axios.post(`/${this.getUrl}/${this.slug}/${this.mode}s`, this.form[this.mode])
            .then( (response) => {
                if( response.status === 201 ) {  
                    if(this.mode === 'review') this.$emit('reviewedProperty', response.data)

                    this.showReportOrReviewModal = false; 

                    this.toast.fire({
                        icon: 'success',
                        position: 'bottom-end',
                        title: `${this.mode} submitted!`
                    })
                }
            })
            .catch( (error) => {
                if( error.response.status === 403 ) {  
                    this.showReportOrReviewModal = false; 

                    if(this.mode === 'review') { 
                        this.toast.fire({
                            icon: 'error',
                            position: 'bottom-end',
                            title: `Cannot review a ${this.model} more than once` 
                        })
                    }
                }
            })
        },
    },
}
</script>