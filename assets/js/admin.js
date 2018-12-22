import bootstrap from "./bootstrap";

window.Vue = vue;

// Router
import VueRouter from "vue-router";
import router from "./routes";
import { ProgressOptions } from "./progress";
import store from "./vuex";
import localforage from "localforage";

localforage.config({
    driver: localforage.LOCALSTORAGE,
    storeName: `design_by_code`
});

Vue.use(VueRouter);

// Progress
import VueProgressBar from "vue-progressbar";
import vue from "vue";

import luna_sass from "luna-sass/Framework/js/luna.js";

import toastr0 from "toastr/toastr.js";

Vue.use(VueProgressBar, ProgressOptions);

window.bus = new Vue();
window.toastr = toastr0;
toastr.options.progressBar = true;
toastr.options.timeOut = 1200;
toastr.options.closeButton = true;

const files = require.context("./", true, /\.vue$/i);

files.keys().map(key => {
    return Vue.component(_.last(key.split("/")).split(".")[0], files(key))
});

const app = new Vue({
    el: "#app",
    router,
    store,
    mounted() {
        this.$Progress.finish()
    },
    created() {
        this.$Progress.start();
        this.$router.beforeEach((to, from, next) => {

            store.dispatch("auth/checkTokenExists").then(() => {
                if (to.meta.guest) {
                    next({ name: "admin"})
                    return
                }
                next()
            }).catch( () => {

                if (to.meta.needsAuth) {
                    localforage.setItem("intended", to.name);
                    next({ name: "login"});
                    return
                }
                next()
            });

            //  does the page we want to go to have a meta.progress object
            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress;
                // parse meta tags
                this.$Progress.parseMeta(meta)
            }
            //  start the progress bar
            this.$Progress.start();
            //  continue to next page
            if (!to.matched.length) {
                next({name: "page404"})

            }else {
                next()
            }
        });
        this.$router.afterEach((to, from) => {
            //  finish the progress bar
            this.$Progress.finish()
        })
    }
});




store.dispatch("auth/setToken").then( () => {
    store.dispatch("auth/fetchUser").catch( () => {
        store.dispatch("auth/clearAuth");
        router.replace({name: "login"});
    })
}).catch(() => {
    store.dispatch("auth/clearAuth");
});




(function($, window, document){

    "use strict";

    $(document).Luna();

})(jQuery, window, document);
