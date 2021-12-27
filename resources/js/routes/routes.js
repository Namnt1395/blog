import Vue from "vue";
import VueRouter from "vue-router";
import Dashboard from "../views/Dashboard";
import Category from "../views/Category"

Vue.use(VueRouter)
const routes = [
    {path: '/', component: Dashboard, name: 'dashboard', meta: {title: 'Dashboard', visible: true, icon: 'fa-th'}},
    {path: '/category', component: Category, name: 'category', meta: {title: 'Category', visible: true, icon: 'fa-copy'}},
]

export default new VueRouter({
    mode: 'history',
    base: __dirname,
    routes
})
