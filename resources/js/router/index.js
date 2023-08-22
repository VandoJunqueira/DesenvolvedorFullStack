import { createRouter, createWebHistory } from 'vue-router'
import NotFound from '../views/NotFound.vue'


const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import(/* webpackChunkName: "home" */ '../views/HomePage.vue'),
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import(/* webpackChunkName: "dashboard" */ '../views/DashboardPage.vue'),
    },
    {
        path: '/dashboard/deleted',
        name: 'dashboard.deleted',
        component: () => import(/* webpackChunkName: "dashboard" */ '../views/DashboardPage.vue'),
    },
    {
        path: '/dashboard/stats',
        name: 'dashboard.stats',
        component: () => import(/* webpackChunkName: "dashboard.stats" */ '../views/StatsPage.vue'),
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

/* router.beforeEach((to, from, next) => {

    const requiresAuth = to.meta.requeresAuth;
    const nivel = to.meta.nivel ?? null;
    const isAuthenticated = localStorage.user ?? false

    if (requiresAuth && !isAuthenticated) {
        next('entrar');
    } else {
        if (isAuthenticated) {
            let user = JSON.parse(localStorage.user)
            if (user.nivel > nivel && nivel != null) {
                next('403');
            } else {
                next();
            }
        } else {
            next();
        }

    }
}); */

export default router
