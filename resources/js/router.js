// import { createRouter, createWebHistory } from 'vue-router';
import { createWebHistory, createRouter } from "vue-router";
import axios from 'axios'
import createApartment from './components/Apartments/CreateApartment.vue';
import userApartments from './components/Apartments/userApartments.vue';
import editApartment from './components/Apartments/editApartment.vue';
// import home from './components/Home.vue';
// const router = createRouter({
//     history: createWebHistory(),
//     routes: [
//         {
//             path: '/home',
//             name: 'home',
//             component: home,

//         },
//         {
//             path: '/apartment',
//             name: 'userApartments',
//             component: userApartments,

//         },
//         {
//             path: '/editApartment/:id',
//             name: 'editApartment',
//             component: editApartment,

//         },
//     ]
// });
// export { router };

import Home from './components/Home.vue';
// import About from './components/About';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Dashboard from './components/Dashboard.vue';
// import NotFound from './components/NotFound';


// export default {
//     mode: 'history',
//     linkActiveClass: 'font-semibold',
//     routes: [

//         {
//             path: '/',
//             component: Home,
//             name: "Home"
//         },
//         {
//             path: '/apartment',
//             name: 'userApartments',
//             component: userApartments,
//             beforeEnter: (to, form, next) => {
//                 axios.get('/api/athenticated').then(() => {
//                     next()
//                 }).catch(() => {
//                     return next({ name: 'Login' })
//                 })
//             }

//         },
//         {
//             path: '/register',
//             component: Register
//         },
//         {
//             path: '/login',
//             component: Login,
//             name: 'Login'
//         },
//         {
//             path: "/dashboard",
//             name: "Dashboard",
//             component: Dashboard,
//             beforeEnter: (to, form, next) => {
//                 axios.get('/api/athenticated').then(() => {
//                     next()
//                 }).catch(() => {
//                     return next({ name: 'Login' })
//                 })
//             }

//         }

//     ]
// }
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