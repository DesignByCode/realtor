
require('./bootstrap');

window.Vue = require('vue');



import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'

const PropgressOptions = {
    color: '#0045ff',
    failedColor: '#f00000',
    thickness: '4px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}


Vue.use(VueProgressBar, PropgressOptions)
Vue.use(VueRouter)




import router from './routes'

window.bus = new Vue()

Vue.filter('json', function (value) {
    return JSON.stringify(value)
})


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
                next({name: 'pagenotfound'})
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
