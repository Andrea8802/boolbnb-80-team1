// import { createRouter, createWebHistory } from 'vue-router';
import { createWebHistory, createRouter } from "vue-router";
import axios from 'axios'
import createApartment from './components/Apartments/CreateApartment.vue';
import userApartments from './components/Apartments/userApartments.vue';
import editApartment from './components/Apartments/editApartment.vue';
import detailApartment from './components/Apartments/detailApartment.vue';
import advancedSearch from './components/Apartments/advancedSearch.vue';
import Home from './components/Home.vue';
// import About from './components/About';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Dashboard from './components/Dashboard.vue';
import Sponsor from './components/Sponsor.vue';
import Payment from './components/Payment.vue';
import Message from './components/messageApartment.vue';
import viewMessages from './components/viewMessages.vue';
import ChartStatistics from './components/ChartStatistics.vue';

const routes = [
    {
        path: '/',
        component: Home,
        name: "Home"
    },
    {
        path: '/userApartments',
        name: 'userApartments',
        component: userApartments,
        beforeEnter: (to, form, next) => {
            axios.get('/api/athenticated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        }

    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/login',
        component: Login,
        name: 'Login'
    },
    {
        path: '/payment/:id/:sponsor',
        component: Payment,
        name: 'payment',
        beforeEnter: (to, form, next) => {
            axios.get('/api/athenticated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        }
    },
    {
        path: '/create',
        component: createApartment,
        name: 'createApartment',
        beforeEnter: (to, form, next) => {
            axios.get('/api/athenticated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        }
    },
    {
        path: '/sponsor/:id',
        component: Sponsor,
        name: 'sponsor',
        beforeEnter: (to, form, next) => {
            axios.get('/api/athenticated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        }
    },
    {
        path: '/message/:id',
        name: 'message',
        component: Message,
    },
    {
        path: '/edit-apartment/:id',
        name: 'editApartment',
        component: editApartment,
        beforeEnter: (to, form, next) => {
            axios.get('/api/athenticated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        }
    },
    {
        path: '/detailApartment/:id',
        name: 'detailApartment',
        component: detailApartment,
    },
    {
        path: '/viewMessages/:id',
        name: 'viewMessages',
        component: viewMessages,
        beforeEnter: (to, form, next) => {
            axios.get('/api/athenticated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        }
    },
    {
        path: '/advancedSearch',
        name: 'advancedSearch',
        component: advancedSearch,
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
        beforeEnter: (to, form, next) => {
            axios.get('/api/athenticated').then(() => {
                next()
            }).catch(() => {
                return next({ name: 'Login' })
            })
        }

    },
    {
        path: '/chartStatistics',
        name: 'chartStatistics',
        component: ChartStatistics,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;