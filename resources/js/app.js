
import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import createApartment from './components/Apartments/CreateApartment.vue';
import userApartments from './components/Apartments/userApartments.vue';
import editApartment from './components/Apartments/editApartment.vue';
import home from './components/Home.vue';

app.component('component-apartment', createApartment);
app.component('component-userapartments', userApartments);
app.component('component-editapartment', editApartment);
app.component('component-home', home);

import { router } from './router';

app.use(router).mount('#app');
