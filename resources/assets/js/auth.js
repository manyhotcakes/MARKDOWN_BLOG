import Vue from 'vue';
import Vuetify from 'vuetify';
import VeeValidate from 'vee-validate'
import marked from './plugins/marked'
import axios from './plugins/axios'
import lodash from './plugins/lodash'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

Vue.use(Vuetify)
Vue.use(VeeValidate)
Vue.use(marked)
Vue.use(axios)
Vue.use(lodash)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: {
      'uploadfooter': () => import('./components/Uploadfooter.vue' /* webpackChunkName: "js/uploader-component" */),
      'article-list': () => import('./components/ArticleList.vue' /* webpackChunkName: "js/article-list" */),
    }
});
