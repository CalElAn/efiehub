<template>
    <div 
        :class="[showFullCard ? 'sm:flex-row flex-col' : 'flex-col sm:shadow-lg']"
        class="flex gap-2 shadow rounded-lg p-3 py-7 border">
        <div v-if="property">
            <span class="font-semibold text-base lg:text-lg">GH&#8373; {{property.price}}</span> / month
        </div>
        <div 
            v-if="showFullCard" 
            class="bg-contain bg-center bg-no-repeat h-20 sm:h-auto sm:w-2/5 rounded-full"
            :style="{'background-image': 'url('+ user.profile_picture_path +')'}" 
            alt="profile picture">
        </div>
        <div 
            :class="[showFullCard ? 'sm:w-3/5' : '']"
            class="flex flex-col gap-2">
            <div class="flex flex-col items-center justify-center gap-2">
                <div
                     v-if="!showFullCard"
                    class="bg-contain bg-center bg-no-repeat h-12 w-12 rounded-full"
                    :style="{'background-image': 'url('+ user.profile_picture_path +')'}" alt="profile picture">
                </div>
                <p
                    class="font-medium"
                    :class="[showFullCard ? 'sm:text-xl' : '']"
                >
                    <a 
                        :class="{showFullCard: 'underline'}" 
                        :href="'/users/'+user.id">
                        {{user.name}}
                    </a>
                </p>
            </div>
            <button class="flex items-center justify-center gap-2 bg-main-orange bg-opacity-95 hover:bg-white text-white hover:text-main-orange hover:border hover:border-main-orange p-2 rounded-lg">
                <PhoneIcon class="h-5 w-5 md:h-4 md:w-4"/> Show contact
            </button>
            <button class="flex items-center justify-center gap-2 border border-main-orange text-main-orange hover:text-white bg-white hover:bg-main-orange bg-opacity-95 p-1 rounded-lg">
                <ChatAltIcon class="h-5 w-5 md:h-4 md:w-4"/> Chat
            </button>
            <button
                v-show="!requestCallBackToggle"
                :disabled="authenticatedUser?.id === user.user_id"
                @click="requestCallBackToggle = true"
                style="text-decoration-color: #4568ED;"
                class="rounded-xl underline hover:border hover:shadow-md p-2 md:p-1">
                Request call back
            </button>
            <div
                v-show="requestCallBackToggle"
                class="flex text-xs">
                <form
                    @submit.prevent="requestCallBack"
                    class="w-full flex flex-col xl:flex-row gap-1">
                    <input
                        required
                        v-model="phoneNumberForRequestCallback"
                        type="text"
                        placeholder="enter phone number"
                        class="text-xs block w-full xl:w-3/5 rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                    <div class="flex gap-1 xl:w-2/5">
                        <button
                            type="submit"
                            class="flex w-1/2 xl:w-1/2 py-1 xl:py-0 justify-center items-center border border-transparent shadow-sm rounded-md xl:rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            request
                        </button>
                        <button
                            @click="requestCallBackToggle = false"
                            type="button"
                            class="flex w-1/2 xl:w-1/2 py-1 xl:py-0 justify-center items-center border border-transparent shadow-sm rounded-md xl:rounded-lg text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            cancel
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="flex justify-center items-center gap-1 text-xs">
                <StarIcon class="h-4 lg:h-5 w-4 lg:w-5 text-main-orange"/>
                {{reviewsAverageAndCount.average}} <span>({{reviewsAverageAndCount.count}} agent reviews)</span>
            </div>
        </div>
    </div>
</template>

<script>
import { PhoneIcon, StarIcon } from '@heroicons/vue/solid'
import { ChatAltIcon } from '@heroicons/vue/outline'

export default {
    components: {
        PhoneIcon,
        ChatAltIcon,
        StarIcon,
    },

    inject: ['authenticatedUser'],

    data() {
        return {
            phoneNumberForRequestCallback: this.authenticatedUser?.phone_number,
            requestCallBackToggle: false,
            reviewsAverageAndCount: this.getReviewsAverageAndCount(this.user.reviews)
        }
    },
    
    props: ['user', 'property', 'showFullCard'],

    methods: {
        requestCallBack() {
            if (!this.isUserAuthenticated) { 

                this.$vfm.show('LogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to request a call back, or'})
                return
            }  

            if (!this.phoneNumberForRequestCallback) return

            axios.post(`/users/${this.property.user_id}/request-call-back`, {phoneNumber: this.phoneNumberForRequestCallback})
                .then( (response) => {
                    if( response.status === 200 ) { 

                        this.toast.fire({
                            icon: 'success',
                            position: 'bottom-end',
                            title: `Callback requested!`
                        })
                        this.requestCallBackToggle = false;
                    }
                })
                .catch( (error) => {
                    console.log(error)
            })  
        },
    }
}
</script>
