<template>
<vue-final-modal
    v-model="showSignUpModal"
    name = 'SignUpModal'
    :transition="{
        'enter-active-class': 'transition duration-200 ease-in-out transform',
        'enter-from-class': 'translate-y-full',
        'enter-to-class': 'translate-y-0',
        'leave-active-class': 'transition duration-200 ease-in-out transform',
        'leave-to-class': 'translate-y-full',
        'leave-from-class': 'translate-y-0'
    }"
    classes="text-sm sm:text-base flex justify-center items-center"
    content-class="overflow-y-auto sm:w-full sm:max-w-md px-6 pb-6 pt-8 bg-white overflow-hidden sm:rounded-lg rounded-2xl relative flex flex-col max-h-full border"
>
    <button class="absolute top-0 right-0 mt-2 mr-2" @click="showSignUpModal=false">
      <XIcon  class="h-5 w-5 text-black"/>
    </button>

    <!-- Validation Errors -->
    <div v-if="Object.keys(form.errors).length > 0">
        <div class="font-medium text-red-600">
            Whoops! Something went wrong
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li v-for="(item, index) in form.errors" :key="index">{{ item }}</li>
        </ul>
    </div>

    <form @submit.prevent="onSubmit" method="POST" action="/register">

        <!-- Name -->
        <div class="mt-4">
            <label for="name" class="block font-medium text-gray-700">Name</label>
            <input id="name"
                v-model="form.name"
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" 
                type="text" name="name" required autofocus>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="SignUpEmail" class="block font-medium text-gray-700">Email</label>
            <input id="SignUpEmail"
                v-model="form.email" 
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" 
                type="email" name="email"  required autofocus>
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <label for="phoneNumber" class="block font-medium text-gray-700">Phone Number</label>
            <input id="phoneNumber"
                v-model="form.phone_number" 
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" 
                type="tel" name="phoneNumber"  required >
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="signuppassword" class="block font-medium text-gray-700">Password</label>
            <input id="signuppassword"
                v-model="form.password" 
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" 
                type="password"
                name="password"
                required autocomplete="new-password" >
        </div>

        <!-- Password Confirmation -->
        <div class="mt-4">
            <label for="signupconfirmpassword" class="block font-medium text-gray-700">Confirm Password</label>
            <input
                v-model="form.password_confirmation"
                id="signupconfirmpassword" 
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" 
                type="password"
                name="remember-password"
                required >
        </div>

        <div class="flex flex-col items-end gap-2 mt-4">
            <button 
                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Sign Up
            </button>

            <div class="flex">
                <span>Already have an account?&nbsp;</span>
                <button
                    @click="showLogInModal"
                    class="underline text-sm text-indigo-600 hover:text-indigo-700"
                    href="#"
                    >
                    Log in
                </button>
            </div>
        </div>
    </form>
</vue-final-modal>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    setup () {
        const form = useForm({
            name: '',
            email: '',
            phone_number: '',
            password: '',
            password_confirmation: '',
        })

        return { form }
    },

    data() {
        return {
            showSignUpModal: false,
        }
    },

    methods: {
        showLogInModal() {
            this.showSignUpModal = false;
            this.$vfm.show('LogInModal')
        },

        onSubmit() {
            this.form.post('/register?fromModal=true', {
                preserveState: true,
                onSuccess: () => {
                    this.showSignUpModal = false; 
                    this.toast.fire({
                        icon: 'success',
                        position: 'bottom-end',
                        title: `Successfully registered!`
                    })
                },
            })
        },
    },
}
</script>