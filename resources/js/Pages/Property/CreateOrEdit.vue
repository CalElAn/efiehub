<template>
<div class="pt-10 sm:pt-20">
    <Head :title="`${mode === 'create' ? 'Add' : 'Edit'} Property`"></Head>
    <div class="ml-auto mr-auto mb-5 sm:mt-5 sm:w-1/2">
        <ul id="progress-bar" class="sm:font-semibold">
            <li :class="[step == 1 ? 'active' : '']" class="progress-step inline list-none text-center">
                Details
            </li>
            <li :class="[step == 2 ? 'active' : '']" class="progress-step inline list-none text-center">
                Features
            </li>
            <li :class="[step == 3 ? 'active' : '']" class="progress-step inline list-none text-center">
                Media
            </li>
        </ul>
    </div>
    <div class="flex justify-center items-center h-3/4">
        <div class="rounded-2xl border shadow text-xs sm:text-sm bg-white p-6" :class="[animation, step == 3 ? 'w-11/12 md:w-1/2' : '']">
            <button
                v-if="mode==='edit'"
                @click="deleteProperty" 
                class="flex gap-1 items-center mx-auto mb-3 border border-red-600 text-red-600 p-2 rounded-lg hover:underline hover:bg-gray-100">
                <!-- <svg class="w-4 h-4 text-main-orange" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M212.333 224.333H12c-6.627 0-12-5.373-12-12V12C0 5.373 5.373 0 12 0h48c6.627 0 12 5.373 12 12v78.112C117.773 
                    39.279 184.26 7.47 258.175 8.007c136.906.994 246.448 111.623 246.157 248.532C504.041 393.258 393.12 504 256.333 504c-64.089 
                    0-122.496-24.313-166.51-64.215-5.099-4.622-5.334-12.554-.467-17.42l33.967-33.967c4.474-4.474 11.662-4.717 16.401-.525C170.76 
                    415.336 211.58 432 256.333 432c97.268 0 176-78.716 176-176 0-97.267-78.716-176-176-176-58.496 0-110.28 28.476-142.274 
                    72.333h98.274c6.627 0 12 5.373 12 12v48c0 6.627-5.373 12-12 12z"/>
                </svg> -->
                <TrashIcon class="w-4 h-4 text-red-600"/>
                Delete
            </button>
            <!-- Details -->
            <section v-show="step == 1">
                <div class="text-xl mb-3">Property Details</div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2 sm:col-span-2">
                        <label for="region" class="block font-medium text-gray-700">Region <span
                                class="text-red-600">*</span></label>
                        <select v-model="form.region" id="region"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option v-for="(item, index) in $page.props.regions" :key="index">{{item.name}}</option>
                        </select>
                        <span class="text-red-600" v-if="v$.form.region.$error">{{ v$.form.region.$errors[0].$message }}
                        </span>
                    </div>
                    <!-- <div class="hidden sm:block"></div> -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="city" class="block font-medium text-gray-700">City <span
                                class="text-red-600">*</span></label>
                        <input v-model="form.city" type="text" id="city"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        <span class="text-red-600" v-if="v$.form.city.$error">{{ v$.form.city.$errors[0].$message }}
                        </span>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="town" class="block font-medium text-gray-700">Town <span
                                class="text-red-600">*</span></label>
                        <input v-model="form.town" type="text" id="town"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        <span class="text-red-600" v-if="v$.form.town.$error">{{ v$.form.town.$errors[0].$message }}
                        </span>
                    </div>
                    <div class="col-span-2">
                        <label for="address" class="block font-medium text-gray-700">Street address <span
                                class="text-red-600">*</span></label>
                        <input v-model="form.address" type="text" id="address"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        <span class="text-red-600" v-if="v$.form.address.$error">{{ v$.form.address.$errors[0].$message }}
                        </span>
                    </div>
                    <div class="col-span-2">
                        <label for="gps_location" class="block font-medium text-gray-700">GPS location ...for example: 3.423, 4.53545</label>
                        <div class="flex flex-col sm:flex-row rounded-md">
                            <input v-model="form.gpsLocation" type="text" id="gps_location"
                                class="block w-full mt-1 rounded-t-md sm:rounded-l-md sm:rounded-r-none border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            <button
                                @click="getLocation"
                                class="text-xs py-0.5 sm:py-0 bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 border sm:mt-1 border-gray-300 border-b-0 sm:border-l-0 inline-flex justify-center items-center px-2 rounded-b-md sm:rounded-r-md  sm:rounded-l-none sm:w-2/3 shadow-sm text-gray-500 font-medium">
                                Click to use current location
                            </button>
                            <span class="text-red-600" v-if="gpsLocationError">{{ gpsLocationError }}
                            </span>
                        </div>
                    </div>
                    <div class="col-span-2 sm:col-span-1 col-start-1">
                        <label for="contact-number" class="block font-medium text-gray-700">Contact number <span
                                class="text-red-600">*</span></label>
                        <input v-model="form.contactPhoneNumber" type="tel" id="contact-number"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        <span class="text-red-600"
                            v-if="v$.form.contactPhoneNumber.$error">{{ v$.form.contactPhoneNumber.$errors[0].$message }}
                        </span>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="email" class="block font-medium text-gray-700">Contact Email <span
                                class="text-red-600">*</span></label>
                        <input v-model="form.contactEmail" type="email" id="email"
                            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        <span class="text-red-600" v-if="v$.form.contactEmail.$error">{{ v$.form.contactEmail.$errors[0].$message }}
                        </span>
                    </div>
                    <div class="col-span-2 flex justify-end">
                        <button @click="nextStep"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-full text-white bg-main-blue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-main-blue">
                            Next
                        </button>
                    </div>
                </div>
            </section>
            <!-- Features -->
            <section v-show="step == 2">
                <div class="text-xl mb-3">Property Features</div>
                <div class="grid gap-6" :class="[propertyTypesAndFeatures[form.type]?.[0] ? 'grid-cols-2' : 'grid-cols-1']">
                    <div class="col-span-2">
                        <label for="type" class="block font-medium text-gray-700">Type <span
                                class="text-red-600">*</span></label>
                        <select 
                            v-model="form.type" 
                            @change="typeOnChange"  
                            id="type"
                            class="block w-full mt-1 text-xs sm:text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">-- Select property type --</option>
                            <option v-for="(item, index) in propertyTypesAndFeatures" :key="index" 
                                :value="index">
                                {{ index }}
                            </option>
                        </select>
                        <span class="text-red-600" v-if="v$.form.type.$error">{{ v$.form.type.$errors[0].$message }}
                        </span>
                    </div>
                    <template v-for="(item, index) in propertyTypesAndFeatures[form.type]" :key="index">
                        <div v-if="item['input_type'] == 'number'" class="col-span-1">
                            <label for="address" class="block font-medium text-gray-700">{{ item['feature'] }}</label>
                            <input type="number"
                                v-model="form.inputFeatures[item['feature']]"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>
                    </template>
                    <template v-for="(item, index) in propertyTypesAndFeatures[form.type]" :key="index">
                        <div v-if="item['input_type'] == 'checkbox'" class="col-span-1 flex items-center">
                            <label class="flex gap-2">
                                <input type="checkbox"
                                    v-model="form.checkedFeatures"
                                    :value="item['feature']"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                />
                                {{ item['feature'] }}
                            </label>
                        </div>
                    </template>
                    <template v-for="(item, index) in propertyTypesAndFeatures[form.type]" :key="index">
                        <div v-if="item['input_type'] == 'radio'" class="col-span-1 flex items-center">
                            <label class="flex gap-2">
                                <input  type="radio"
                                    v-model="form.pickedFeatures"
                                    :value="item['feature']"
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                >
                                {{ item['feature'] }}
                            </label>
                        </div>
                    </template>
                    <div class="col-span-2 col-start-1">
                        <!-- <div class="flex justify-between items-center"> -->
                            <label for="description" class="block font-medium text-gray-700">
                            Other Features
                            </label>
                        <!-- </div> -->
                        <div class="mt-1 flex justify-between items-center gap-3">
                            <p class="text-gray-500 text-xs">
                                Add any other features we might have missed
                            </p>
                            <button 
                                @click="form.otherFeatures.push('')"
                                class="flex items-center gap-0.5 text-indigo-600 hover:bg-indigo-600 hover:text-white border border-indigo-600 rounded-full p-1">
                                <PlusCircleIcon class="h-5 w-5"/>
                                Add
                            </button>
                        </div>
                        <div class="flex flex-col gap-1.5 mt-2">
                            <div
                                v-for="(item, index) in form.otherFeatures"
                                :key="index"
                                class="flex gap-2">
                                    <input
                                        v-model="form.otherFeatures[index]"
                                        type="text"
                                        class="text-xs sm:text-sm block w-full p-0.5 px-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <button 
                                        @click="form.otherFeatures.splice(index, 1)"
                                        class="flex items-center gap-0.5 text-main-orange hover:border rounded-full hover:border-main-orange p-1 underline text-xs">
                                        <MinusCircleIcon class="h-4 w-4"/>
                                        Remove
                                    </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 col-start-1">
                        <div>
                            <label for="price"
                                class="block font-medium text-gray-700">{{ 'Rent (GH&#8373; / month)' }}
                                <span class="text-red-600">*</span></label>
                            <input type="number" step="any" id="address"
                                v-model="form.price"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            <span class="text-red-600" v-if="v$.form.price.$error">{{ v$.form.price.$errors[0].$message }}
                            </span>
                        </div>
                        <div class="col-span-1 col-start-1 inline-flex items-center mt-2">
                            <label class="flex gap-2">
                                <input type="checkbox"
                                    v-model="form.negotiable"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50"
                                />
                                Negotiable
                            </label>
                        </div>
                    </div>
                    <div class="col-span-2 flex justify-between">
                        <button @click="previousStep"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-full text-white bg-main-blue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-main-blue">
                            Previous
                        </button>
                        <button @click="nextStep"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-full text-white bg-main-blue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-main-blue">
                            Next
                        </button>
                    </div>
                </div>
            </section>
            <!-- Upload Media -->
            <section v-show="step == 3">
                <div>
                    <div class="my-3 border border-red-400 rounded">
                        Test
                        <input type="file" name="test">
                    </div>
                    <div class="text-xl mb-3">Upload photos</div>
                    <div>
                        <label class="block text-gray-700">
                            Upload 5 to 15 photos
                        </label>
                        <file-pond
                            name="filepond"
                            ref="filepond"
                            label-idle="Drop pictures here or <span class='filepond--label-action'>Browse</span>"
                            :allowMultiple="true"
                            :max-files="15"
                            itemInsertLocation="after"
                            captureMethod="environment"
                            :allow-reorder="true"
                            :files="filepondInitialMedia"
                            :acceptedFileTypes="['image/*']"
                            :server = "{
                                url: '/filepond',
                                process: '/process',
                                revert: '/revert',
                                restore: '/restore',
                                load: '/load/PropertyMedia/',
                                fetch: '/fetch',
                                remove: handleFilePondRemove,
                                headers: {
                                    'X-CSRF-TOKEN': $page.props.csrf_token
                                }
                            }"
                            @processfile="onFilePondProcessFile"
                            :imagePreviewHeight="256"
                        />
                        <ul class=" list-disc list-inside text-red-600" v-if="mediaError">
                            <li>{{ mediaError }}</li>
                        </ul>
                    </div>
                    <div class="input-errors ml-3 my-3 text-red-600">
                        <ul class="mt-3 list-disc list-inside">
                            <li v-for="error of v$.form.$errors" :key="error.$uid">{{ error.$message +' on "'+ error.$property +'"'  }}</li>
                        </ul>
                    </div>
                    <div 
                        v-if="Object.keys(form.errors).length"
                        class="input-errors ml-3 my-3 border-t text-red-600">
                        <p class="font-medium text-gray-600">
                            We also detected these errors. Kindly correct them before clicking submit
                        </p>
                        <ul class="mt-3 list-disc list-inside">
                            <li v-for="(item, index) in form.errors" :key="index">
                                {{ item  }}
                            </li>
                        </ul>
                    </div>
                    <label class="block text-xs lg:text-sm text-gray-700">
                        (If photos are uploading, wait for the uploads to complete before clicking submit)
                    </label>                
                    <div class="mt-7 col-span-2 flex justify-between">
                        <button @click="previousStep"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-full text-white bg-main-blue hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-main-blue">
                            Previous
                        </button>
                        <button
                            @click="submitForm"
                            :disabled="form.processing"
                            class="disabled:opacity-40 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm font-medium rounded-full text-white bg-main-orange hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-main-orange">
                            {{form.processing ? `submitting...` : 'Submit'}}
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</template>

