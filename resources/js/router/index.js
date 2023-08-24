import { createRouter, createWebHistory } from 'vue-router'
import RedirectPage from '../views/RedirectPage.vue'
import store from '../config/vuex/store';


const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import(/* webpackChunkName: "login" */ '../views/auth/LoginPage.vue'),
        meta: {
            requeresAuth: false,
        },
    },
    {
        path: '/sing-up',
        name: 'sing-up',
        component: () => import(/* webpackChunkName: "login" */ '../views/auth/SignUpPage.vue'),
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
        component: () => import(/* webpackChunkName: "dashboard" */ '../views/StatsPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/dashboard/links/create',
        name: 'dashboard.create',
        component: () => import(/* webpackChunkName: "dashboard.links" */ '../views/links/CreateLinkPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/dashboard/links/:slug/edit',
        name: 'dashboard.edit',
        component: () => import(/* webpackChunkName: "dashboard.links" */ '../views/links/EditLinkPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/dashboard/links/:slug/copy',
        name: 'dashboard.copy',
        component: () => import(/* webpackChunkName: "dashboard.links" */ '../views/links/CopyLinkPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/dashboard/links/:slug/details',
        name: 'dashboard.details',
        component: () => import(/* webpackChunkName: "dashboard.links" */ '../views/links/DetailsLinkPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/dashboard/perfil',
        name: 'dashboard.perfil',
        component: () => import(/* webpackChunkName: "dashboard.perfil" */ '../views/perfil/PerfilPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/dashboard/perfil/edit',
        name: 'dashboard.perfil.edit',
        component: () => import(/* webpackChunkName: "dashboard.perfil" */ '../views/perfil/PerfilEditPage.vue'),
        meta: {
            requeresAuth: true,
        },
    },
    {
        path: '/:pathMatch(.*)',
        component: RedirectPage,
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
