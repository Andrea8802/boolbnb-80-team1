// import { createRouter, createWebHistory } from 'vue-router';
import { createWebHistory, createRouter } from "vue-router";
import axios from 'axios'
import createApartment from './components/Apartments/CreateApartment.vue';
import userApartments from './components/Apartments/userApartments.vue';
import editApartment from './components/Apartments/editApartment.vue';
import detailApartment from './components/Apartments/detailApartment.vue';
import Home from './components/Home.vue';
// import About from './components/About';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Dashboard from './components/Dashboard.vue';
import Sponsor from './components/Sponsor.vue';
import Message from './components/messageApartment.vue';

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
        path: '/sponsor',
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
        path: '/message',
        component: Message,
        name: 'message',
    },
    {
        path: '/editApartment/:id',
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

    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;