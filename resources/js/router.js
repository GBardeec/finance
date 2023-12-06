import { createWebHistory, createRouter } from 'vue-router';

const routes = [
    {
        path: '/',
        component: () => import('./components/finance/Index.vue'),
        name: 'finance.index'
    },
    {
        path: '/login',
        component: () => import('./components/auth/Index.vue'),
        name: 'auth.index'
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token");

    if (!token) {
        if (to.name !== 'auth.index') {
            return next({ name: 'auth.index' });
        }
    } else {
        if (to.name === 'auth.index') {
            return next({ name: 'finance.index' });
        }
    }

    next();
});




export default router;
