<template>
<div class="mt-10 mx-3 sm:mt-32">
    <Head title="Edit User Profile"></Head>
    <p class="mb-6 font-semibold text-xl sm:text-2xl">
        Edit user profile
    </p>
    <div class="w-full sm:max-w-md mt-6 px-6 mx-auto py-4 bg-white border border-gray-200 shadow-md overflow-hidden sm:rounded-lg">
        <form @submit.prevent="submit">
            <BreezeValidationErrors class="mb-4" />
            <file-pond
                name="filepond"
                ref="filepond"
                label-idle="Drag & Drop your picture here or <span class='filepond--label-action'>Browse</span>"
                accepted-file-types="image/png, image/jpeg"
                :allow-multiple="false"
                :max-files="1"
                :required="false"
                :captureMethod="null"
                :server = "{
                    url: '/filepond',
                    process: '/process',
                    revert: '/revert',
                    restore: '/restore',
                    load: '/load/User/',
                    fetch: '/fetch',
                    remove: handleFilePondRemove,
                    headers: {
                        'X-CSRF-TOKEN': $page.props.csrf_token
                    }
                }"
                :files="filepondInitialMedia"
                :imagePreviewHeight="170"
                imageCropAspectRatio="1:1"
                :imageResizeTargetWidth="200"
                :imageResizeTargetHeight="200"
                :stylePanelLayout="'compact circle'"
                styleLoadIndicatorPosition='center bottom'
                styleProgressIndicatorPosition='right bottom'
                styleButtonRemoveItemPosition='left bottom'
                styleButtonProcessItemPosition='right bottom'
            />
            <div>
                <BreezeLabel for="name" value="Name" />
                <BreezeInput type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="email" />
            </div>
            <div class="mt-4">
                <BreezeLabel for="phone_number" value="Phone number" />
                <BreezeInput id="phone_number" type="tel" class="mt-1 block w-full" v-model="form.phone_number" required autocomplete="phone_number" />
            </div>
            <div class="flex items-center justify-between mt-6">
                <Link href="/forgot-password" class="underline text-gray-600">
                    Change password?
                </Link>
                <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </BreezeButton>
            </div>
        </form>    
    </div>
</div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3';

import BreezeButton from '../../components/Auth/Button.vue';
import BreezeInput from '../../components/Auth/Input.vue';
import BreezeLabel from '../../components/Auth/Label.vue';
import BreezeValidationErrors from '../../components/Auth/ValidationErrors.vue';

import vueFilePond from 'vue-filepond'

import 'filepond/dist/filepond.min.css'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'

import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
import FilePondPluginFileEncode from 'filepond-plugin-file-encode'
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation'
import FilePondPluginImageCrop from 'filepond-plugin-image-crop'
import FilePondPluginImageResize from 'filepond-plugin-image-resize'
import FilePondPluginImageTransform from 'filepond-plugin-image-transform'

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginFileEncode,
    FilePondPluginImageExifOrientation,
    FilePondPluginImageCrop,
    FilePondPluginImageResize,
    FilePondPluginImageTransform,
)

const filepondInitialMedia = ref([])
const filepond = ref(null)

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    phone_number: props.user.phone_number,
});

function handleFilePondRemove(source, load, error) {
    axios.delete(`/filepond/remove/User${source}`)
        .then( (response) => {
            if( response.status === 200 && response.data === 1 ) load()
        })
        .catch( (axiosError) => {
            error('Server error, could not delete');
            console.log(axiosError)
        })  
}

const submit = () => {
    form
        .transform((data) => ({
            ...data,
            filepond: filepond.value.getFile()?.serverId,
        }))
        .patch(`/users/${props.user.id}`);
};

onMounted(() => {
    if(!(props.user.profile_picture_path.includes('https://'))) {
        filepondInitialMedia.value = [{
            source: `${props.user.id}`, 
            options: {type: 'local'}
        }]
    }
})
</script>

<style>
.filepond--root {
	width:170px;
	margin: 0 auto;
}
</style>
