import { createRouter, createWebHistory } from 'vue-router'
import NotFound from '../views/NotFound.vue'
import store from '../config/vuex/store';


const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import(/* webpackChunkName: "login" */ '../views/LoginPage.vue'),
        meta: {
            requeresAuth: false,
        },
    },
    {
        path: '/sing-up',
        name: 'sing-up',
        component: () => import(/* webpackChunkName: "login" */ '../views/SignUpPage.vue'),
        meta: {
            requeresAuth: false,
        },
    },
    {
        path: '/',
        name: 'home',
        component: () => import(/* webpackChunkName: "home" */ '../views/HomePage.vue'),
        meta: {
            requeresAuth: false,
        },
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import(/* webpackChunkName: "dashboard" */ '../views/DashboardPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/dashboard/deleted',
        name: 'dashboard.deleted',
        component: () => import(/* webpackChunkName: "dashboard" */ '../views/DashboardPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/dashboard/stats',
        name: 'dashboard.stats',
        component: () => import(/* webpackChunkName: "dashboard.stats" */ '../views/StatsPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/:pathMatch(.*)',
        component: NotFound,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {

    console.log(to.meta.requeresAuth)

    if (to.meta.requeresAuth && store.state.auth.login == null) {
        next({ name: 'login' });
    } else if (!to.meta.requeresAuth && !store.state.auth.login) {
        next();
    } else {
        next();
    }

    window.scrollTo(0, 0);
});

export default router
