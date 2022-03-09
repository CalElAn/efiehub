<template>
    <div 
        :class="[showFullCard ? 'sm:flex-row flex-col' : 'flex-col sm:shadow-lg']"
        class="flex gap-2 shadow rounded-lg p-3 py-7 border">
        <div v-if="property">
            <span class="font-semibold text-base lg:text-lg">GH&#8373; {{property.price}}</span> / month
        </div>
        <div 
            v-if="showFullCard" 
            class="place-self-center bg-contain bg-center bg-no-repeat h-52 w-52 rounded-full"
            :style="{'background-image': 'url('+ getProfilePictureUrl(user) +')'}" 
            alt="profile picture">
        </div>
        <div 
            :class="[showFullCard ? 'sm:w-3/5' : '']"
            class="flex flex-grow flex-col gap-2">
            <div class="flex flex-col items-center justify-center gap-2">
                <div
                     v-if="!showFullCard"
                    class="bg-contain bg-center bg-no-repeat h-12 w-12 rounded-full"
                    :style="{'background-image': 'url('+ getProfilePictureUrl(user) +')'}" alt="profile picture">
                </div>
                <p
                    class="font-medium"
                    :class="[showFullCard ? 'sm:text-xl' : '']"
                >
                    <a 
                        class="underline"
                        :class="{showFullCard: 'underline'}" 
                        :href="'/users/'+user.id">
                        {{user.name}}
                    </a>
                </p>
            </div>
            <button 
                @click="showContact"
                v-if="!showContactToggle"
                class="flex items-center justify-center gap-2 bg-main-orange bg-opacity-95 hover:bg-white text-white hover:text-main-orange hover:border hover:border-main-orange p-2 rounded-lg">
                <PhoneIcon class="h-5 w-5 md:h-4 md:w-4"/> 
                Show contact
            </button>
            <p 
                v-else
                class="py-1 px-3 mx-auto text-gray-600 rounded-md">
                Tel:
                <a 
                    class="underline text-main-blue"
                    :href="'tel:'+user.phone_number">
                    {{user.phone_number}}
                </a>
            </p>
            <button 
                @click="showChatBox"
                :disabled="authenticatedUser && authenticatedUser.id === user.id"
                class="flex items-center justify-center gap-2 border border-main-orange text-main-orange hover:text-white bg-white hover:bg-main-orange bg-opacity-95 p-1 rounded-lg">
                <ChatAltIcon class="h-5 w-5 md:h-4 md:w-4"/> 
                Chat
            </button>
            <button
                v-show="!requestCallBackToggle"
                :disabled="authenticatedUser && authenticatedUser.id === user.id"
                @click="requestCallBackToggle = true"
                style="text-decoration-color: #4568ED;"
                class="rounded-xl underline hover:border hover:shadow-md p-2 md:p-1">
                Request call back
            </button>
            <div
                v-show="requestCallBackToggle"
                class="flex flex-col text-xs xl:text-sm pt-2 my-2 border-t border-b">
                <form
                    @submit.prevent="requestCallBack"
                    class="w-full flex flex-col gap-2">
                    <div class="flex flex-col gap-1">
                        <input
                            required
                            v-model="requestCallBackForm.phone_number"
                            type="text"
                            placeholder="enter phone number"
                            class="text-xs block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        <textarea
                            rows="2"
                            class="shadow-sm focus:ring-indigo-500 text-xs sm:text-sm focus:border-indigo-500 mt-1 block w-full sm border border-gray-300 rounded-md"
                            @input="autoGrowTextarea"
                            v-model="requestCallBackForm.details"
                            placeholder="Details (optional)">
                        </textarea>
                    </div>
                    <div class="flex gap-1">
                        <button
                            type="submit"
                            class="flex w-1/2 py-1 xl:py-1 justify-center items-center border border-transparent shadow-sm rounded-md xl:rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            request
                        </button>
                        <button
                            @click="requestCallBackToggle = false"
                            type="button"
                            class="flex w-1/2 py-1 xl:py-1 justify-center items-center border border-transparent shadow-sm rounded-md xl:rounded-lg text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
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
        <ChatBox
            v-if="showChatBoxToggle"
            :messagedUser="user"
            @closeChatBox="showChatBoxToggle = false"
        />
    </div>
</template>

<script>
import ChatBox from '../ChatBox.vue'

import { PhoneIcon, StarIcon } from '@heroicons/vue/solid'
import { ChatAltIcon } from '@heroicons/vue/outline'

export default {
    components: {
        ChatBox,

        PhoneIcon,
        ChatAltIcon,
        StarIcon,
    },

    inject: ['isUserAuthenticated', 'authenticatedUser'],

    data() {
        return {
            requestCallBackForm: {
                phone_number: this.authenticatedUser?.phone_number,
                details: '',
            },

            requestCallBackToggle: false,
            showContactToggle: false,
            showChatBoxToggle: false,
            reviewsAverageAndCount: this.getReviewsAverageAndCount(this.user.reviews),
        }
    },
    
    props: ['user', 'property', 'showFullCard'],

    methods: {
        showContact() {
            if (!this.isUserAuthenticated) { 

                this.$vfm.show('LogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to view the contact number, or'})
                return
            } 
            
            this.showContactToggle = true
        },

        requestCallBack() {
            if (!this.isUserAuthenticated) { 

                this.$vfm.show('LogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to request a call back, or'})
                return
            }  

            if (!this.requestCallBackForm.phone_number) return

            axios.post(`/users/${this.user.id}/request-call-back`, this.requestCallBackForm)
                .then( (response) => {
                    if( response.status === 200 ) { 
                        this.toast.fire({
                            icon: 'success',
                            position: 'bottom-end',
                            title: `Call back requested!`
                        })
                        this.requestCallBackToggle = false;
                    }
                })
                .catch( (error) => {
                    console.log(error)
            })  
        },

        showChatBox() {
            if (!this.isUserAuthenticated) { 
                this.$vfm.show('LogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to chat, or'})
                return
            } 
            
            this.showChatBoxToggle = true
        },

    }
}
</script>
