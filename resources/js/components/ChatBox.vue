<template>
    <div class="border bottom-0 fixed flex flex-col justify-between sm:right-6 rounded-lg w-11/12 h-80 sm:w-80 z-10">
        <div class="flex justify-between bg-gray-200 font-medium rounded-t-lg p-2">
            {{messagedUser.name}}
            <button
                @click="$emit('closeChatBox')"
            >
                <XIcon class="h-5 w-5"/>
            </button>
        </div>
        <div class="flex flex-col flex-grow gap-2 p-2 bg-gray-50 overflow-auto">
            <div
                class="w-3/4 border rounded-md bg-gray-100 p-1 text-sm"
                v-for="(item,index) in messages"
                :class="[item.from_user_id === messagedUser.id ? 'self-start' : 'self-end']"
                :key="index"
            >
                {{item.message}}
            </div>
            <div id="divToScrollTo"></div>
        </div>
        <div class="bg-gray-200 font-medium flex gap-1 p-1">
            <textarea
                rows="1"
                :disabled="isSendMessagePending"
                class="disabled:opacity-50 shadow-sm w-3/4 focus:ring-indigo-500 text-xs placeholder-gray-300 sm:text-sm focus:border-indigo-500 block sm border border-gray-300 rounded-md"
                @input="autoGrowTextarea"
                v-model="message"
                placeholder="type message here ...">
            </textarea>
            <button 
                @click="sendMessage"
                :disabled="isSendMessagePending"
                type="button"
                class="disabled:opacity-50 w-1/4 text-xs flex p-2 my-auto justify-center items-center border border-transparent shadow-sm rounded-md xl:rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                {{isSendMessagePending ? 'sending....' : 'send'}}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            message: '',
            isSendMessagePending: false,
        }
    },

    inject: ['authenticatedUser'],

    props: ['messagedUser'],

    emits: ['closeChatBox'],

    methods: {
        sendMessage() {
            this.isSendMessagePending = true

            if (this.message == '') return

            axios.post(`/chat-messages`, {
                    messaged_user_id: this.messagedUser.id,
                    message: this.message,
                })
                .then( (response) => {
                    if( response.status === 201 ) {
                        this.messages.push(response.data)
                        this.message = ''
                        this.isSendMessagePending = false
                        this.scrollToLastMessage()
                    }
                })
                .catch( (error) => {
                    console.log(error)
                    this.isSendMessagePending = false
            })           
        },

        scrollToLastMessage() {
            setTimeout(() => {
                document.getElementById('divToScrollTo').scrollIntoView()
            }, 100)
        }
    },

    mounted() {
        axios.get(`/chat-messages/${this.messagedUser.id}`)
            .then( (response) => {
                this.messages = response.data.messages
            })
            .catch( (error) => {
                console.log(error)
        })

        this.scrollToLastMessage()

        window.Echo.private(`chat.${this.messagedUser.id}.${this.authenticatedUser.id}`)
            .listen('ChatMessageSent', (e) => {
                this.messages.push(e.chatMessage);
                this.scrollToLastMessage()
            });
    },   
}
</script>