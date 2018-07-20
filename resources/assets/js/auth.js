import Vue from 'vue';
import Vuetify from 'vuetify';
import VeeValidate from 'vee-validate'

require('./bootstrap');

window.Popper = require('popper.js').default;
try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

// import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify)
Vue.use(VeeValidate)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
      'example-component': () => import('./components/ExampleComponent.vue' /* webpackChunkName: "js/example-component" */),
      'uploader': () => import('./components/Uploader.vue' /* webpackChunkName: "js/uploader-component" */)
    }
});
