
require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import { routes }  from './index';
// import Vuetify from 'vuetify';
import vuetify from '../plugins/vuetify';
// Vue.use(Vuetify);
Vue.use(VueRouter);
// Vue.use(CKEditor);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.prototype.$scrollToTop = () => window.scrollTo(0,0);
const router = new VueRouter({
	// history: true,
    mode: 'hash',
    // mode: 'history',
    routes,
    scrollBehavior() {
        document.getElementById('app').scrollIntoView();
    }
});

const app = new Vue({
	router,
    el: '#app',
    vuetify
    
    // render: h => h(App) //add this new line
});
