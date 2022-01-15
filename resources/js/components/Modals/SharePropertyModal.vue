<template>
<vue-final-modal
    v-model="showSharePropertyModal"
    name = 'SharePropertyModal'
     v-slot="{ params }"
    @beforeOpen="event => property = event.ref.params"
    :transition="{
        'enter-active-class': 'transition duration-200 ease-in-out transform',
        'enter-from-class': 'translate-y-full',
        'enter-to-class': 'translate-y-0',
        'leave-active-class': 'transition duration-200 ease-in-out transform',
        'leave-to-class': 'translate-y-full',
        'leave-from-class': 'translate-y-0'
    }"
    classes="text-base sm:text-lg flex justify-center items-center"
    content-class="sm:w-full sm:max-w-md px-6 pb-6 pt-8 mx-4 sm:mx-0 bg-white overflow-hidden sm:rounded-lg rounded-2xl relative flex flex-col max-h-full border"
>
    <button class="absolute top-0 right-0 mt-2 mr-2" @click="showSharePropertyModal=false">
      <XIcon  class="h-5 w-5 text-black"/>
    </button>

    <p class="font-medium mb-6 text-xl sm:text-2xl">
        Share this property
    </p>

    <div class="flex flex-wrap justify-center gap-3">
        <ShareNetwork
            @open="onOpenLink"
            v-for="network in networks"
            :network="network.network"
            :key="network.network"
            class="flex gap-2 items-center p-2 rounded-xl border"
            :url="shareNetworkUrl(params)"
            :title="`Check out this ${params.title} available for rent on efiehub`"
            :description="`${params.title} available for rent on efiehub`"
            :quote="`Check out this ${params.title} available for rent on efiehub`">
            <i 
                :style="{color: network.color}"
                :class="network.icon">
            </i>
            <span>{{ network.name }}</span>
        </ShareNetwork>
    </div>

    
</vue-final-modal>
</template>

<script>

import { XIcon } from '@heroicons/vue/solid'

export default {

    data: () => ({
        showSharePropertyModal: false,
        sharing: {
                // url: 'https://news.vuejs.org/issues/180',
                // title: 'Check out this property for rent on efiehub',
                description: 'This week, I\'d like to introduce you to "Vite", which means "Fast". It\'s a brand new development setup created by Evan You.',
                // quote: 'The hot reload is so fast it\'s near instant. - Evan You', //facebook only
            },
        networks: [
            { network: 'email', name: 'Email', icon: 'far fah fa-lg fa-envelope', color: '#333333' },
            { network: 'facebook', name: 'Facebook', icon: 'fab fah fa-lg fa-facebook-f', color: '#1877f2' },
            { network: 'messenger', name: 'Messenger', icon: 'fab fah fa-lg fa-facebook-messenger', color: '#0084ff' },
            { network: 'sms', name: 'SMS', icon: 'far fah fa-lg fa-comment-dots', color: '#333333' },
            { network: 'telegram', name: 'Telegram', icon: 'fab fah fa-lg fa-telegram-plane', color: '#0088cc' },
            { network: 'twitter', name: 'Twitter', icon: 'fab fah fa-lg fa-twitter', color: '#1da1f2' },
            { network: 'whatsapp', name: 'Whatsapp', icon: 'fab fah fa-lg fa-whatsapp-square', color: '#25d366' },
        ],
        property: {},
    }),

    components: {
        XIcon
    },

    props: [],

    methods: {
        shareNetworkUrl(property) {
            return `${window.location.href}show-property/${property.slug}`
        },

        onOpenLink(network, url) {
            axios.post('/add-analytics', {
                    event: 'clicked share property button',
                    details: {
                        network: network,
                        url: url,
                        property_id: this.property.property_id
                    }
                })
        }
    },
}
</script>