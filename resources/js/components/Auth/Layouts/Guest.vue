<script setup>
import BreezeApplicationLogo from '../ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- <div>
            <Link href="/">
                <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div> -->

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white border shadow overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
