
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// import Vue from 'vue'

window.EventBus = new Vue();

import Toasted from 'vue-toasted';
Vue.use(Toasted)

import auth from './Auth/authorization'
window.Auth = auth

import Exception from './Auth/Exception'
window.Exception = Exception

import Vuetify from 'vuetify'
Vue.use(Vuetify)

var MarkdownIt = require('markdown-it')
window.md = new MarkdownIt();

import VueSimplemde from 'vue-simplemde'
Vue.use(VueSimplemde)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app-home', require('./components/AppHome.vue'));
import router from './components/routes/routes';

const app = new Vue({
    el: '#app',
    router: router,
});
