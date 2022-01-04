
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'

import Slider from '@vueform/slider'
import Multiselect from '@vueform/multiselect'

import { ChevronDownIcon, LocationMarkerIcon } from '@heroicons/vue/solid'

import SearchBarFormInputs from './SearchBarFormInputs.vue'

const searchBarMixin = {

    components: {
        Popover, 
        PopoverButton, 
        PopoverPanel, 
        ChevronDownIcon,
        LocationMarkerIcon,
        Slider,
        Multiselect,
        SearchBarFormInputs,
    },

    props: ['propertyTypes', 'regions'],

    data () {
        return {
            csrfToken: csrfToken,
            isSearchBarFocused: false,
            isInputFocused: false,
            isScrollYPastSearchBar: false,

            sliderFormat: {
                prefix: 'GH&#8373;',
                decimals: 0,
            },

            form: {
                types: this.searchQuery?.types ?? [],
                priceRange: this.searchQuery?.priceRange ?? [0, 500],
                regions: this.searchQuery?.regions ?? [],
                orderBy: this.searchQuery?.orderBy ?? 'latest',
            },
        }
    },
    
    computed: {
        selectAllPropertyTypes: {
            get: function () {
                return this.form.types ? this.propertyTypes.length == this.form.types.length : false;
            },
            set: function (value) {
                    var selectedTypes = [];

                    if (!value) { 
                        this.form.types = []
                        return
                    }

                    this.propertyTypes.forEach( (item) => { selectedTypes.push(item.type) });

                    this.form.types = selectedTypes   
            }
        }
    },

    methods: {
        onSearchBarNotFocused(event) {

            if (!this.$refs.searchBar?.contains(event.target)) {
                
                this.isSearchBarFocused = false;
            }
        },
    },

    mounted() {
        document.addEventListener('click', this.onSearchBarNotFocused);   
    }   
}

export default searchBarMixin