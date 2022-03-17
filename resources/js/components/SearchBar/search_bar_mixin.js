import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'

import Slider from '@vueform/slider'
import Multiselect from '@vueform/multiselect'

import { ChevronDownIcon, LocationMarkerIcon } from '@heroicons/vue/solid'

const searchBarMixin = {
    components: {
        Popover, 
        PopoverButton, 
        PopoverPanel, 
        ChevronDownIcon,
        LocationMarkerIcon,
        Slider,
        Multiselect,
    },

    data () {
        return {
            isSearchBarFocused: false,
            isInputFocused: false,

            sliderFormat: {
                prefix: 'GH&#8373;',
                decimals: 0,
            },

            propertyTypes: this.$page.props.propertyTypes,
            regions: this.$page.props.regions,

            form: {
                types: this.searchQuery?.types ?? [],
                priceRange: this.searchQuery?.priceRange.map(item => parseInt(item)) ?? [parseInt(this.$page.props.minPrice), parseInt(this.$page.props.maxPrice)],
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
        searchProperty() {
            this.$nextTick( () => {
                this.$inertia.get('/properties/search', this.form, {
                        preserveState: true,
                        replace: true,
                    })
            })
        },

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