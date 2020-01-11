
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Fingerprint2 = require("fingerprintjs2");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('order-form', require('./components/OrderForm.vue'));
Vue.component('vote-form', require('./components/VoteForm.vue'));
Vue.component('chart', require('./components/Chart.vue'));
Vue.component('time-zone', require('./components/Time.vue'));

const app = new Vue({
    el: '#app'
});
