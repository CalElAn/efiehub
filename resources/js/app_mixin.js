
const app_mixin = {

    data() {
        return {
            isInHomepage: window.location.pathname === '/',
            toast: '',
        }
    },

    methods: {
        serialize(obj, prefix) {
            var str = [], p;

            for (p in obj) {
                if (obj.hasOwnProperty(p)) {
                    var k = prefix ? prefix + "[" + p + "]" : p,
                    v = obj[p];
                    str.push((v !== null && typeof v === "object") ?
                    this.serialize(v, k) :
                    encodeURIComponent(k) + "=" + encodeURIComponent(v));
                }
            }
            return str.join("&");
        },

        getReviewsAverageAndCount(reviewsData) {
            if(!reviewsData?.[0]) return {count: 0, average: 0}

            return {
                count: Object.keys(reviewsData)?.length, 
                average: Math.round((Object.values(reviewsData).reduce((a, b) => a + parseFloat(b.rating), 0) / Object.keys(reviewsData)?.length)*100)/100
            }
        },

    },

    mounted() {
        this.toast = this.$swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
              popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', this.$swal.stopTimer)
                toast.addEventListener('mouseleave', this.$swal.resumeTimer)
            }
        })
    },
} 

export default app_mixin