<script>
import vueFilePond from 'vue-filepond'
import 'filepond/dist/filepond.min.css'
// Import image preview plugin styles
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'
// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
// Create component
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
)

//Vuelidate
import useVuelidate from '@vuelidate/core';
import { required, email, numeric } from '@vuelidate/validators';

import { PlusCircleIcon, MinusCircleIcon, TrashIcon } from '@heroicons/vue/outline'

import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

export default {
    setup(props) {
        const form = useForm({
            region: props.property.region,
            city: props.property.city,
            town: props.property.town,
            address: props.property.address,
            gpsLocation: props.property.gps_location,
            contactPhoneNumber: props.mode === 'create' ? Inertia.page.props.authenticatedUser?.phone_number : props.property.contact_phone_number,
            contactEmail: props.mode === 'create' ? Inertia.page.props.authenticatedUser?.email : props.property.contact_email,
            type: props.property.type ?? '',
            checkedFeatures: props.mode === 'create' ? [] : props.property.features.filter(obj => obj.input_type === 'checkbox')?.map(obj => obj.feature),
            pickedFeatures: props.mode === 'create' ? 'Furnished' : props.property.features.find(obj => obj.input_type === 'radio')?.feature,
            inputFeatures: props.mode === 'create' ? {} : props.property.features.filter(obj => obj.input_type === 'number')?.reduce((obj, key) => ({ ...obj, [key.feature]: key.pivot.number }), {}),
            otherFeatures: props.mode === 'create' ? [] : props.property.other_features,
            price: props.property.price,
            negotiable: props.mode === 'create' ? false : props.property.is_rent_negotiable, //later check when submitted if I need to change true/false value to 0 or 1
            media: [],
        })

        return {
            v$: useVuelidate(),
            form
        };
    },

    data() {
        return {
            step: 1,
            animation: '',

            gpsLocationError: '',
            mediaError: '',

            filepondInitialMedia: [],
        };
    },

    components: {
      FilePond,
      PlusCircleIcon,
      MinusCircleIcon,
      TrashIcon,
    },

    validations() {
        return {
            form: {
                region: {
                    required,
                    $autoDirty: true
                },
                city: {
                    required,
                    $autoDirty: true
                },
                town: {
                    required,
                    $autoDirty: true
                },
                address: {
                    required,
                    $autoDirty: true
                },
                contactPhoneNumber: {
                    required,
                    $autoDirty: true
                },
                contactEmail: {
                    required,
                    email,
                    $autoDirty: true
                },
                type: {
                    required,
                    $autoDirty: true
                },
                price: {
                    required,
                    $autoDirty: true,
                    numeric
                },
            }
        };
    },

    props: {
        mode: String,
        property: Object,
        propertyTypesAndFeatures: Object,
    },

    computed: {
        enterDefaultValueForPickedFeatures() { //to make sure that default value always exists
            if(this.mode === 'edit') return 

            if ( this.propertyTypesAndFeatures[this.form.type].find(item => item['input_type'] === 'radio') ) {
                this.form.pickedFeatures = 'Unfurnished'
            } else {
                this.form.pickedFeatures = ''
            }
        },

        filepondInitialMediaSourceArray() {
            return this.filepondInitialMedia.map(obj => obj.source)
        }
    },

    methods: {
        nextStep() {
            this.animation = 'card-fade-out';

            setTimeout(() => {
                this.animation = 'card-slide-in-from-right';
                this.step++;
            }, 300);
        },

        previousStep() {
            this.animation = 'card-fade-out';

            setTimeout(() => {
                this.animation = 'card-slide-in-from-left';
                this.step--;
            }, 300);
        },

        handleFilePondRemove(source, load, error) {
            this.$swal.fire({
                title: 'Delete picture?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4568ED',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/filepond/remove/PropertyMedia${source}`)
                        .then( (response) => {
                            if( response.status === 200 && response.data === 1 ) {
                                _.remove(this.filepondInitialMedia, value => value.source === source)  
                                this.$swal.fire({
                                    icon: 'success',
                                    title: 'Deleted',
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                load()
                            }
                        })
                        .catch( (axiosError) => {
                            error('Server error, could not delete');
                            console.log(axiosError)
                        })  
                }
            })
        },

        deleteProperty() {
            this.$swal.fire({
                title: 'Delete property?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4568ED',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(`/properties/${this.property.slug}` ,{
                        onSuccess: () => {
                            this.$swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 500
                            })
                        },
                    })
                }
            })
        },

        undoChanges() {
            location.reload()
        },

        getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(this.showPosition);
            } else {
                gpsLocationError = 'Geolocation is not supported by this browser.';
            }
        },

        showPosition(position) {
            this.form.gpsLocation = position.coords.latitude + ',' + position.coords.longitude;
        },

        typeOnChange() {
            this.form.checkedFeatures.length = 0;
            this.form.pickedFeatures = '';
            this.form.inputFeatures = {};
        },

        submitForm() {
            this.v$.$touch()

            this.form.media.length = 0;
            this.$refs.filepond.getFiles()
                .forEach((value, key) => {
                    if( !this.filepondInitialMediaSourceArray.includes(value.source) ) this.form.media.push(value.serverId)
                }); 
            
            if(this.form.media.length + this.filepondInitialMedia.length < 5) {
                this.mediaError = 'At least 5 images are required';
                return
            }

            if (this.v$.$error) return

            if (!this.$page.props.isUserAuthenticated) {
                this.$vfm.show('LogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to complete the submission, or'})
                return
            }

            this.form[this.mode === 'edit' ? 'patch' : 'post'](
                this.mode === 'edit' ? `/properties/${this.property.slug}` : '/properties', {
                    onSuccess: () => {
                        this.toast.fire({
                            icon: 'success',
                            position: 'center',
                            title: this.mode === 'edit' ? "Saved!" : "Property added!"
                        })
                    },
                }
            ) 
        },

        // keepTokenAlive() {
        //     axios.post('/keep-csrf-token-alive')
        //         .catch(function (error) {
        //             console.log(error);
        //             if (error.response.status == 419) 
        //             {
        //                 location.reload();
        //             }    
        //         })
        // },

        onFilePondProcessFile() {
            this.mediaError = '';
        },
    },

    mounted() {
        // setInterval(this.keepTokenAlive, 1000 * 60 * 60); // every 60 mins 

        if(this.mode === 'edit') this.filepondInitialMedia = this.property.media.map(obj => ( {source: `${obj.property_media_id}`, options: {type: 'local'}} )) //using string interpolation because it has to be a string
    },

}
</script>

<style>
.filepond--item {
    /* percentage over (number of columns in grid divided by 2) */
    width: calc(100% - 0.5em);
}

@media (min-width: 640px) {
    .filepond--item {
        width: calc(50%/1 - 0.5em); 
    }
}
</style>

<style lang="scss" scoped>

#progress-bar {
	overflow: hidden;
}

.progress-step {
	/*progress-bar text*/
	width: 33.33%;
	float: left;
	position: relative;
	color: rgb(79, 70, 229);

	/*progress-bar circle*/
	&:before {
		content: '';
		width: 15px;
		height: 15px;
		display: block;
		background: rgb(79, 70, 229);
		border-radius: 50%;
		/* top | right | bottom | left */
		margin: 0 auto 0px auto;
	}

	/*progress-bar connectors(lines)*/
	&:after {
		content: '';
		width: 100%;
		height: 3px;
		background: rgb(79, 70, 229);
		position: absolute;
		left: -50%;
		top: 6px;
		z-index: -1; /*put it behind the numbers*/
	}

	&:first-child:after {
		/*line not needed before the first step*/
		content: none;
	}

	/*to style every sibling after li active*/
	&.active {
		~ .progress-step {
			color: #9CA3AF;
		}

		~ .progress-step:before,
		~ .progress-step:after {
			background: #9CA3AF;
		}
	}
}

.card-slide-in-from-right {
	animation: slide-in-from-right-animation 0.4s ease-out;
}

@keyframes slide-in-from-right-animation {
	0% {
		transform: translateX(25%);
	}
	100% {
		transform: translateX(0%);
	}
}

.card-slide-in-from-left {
	animation: slide-in-from-left-animation 0.4s ease-out;
}

@keyframes slide-in-from-left-animation {
	0% {
		transform: translateX(-25%);
	}
	100% {
		transform: translateX(0%);
	}
}

.card-fade-out {
	animation: fade-out-animation 0.4s ease-in-out;
}

@keyframes fade-out-animation {
	0% {
		opacity: 1;
	}
	100% {
		opacity: 0;
	}
}
</style>