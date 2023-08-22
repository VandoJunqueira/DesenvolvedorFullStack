import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '@/views/HomePage.vue'


const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import(/* webpackChunkName: "home" */ '../views/HomePage.vue'),
    },
]

const router = createRouter({
    history: createWebHistory('http://localhost/'),
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
