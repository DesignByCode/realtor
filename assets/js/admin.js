
require('./bootstrap');

window.Vue = require('vue');

// Router
import VueRouter from 'vue-router'
import router from './routes'
import { PropgressOptions } from "./progress";
import store from './vuex'

Vue.use(VueRouter)

// Progress
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, PropgressOptions)

window.bus = new Vue()

const luna =  require('luna-sass/Framework/js/luna.js');


window.toastr = require('toastr/toastr.js');
toastr.options.progressBar = true;
toastr.options.timeOut = 1200;
toastr.options.closeButton = true;

const files = require.context('./', true, /\.vue$/i)

files.keys().map(key => {
    return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
});

const app = new Vue({
    el: '#app',
    router,
    store,
    mounted() {
        this.$Progress.finish()
    },
    created() {
        this.$Progress.start()
        this.$router.beforeEach((to, from, next) => {
            //  does the page we want to go to have a meta.progress object
            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress
                // parse meta tags
                this.$Progress.parseMeta(meta)
            }
            //  start the progress bar
            this.$Progress.start()
            //  continue to next page
            if (!to.matched.length) {
                next({name: 'page404'})

            }else {
                next()
            }
        })
        this.$router.afterEach((to, from) => {
            //  finish the progress bar
            this.$Progress.finish()
        })
    }
});

(function($, window, document){

    'use strict';

    $(document).Luna();
    
})(jQuery, window, document);
