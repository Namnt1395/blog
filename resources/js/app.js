import './bootstrap';
import Vue from "vue";
import router from "./routes/routes";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import VueRouter from 'vue-router';
import SideMenu from "./components/SideMenu";
Vue.use(VueRouter);
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


Vue.component('side-menu', SideMenu)

const app = new Vue({
    router,
    el: '#app'
});
