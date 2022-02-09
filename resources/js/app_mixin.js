
const app_mixin = {

    data() {
        return {
            isUserAuthenticated: isUserAuthenticatedVar,
            authenticatedUser: authenticatedUserVar,

            isInHomepage: window.location.pathname === '/',
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
    }
} 

export default app_mixin