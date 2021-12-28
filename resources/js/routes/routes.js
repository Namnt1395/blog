import Vue from "vue";
import VueRouter from "vue-router";
import Dashboard from "../views/Dashboard";
// import Category from "../views/Category"
import CategoryNew from "../views/CategoryNew"
import Category from "../views/category/Category"
import ListCategory from "../views/category/List"
import CategoryCreate from "../views/category/Create";

Vue.use(VueRouter)

const Moderate = {
    template: `
    <transition name="fade-in" mode="out-in">
        <router-view></router-view>
    </transition>
  `
}

const routes = [
    {
        path: '/', component: Dashboard, name: 'dashboard', meta: {title: 'Dashboard', visible: true, icon: 'fa-th'},
    },
    {
        path: '/category',
        component: Category,
        name: 'category',
        redirect: 'category',
        meta: {title: 'Category', visible: true, icon: 'fa-copy'},
        children: [
            {
                path: 'create', component: CategoryCreate, name: 'category.create',
                meta: {
                    title: 'Create',
                    visible: true,
                }
            },
            {
                path: '', component: ListCategory, name: 'category.list',
            }
        ]
    },
]

export default new VueRouter({
    mode: 'history',
    base: __dirname,
    routes
})
