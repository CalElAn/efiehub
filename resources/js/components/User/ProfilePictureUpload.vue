<template>
    <file-pond
        name="filepond"
        ref="filepond"
        label-idle="Drag & Drop your picture here or <span class='filepond--label-action'>Browse</span>"
        accepted-file-types="image/png, image/jpeg"
        :allow-multiple="false"
        :max-files="1"
        :required="false"
        :server = "{
            url: '/filepond',
            process: '/process',
            revert: '/revert',
            restore: '/restore',
            load: '/load/User',
            fetch: '/fetch',
            remove: handleFilePondRemove,
            headers: {
                'X-CSRF-TOKEN': csrfToken
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
    
</template>

<script>
// Import Vue FilePond
import vueFilePond from 'vue-filepond'

// Import FilePond styles
import 'filepond/dist/filepond.min.css'

// Import FilePond plugins
// Please note that you need to install these plugins separately

// Import image preview plugin styles
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'

// Import plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
import FilePondPluginFileEncode from 'filepond-plugin-file-encode'
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation'
import FilePondPluginImageCrop from 'filepond-plugin-image-crop'
import FilePondPluginImageResize from 'filepond-plugin-image-resize'
import FilePondPluginImageTransform from 'filepond-plugin-image-transform'

// Create component
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginFileEncode,
    FilePondPluginImageExifOrientation,
    FilePondPluginImageCrop,
    FilePondPluginImageResize,
    FilePondPluginImageTransform,
)

export default {
    components: {
        FilePond,
    }, 

    data() {
        return {
            csrfToken: csrfToken,
            filepondInitialMedia: [],
        }
    },

    props: ['user'],

    methods: {
        handleFilePondRemove(source, load, error) {
            axios.delete(`/filepond/remove/User${source}`)
                .then( (response) => {
                    if( response.status === 200 && response.data === 1 ) load()
                })
                .catch( (axiosError) => {
                    error('Server error, could not delete');
                    console.log(axiosError)
                })  
        }
    },

    mounted() {
        // this.filepondInitialMedia.push({source: '/' + this.user.id, options: {type: 'local'}}) 
        this.filepondInitialMedia = [{source: '/' + this.user.id, 
            options: {type: 'local'}
        }]
    },

}
</script>

<style>
.filepond--root {
	width:170px;
	margin: 0 auto;
}
</style>