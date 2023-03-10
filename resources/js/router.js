import { createRouter, createWebHistory } from 'vue-router';
import createApartment from './components/Apartments/CreateApartment.vue';
import userApartments from './components/Apartments/userApartments.vue';
import editApartment from './components/Apartments/editApartment.vue';
import home from './components/Home.vue';
import welcomeMain from './components/welcome_components/welcomeMain.vue';
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/home',
            name: 'home',
            component: home,

        },
        {
            path: '/apartment',
            name: 'userApartments',
            component: userApartments,

        },
        {
            path: '/editApartment/:id',
            name: 'editApartment',
            component: editApartment,

        },
        {
            path: '/',
            name: 'welcome',
            component: welcomeMain,
        }
    ]
});
export { router };