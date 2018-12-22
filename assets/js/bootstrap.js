import jquery from "jquery";

import axios0 from "axios";

window._ = require("lodash");


try {
    window.$ = window.jQuery = jquery;
} catch (e) {}


window.axios = axios0;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

const appurl = document.head.querySelector('meta[name="app-url"]');
window.appurl = appurl.content;

const user = document.head.querySelector('meta[name="user"]');
window.user = user;

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
