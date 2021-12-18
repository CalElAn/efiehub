<template>
<vue-final-modal
    v-model="showLogInModal"
    name = 'LogInModal'
    @closed = "this.$emit('closedLoginModal')"
    :transition="{
        'enter-active-class': 'transition duration-200 ease-in-out transform',
        'enter-from-class': 'translate-y-full',
        'enter-to-class': 'translate-y-0',
        'leave-active-class': 'transition duration-200 ease-in-out transform',
        'leave-to-class': 'translate-y-full',
        'leave-from-class': 'translate-y-0'
    }"
    classes="text-main flex justify-center items-center"
    content-class="w-full sm:max-w-md px-6 pb-6 pt-8 bg-white overflow-hidden sm:rounded-lg rounded-2xl relative flex flex-col max-h-full border"
>
    <button class="absolute top-0 right-0 mt-2 mr-2" @click="showLogInModal=false">
      <XIcon  class="h-5 w-5 text-black"/>
    </button>
    <div v-if="showWelcomeText" class="mb-4 text-center">
        <div class="font-bold">Welcome!</div>
        Kindly login to complete the submission process, or             
        <a 
            @click="showSignUpModal"
            class="underline text-sm text-indigo-600 hover:text-indigo-700" 
            href="#"
        >
            Sign Up
        </a>
        if you do not have an account
       
    </div>
    <!-- Validation Errors -->
    <div class="mb-4" v-if="errors.email">
        <div class="font-medium text-red-600">
            Whoops! Something went wrong
        </div>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li v-for="(item, index) in errors.email" :key="index">{{ item }}</li>
        </ul>
    </div>

    <form @submit.prevent="onSubmit" method="POST" action="/login">
        <!-- Email Address -->
        <div>
            <label for="loginEmail" class="block font-medium text-sm text-gray-700" >Email</label>

            <input
                v-model="form.email"
                id="loginEmail" 
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" 
                type="email" name="email"  required autofocus>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex justify-between">
                <label for="password" class="font-medium text-sm text-gray-700" >Password</label>
                <a class="underline text-sm text-indigo-600 hover:text-indigo-700" href="/forgot-password">
                    Forgot your password?
                </a>
            </div>

            <input
                v-model="form.password"
                id="password" 
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" 
                type="password"
                name="password"
                required autocomplete="current-password" >
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input 
                    v-model="form.remember"
                    id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                    name="remember">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <span>Don't have an account?&nbsp;</span>
            <a 
                @click="showSignUpModal"
                class="underline text-sm text-indigo-600 hover:text-indigo-700" 
                href="#"
                >
                Sign Up
            </a>

            <button 
                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Log In
            </button>
        </div>
    </form>
</vue-final-modal>
</template>

<script>

import { XIcon } from '@heroicons/vue/solid'

export default {

    data: () => ({
        showLogInModal: false,
        errors: {},
        form: {
                email: '',
                password: '',
                remember: '',
            }
    }),

    components: {
        XIcon
    },

    props: ['showWelcomeText'],

    methods: {
        showSignUpModal() {
            this.$emit('showSignUpModal');
            this.showLogInModal = false;
        },

        onSubmit() {
            axios.post('/login', this.form)
            .then( (response) => {
                if( response.status == 200 ) {  
                    // console.log(response.data)
                    this.$emit('userHasBeenAuthenticated', response.data)
                    this.showLogInModal = false; 
               }
            })
            .catch( (error) => {
                this.errors = error.response.data.errors;
            })
        }
    },
}
</script>