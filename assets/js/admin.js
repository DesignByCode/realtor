
require('./bootstrap');

// window.Dropzone = require('dropzone');
// Dropzone.autoDiscover = false;

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

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css'


Vue.use(VueProgressBar, PropgressOptions)
Vue.use(VueRouter)
Vue.use(Loading)



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

    // let inputs = $('.form__item__v2')
    //
    // inputs.focusout(function(e) {
    //     let self = $(this)
    //     console.log(self)
    //     labelMove(self)
    // })
    // setTimeout(function() {
    //     inputs.each(function (i, input) {
    //
    //         labelMove($(input))
    //     })
    // },500)
    //
    // function labelMove(input) {
    //     ( input.val() === '') ? input.removeClass('not__empty') : input.addClass('not__empty')
    // }



})(jQuery, window, document);
