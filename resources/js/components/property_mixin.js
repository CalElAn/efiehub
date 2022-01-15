
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/lazy'
import "swiper/css/thumbs"
import "swiper/css/free-mode"
import "swiper/css/scrollbar"

// import Swiper core and required modules
import SwiperCore, { Navigation, Pagination, Lazy, Thumbs, FreeMode, Scrollbar } from 'swiper';

// install Swiper modules
SwiperCore.use([Navigation, Pagination, Lazy, Thumbs, FreeMode, Scrollbar]);

import { StarIcon, HeartIcon, ShareIcon, LocationMarkerIcon } from '@heroicons/vue/solid'


const propertyMixin = {
    components: {
        Swiper,
        SwiperSlide,
        StarIcon,
        HeartIcon,
        ShareIcon,
        LocationMarkerIcon
    },

    props: ['property', 'isUserAuthenticated', 'authenticatedUser'],

    emits: ['showLogInModal', 'unfavouriteProperty', 'favouriteProperty'],

    methods: {
        favouriteProperty() {

            if (!this.isUserAuthenticated) {

                this.$emit('showLogInModal', {showWelcomeText: true, welcomeText: 'Kindly login to add to favourites, or'})
                return
            }

            axios.post('/favourite-property', { 'propertyId': this.property.property_id,})
            .then( (response) => {
                if( response.status === 200 ) { 

                    this.$emit('unfavouriteProperty', this.property.property_id)
                }

                if( response.status === 201 ) { 

                    this.$notify({ type: "success", text: "Added to favourites!" });
                    this.$emit('favouriteProperty', response.data)
                }
            })
            .catch( (error) => {
                console.log(error)
            })  
        },

        shareProperty() {
            this.$vfm.show('SharePropertyModal', this.property)
        },
    },

    computed: {
        isPropertyFavouritedByUser() {
            return !!( this.authenticatedUser?.favourite_properties?.find( obj => obj.property_id === this.property.property_id) )
        },

        propertyReviews() {
            if(!this.property.reviews[0]) return {count: 0, average: 0}

            return {
                count: Object.keys(this.property?.reviews).length, 
                average: Math.round((Object.values(this.property?.reviews).reduce((a, b) => a + parseFloat(b.rating), 0) / Object.keys(this.property?.reviews).length)*100)/100
            }
        },

        numberOfBedroomsAndBathrooms() {

            if( this.property?.features?.find(obj => obj.feature == 'Number of bedrooms') 
                && this.property?.features?.find(obj => obj.feature == 'Number of bathrooms') ) {

                return {
                    exists: true,
                    numberOfBedrooms: this.property?.features?.find(obj => obj.feature == 'Number of bedrooms')?.pivot?.number,
                    numberOfBathrooms: this.property?.features?.find(obj => obj.feature == 'Number of bathrooms')?.pivot?.number
                }
            }

            return {
                exists: false,
            }
        }
    }
}

export default propertyMixin