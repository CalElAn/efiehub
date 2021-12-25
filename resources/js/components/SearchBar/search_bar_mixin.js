
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'

import Slider from '@vueform/slider'

import { ChevronDownIcon } from '@heroicons/vue/solid'
import { LocationMarkerIcon } from '@heroicons/vue/solid'


const searchBarMixin = {

    components: {
        Popover, 
        PopoverButton, 
        PopoverPanel, 
        ChevronDownIcon,
        LocationMarkerIcon,
        Slider,
    },

    props: ['propertyTypes', 'isSearchBarInNavbar'],

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
                types: [],
                priceRange: [0, 500]
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
                //the click was outside the specifiedElement, do something
                this.isSearchBarFocused = false;
                // console.log(this.$refs.searchBar)
            }
        },
    },

    mounted() {
        document.addEventListener('click', this.onSearchBarNotFocused);

        // if(!this.isSearchBarInNavbar) {
        //     let searchBarOffsetTop = this.$refs.searchBar.offsetTop;
        //     let searchBarOffsetHeight = this.$refs.searchBar.offsetHeight;
        //     let navBarHeight = document.getElementById('nav-bar').offsetHeight;
        //     let thisVar = this;
    
        //     window.addEventListener(
        //         'scroll', 
        //         _.throttle( function() {
        //             if (window.scrollY >= searchBarOffsetTop + navBarHeight - (window.scrollY) ) {
        //                 thisVar.isScrollYPastSearchBar = true
        //                 // thisVar.$emit('onScrollYPastSearchBar')
        //             } else {
        //                 thisVar.isScrollYPastSearchBar = false
        //                 // thisVar.$emit('onScrollYNotPastSearchBar')
        //             }
        //         }, 600)
        //     );
        // }    
    }   
}

export default searchBarMixin