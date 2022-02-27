
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

        getProfilePictureUrl(user) {
            if(user.profile_picture_path.includes('https://')) return user.profile_picture_path

            return '/storage/' + user.profile_picture_path
        },    

        autoGrowTextarea(element) {
            element.target.style.height = "";
            element.target.style.height = (element.target.scrollHeight) + "px";
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