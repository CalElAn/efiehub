<template>
<div>
    <div class="flex flex-col sm:flex-row gap-3">
        <p class="flex gap-1 items-center font-semibold text-lg sm:text-xl">
            <StarIcon class="h-6 sm:h-6 w-6 sm:w-6 text-main-orange"/>
            {{reviewsAverageAndCount.average}}
            <span>
                ({{reviewsAverageAndCount.count}} {{(reviewsAverageAndCount.count > 1 || reviewsAverageAndCount.count === 0) ? 'reviews' : 'review'}})
            </span>
        </p>
        <button
            v-if="!hasAuthUserReviewed"
            @click="reviewProperty"
            class="flex items-center justify-center gap-0.5 w-1/2 sm:w-auto mx-auto sm:mx-0 text-indigo-600 hover:bg-indigo-600 hover:text-white border border-indigo-600 rounded-full py-1 px-2">
            <PlusCircleIcon class="h-5 w-5"/>
            Add review
        </button>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 mt-6">
        <div
            v-for="(item, index) in reviewsToDisplay"
            :key="index"
            class="flex flex-col gap-2 h-44 overflow-auto">
            <div class="flex flex-col justify-center gap-2 h-2/5">
                <div class="flex items-center gap-2">
                    <div
                        class="bg-contain bg-center bg-no-repeat rounded-full h-8 w-8"
                        :style="{'background-image': 'url('+ item.user.profile_picture_path +')'}"
                        alt="profile picture">
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="font-medium">
                            {{item.user.name}}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{item.updated_at}}
                        </p>
                    </div>
                </div>
                <star-rating
                    v-model:rating="item.rating"
                    :round-start-rating="true"
                    :clearable="true"
                    :inline="true"
                    :read-only="true"
                    :increment="0.5"
                    :star-size="15"
                    :padding="2"
                    active-color="#FF5B1A"
                    :show-rating="false"
                >
                </star-rating>
            </div>
            <p class="overflow-auto">
                {{item.review}}
            </p>
        </div>
    </div>
    <button
        v-if="reviewsWithReview?.length > 5"
        @click="showAllReviews = !showAllReviews"
        class="border border-black p-2 rounded-md hover:underline hover:bg-gray-100">
        Show {{showAllReviews ? 'less' : 'more reviews'}}
    </button>
    <report-or-review-modal
        :model="model"
        :slug="slug"
        @reviewedProperty="onReviewedProperty"
    >
    </report-or-review-modal>
</div>
</template>

<script>
import ReportOrReviewModal from './Modals/ReportOrReviewModal.vue'

import StarRating from 'vue-star-rating'

import { PlusCircleIcon } from '@heroicons/vue/outline'
import { StarIcon } from '@heroicons/vue/solid'

export default {
    components: {
        PlusCircleIcon,
        StarRating,
        StarIcon,
        ReportOrReviewModal,
    },

    data() {
        return {
            showAllReviews: false,
            reviewsData: this.initialReviewsData
        }
    },

    inject: ['isUserAuthenticated', 'authenticatedUser'],

    props: [
        'initialReviewsData',
        'hasAuthUserReviewed',
        'slug',
        'model',
    ],

    computed: {
        reviewsWithReview() {
            return this.reviewsData?.filter(obj => obj.review !== null)
        },

        reviewsToDisplay() {
            return this.showAllReviews ? this.reviewsWithReview : this.reviewsWithReview?.slice(0, 5)
        },

        reviewsAverageAndCount() {
            if(!this.reviewsData?.[0]) return {count: 0, average: 0}

            return {
                count: Object.keys(this.reviewsData)?.length, 
                average: Math.round((Object.values(this.reviewsData).reduce((a, b) => a + parseFloat(b.rating), 0) / Object.keys(this.reviewsData)?.length)*100)/100
            }
        },
    },

    methods: {
        reviewProperty() {
            if (!this.isUserAuthenticated) {
                this.$vfm.show('LogInModal', {showWelcomeText: true, welcomeText: `Kindly login to review this ${this.model}, or`})
                return
            }
            
            this.$vfm.show('ReportOrReviewModal', {mode: 'review'})
        },

        onReviewedProperty(reviewData) {
            this.reviewsData.unshift(reviewData)
        }
    }
}
</script>