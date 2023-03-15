
// import './bootstrap';
// import { createApp } from 'vue';

// const app = createApp({});

//  import createApartment from './components/Apartments/CreateApartment.vue';
//  import userApartments from './components/Apartments/userApartments.vue';
//  import editApartment from './components/Apartments/editApartment.vue';
//  import home from './components/Home.vue';

//  app.component('component-apartment', createApartment);
//  app.component('component-userapartments', userApartments);
//  app.component('component-editapartment', editApartment);
//  app.component('component-home', home);

// import routes from './router';

// app.use(routes).mount('#app');

//  require('./bootstrap');

// window.Vue = require('vue');

// import VueRouter from 'vue-router';
// import * as vueRouter from 'vue-router'
// import routes from './router.js';

// Vue.use(VueRouter);

// const app = new Vue({
//     el: '#app',
//     router: new VueRouter(routes)
// });


// window.Vue = require('vue');

// import routes from './router';

// Vue.use(VueRouter);


import Dashboard from './components/Dashboard.vue';

import { createApp } from 'vue'
import router from './router' // <---

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(fas, far, fab)

const app = ({
    el: '#app',
    router: router,
    components: {
        "component-dashboard": Dashboard,
    }
});
createApp(app).use(router).component('font-awesome-icon', FontAwesomeIcon).mount('#app')