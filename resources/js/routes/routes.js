import Vue from "vue";
import VueRouter from "vue-router";
import Dashboard from "../views/Dashboard";
import AdTag from "../views/AdTag"

Vue.use(VueRouter)
const routes = [
    {path: '/', component: Dashboard, name: 'dashboard', meta: {title: 'Dashboard', visible: true, icon: 'fa-th'}},
    {path: '/ad-tag', component: AdTag, name: 'ad-tag', meta: {title: 'AdTag', visible: true, icon: 'fa-copy'}},
]

export default new VueRouter({
    mode: 'history',
    base: __dirname,
    routes
})
